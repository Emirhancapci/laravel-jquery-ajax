<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Client</h5>

            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="clientId" name="id">
                    <div class="mb-3">
                        <label for="editFname" class="form-label">First name:</label>
                        <input type="text" id="editFname" name="first_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editLname" class="form-label">Last name:</label>
                        <input type="text" id="editLname" name="last_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editImage" class="form-label">Image:</label>
                        <input type="file" id="editImage" name="image" accept="image/*" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary updateBtn">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Client</h5>
            </div>
            <div class="modal-body">
                <form method="POST" id="saveForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="fname" class="form-label">First name:</label>
                        <input type="text" id="fname" name="first_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="lname" class="form-label">Last name:</label>
                        <input type="text" id="lname" name="last_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image:</label>
                        <input type="file" id="image" name="image" accept="image/*" class="form-control">
                        <img id="imagePreview" src="#" alt="Image preview" class="img-thumbnail mt-2" style="display:none;">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save_customer">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="header">
        <h2>CLIENTS</h2>
        <a class="button" href="#" data-toggle="modal" data-target="#exampleModal">Create Client</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        @foreach($client_lists as $list)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $list->first_name }}</td>
                <td>{{ $list->last_name }}</td>
                <td>
                    <img src="{{ asset($list->image) }}" alt="{{ $list->first_name }}" width="200">
                </td>
                <td>
                    <a data-id="{{ $list->id }}" href="{{ route('intro.edit', $list->id) }}" class="btn btn-primary editBtn">Edit</a>
                    <a data-id="{{ $list->id }}" href="{{ route('intro.delete', $list->id) }}" class="btn btn-danger deleteBtn">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {

        $('.deleteBtn').on('click', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            var url = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Client deleted successfully!',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        },
                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'An error occurred',
                                text: response.responseText,
                            });
                        }
                    });
                }
            });
        });

        $('.editBtn').on('click', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            var url = $(this).attr('href');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    console.log(response)
                    $('#clientId').val(response.id);
                    $('#editFname').val(response.first_name);
                    $('#editLname').val(response.last_name);
                    $('#editForm').attr('action', '{{ url('update') }}/' + response.id);
                    $('#editModal').modal('show');
                },
                error: function() {
                    alert('An error occurred while loading the data');
                }
            });
        });

        $('.updateBtn').on('click', function() {
            var form = $('#editForm')[0];
            var formData = new FormData(form);

            $.ajax({
                url: form.action,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Client updated successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    $('#editModal').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'An error occurred',
                        text: response.responseText,
                    });
                }
            });
        });

        $('.save_customer').on('click', function(e) {
            e.preventDefault();

            var form = $('#saveForm')[0];
            var formData = new FormData(form);

            $.ajax({
                url: "{{ route('intro.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Client saved successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $('#exampleModal').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                error: function(response) {
                    console.log(response);
                    alert('An error occurred: ' + response.responseText);
                }
            });
        });
    });
</script>
<style>
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0px;
    }

    .header .button{
        display: flex;
        width: 150px;
        height: 50px;
        background-color: blue;
        color: #eee;
        cursor: pointer;
        border: none;
        border-radius: 10px;
        align-items: center;
        justify-content: center;
    }

    .header .button:hover{
        background-color: green;
        color: #eee;
    }
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
</body>
</html>

