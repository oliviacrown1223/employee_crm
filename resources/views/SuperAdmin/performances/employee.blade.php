@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Employee KPI Graph</h4>
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
