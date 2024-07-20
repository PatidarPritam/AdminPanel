<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modal.css') }}" rel="stylesheet"> <!-- Link to the new modal CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Employee CRUD Table</title>
</head>
<body>
    <h1>Employee Table</h1>
   
    <button id="open-add-modal" class="btn btn-primary">Add Employee</button>
    <button class="logout"><a href="{{url('logout')}}">Logout</a></button>

    <!-- Add Employee Modal -->
    <div id="add-modal" class="modal">
        <div class="modal-content">
            <span class="close" id="close-add-modal">&times;</span>
            <h2>Add Employee</h2>
            <form id="add-employee-form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="add-firstName">First Name:</label>
                    <input type="text" id="add-firstName" name="firstName" placeholder="Enter name here" required>
                </div>
                <div class="form-group">
                    <label for="add-lastName">Last Name:</label>
                    <input type="text" id="add-lastName" name="lastName" placeholder="Enter last here" required>
                </div>
                <div class="form-group">
                    <label for="add-email">Email:</label>
                    <input type="email" id="add-email" name="email" placeholder="Enter email here" required>
                </div>
                <div class="form-group">
                    <label for="add-address">Address:</label>
                    <input type="text" id="add-address" name="address" placeholder="Enter address here" required>
                </div>
                <div class="form-group">
                    <label for="add-phone">Phone:</label>
                    <input type="tel" id="add-phone" name="phone" placeholder="Enter phone number here" required>
                </div>
                <div class="form-group">
                    <label for="add-image">Image:</label>
                    <input type="file" id="add-image" name="image">
                </div>
                <button type="submit">Submit</button>
                <!-- <button type="button" id="close-add-modal">Cancel</button> -->
            </form>
        </div>
    </div>

    <table id="employee-table">
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
                <tr data-id="{{ $employee->id }}">
                    <td>
                        @if($employee->img)
                            <img src="{{ asset('storage/' . $employee->img) }}" alt="Employee Image" style="width:100px;height:auto;">
                        @else
                            <img src="images/default.jpg" alt="Default Image">
                        @endif
                    </td>
                    <td>{{ $employee->firstName }}</td>
                    <td>{{ $employee->lastName }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>
                        <button class="edit-button" data-id="{{ $employee->id }}">Edit</button>
                        <button class="delete-button" data-id="{{ $employee->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Edit Employee Modal -->
    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <span class="close" id="close-edit-modal">&times;</span>
            <h2>Edit Employee</h2>
            <form id="edit-employee-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit-id" name="id">
                <div class="form-group">
                    <label for="edit-firstName">First Name:</label>
                    <input type="text" id="edit-firstName" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="edit-lastName">Last Name:</label>
                    <input type="text" id="edit-lastName" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="edit-email">Email:</label>
                    <input type="email" id="edit-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="edit-address">Address:</label>
                    <input type="text" id="edit-address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="edit-phone">Phone:</label>
                    <input type="tel" id="edit-phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="edit-image">Image:</label>
                    <input type="file" id="edit-image" name="image">
                </div>
                <button type="submit">Update</button>
                <!-- <button type="button" id="close-edit-modal">Cancel</button> -->
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Setup CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Open add modal
            $('#open-add-modal').on('click', function() {
                $('#add-modal').show();
            });

            // Close add modal
            $('#close-add-modal').on('click', function() {
                $('#add-modal').hide();
            });

            // Handle add form submission
            $('#add-employee-form').on('submit', function(event) {
                event.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: '{{ route("addEmployee") }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#add-modal').hide();
                        let employee = response.employee;
                        $('#employee-table tbody').append(`
                            <tr data-id="${employee.id}">
                                <td><img src="/storage/${employee.img}" alt="Employee Image" style="width:100px;height:auto;"></td>
                                <td>${employee.firstName}</td>
                                <td>${employee.lastName}</td>
                                <td>${employee.email}</td>
                                <td>${employee.address}</td>
                                <td>${employee.phone}</td>
                                <td>
                                    <button class="edit-button" data-id="${employee.id}">Edit</button>
                                    <button class="delete-button" data-id="${employee.id}">Delete</button>
                                </td>
                            </tr>
                        `);
                    },
                    error: function(response) {
                        alert("Failed to add employee because the email or password already exists.");
                    }
                });
            });

            // Open edit modal
            $('#employee-table').on('click', '.edit-button', function() {
                let id = $(this).data('id');

                $.ajax({
                    url: '{{ route("edit", ":id") }}'.replace(':id', id),
                    method: 'GET',
                    success: function(response) {
                        let employee = response.employee;
                        $('#edit-id').val(employee.id);
                        $('#edit-firstName').val(employee.firstName);
                        $('#edit-lastName').val(employee.lastName);
                        $('#edit-email').val(employee.email);
                        $('#edit-address').val(employee.address);
                        $('#edit-phone').val(employee.phone);
                        $('#edit-modal').show();
                    },
                    error: function(response) {
                        alert('Failed to retrieve employee details.');
                    }
                });
            });

            // Close edit modal
            $('#close-edit-modal').on('click', function() {
                $('#edit-modal').hide();
            });

            // Handle edit form submission
            $('#edit-employee-form').on('submit', function(event) {
                event.preventDefault();
                let formData = new FormData(this);
                let id = $('#edit-id').val();

                $.ajax({
                    url: '{{ route("update", ":id") }}'.replace(':id', id),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#edit-modal').hide();
                        let employee = response.employee;
                        let row = $(`#employee-table tbody tr[data-id="${employee.id}"]`);
                        row.find('td:eq(0) img').attr('src', `/storage/${employee.img}`);
                        row.find('td:eq(1)').text(employee.firstName);
                        row.find('td:eq(2)').text(employee.lastName);
                        row.find('td:eq(3)').text(employee.email);
                        row.find('td:eq(4)').text(employee.address);
                        row.find('td:eq(5)').text(employee.phone);
                    },
                    error: function(response) {
                        alert('Failed to update employee.');
                    }
                });
            });

            // Handle delete button
            $('#employee-table').on('click', '.delete-button', function() {
                let id = $(this).data('id');

                if (confirm('Are you sure you want to delete this employee?')) {
                    $.ajax({
                        url: '{{ route("delete", ":id") }}'.replace(':id', id),
                        method: 'DELETE',
                        success: function(response) {
                            $(`#employee-table tbody tr[data-id="${id}"]`).remove();
                        },
                        error: function(response) {
                            alert('Failed to delete employee.');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
