@extends('manager.layout.admin')

@section('content')

    <div class="card">

        <div class="card-header">
            <h4>Update Team Rating</h4>
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('manager.performance.update', $performance->id) }}">

                @csrf

                <label class="mb-2">
                    Manager Rating (1-5)
                </label>

                <select name="manager_rating"
                        class="form-control"
                        >

                    <option value="1">⭐ 1 Star</option>
                    <option value="2">⭐⭐ 2 Star</option>
                    <option value="3">⭐⭐⭐ 3 Star</option>
                    <option value="4">⭐⭐⭐⭐ 4 Star</option>
                    <option value="5">⭐⭐⭐⭐⭐ 5 Star</option>

                </select>

                <button class="btn btn-primary mt-3">
                    Update Rating
                </button>

            </form>

        </div>

    </div>

@endsection
