@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Certificates</h1>
    <a href="{{ route('admin.certificates.create') }}" class="btn btn-primary mb-3">Add New Certificate</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Issuing Organization</th>
                <th>Issue Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($certificates as $certificate)
                <tr>
                    <td>{{ $certificate->name }}</td>
                    <td>{{ $certificate->issuing_organization }}</td>
                    <td>{{ $certificate->issue_date->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.certificates.edit', $certificate->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('admin.certificates.destroy', $certificate->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this certificate?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No certificates found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
