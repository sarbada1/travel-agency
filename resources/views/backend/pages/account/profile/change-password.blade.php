@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-3 mb-4">
                        <div class="col-md-13">
                            <h2>
                                <i class="bi bi-lock-fill"></i> Update Password
                            </h2>
                            @include('lib.message')

                            <hr>
                        </div>
                        <div class="col-md-13">
                            <form action="{{route('change-password')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label for="old_password">Old Password: <a
                                                style="color: red;">{{$errors->first('old_password')}}</a></label>
                                        <input type="password" name="old_password" id="old_password"
                                               value="{{old('old_password')}}"
                                               class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password">Password: <a
                                                style="color: red;">{{$errors->first('password')}}</a></label>
                                        <input type="password" name="password" id="password"
                                               value="{{old('password')}}"
                                               class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password_confirmation">Confirm Password: <a
                                                style="color: red;">{{$errors->first('password_confirmation')}}</a></label>
                                        <input type="password" name="password_confirmation"
                                               id="password_confirmation"
                                               value="{{old('password_confirmation')}}"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button class="btn btn-success  w-100">
                                        <i class="bi bi-bag-plus-fill"></i> Change Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

@section('scripts')

@endsection
