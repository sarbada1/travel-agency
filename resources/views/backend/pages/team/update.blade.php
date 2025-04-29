<?php
$columnName = "image";
?>
@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-xl-12">

                    <div class="card">
                        <div class="card-body pt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>
                                        <i class="bi bi-pencil-square"></i> Update Team Member
                                        <a href="{{route('manage-team.index')}}"
                                           class="btn btn-primary btn-sm float-end">
                                            <i class="bi bi-eye-fill"></i> Show Teams</a>
                                    </h2>
                                    @include('backend.layouts.message')
                                </div>
                                <div class="col-md-12">
                                    <form action="{{route('manage-team.update',$teamData->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="tab-content pt-2">
                                            <div class="tab-pane fade mt-3 show active profile-overview"
                                                 id="profile-overview">
                                                <div class="row">

                                                    <div class="col-md-8">

                                                        <div class="form-group mb-2">
                                                            <label for="member_type_id">Member Types: <a
                                                                    style="color: red;">{{$errors->first('member_type_id')}}</a></label>
                                                            <select name="member_type_id" id="member_type_id"
                                                                    class="form-control">
                                                                <option
                                                                    value="{{$teamData->memberType->id}}">{{$teamData->memberType->type}}
                                                                </option>
                                                                @foreach($membersTypeData as $type)
                                                                    @if($type->id != $teamData->memberType->id)
                                                                        <option
                                                                            value="{{$type->id}}" {{old('member_type_id') == $type->id ? 'selected' : ''}}>{{$type->type}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group mb-1">
                                                                    <label for="name">Full Name:
                                                                        <a style="color: red;">{{$errors->first('name')}}</a>
                                                                    </label>
                                                                    <input name="name" type="text" class="form-control"
                                                                           id="name"
                                                                           value="{{$teamData->name}}">

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group mb-2">
                                                                    <label for="Email">Email:
                                                                        <a style="color: red;">{{$errors->first('email')}}</a>
                                                                    </label>
                                                                    <input name="email" type="email"
                                                                           class="form-control"
                                                                           id="Email"
                                                                           value="{{$teamData->email}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-2">
                                                                    <label for="phone">Phone:
                                                                        <a style="color: red;">{{$errors->first('phone')}}</a>
                                                                    </label>
                                                                    <input name="phone" type="text" class="form-control"
                                                                           id="phone"
                                                                           value="{{$teamData->phone}}">

                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-2">
                                                                    <label for="gender">Gender:
                                                                        <a style="color: red;">{{$errors->first('gender')}}</a>
                                                                    </label>
                                                                    <select name="gender" id="gender"
                                                                            class="form-control">
                                                                        <option value="" readonly selected>Select Gender
                                                                        </option>
                                                                        <option
                                                                            value="male" {{$teamData->gender=='male' ? 'selected':''}}>
                                                                            Male
                                                                        </option>
                                                                        <option
                                                                            value="female" {{$teamData->gender=='female' ? 'selected':''}}>
                                                                            Female
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-2">
                                                                    <label for="birthday">Birthday:
                                                                        <a style="color: red;">{{$errors->first('birthday')}}</a>
                                                                    </label>
                                                                    <input name="birthday" type="date"
                                                                           class="form-control"
                                                                           id="birthday"
                                                                           value="{{$teamData->birthday}}">

                                                                </div>
                                                            </div>

                                                        </div>


                                                        <div class="form-group mb-2">
                                                            <label for="description">About:
                                                                <a style="color: red;">{{$errors->first('description')}}</a>
                                                            </label>
                                                            <textarea name="description" class="form-control"
                                                                      id="description"
                                                                      style="height: 100px">{{$teamData->description}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-2">
                                                            <label for="country">Country:
                                                                <a style="color: red;">{{$errors->first('country')}}</a>
                                                            </label>
                                                            <input type="text" name="country"
                                                                   value="{{$teamData->country}}"
                                                                   class="form-control">
                                                        </div>


                                                        <div class="form-group mb-2">
                                                            <label for="Address">Address:
                                                                <a style="color: red;">{{$errors->first('address')}}</a>
                                                            </label>
                                                            <input name="address" type="text" class="form-control"
                                                                   id="Address"
                                                                   value="{{$teamData->address}}">

                                                        </div>

                                                        <div class="form-group mb-2">
                                                            <label for="Twitter">Twitter </label>
                                                            <input name="twitter" type="text" class="form-control"
                                                                   id="Twitter"
                                                                   value="{{$teamData->twitter}}">

                                                        </div>

                                                        <div class="form-group mb-2">
                                                            <div class="form-group mb-3">
                                                                <label for="Facebook">Facebook</label>
                                                                <input name="facebook" type="text" class="form-control"
                                                                       id="Facebook"
                                                                       value="{{$teamData->facebook}}">
                                                            </div>

                                                            <div class="form-group mb-2">
                                                                <label for="Instagram">Instagram</label>
                                                                <input name="instagram" type="text" class="form-control"
                                                                       id="Instagram"
                                                                       value="{{$teamData->instagram}}">

                                                            </div>

                                                            <div class="form-group mb-2">
                                                                <label for="Linkedin">Linkedin</label>
                                                                <input name="linkedin" type="text" class="form-control"
                                                                       id="Linkedin"
                                                                       value="{{$teamData->linkedin}}">
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <label for="profileImage"> Image</label>
                                                                @include('backend.layouts.update-image',['tableName'=>$teamData->getTable(),'id'=>$teamData->id])

                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary w-100">
                                                            <i class="bi bi-pencil-square"></i> Update Member
                                                        </button>
                                                    </div>
                                                </div>


                                            </div><!-- End Bordered Tabs -->
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

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


