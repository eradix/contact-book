import { Link } from '@inertiajs/react';

export default function ContactInfo({contact}) {
    return (
        <div className="p-5">
            <p className="my-3">
                <span className="font-bold">First name: </span>
                {contact.first_name}
            </p>
            <p className="my-3">
                <span className="font-bold">Last name: </span>
                {contact.last_name}
            </p>
            <p className="my-3">
                <span className="font-bold">Email: </span>
                {contact.email}
            </p>
            <p className="my-3">
                <span className="font-bold">Phone: </span>
                {contact.phone}
            </p>
            <p className="my-3">
                <span className="font-bold">Address: </span>
                {contact.address}
            </p>
            <Link href={route('dashboard')} className='bg-gray-200 px-5 py-2 rounded-lg'>Back</Link>
        </div>
    );
}