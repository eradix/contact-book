import ContactList from '@/Components/Contacts/ContactList';
import MessageModal from '@/Components/MessageModal';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import axios from 'axios';
import saveAs from 'file-saver';
import { useState } from "react";

export default function Dashboard({contacts, user_id}) {
    const [modalData, setModalData] = useState({ show: false, title: "", message: "" });

    const downloadPdf = async () => {
        try {
            const response = await axios.get(route('contact.pdf', user_id), {
            responseType: 'blob',
            });
            saveAs(response.data, 'contacts.pdf');
        } catch (err) {
            if (err.response) {
                // Convert the Blob back to text, then parse JSON
                const reader = new FileReader();
                reader.onload = () => {
                    try {
                        const errorData = JSON.parse(reader.result);
                        setModalData({
                            show: true,
                            title: err.response.status === 403 ? "Error 403. Access Denied" : "Error 404. Not Found",
                            message: errorData.error
                        });
                    } catch (e) {
                        console.error("Could not parse error response", e);
                    }
                };
                reader.readAsText(err.response.data);
            }
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

            <MessageModal
                show={modalData.show}
                title={modalData.title}
                message={modalData.message}
                onClose={() => setModalData({ ...modalData, show: false })}
            />
        </AuthenticatedLayout>
    );
}
