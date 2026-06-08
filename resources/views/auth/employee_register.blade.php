<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Register</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="mainloginpage">

<div class="login-wrapper register-wrapper">

    <div class="login-left">

        <div class="brand-icon">
            <i class="bi bi-person-plus-fill"></i>
        </div>

        <h1>Join Employee CRM</h1>

        <p>
            Create your employee account and access your dashboard,
            attendance, salary, daily work and profile information securely.
        </p>

        <div class="feature-list">

            <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Quick employee registration</span>
            </div>

            <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Secure login access</span>
            </div>

            <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Role based CRM dashboard</span>
            </div>

        </div>

    </div>

    <div class="login-right">

        <h3 class="form-title">Create Account</h3>
        <p class="form-subtitle">
            Fill your details to register as employee
        </p>

        <form id="empForm">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Name</label>

                <div class="input-group-custom">
                    <i class="bi bi-person"></i>

                    <input type="text"
                           name="name"
                           id="name"
                           class="form-control formcontroller"
                           placeholder="Enter full name">
                </div>

                <small class="text-danger" id="error-name"></small>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>

                <div class="input-group-custom">
                    <i class="bi bi-envelope"></i>

                    <input type="email"
                           name="email"
                           id="email"
                           class="form-control formcontroller"
                           placeholder="example@domain.com">
                </div>

                <small class="text-danger" id="error-email"></small>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Mobile</label>

                <div class="input-group-custom">
                    <i class="bi bi-phone"></i>

                    <input type="text"
                           name="mobile"
                           id="mobile"
                           class="form-control formcontroller"
                           placeholder="10 digit mobile number">
                </div>

                <small class="text-danger" id="error-mobile"></small>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>

                <div class="input-group-custom">
                    <i class="bi bi-lock"></i>

                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control formcontroller"
                           placeholder="Minimum 6 characters">
                </div>

                <small class="text-danger" id="error-password"></small>
            </div>

            <button type="submit" class="btn btn-login w-100 mt-2 buttonlogin">
                <i class="bi bi-person-plus me-1"></i>
                Create Account
            </button>

            <div class="text-center mt-4 ">
                <span class="text-muted">Already registered?</span>

                <a href="{{ url('/login') }}" class="register-link">
                    Login Here
                </a>
            </div>

        </form>

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

    $('#name').on('input', function(){
        this.value = this.value.replace(/[^a-zA-Z\s]/g,'');

        if(this.value.length < 3){
            setError('name','Minimum 3 characters required');
        } else {
            setValid('name');
        }
    });

    $('#mobile').on('input', function(){
        this.value = this.value.replace(/[^0-9]/g,'').slice(0,10);

        if(this.value.length !== 10){
            setError('mobile','Must be 10 digits');
        } else {
            setValid('mobile');
        }
    });

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
