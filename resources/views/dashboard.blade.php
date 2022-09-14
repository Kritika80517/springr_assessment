@extends('layout.master')
@section('content')
    <link href="{{ asset('asset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <div class="container-fluid">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-auto">
                                <h6 class="m-0 font-weight-bold text-primary">User Records</h6>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Add New
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Experience</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <img src="image/{{ $user->image }}" alt="" width="50px"
                                                    height="50px">
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ date_diff(new \DateTime($user->date_of_joining), new \DateTime($user->date_of_leaving))->format('%y Years, %m Months, %d days') }}
                                            </td>
                                            <td>
                                                <a href="{{ url('deleteuser', $user->id) }}" class="btn">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog  modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Record</h5>
                                <button type="button" class="btn-close btn" data-bs-dismiss="modal"
                                    aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ url('storeuser') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" name="email" required class="form-control"
                                                id="inputEmail3">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputName" class="col-sm-3 col-form-label">Full Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" required name="name"
                                                id="inputName">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputName" class="col-sm-3 col-form-label">Date of Joining</label>
                                        <div class="col-sm-9">
                                            <input type="date" onchange="myFunction()" class="form-control" required
                                                name="date_of_joining" id="from">
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <label for="inputName" class="col-sm-3 col-form-label">Date of Leaving</label>
                                        <div class="col-sm-5 ms-2">
                                            <input type="date" class="form-control" required name="date_of_leaving"
                                                id="to">
                                        </div>
                                        <div class="col-sm-4 pl-5 align-items-center">
                                            <input style="width: 20px;height:20px;" name="still_work"
                                                class="form-check-input" type="checkbox" id="gridCheck">
                                            <label class="form-check-label pt-1 pl-2" for="gridCheck">
                                                Still Working
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputImage" class="col-sm-3 col-form-label">Upload image</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" name="image" id="inputImage">
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <script src="{{ asset('asset/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('asset/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('asset/js/demo/datatables-demo.js') }}"></script>

        <script>
            document.getElementById('to').setAttribute("disabled", "disabled");

            function myFunction() {
                document.getElementById('to').removeAttribute("disabled");
                var from = document.getElementById("from").value;
                document.getElementById("to").min = from;

            }
        </script>
    @endsection
