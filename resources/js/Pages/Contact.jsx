import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Contact({contact, username}) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Contact Info
                </h2>
            }
        >
            <Head title="Contact" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 text-xl font-bold">
                            {contact.first_name} {contact.last_name} Contact
                            <blockquote className='text-sm text-gray-500'>{username}</blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
