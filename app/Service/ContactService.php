<?php

namespace App\Service;

use App\Models\User;
use App\Models\Contact;
use App\Http\Resources\ContactResource;
use Illuminate\Auth\Access\AuthorizationException;

class ContactService
{
    public function index()
    {
        return Contact::with('user')
            ->where('user_id', auth()->user()->id)
            ->orderBy('last_name')
            ->paginate(10);
    }
    public function validateUserAccessToContacts(User $user)
    {
        if ($user->id !== auth()->user()->id) {
            throw new AuthorizationException('You are not authorized to process or view this contact.');
        }
    }
}