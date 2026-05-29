@extends('hr.layout.admin')

@section('content')

    <div class="card shadow-sm">

        <div class="card-header">
            <h4>Employee KPI Graph</h4>
        </div>

        <div class="card-body">

            <canvas id="employeeChart"></canvas>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        let labels = @json($data->pluck('month'));

        let values = @json($data->pluck('final_rating'));

        new Chart(document.getElementById('employeeChart'), {

            type: 'line',

            data: {

                labels: labels,

                datasets: [{

                    label: 'Employee KPI',

                    data: values,

                    tension: 0.4,

                    borderWidth: 3

                }]
            }

        });

    </script>

@endsection
