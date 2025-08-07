<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Exports\ContactsExport;
use App\Service\ContactService;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Auth\MustVerifyEmail;

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
            'contacts' => $this->contactService->index()
        ]);
    }

    public function show(Contact $contact)
    {
        if ($contact->user->id !== auth()->user()->id) {
            abort(403, 'You don\'t have access to this contact.');
        }
        return Inertia::render('Contact', [
            'contact' => $contact,
            'username' => $contact->user->name
        ]);
    }
    public function exportExcel()
    {
        return Excel::download(new ContactsExport, 'contacts.xlsx');
    }

    public function exportPdf()
    {
        $contacts = Contact::all();
        $pdf = Pdf::loadView('Pdf.contacts', compact('contacts'));
        return $pdf->download('contacts.pdf');
    }
}
