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
                    <h5 class="card-title mb-0 flex-grow-1">Add Rows</h5>
                    <div>
                        <button id="addRow" class="btn btn-primary">Add New Row</button>
                    </div>
                </div>
                <div class="card-body">

                    <table id="add-rows" class="table table-nowrap dt-responsive table-bordered display"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Column 1</th>
                                <th>Column 2</th>
                                <th>Column 3</th>
                                <th>Column 4</th>
                                <th>Column 5</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>hello</td>
                                <td>hello</td>
                                <td>hello</td>
                                <td>hello</td>
                                <td>hello</td>
                            </tr>
                            <tr>
                                <td>hello</td>
                                <td>hello</td>
                                <td>hello</td>
                                <td>hello</td>
                                <td>hello</td>
                            </tr>
                            <tr>
                                <td>hello</td>
                                <td>hello</td>
                                <td>hello</td>
                                <td>hello</td>
                                <td>hello</td>
                            </tr>
                            <tr>
                                <td>hello</td>
                                <td>hello</td>
                                <td>hello</td>
                                <td>hello</td>
                                <td>hello</td>
                            </tr>
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
        $(document).ready(function() {
            var e = $("#add-rows").DataTable(),
                a = 1;
            $("#addRow").on("click", function() {
                    e.row
                        .add([
                            a + ".1",
                            a + ".2",
                            a + ".3",
                            a + ".4",
                            a + ".5",
                            a + ".6",
                            a + ".7",
                            a + ".8",
                            a + ".9",
                            a + ".10",
                            a + ".11",
                            a + ".12",
                        ])
                        .draw(!1),
                        a++;
                }),
                $("#addRow").click();
        });
    </script>
@endsection
