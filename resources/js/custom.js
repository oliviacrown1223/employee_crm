import Swal from 'sweetalert2';

// DELETE CONFIRM
document.addEventListener('click', function (e) {

    const btn = e.target.closest('.delete-confirm');

    if (!btn) return;

    e.preventDefault();

    Swal.fire({
        title: 'Are you sure?',
        text: "This record will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {

        if (result.isConfirmed) {

            btn.closest('form').submit();

        }
    });

});

// UPDATE CONFIRM
document.addEventListener('submit', function (e) {

    const form = e.target;

    if (!form.classList.contains('update-confirm')) return;

    e.preventDefault();

    Swal.fire({
        title: 'Save Changes?',
        text: 'Do you want to update this record?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, Update',
        cancelButtonText: 'Cancel'
    }).then((result) => {

        if (result.isConfirmed) {

            form.submit();

        }
    });

});
/*
|--------------------------------------------------------------------------
| CREATE CONFIRM
|--------------------------------------------------------------------------
*/
document.addEventListener("submit", function (e) {

    const form = e.target;

    if (!form.classList.contains("create-confirm")) return;

    e.preventDefault();

    Swal.fire({
        title: "Create Record?",
        text: "Do you want to save this record?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Yes, Save",
        cancelButtonText: "Cancel"
    }).then((result) => {

        if (result.isConfirmed) {
            form.submit();
        }

    });

});
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



//logout button
document.addEventListener("DOMContentLoaded", function () {

    function confirmLogout(formId) {

        const form = document.getElementById(formId);
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Logout?',
                text: 'You will be signed out from system',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Logout',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        });

    }

    confirmLogout('logoutForm');
    confirmLogout('logoutFormDropdown');

});
