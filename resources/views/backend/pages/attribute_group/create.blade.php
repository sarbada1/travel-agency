@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="py-3 card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2><i class="bi bi-plus-circle"></i> Add Attribute Group
                                        <a href="{{route('manage-attribute-group.index')}}"
                                           class="btn btn-success btn-sm float-end">
                                            <i class="bi bi-eye-fill"></i> Show Attribute Groups</a>
                                    </h2>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @include('backend.layouts.message')
                                </div>
                                <form action="{{route('manage-attribute-group.store')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label for="name">Name:
                                                    <a style="color: red;">{{$errors->first('name')}}</a>
                                                </label>
                                                <input type="text" id="name" name="name"
                                                       class="form-control"
                                                       value="{{old('name')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label for="slug">Slug:
                                                    <a style="color: red;">{{$errors->first('slug')}}</a>
                                                </label>
                                                <input type="text" id="slug" name="slug"
                                                       class="form-control"
                                                       value="{{old('slug')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label for="display_order">Display Order:
                                                    <a style="color: red;">{{$errors->first('display_order')}}</a>
                                                </label>
                                                <input type="number" id="display_order" name="display_order"
                                                       class="form-control"
                                                       value="{{old('display_order', 0)}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 form-group">
                                                <label for="active">Status:</label>
                                                <div class="form-check mt-2">
                                                    <input class="form-check-input" type="checkbox" id="active" name="active" value="1" 
                                                        {{old('active', true) ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="active">
                                                        Active
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 form-group">
                                        <label for="description">Description:
                                            <a style="color: red;">{{$errors->first('description')}}</a>
                                        </label>
                                        <textarea name="description" id="description"
                                                  class="form-control" rows="5">{{old('description')}}</textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-success w-100">
                                            <i class="bi bi-plus-circle"></i> Add Attribute Group
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            // Auto-generate slug from name
            $('#name').on('keyup', function () {
                var name = $(this).val();
                var slug = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                $('#slug').val(slug);
            });
        });
    </script>
@endsection