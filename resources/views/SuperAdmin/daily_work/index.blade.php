@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h4 class="fw-bold mb-1">Daily Work</h4>
            <small class="text-muted">Manage employee tasks & submissions</small>
        </div>

    </div>


    <div class="card border-0 shadow-sm rounded-4">

        <!-- HEADER -->
        <div class="card-header bg-white border-0 p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <!-- TITLE -->
                <div>
                    <h3 class="fw-bold mb-1">Daily Work Management</h3>
                    <p class="text-muted mb-0">Manage tasks, submissions & approvals</p>
                </div>

                <!-- ACTIONS -->
                <div class="d-flex gap-2 flex-wrap">

                    <!-- FILTER -->
                    <select id="statusFilter"
                            class="form-select rounded-3 border-0 shadow-sm"
                            style="width:170px;height:45px;">
                        <option value="all">All Status</option>
                        <option value="draft">Draft</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>

                    <!-- SEARCH -->
                    <input type="text"
                           id="searchInput"
                           class="form-control rounded-3 border-0 shadow-sm"
                           placeholder="Search work..."
                           style="width:240px;height:45px;">

                    <!-- ADD BUTTON -->
                    @if(auth()->user()->role == 'super-admin')

                        <a href="{{ route('daily-work.create') }}"
                           class="btn btn-primary rounded-3 shadow-sm px-4 d-flex align-items-center gap-2">

                            <i class="bi bi-plus-circle"></i>
                            Add Work

                        </a>

                    @endif

                </div>

            </div>

        </div>


        <!-- TABLE -->
        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                    <tr>
                        <th class="ps-4">Task</th>
                        <th>Description</th>
                        <th>Hours</th>
                        <th>Work Date</th>
                        <th>Submitted</th>
                        <th>Status</th>
                        <th class="text-center pe-4">Actions</th>
                    </tr>

                    </thead>

                    <tbody id="workTable">

                    @include('SuperAdmin.daily_work.partials.table')

                    </tbody>

                </table>

                <!-- EMPTY STATE (Better UX) -->
                @if(isset($works) && count($works) == 0)
                    <div class="text-center py-5">

                        <i class="bi bi-inbox fs-1 text-muted"></i>

                        <h5 class="fw-bold text-muted mt-2">
                            No Daily Work Found
                        </h5>

                        <p class="text-muted mb-0">
                            Start assigning tasks to employees
                        </p>

                    </div>
                @endif

            </div>

        </div>

    </div>

@endsection


{{-- SCRIPT SECTION --}}
@push('scripts')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>

        $(document).ready(function () {

            function loadData() {

                let search = $('#searchInput').val();
                let status = $('#statusFilter').val();

                $.ajax({
                    url: "{{ route('daily-work.search') }}",
                    type: "GET",
                    data: {
                        search: search,
                        status: status
                    },
                    success: function (data) {
                        $('#workTable').html(data);
                    }
                });

            }

            $('#searchInput').on('keyup', function () {
                loadData();
            });

            $('#statusFilter').on('change', function () {
                loadData();
            });

        });

    </script>

@endpush
