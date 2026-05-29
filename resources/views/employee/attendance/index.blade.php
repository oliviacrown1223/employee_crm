@extends('employee.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h2 class="fw-bold mb-1 text-dark">My Attendance</h2>
                <p class="text-muted mb-0">Track your daily check-in and working hours</p>
            </div>

            <span class="badge bg-primary px-3 py-2 shadow-sm">
            {{ now()->format('d M Y') }}
        </span>

        </div>

        <!-- MAIN CARD -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- HEADER -->
            <div class="card-header bg-dark text-white py-4 border-0">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="mb-0 fw-semibold">Attendance Dashboard</h5>
                        <small class="text-light opacity-75">Daily attendance records</small>
                    </div>

                </div>

            </div>

            <!-- BODY -->
            <div class="card-body p-0">

                <!-- TABLE -->
                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="bg-light">
                        <tr class="text-uppercase small fw-bold text-muted">

                            <th>Employee</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Hours</th>
                            <th>Status</th>

                        </tr>
                        </thead>

                        <tbody>

                        @forelse($attendances as $att)

                            <tr class="border-bottom">

                                <!-- EMPLOYEE -->
                                <td class="fw-semibold">
                                    {{ $att->employee->name ?? 'N/A' }}
                                </td>

                                <!-- DATE -->
                                <td>
                                    <span class="text-muted">
                                        {{ $att->attendance_date }}
                                    </span>
                                </td>

                                <!-- CHECK IN -->
                                <td>
                                    <span class="text-success fw-semibold">
                                        {{ $att->check_in ?? '-' }}
                                    </span>
                                </td>

                                <!-- CHECK OUT -->
                                <td>
                                    <span class="text-danger fw-semibold">
                                        {{ $att->check_out ?? '-' }}
                                    </span>
                                </td>

                                <!-- HOURS -->
                                <td>
                                    <span class="badge bg-dark px-3 py-2 rounded-pill">
                                        {{ $att->working_hours ?? 0 }} hrs
                                    </span>
                                </td>

                                <!-- STATUS -->
                                <td>
                                    @if($att->status == 'present')

                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            Present
                                        </span>

                                    @else

                                        <span class="badge bg-danger px-3 py-2 rounded-pill">
                                            Absent
                                        </span>

                                    @endif
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-calendar-x display-5 d-block mb-2"></i>
                                    No Attendance Found
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <!-- AJAX SCRIPTS (UNCHANGED LOGIC) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>

        $(document).on('click', '.checkInBtn', function(e){

            e.preventDefault();

            $.ajax({
                url: "{{ route('employee.attendance.checkin') }}",
                type: "POST",
                data: { _token: "{{ csrf_token() }}" },

                success: function(response){
                    alert(response.message);
                    location.reload();
                },

                error: function(xhr){
                    console.log(xhr.responseText);
                    alert('Something went wrong');
                }

            });

        });

        $(document).on('click', '.checkOutBtn', function(e){

            e.preventDefault();

            $.ajax({
                url: "{{ route('employee.attendance.checkout') }}",
                type: "POST",
                data: { _token: "{{ csrf_token() }}" },

                success: function(response){
                    alert(response.message);
                    location.reload();
                },

                error: function(xhr){
                    console.log(xhr.responseText);
                    alert('Something went wrong');
                }

            });

        });

    </script>

@endsection
