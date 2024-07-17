<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/UserDashboard.css') }}" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
    <div class="user-panel">
        <h1>Dashboard</h1>
        
        @if ($student)
            <div class="user-info">
                <h2>Welcome, {{ $student->name }}</h2>
            </div>
            <div class="user-data">
                <table border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->address }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <p class="no-data">No student data found.</p>
        @endif
    </div>
</body>
</html>