@extends('hr.layout.admin')

@section('content')

    <div class="container-fluid">

        <div class="card border-0 shadow-lg rounded-4">

            <div class="card-header bg-white">

                <h4 class="fw-bold">
                    Create Employee
                </h4>

            </div>

            <div class="card-body">

                <form method="POST"
                      action="{{ route('hr.employees.store') }}"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Name</label>

                            <input type="text"
                                   name="name"
                                   class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Email</label>

                            <input type="email"
                                   name="email"
                                   class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Mobile</label>

                            <input type="text"
                                   name="mobile"
                                   class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Department</label>

                            <input type="text"
                                   name="department"
                                   class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Designation</label>

                            <input type="text"
                                   name="designation"
                                   class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Salary</label>

                            <input type="number"
                                   name="salary"
                                   class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Joining Date</label>

                            <input type="date"
                                   name="joining_date"
                                   class="form-control">

                        </div>


                        <div class="col-md-12 mb-3">

                            <label>Address</label>

                            <textarea name="address"
                                      class="form-control"></textarea>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label>Photo</label>

                            <input type="file"
                                   name="photo"
                                   class="form-control">

                        </div>

                    </div>

                    <button class="btn btn-success">

                        Create Employee

                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection
