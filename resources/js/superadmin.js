
document.addEventListener('DOMContentLoaded', function () {

    const employeeSelect = document.getElementById('employee_id');

    const basicSalary = document.getElementById('basic_salary');

    employeeSelect.addEventListener('change', function () {

        let selectedOption = this.options[this.selectedIndex];

        let salary = selectedOption.getAttribute('data-salary');

        basicSalary.value = salary ?? '';

    });

});

//salary

document.addEventListener('DOMContentLoaded', function () {

    const employeeSelect = document.getElementById('employee_id');

    const basicSalary = document.getElementById('basic_salary');

    const bonus = document.getElementById('bonus');

    const deduction = document.getElementById('deduction');

    const netSalaryPreview = document.getElementById('netSalaryPreview');

    // AUTO FILL SALARY
    employeeSelect.addEventListener('change', function () {

        let selectedOption = this.options[this.selectedIndex];

        let salary = selectedOption.getAttribute('data-salary');

        basicSalary.value = salary ?? '';

        calculateNetSalary();

    });

    // LIVE CALCULATION
    bonus.addEventListener('input', calculateNetSalary);

    deduction.addEventListener('input', calculateNetSalary);

    function calculateNetSalary() {

        let basic = parseFloat(basicSalary.value) || 0;

        let bonusValue = parseFloat(bonus.value) || 0;

        let deductionValue = parseFloat(deduction.value) || 0;

        let total = (basic + bonusValue) - deductionValue;

        netSalaryPreview.innerText = total;

    }

    calculateNetSalary();

});


  //  DAily work


document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('dailyWorkForm');

    const title = document.getElementById('task_title');

    const description = document.getElementById('task_description');

    const hours = document.getElementById('hours_worked');

    const workDate = document.getElementById('work_date');

    const employee = document.getElementById('employee_id');

    const previewHours = document.getElementById('previewHours');

    // LIVE HOURS PREVIEW
    hours.addEventListener('input', function () {

        previewHours.innerText = this.value || 0;

    });

    // LIVE VALIDATION
    const fields = [title, description, hours, workDate, employee];

    fields.forEach(field => {

        field.addEventListener('input', validateField);

        field.addEventListener('change', validateField);

    });

    function validateField(e) {

        const field = e.target;

        if (field.value.trim() === '') {

            field.classList.add('is-invalid');

            field.classList.remove('is-valid');

        } else {

            field.classList.remove('is-invalid');

            field.classList.add('is-valid');

        }

    }

    // FORM SUBMIT VALIDATION
    form.addEventListener('submit', function (e) {

        let valid = true;

        fields.forEach(field => {

            if (field.value.trim() === '') {

                field.classList.add('is-invalid');

                valid = false;

            }

        });

        if (!valid) {

            e.preventDefault();

        }

    });

});

//DAily work edit

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('editDailyWorkForm');

    const title = document.getElementById('task_title');

    const description = document.getElementById('task_description');

    const hours = document.getElementById('hours_worked');

    const workDate = document.getElementById('work_date');

    const previewHours = document.getElementById('previewHours');

    // LIVE HOURS PREVIEW
    previewHours.innerText = hours.value || 0;

    hours.addEventListener('input', function () {

        previewHours.innerText = this.value || 0;

    });

    // LIVE VALIDATION
    const fields = [title, description, hours, workDate];

    fields.forEach(field => {

        field.addEventListener('input', validateField);

        field.addEventListener('change', validateField);

    });

    function validateField(e) {

        const field = e.target;

        if (field.value.trim() === '') {

            field.classList.add('is-invalid');

            field.classList.remove('is-valid');

        } else {

            field.classList.remove('is-invalid');

            field.classList.add('is-valid');

        }

    }

    // SUBMIT VALIDATION
    form.addEventListener('submit', function (e) {

        let valid = true;

        fields.forEach(field => {

            if (field.value.trim() === '') {

                field.classList.add('is-invalid');

                valid = false;

            }

        });

        if (!valid) {

            e.preventDefault();

        }

    });

});



//performance create
document.addEventListener('DOMContentLoaded', function () {

    const attendance = document.getElementById('attendance_score');

    const task = document.getElementById('task_completion_score');

    const manager = document.getElementById('manager_rating');

    const finalRating = document.getElementById('finalRating');

    const performanceGrade = document.getElementById('performanceGrade');

    const fields = [

        document.getElementById('employee_id'),
        document.getElementById('month'),
        attendance,
        task,
        manager

    ];

    // LIVE VALIDATION
    fields.forEach(field => {

        field.addEventListener('input', validateField);

        field.addEventListener('change', validateField);

    });

    function validateField(e) {

        const field = e.target;

        if (field.value.trim() === '') {

            field.classList.add('is-invalid');

            field.classList.remove('is-valid');

        } else {

            field.classList.remove('is-invalid');

            field.classList.add('is-valid');

        }

    }

    // LIVE RATING CALCULATION
    function calculateRating() {

        let attendanceValue = parseFloat(attendance.value) || 0;

        let taskValue = parseFloat(task.value) || 0;

        let managerValue = parseFloat(manager.value) || 0;

        let total = (

            attendanceValue +
            taskValue +
            managerValue

        ) / 3;

        total = total.toFixed(1);

        finalRating.innerText = total;

        // GRADE
        if (total >= 90) {

            performanceGrade.innerText = 'A+';

        } else if (total >= 75) {

            performanceGrade.innerText = 'A';

        } else if (total >= 60) {

            performanceGrade.innerText = 'B';

        } else if (total >= 40) {

            performanceGrade.innerText = 'C';

        } else {

            performanceGrade.innerText = 'D';

        }

    }

    attendance.addEventListener('input', calculateRating);

    task.addEventListener('input', calculateRating);

    manager.addEventListener('input', calculateRating);

    calculateRating();

});

//performance edit:--
document.addEventListener('DOMContentLoaded', function () {

    const attendance = document.getElementById('attendance_score');

    const task = document.getElementById('task_completion_score');

    const manager = document.getElementById('manager_rating');

    const finalRating = document.getElementById('finalRating');

    const performanceGrade = document.getElementById('performanceGrade');

    const fields = [

        document.getElementById('employee_id'),
        document.getElementById('month'),
        attendance,
        task,
        manager

    ];

    // LIVE VALIDATION
    fields.forEach(field => {

        field.addEventListener('input', validateField);

        field.addEventListener('change', validateField);

    });

    function validateField(e) {

        const field = e.target;

        if (field.value.trim() === '') {

            field.classList.add('is-invalid');

            field.classList.remove('is-valid');

        } else {

            field.classList.remove('is-invalid');

            field.classList.add('is-valid');

        }

    }

    // LIVE CALCULATION
    function calculateRating() {

        let attendanceValue = parseFloat(attendance.value) || 0;

        let taskValue = parseFloat(task.value) || 0;

        let managerValue = parseFloat(manager.value) || 0;

        let total = (

            attendanceValue +
            taskValue +
            managerValue

        ) / 3;

        total = total.toFixed(1);

        finalRating.innerText = total;

        // GRADE
        if (total >= 90) {

            performanceGrade.innerText = 'A+';

        } else if (total >= 75) {

            performanceGrade.innerText = 'A';

        } else if (total >= 60) {

            performanceGrade.innerText = 'B';

        } else if (total >= 40) {

            performanceGrade.innerText = 'C';

        } else {

            performanceGrade.innerText = 'D';

        }

    }

    attendance.addEventListener('input', calculateRating);

    task.addEventListener('input', calculateRating);

    manager.addEventListener('input', calculateRating);

    calculateRating();

});
$(document).ready(function () {

    $('#passwordForm').unbind('submit').bind('submit', function (e) {

        e.preventDefault();

        // CLEAR ERRORS
        $('.error_current_password').html('');
        $('.error_new_password').html('');
        $('.error_new_password_confirmation').html('');

        $('#current_password').removeClass('is-invalid');
        $('#new_password').removeClass('is-invalid');
        $('#new_password_confirmation').removeClass('is-invalid');

        $.ajax({

            url: $(this).attr('action'),

            type: 'POST',

            data: $(this).serialize(),

            success: function (response) {

                Swal.fire({

                    icon: 'success',
                    title: 'Success',
                    text: response.message

                }).then(() => {

                    window.location.href = "/dashboard";

                });

            },

            error: function (xhr) {

                if (xhr.status === 422) {

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {

                        $('#' + key).addClass('is-invalid');

                        $('.error_' + key).html(value[0]);

                    });

                }

            }

        });

    });

});

    document.getElementById('conform').addEventListener('submit', function (e) {

    e.preventDefault();

    let form = this;

    Swal.fire({
    title: "Are you sure?",
    text: "Do you want to generate salary?",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Yes, Generate",
    cancelButtonText: "Cancel"
}).then((result) => {

    if (result.isConfirmed) {
    form.submit(); // 🔥 normal Laravel submit
}

});

});



