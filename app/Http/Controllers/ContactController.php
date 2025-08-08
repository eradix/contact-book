<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Exports\ContactsExport;
use App\Service\ContactService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Auth\Access\AuthorizationException;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContactController extends Controller
{

    private $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }
    public function index()
    {   
        return Inertia::render('Dashboard', [
            'contacts' => $this->contactService->index(),
            'user_id' => auth()->user()->id
        ]);
    }

    public function show(Contact $contact)
    {
        // Todo fix this next week
        // if (! $this->contactService->isUserHasAccessToContacts($contact->user->id)) {
        //     abort(403, 'You don\'t have access to this contact.');
        // }
        return Inertia::render('Contact', [
            'contact' => $contact,
            'username' => $contact->user->name
        ]);
    }
    public function exportExcel()
    {
        return Excel::download(new ContactsExport, 'contacts.xlsx');
    }

    public function exportPdf($userId)
    {
        try{
            $user = User::findOrFail($userId);
            $this->contactService->validateUserAccessToContacts($user);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Contact not found.'], 404);
        } catch (AuthorizationException $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }
        $pdf = Pdf::loadView('Pdf.contacts', [
            'contacts' => $user->contacts
        ]);
        return $pdf->download('contacts.pdf');
    }
}
