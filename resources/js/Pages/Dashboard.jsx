import ContactList from '@/Components/Contacts/ContactList';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import axios from 'axios';
import saveAs from 'file-saver';

export default function Dashboard({contacts}) {
    const downloadPdf = async () => {
        try {
            const response = await axios.get(route('contact.pdf'), {
            responseType: 'blob',
            });
            saveAs(response.data, 'contacts.pdf');
        } catch (error) {
            console.error('PDF download failed:', error);
        }
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 text-xl font-bold">
                            All Contacts
                        </div>
                        <button onClick={downloadPdf} className='bg-gray-200 px-5 py-2 rounded-lg'>
                            Export PDF
                        </button>

                        <ul>
                            {contacts.data?.length > 0 && contacts.data.map((contact) => (
                                <ContactList key={contact.id} contact={contact} />
                            ))}
                        </ul>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
