$(document).ready(function(){

    // MARK ATTENDANCE

    $('#attendanceForm').submit(function(e){

        e.preventDefault();

        $.ajax({

            url: "/attendance/mark",

            type: "POST",

            data: $(this).serialize(),

            success:function(response){

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });

                if(response.status){

                    setTimeout(() => {
                        location.reload();
                    }, 2000);

                }

            }

        });

    });


    // CHECK IN

    $('.checkInBtn').click(function(){

        let id = $(this).data('id');

        $.post('/attendance/check-in/' + id, {

            _token: $('meta[name="csrf-token"]').attr('content')

        }, function(response){

            Swal.fire({
                icon: 'success',
                title: 'Checked In',
                text: response.message,
                timer: 1500,
                showConfirmButton: false
            });

            setTimeout(() => {
                location.reload();
            }, 1500);

        });

    });


    // CHECK OUT

    $(document).on('click', '.checkOutBtn', function () {

        let id = $(this).data('id');

        if (!id) {
            alert("Invalid Attendance ID");
            return;
        }

        $.ajax({
            url: '/attendance/check-out/' + id,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {

                Swal.fire({
                    icon: 'success',
                    title: 'Checked Out',
                    text: response.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    location.reload();
                }, 1500);
            },

            error: function (xhr) {

                console.log(xhr.responseText);

                Swal.fire({
                    icon: 'error',
                    title: 'Failed',
                    text: 'Check-Out failed (see console)'
                });
            }
        });

    });


    // APPROVE

    $('.approveBtn').click(function(){

        let id = $(this).data('id');

        $.post('/attendance/approve/' + id, {

            _token: $('meta[name="csrf-token"]').attr('content')

        }, function(response){

            Swal.fire({
                icon: 'success',
                title: 'Approved',
                text: response.message,
                timer: 1500,
                showConfirmButton: false
            });

            setTimeout(() => {
                location.reload();
            }, 1500);

        });

    });

});


    document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-form').forEach(form => {

        form.addEventListener('submit', function(e) {

            e.preventDefault();

            Swal.fire({
                title: 'Delete Employee?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                backdrop: true
            }).then((result) => {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        });

    });

});
