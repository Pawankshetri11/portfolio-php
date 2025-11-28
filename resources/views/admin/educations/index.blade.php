
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Education</h3>
                </div>
                <div class="panel-body">
                    <a href="{{ route('educations.create') }}" class="btn btn-primary">Add Education</a>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Degree</th>
                                <th>Institution</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($educations as $education)
                                <tr>
                                    <td>{{ $education->degree }}</td>
                                    <td>{{ $education->institution }}</td>
                                    <td>{{ $education->start_date }}</td>
                                    <td>{{ $education->end_date }}</td>
                                    <td>
                                        <a href="{{ route('educations.edit', $education->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('educations.destroy', $education->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
