<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
    <title>Employee CRUD Table</title>
</head>
<body>

    <h1>Employee Table</h1>
    <a href="{{ url('add') }}" class="btn btn-primary">Add Employee</a>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>
                        @if($employee->img)
                        
                            <img src="{{ asset('storage/' . $employee->img) }}" alt="Employee Image">
                        @else
                            <img src="images/default.jpg" alt="Default Image">
                        @endif
                    </td>
                    <!-- <td>{{$employee->img}}</td> -->
                  
                    <td>{{ $employee->firstName }}</td>
                    <td>{{ $employee->lastName }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->phone }}</td>

                    <td>
                        <a href="{{ url('edit/' . $employee->id) }}">
                            <button class="edit-button">Edit</button>
                        </a>
                        <form action="{{ url('delete/' . $employee->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
