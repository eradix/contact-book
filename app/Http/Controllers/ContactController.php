<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Service\ContactService;
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
}
