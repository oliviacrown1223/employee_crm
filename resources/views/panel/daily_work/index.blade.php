@extends('layouts.admin')

@section('page-title', 'Daily Work')

@section('content')

    <div class="container-fluid py-4 daily-work-page">

        <div class="daily-work-hero mb-4">

            <div>
            <span class="daily-work-badge">
                <i class="bi bi-journal-check me-1"></i>
                Daily Work Module
            </span>

                <h2 class="fw-bold mt-3 mb-2">
                    Daily Work Management
                </h2>

                <p class="mb-0 opacity-75">
                    Manage tasks, submissions & approvals
                </p>
            </div>

            @if(auth()->user()->hasAnyRole(['super-admin']) || auth()->user()->can('daily_work.create.team'))
                <a href="{{ route('daily-work.create') }}"
                   class="btn btn-light rounded-pill px-4 fw-semibold shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i>
                    Add Work
                </a>
            @endif

        </div>

        <div class="daily-work-card">

            <div class="daily-work-card-header">

                <div>
                    <h5 class="fw-bold mb-1">
                        Work Records
                    </h5>

                    <small class="text-muted">
                        Search and filter daily work activity
                    </small>
                </div>

                <div class="daily-work-filters">

                    <select id="statusFilter"
                            class="form-select daily-work-input statusFilter">
                        <option value="all">All Status</option>
                        <option value="draft">Draft</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>

                    <div class="daily-search-box">
                        <i class="bi bi-search"></i>

                        <input type="text"
                               id="searchInput"
                               class="form-control daily-work-input search-input"
                               placeholder="Search work...">
                    </div>

                </div>

            </div>

            <div class="table-responsive">

                <table class="table daily-work-table align-middle mb-0">

                    <thead>
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
                    @include('panel.daily_work.partials.table')
                    </tbody>

                </table>

                @if(isset($works) && count($works) == 0)

                    <div class="daily-empty-box">
                        <i class="bi bi-inbox"></i>

                        <h5 class="fw-bold text-muted mt-2">
                            No Daily Work Found
                        </h5>

                        <p class="text-muted mb-0">
                            Start adding tasks
                        </p>
                    </div>

                @endif

            </div>

        </div>

    </div>

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

@endsection
