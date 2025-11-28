@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Add New Certificate</h1>
    <form action="{{ route('admin.certificates.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Certificate Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="issuing_organization" class="form-label">Issuing Organization</label>
            <input type="text" class="form-control" id="issuing_organization" name="issuing_organization" value="{{ old('issuing_organization') }}" required>
            @error('issuing_organization')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="issue_date" class="form-label">Issue Date</label>
            <input type="date" class="form-control" id="issue_date" name="issue_date" value="{{ old('issue_date') }}" required>
            @error('issue_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="icon" class="form-label">Icon (e.g., Font Awesome class)</label>
            <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon') }}" required>
            @error('icon')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="view_type" class="form-label">View Type</label>
            <select class="form-control" id="view_type" name="view_type" required>
                <option value="link" {{ old('view_type') == 'link' ? 'selected' : '' }}>Link</option>
                <option value="image" {{ old('view_type') == 'image' ? 'selected' : '' }}>Image</option>
            </select>
            @error('view_type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="credential_url" class="form-label">Credential URL (if view type is Link)</label>
            <input type="url" class="form-control" id="credential_url" name="credential_url" value="{{ old('credential_url') }}">
            @error('credential_url')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="certificate_image" class="form-label">Certificate Image URL (if view type is Image)</label>
            <input type="text" class="form-control" id="certificate_image" name="certificate_image" value="{{ old('certificate_image') }}">
            @error('certificate_image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Add Certificate</button>
        <a href="{{ route('admin.certificates.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
