@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-pencil-square"></i> Edit Ad Position
                                <a href="{{ route('manage-ad-position.index') }}" class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-eye-fill"></i> Show Positions</a>
                            </h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @include('backend.layouts.message')
                        <hr>
                    </div>

                    <form action="{{ route('manage-ad-position.update', $position->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Position Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $position->name) }}" required>
                                <small class="text-muted">Position name like (e.g., Blog Sidebar Top, After Blog Content)</small>

                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="identifier" class="form-label">Identifier <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="identifier" name="identifier" value="{{ old('identifier', $position->identifier) }}" required>
                                <small class="text-muted">Unique identifier used to reference this position in templates (e.g., blog_sidebar_top)</small>
                                @error('identifier')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $position->description) }}</textarea>
                                <small class="text-muted">Brief description of where this ad position is located</small>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Update Position</button>
                                <a href="{{ route('manage-ad-position.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection