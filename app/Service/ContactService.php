<?php

namespace App\Service;

use App\Http\Resources\ContactResource;
use App\Models\Contact;

class ContactService
{
    public function index()
    {
        return Contact::with('user')
            ->where('user_id', auth()->id())
            ->orderBy('last_name')
            ->paginate(10);
    }
}