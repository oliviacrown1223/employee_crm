<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg, #eef2f3, #cfd9df);
        }

        /* Card premium look */
        .card{
            border-radius: 18px;
            overflow: hidden;
        }

        /* Inputs */
        .form-control{
            border-radius: 12px;
            font-size: 15px;
        }

        /* Focus effect */
        .form-control:focus{
            border-color: #000;
            box-shadow: 0 0 0 0.15rem rgba(0,0,0,.1);
        }

        /* Placeholder */
        .form-control::placeholder{
            font-size: 13px;
            color: #999;
        }

        /* Error text */
        .text-danger{
            font-size: 12px;
        }

        /* Valid/Invalid UI */
        .is-valid{
            border-color: #198754 !important;
        }

        .is-invalid{
            border-color: #dc3545 !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="col-lg-5">

        <div class="card shadow-lg border-0">

            <!-- HEADER -->
            <div class="card-header bg-dark text-white text-center py-3">
                <h4 class="mb-0">Employee Registration</h4>
            </div>

            <div class="card-body p-4">

                <form id="empForm">

                    @csrf

                    <!-- NAME -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" id="name"
                               class="form-control form-control-lg"
                               placeholder="Enter full name">
                        <small class="text-danger" id="error-name"></small>
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" id="email"
                               class="form-control form-control-lg"
                               placeholder="example@domain.com">
                        <small class="text-danger" id="error-email"></small>
                    </div>

                    <!-- MOBILE -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Mobile</label>
                        <input type="text" name="mobile" id="mobile"
                               class="form-control form-control-lg"
                               placeholder="10 digit mobile number">
                        <small class="text-danger" id="error-mobile"></small>
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" id="password"
                               class="form-control form-control-lg"
                               placeholder="Minimum 6 characters">
                        <small class="text-danger" id="error-password"></small>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 btn-lg">
                        Create Account
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

    function clearErrors(){
        $('input').removeClass('is-invalid is-valid');
        $('.text-danger').text('');
    }

    function setError(field, message){
        let input = $('#' + field);
        input.addClass('is-invalid').removeClass('is-valid');
        $('#error-' + field).text(message);
    }

    function setValid(field){
        let input = $('#' + field);
        input.addClass('is-valid').removeClass('is-invalid');
        $('#error-' + field).text('');
    }

    /* ===============================
       SUBMIT (ONLY ONE TIME)
    =============================== */

    $('#empForm').on('submit', function(e){
        e.preventDefault();

        clearErrors();

        let form = this;

        $.ajax({
            url: "{{ url('/employee/register') }}",
            type: "POST",
            data: $(form).serialize(),

            success: function(){

                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Employee registered successfully!",
                    confirmButtonText: "OK",
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {

                    if (result.isConfirmed) {
                        window.location.href = "/login";
                    }

                });

            },

            error: function(xhr){

                let errors = xhr.responseJSON.errors;

                if(errors.name) setError('name', errors.name[0]);
                if(errors.email) setError('email', errors.email[0]);
                if(errors.mobile) setError('mobile', errors.mobile[0]);
                if(errors.password) setError('password', errors.password[0]);
            }
        });

    });

    /* ===============================
       LIVE VALIDATIONS
    =============================== */

    // NAME
    $('#name').on('input', function(){
        this.value = this.value.replace(/[^a-zA-Z\s]/g,'');

        if(this.value.length < 3){
            setError('name','Minimum 3 characters required');
        } else {
            setValid('name');
        }
    });

    // MOBILE
    $('#mobile').on('input', function(){
        this.value = this.value.replace(/[^0-9]/g,'').slice(0,10);

        if(this.value.length !== 10){
            setError('mobile','Must be 10 digits');
        } else {
            setValid('mobile');
        }
    });

    // EMAIL
    $('#email').on('input', function(){
        this.value = this.value.replace(/\s/g,'').toLowerCase();

        let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if(this.value.length === 0){
            $('#error-email').text('');
            $(this).removeClass('is-valid is-invalid');
            return;
        }

        if(regex.test(this.value)){
            setValid('email');
        } else {
            setError('email','Invalid email format');
        }
    });

    // PASSWORD
    $('#password').on('input', function(){

        if(this.value.length < 6){
            setError('password','Minimum 6 characters required');
        } else {
            setValid('password');
        }
    });

</script>
</body>
</html>
