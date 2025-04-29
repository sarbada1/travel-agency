<?php
$columnName = "image";
?>
@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-eye-fill"></i> Update Account
                            </h2>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form action="{{route('admin.update',$adminData->id)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="role">Role: <a
                                                style="color: red;">{{$errors->first('role')}}</a></label>
                                        <select name="role" id="role" class="form-control">
                                            @if(count($adminData->role)>0)
                                                <option value="{{$adminData->role[0]->id}}"
                                                        selected>
                                                    {{$adminData->role[0]->name}}
                                                </option>
                                            @else
                                                <option value="">---Select Role---</option>
                                            @endif

                                            @foreach($roles as $role)
                                                <option
                                                    value="{{$role->id}}" {{old('role') == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="account_type_id">Account Types: <a
                                                style="color: red;">{{$errors->first('account_type_id')}}</a></label>
                                        <select name="account_type_id" id="account_type_id" class="form-control">
                                            @if($adminData->account_type)
                                                <option value="{{$adminData->account_type->id}}">
                                                    {{$adminData->account_type->name ?? ""}}
                                                </option>
                                            @else
                                                <option value="">---Select Account Type---</option>
                                            @endif
                                            @foreach($accountTypes as $type)
                                                <option
                                                    value="{{$type->id}}" {{old('account_type_id') == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group mb-2">
                                        <label for="name">Full Name</label>
                                        <input name="name" type="text" class="form-control" id="name"
                                               value="{{$adminData->name}}">

                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="phone_number">Phone</label>
                                        <input name="phone_number" type="text" class="form-control"
                                               id="phone_number"
                                               value="{{$adminData->phone_number ?? ''}}">

                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="birthday">Birthday</label>
                                        <input name="birthday" type="date" class="form-control"
                                               id="birthday"
                                               value="{{$adminData->birthday ?? ''}}">

                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="Email">Email</label>
                                        <input name="email" type="email" class="form-control" id="Email"
                                               value="{{$adminData->email}}">
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="description">About</label>
                                        <textarea name="description" class="form-control" id="description"
                                                  style="height: 100px">{!! $adminData->description?? '' !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="male"
                                                {{$adminData->gender=='male' ? 'selected':''}}> Male
                                            </option>
                                            <option value="female" {{$adminData->gender=='female' ? 'selected':''}}>
                                                Female
                                            </option>
                                            <option value="other" {{$adminData->gender=='other' ? 'selected':''}}>
                                                Other
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="Address">Address</label>
                                        <input name="address" type="text" class="form-control" id="Address"
                                               value="{{$adminData->address ?? ''}}">

                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="city">City</label>
                                        <input name="city" type="text" class="form-control" id="city"
                                               value="{{$adminData->city ?? ''}}">
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="Twitter">Twitter </label>
                                        <input name="twitter" type="text" class="form-control" id="Twitter"
                                               value="{{$adminData->twitter ?? ''}}">

                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="Facebook">Facebook</label>
                                        <input name="facebook" type="text" class="form-control" id="Facebook"
                                               value="{{$adminData->facebook ?? ''}}">
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="Instagram">Instagram</label>
                                        <input name="instagram" type="text" class="form-control" id="Instagram"
                                               value="{{$adminData->instagram ?? ''}}">

                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="Linkedin">Linkedin</label>
                                        <input name="linkedin" type="text" class="form-control" id="Linkedin"
                                               value="{{$adminData->linkedin ?? ''}}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="profileImage">Profile Image</label>
                                        @include('backend.layouts.update-image',['tableName'=>$adminData->getTable(),'id'=>$adminData->id])

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary w-100">Update Profile</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </main><!-- End #main -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            CKEDITOR.replace('description', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });

        });


    </script>
@endsection


