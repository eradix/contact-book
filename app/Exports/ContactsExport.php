<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContactsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Contact::select('first_name', 'last_name', 'email', 'phone', 'address')->get();
    }

    public function headings(): array
    {
        return [
            'First name',
            'Last name',
            'Email',
            'Phone',
            'Address'
        ];
    }
}

