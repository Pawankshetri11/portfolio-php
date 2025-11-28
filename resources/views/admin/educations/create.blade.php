@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add Education</h3>
                </div>
                <div class="panel-body">
                    <form action="{{ route('educations.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="degree">Degree</label>
                            <input type="text" name="degree" id="degree" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="institution">Institution</label>
                            <input type="text" name="institution" id="institution" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection