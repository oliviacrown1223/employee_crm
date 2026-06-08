@extends('layouts.admin')

@section('page-title', 'Employee KPI Graph')

@section('content')

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white">
            <h4 class="fw-bold mb-0">Employee KPI Graph</h4>
        </div>

        <div class="card-body">
            <canvas id="empChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let labels = @json($data->pluck('month'));
        let values = @json($data->pluck('final_rating'));

        new Chart(document.getElementById('empChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'KPI Score',
                    data: values,
                    tension: 0.3
                }]
            }
        });
    </script>

@endsection
