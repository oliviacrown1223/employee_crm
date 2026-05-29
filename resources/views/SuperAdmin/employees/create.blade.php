@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="table-section">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3 class="fw-bold mb-0">Add Employee</h3>
                <small class="text-muted">Create new employee record</small>
            </div>

            <a href="{{ route('employees.index') }}"
               class="btn btn-outline-secondary rounded-3 px-4">

                ← Back
            </a>

        </div>

        <!-- FORM CARD -->
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body p-4">

                <form id="employeeForm"
                      enctype="multipart/form-data"
                      onsubmit="return false;">

                    @csrf

                    <div class="row g-4">

                        <!-- LEFT SIDE -->
                        <div class="col-md-6">

                            <!-- NAME -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text"
                                       name="name"
                                       class="form-control rounded-3"
                                       placeholder="Enter full name">
                                <small class="text-danger error-name"></small>
                            </div>

                            <!-- EMAIL -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email"
                                       name="email"
                                       id="email"
                                       class="form-control rounded-3"
                                       placeholder="example@gmail.com"
                                       autocomplete="off">
                                <small class="text-danger error-email"></small>
                            </div>

                            <!-- MOBILE -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Mobile</label>

                                <div class="input-group">
                                    <span class="input-group-text">+91</span>

                                    <input type="text"
                                           name="mobile"
                                           id="mobile"
                                           class="form-control"
                                           placeholder="10 digit mobile number"
                                           inputmode="numeric"
                                           maxlength="10"
                                           autocomplete="off"
                                           oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                </div>

                                <small class="text-danger error-mobile"></small>
                            </div>

                            <!-- DEPARTMENT -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Department</label>
                                <select name="department" class="form-select rounded-3">
                                    <option value="">Select department</option>
                                    <option>IT</option>
                                    <option>HR</option>
                                    <option>Sales</option>
                                    <option>Marketing</option>
                                </select>
                                <small class="text-danger error-department"></small>
                            </div>

                            <!-- DESIGNATION -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Designation</label>
                                <input type="text"
                                       name="designation"
                                       class="form-control rounded-3"
                                       placeholder="e.g. Software Engineer">
                                <small class="text-danger error-designation"></small>
                            </div>

                            <!-- SALARY -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Salary</label>
                                <input type="number"
                                       name="salary"
                                       class="form-control rounded-3"
                                       placeholder="Enter monthly salary">
                                <small class="text-danger error-salary"></small>
                            </div>

                            <!-- JOINING DATE -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Joining Date</label>
                                <input type="date"
                                       name="joining_date"
                                       class="form-control rounded-3">
                                <small class="text-danger error-joining_date"></small>
                            </div>

                        </div>

                        <!-- RIGHT SIDE -->
                        <div class="col-md-6">

                            <!-- IMAGE -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Profile Image</label>

                                <div class="border rounded-4 p-4 text-center bg-light"
                                     style="cursor:pointer;"
                                     onclick="document.getElementById('photo').click();">

                                    <input type="file"
                                           name="photo"
                                           id="photo"
                                           class="d-none"
                                           onchange="previewImage(event)">

                                    <div class="text-muted">
                                        📤 Click or drag to upload profile image
                                    </div>

                                    <img id="preview"
                                         class="mt-3 shadow-sm"
                                         style="width:100px;height:100px;display:none;border-radius:50%;object-fit:cover;">
                                </div>
                            </div>

                            <!-- ADDRESS -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Address</label>
                                <textarea name="address"
                                          rows="4"
                                          class="form-control rounded-3"
                                          placeholder="Enter full address"></textarea>
                            </div>

                            <!-- STATUS -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="status" class="form-select rounded-3">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                        </div>

                    </div>

                    <!-- SUBMIT -->
                    <div class="text-end mt-4">
                        <button class="btn btn-success px-5 rounded-3 shadow-sm" type="submit">
                            Save Employee
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection
    <!-- IMAGE PREVIEW SCRIPT -->

    <script>

        function previewImage(event)
        {
            let reader = new FileReader();

            reader.onload = function()
            {
                let img = document.getElementById('preview');
                img.src = reader.result;
                img.style.display = 'block';
            }

            reader.readAsDataURL(event.target.files[0]);
        }

    </script>

@push('scripts')

    <script>

        document.addEventListener("DOMContentLoaded", function () {

            let form = document.getElementById('employeeForm');

            const fields = [
                'name','email','mobile',
                'department','designation',
                'salary','joining_date'
            ];

            // =========================
            // LIVE VALIDATION
            // =========================
            fields.forEach(field => {

                let input = document.querySelector(`[name="${field}"]`);

                if (!input) return;

                input.addEventListener("input", function () {

                    let errorBox = document.querySelector(`.error-${field}`);

                    if (this.value.trim() === "") {
                        this.classList.add("is-invalid");
                        if (errorBox) errorBox.innerText = "This field is required";
                    } else {
                        this.classList.remove("is-invalid");
                        if (errorBox) errorBox.innerText = "";
                    }

                });

            });

            // =========================
            // AJAX SUBMIT
            // =========================
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(form);

                fetch("{{ route('employees.store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(res => res.json())
                    .then(data => {

                        if (data.status === 'error') {

                            // show validation errors
                            for (let key in data.errors) {

                                let errorBox = document.querySelector(`.error-${key}`);

                                if (errorBox) {
                                    errorBox.innerText = data.errors[key][0];
                                }
                            }

                        } else {

                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: data.message
                            }).then(() => {

                                // 🔥 REDIRECT HERE
                                window.location.href = data.redirect;

                            });

                        }

                    })
                    .catch(err => console.log(err));

            });

        });

    </script>

@endpush
