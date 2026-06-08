@extends('layouts.admin')

@section('page-title', 'Monthly Performance Report')

@section('content')

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white">
            <h4 class="fw-bold mb-0">Monthly Performance Report</h4>
        </div>

        <div class="card-body">
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let labels = @json($data->pluck('month'));
        let values = @json($data->pluck('avg_rating'));

        new Chart(document.getElementById('monthlyChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Average KPI Rating',
                    data: values,
                    borderWidth: 1
                }]
            }
        });
    </script>

@endsection
