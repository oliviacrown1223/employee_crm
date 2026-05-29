@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Monthly Performance Report</h4>
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
