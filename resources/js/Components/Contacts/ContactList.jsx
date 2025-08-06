export default function ContactList({contact}) {
    return (
        <li className = 'pl-5 py-5'>
            <a href={route('contact.show', contact.id)}>
                {contact.last_name}, {contact.first_name}
            </a>
        </li>
    );
}