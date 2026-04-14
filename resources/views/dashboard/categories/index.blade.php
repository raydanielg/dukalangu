@extends('layouts.dashboard')

@section('title', 'Categories')
@section('page-title', 'Product Categories')

@section('content')
<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="dashboard-card animate__animated animate__fadeIn">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">Add New Category</h5>
            </div>
            <div class="dashboard-card-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g., Electronics" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description (Optional)</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Brief description..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i data-lucide="plus" class="me-2"></i>Add Category
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="dashboard-card animate__animated animate__fadeIn" style="animation-delay: 0.1s;">
            <div class="dashboard-card-header">
                <h5 class="dashboard-card-title">Your Categories</h5>
            </div>
            <div class="dashboard-card-body p-0">
                @if($categories->count() > 0)
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Products</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td class="fw-semibold">{{ $category->name }}</td>
                                <td>{{ Str::limit($category->description, 50) }}</td>
                                <td><span class="badge bg-secondary">0</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i data-lucide="edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i data-lucide="trash-2"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-5">
                        <i data-lucide="folder-open" style="width: 48px; height: 48px; color: #9ca3af;"></i>
                        <p class="text-muted mt-3 mb-0">No categories yet. Add your first category!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
