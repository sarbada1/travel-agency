@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <h2><i class="bi bi-plus-circle"></i> Create New Role
                                    <a class="btn btn-primary btn-sm float-end" href="{{ route('roles.index') }}">
                                        Back</a>
                                </h2>
                                <hr>
                            </div>
                        </div>
                        <div class="col-md-12">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                        <div class="col-md-12">
                            <form action="{{route('roles.store')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name">Role Name:
                                        <span class="text-danger">*
                                    {{$errors->first('name')}}
                                    </span>
                                    </label>
                                    <input type="text" id="name" name="name"
                                           value="{{old('name')}}"
                                           class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Permission:
                                        {{$errors->first('permission')}}
                                    </label>
                                    <br/>
                                    @foreach($permission as $value)
                                        <label>
                                            <input type="checkbox" name="permission[]"
                                                   value="{{$value->id}}"
                                                   @if(is_array(old('permission')) && in_array($value->id, old('permission'))) checked @endif

                                            > {{ $value->name }}
                                        </label>

                                    @endforeach
                                </div>
                                <div class="form-group mb-3">
                                    <button class="btn btn-primary w-100">
                                        <i class="bi bi-plus-circle"></i> Add Role
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')

@endsection

