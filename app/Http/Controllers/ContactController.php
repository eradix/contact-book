<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Service\ContactService;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ContactController extends Controller
{
    public function index(ContactService $contactService, Request $request)
    {   
        return Inertia::render('Dashboard', [
            'contacts' => $contactService->index(),
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
}
