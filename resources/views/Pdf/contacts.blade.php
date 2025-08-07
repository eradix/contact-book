<!DOCTYPE html>
<html>
<head>
    <title>Contacts PDF</title>
</head>
<body>
    <h1>Contact List</h1>
    <p>By: {{ auth()->user()->name }}</p>
    <table class="table-auto">
        <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->first_name }}</td>
                    <td>{{ $contact->last_name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>