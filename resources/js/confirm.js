import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', function () {

    document.addEventListener('submit', function (e) {

        const form = e.target;

        const confirmClasses = [
            'delete-confirm',
            'create-confirm',
            'update-confirm',
            'approve-confirm',
            'reject-confirm',
            'logout-confirm'
        ];

        const matchedClass = confirmClasses.find(function (cls) {
            return form.classList.contains(cls);
        });

        if (!matchedClass) {
            return;
        }

        e.preventDefault();

        let config = {
            title: 'Are you sure?',
            text: 'Do you want to continue?',
            icon: 'question',
            confirmButtonText: 'Yes, continue',
            confirmButtonColor: '#0d6efd',
        };

        if (matchedClass === 'delete-confirm') {
            config = {
                title: 'Delete record?',
                text: 'This record will be deleted permanently.',
                icon: 'warning',
                confirmButtonText: 'Yes, delete',
                confirmButtonColor: '#dc3545',
            };
        }

        if (matchedClass === 'create-confirm') {
            config = {
                title: 'Create record?',
                text: 'Do you want to save this new record?',
                icon: 'question',
                confirmButtonText: 'Yes, create',
                confirmButtonColor: '#198754',
            };
        }

        if (matchedClass === 'update-confirm') {
            config = {
                title: 'Update record?',
                text: 'Do you want to save these changes?',
                icon: 'info',
                confirmButtonText: 'Yes, update',
                confirmButtonColor: '#ffc107',
            };
        }

        if (matchedClass === 'approve-confirm') {
            config = {
                title: 'Approve request?',
                text: 'This request will be approved.',
                icon: 'success',
                confirmButtonText: 'Yes, approve',
                confirmButtonColor: '#198754',
            };
        }

        if (matchedClass === 'reject-confirm') {
            config = {
                title: 'Reject request?',
                text: 'This request will be rejected.',
                icon: 'warning',
                confirmButtonText: 'Yes, reject',
                confirmButtonColor: '#dc3545',
            };
        }

        if (matchedClass === 'logout-confirm') {
            config = {
                title: 'Logout?',
                text: 'Are you sure you want to logout?',
                icon: 'warning',
                confirmButtonText: 'Yes, logout',
                confirmButtonColor: '#dc3545',
            };
        }

        Swal.fire({
            title: config.title,
            text: config.text,
            icon: config.icon,
            showCancelButton: true,
            confirmButtonText: config.confirmButtonText,
            cancelButtonText: 'Cancel',
            confirmButtonColor: config.confirmButtonColor,
            cancelButtonColor: '#6c757d',
        }).then(function (result) {

            if (result.isConfirmed) {

                form.classList.remove(matchedClass);

                form.submit();

            }

        });

    });

});

$(document).on('submit', '#passwordForm', function (e) {

    e.preventDefault();

    let form = $(this);

    $('.error_current_password').html('');
    $('.error_new_password').html('');
    $('.error_new_password_confirmation').html('');

    $('#current_password').removeClass('is-invalid');
    $('#new_password').removeClass('is-invalid');
    $('#new_password_confirmation').removeClass('is-invalid');

    $.ajax({

        url: form.attr('action'),

        type: 'POST',

        data: form.serialize(),

        success: function (response) {

            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: response.message
            }).then(() => {
                form[0].reset();
            });

        },

        error: function (xhr) {

            if (xhr.status === 422) {

                let errors = xhr.responseJSON.errors;

                $.each(errors, function (key, value) {

                    $('#' + key).addClass('is-invalid');

                    $('.error_' + key).html(value[0]);

                });

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong'
                });

            }

        }

    });

});

document.addEventListener('click', function (e) {

    /*
    |--------------------------------------------------------------------------
    | CHECK IN
    |--------------------------------------------------------------------------
    */
    if (e.target.classList.contains('checkInBtn')) {

        e.preventDefault();

        let id = e.target.getAttribute('data-id');

        Swal.fire({
            title: 'Check-In?',
            text: 'Do you want to check-in now?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Check-In',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
        }).then((result) => {

            if (result.isConfirmed) {

                fetch('/attendance/check-in/' + id, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {

                        Swal.fire({
                            icon: data.status ? 'success' : 'warning',
                            title: data.status ? 'Success' : 'Notice',
                            text: data.message,
                        }).then(() => {
                            location.reload();
                        });

                    })
                    .catch(() => {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong',
                        });

                    });

            }

        });
    }


    /*
    |--------------------------------------------------------------------------
    | CHECK OUT
    |--------------------------------------------------------------------------
    */
    if (e.target.classList.contains('checkOutBtn')) {

        e.preventDefault();

        let id = e.target.getAttribute('data-id');

        Swal.fire({
            title: 'Check-Out?',
            text: 'Do you want to check-out now?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Check-Out',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
        }).then((result) => {

            if (result.isConfirmed) {

                fetch('/attendance/check-out/' + id, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {

                        Swal.fire({
                            icon: data.status ? 'success' : 'warning',
                            title: data.status ? 'Success' : 'Notice',
                            text: data.message,
                        }).then(() => {
                            location.reload();
                        });

                    })
                    .catch(() => {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong',
                        });

                    });

            }

        });
    }


    /*
    |--------------------------------------------------------------------------
    | APPROVE ATTENDANCE
    |--------------------------------------------------------------------------
    */
    if (e.target.classList.contains('approveBtn')) {

        e.preventDefault();

        let id = e.target.getAttribute('data-id');

        Swal.fire({
            title: 'Approve Attendance?',
            text: 'This attendance will be approved.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Approve',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#6c757d',
        }).then((result) => {

            if (result.isConfirmed) {

                fetch('/attendance/approve/' + id, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {

                        Swal.fire({
                            icon: data.status ? 'success' : 'warning',
                            title: data.status ? 'Success' : 'Notice',
                            text: data.message,
                        }).then(() => {
                            location.reload();
                        });

                    })
                    .catch(() => {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong',
                        });

                    });

            }

        });
    }

});
