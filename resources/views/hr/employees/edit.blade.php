@extends('hr.layout.admin')

@section('content')

    <div class="container-fluid">

        <div class="card border-0 shadow-lg rounded-4">

            <div class="card-header bg-white">

                <h4 class="fw-bold">
                    Edit Employee
                </h4>

            </div>

            <div class="card-body">

                <form method="POST"
                      action="{{ route('hr.employees.update', $employee->id) }}"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Name</label>

                            <input type="text"
                                   name="name"
                                   value="{{ $employee->name }}"
                                   class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Email</label>

                            <input type="email"
                                   name="email"
                                   value="{{ $employee->email }}"
                                   class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Mobile</label>

                            <input type="text"
                                   name="mobile"
                                   value="{{ $employee->mobile }}"
                                   class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Department</label>

                            <input type="text"
                                   name="department"
                                   value="{{ $employee->department }}"
                                   class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Designation</label>

                            <input type="text"
                                   name="designation"
                                   value="{{ $employee->designation }}"
                                   class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Salary</label>

                            <input type="number"
                                   name="salary"
                                   value="{{ $employee->salary }}"
                                   class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Joining Date</label>

                            <input type="date"
                                   name="joining_date"
                                   value="{{ $employee->joining_date }}"
                                   class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Status</label>

                            <select name="status"
                                    class="form-control">

                                <option value="1"
                                    {{ $employee->status == 1 ? 'selected' : '' }}>

                                    Active

                                </option>


                                <option value="0"
                                    {{ $employee->status == 0 ? 'selected' : '' }}>

                                    Inactive

                                </option>

                            </select>


                        </div>

                        <div class="col-md-12 mb-3">

                            <label>Address</label>

                            <textarea name="address"
                                      class="form-control">{{ $employee->address }}</textarea>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label>Photo</label>

                            <input type="file"
                                   name="photo"
                                   class="form-control">

                            <br>

                            @if($employee->photo)

                                <img src="{{ asset('storage/' . $employee->photo) }}"
                                     class="rounded-circle border border-4 border-white shadow"
                                     width="130"
                                     height="130"
                                     style="object-fit:cover;">

                            @else

                                <img src="https://via.placeholder.com/110"
                                     class="rounded-circle border border-4 border-white shadow">

                            @endif
                        </div>

                    </div>

                    <button class="btn btn-primary">

                        Update Employee

                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection
