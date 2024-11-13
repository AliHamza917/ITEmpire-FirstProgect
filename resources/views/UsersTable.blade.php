@extends('layouts.default')

@section('container')
    <section class="panel">
        <h1>Users Table</h1>


        <section id="unseen">
            <table class="table table-bordered table-striped table-condensed data-table" style="width: 100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Profile Image</th>
                    <th>User Role</th>
{{--                    <th>Created By</th>--}}
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <!-- Data will be populated here via AJAX -->
                </tbody>
            </table>
        </section>
    </section>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('UserTable') }}",  // URL for user data
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'fullname', name: 'fullname' },
                    { data: 'email', name: 'email' },
                    { data: 'status', name: 'status', render: function(data, type, row) {
                            return data == 1 ? 'Active' : 'Deactivated';
                        }
                    },
                    { data: 'profile_img', name: 'profile_img', render: function(data, type, row) {
                            return data ? '<img src="storage/profile-image/' + data + '" width="50" height="50" />' : 'No Image';
                        }
                    },
                    { data: 'user_role', name: 'user_role', render: function(data, type, row) {
                            if (data === 'M') {
                                return 'Manager';
                            } else if (data === 'user') {
                                return 'User';
                            } else {
                                return 'Admin';
                            }
                        }
                    },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            // Handle the update status button click
            $('.data-table').on('click', '.update-status', function () {
                var userId = $(this).data('id');
                var url = "{{ route('UpdateStatus', ':id') }}".replace(':id', userId);

                $.ajax({
                    url: url,
                    type: 'GET', // Use GET request
                    success: function (response) {
                        if (response.success) {
                            alert('Update User status');
                            table.ajax.reload(null, false); // Reload the table without resetting pagination
                        }
                    },
                    error: function (xhr) {
                        alert('Error updating status');
                    }
                });
            });
        });
    </script>

@endsection
