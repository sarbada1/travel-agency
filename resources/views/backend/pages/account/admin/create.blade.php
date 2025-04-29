@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-13">
                            <h2>
                                <i class="bi bi-person-circle"></i> Add new Member
                                <a href="{{route('admin.index')}}" class="btn btn-primary btn-sm pull-right">
                                    <i class="bi bi-people-fill"></i> Show Users</a>
                            </h2>

                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{$error}}
                                </div>
                            @endforeach

                            <hr>
                        </div>
                        <div class="col-md-13">
                            <form action="{{route('admin.store')}}" method="post">
                                @csrf
                                @method('post')
                                <div class="row">
                                    <div class="form-group mb-2">
                                        <label for="role">Role: <a
                                                style="color: red;">{{$errors->first('role')}}</a></label>
                                        <select name="role" id="role" class="form-control">
                                            <option value="" readonly>---Select Role---</option>
                                            @foreach($roles as $role)
                                                <option
                                                    value="{{$role->id}}" {{old('role') == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="account_type_id">Account Types: <a
                                                style="color: red;">{{$errors->first('account_type_id')}}</a></label>
                                        <select name="account_type_id" id="account_type_id" class="form-control">
                                            <option value="" readonly>---Select Account Type---</option>
                                            @foreach($accountTypes as $type)
                                                <option
                                                    value="{{$type->id}}" {{old('account_type_id') == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="name">Name : <a
                                                style="color: red;">{{$errors->first('name')}}</a></label>
                                        <input type="text" name="name" value="{{old('name')}}"
                                               id="name" class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email">Email: <a
                                                style="color: red;">{{$errors->first('email')}}</a></label>
                                        <input type="text" name="email" id="email"
                                               value="{{old('email')}}"
                                               class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password: <a
                                                style="color: red;">{{$errors->first('password')}}</a></label>
                                        <input type="password" name="password" id="password"
                                               class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password_confirmation">Confirm Password: <a
                                                style="color: red;">{{$errors->first('password_confirmation')}}</a></label>
                                        <input type="password" name="password_confirmation"
                                               id="password_confirmation"
                                               class="form-control">
                                    </div>


                                    <div class="col-md-12 mt-3">
                                        <button class="btn btn-success  w-100">
                                            <i class="bi bi-bag-plus-fill"></i> Add New Staff
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

@section('scripts')

@endsection
