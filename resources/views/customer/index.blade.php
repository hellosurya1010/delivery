@extends('layouts.admin')


@section('style')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Customers</h5>
                </div>
                <div class="card-body">

                    <table id="customers-table" class="table table-nowrap dt-responsive table-bordered display"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script>
        let showDeliveryPartDetials;
        $(document).ready(function() {
            var e = $("#customers-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('datatable.customers') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'profile_picture',
                        name: 'profile_picture'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            });
         
        });
    </script>
@endsection
