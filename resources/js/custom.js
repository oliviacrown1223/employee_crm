$(document).ready(function () {

    console.log('custom.js loaded'); // CHECK

    $(document).on('submit', '.delete-form', function(e) {

        e.preventDefault();

        let form = this;

        Swal.fire({

            title: 'Delete Record?',
            text: "This action cannot be undone!",
            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',

            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel',

            reverseButtons: true

        }).then((result) => {

            if (result.isConfirmed)
            {
                form.submit();
            }

        });

    });

});



$(document).on('click', '#downloadPayslip', function(){

    let salaryId = $('#salary_id').val();

    if(salaryId == '')
    {
        Swal.fire({
            icon: 'warning',
            title: 'Please select salary'
        });

        return;
    }

    window.location.href =
        '/superadmin/salaries/' + salaryId + '/payslip';

});


$(document).ready(function(){

    // AJAX SEARCH

    function fetchSalary()
    {
        $.ajax({

            url: "{{ route('superadmin.salaries.index') }}",

            type: "GET",

            data: {

                search: $('#search').val(),
                month: $('#month').val()

            },

            success:function(response)
            {
                $('#salaryTable').html(response);
            }

        });
    }

    // LIVE SEARCH

    $(document).on('keyup', '#search', function(){

        fetchSalary();

    });

    // MONTH FILTER

    $(document).on('change', '#month', function(){

        fetchSalary();

    });

    // OPEN MODAL

    $(document).on('click', '#openPayslipModal', function(){

        $('#payslipModal').modal('show');

    });

    // DOWNLOAD PAYSLIP

    $(document).on('click', '#downloadPayslip', function(){

        let salaryId = $('#salary_id').val();

        if(salaryId == '')
        {
            alert('Please select salary');

            return;
        }

        window.location.href =
            '/superadmin/salaries/' + salaryId + '/payslip';

    });

});
console.log("custom js loaded");
