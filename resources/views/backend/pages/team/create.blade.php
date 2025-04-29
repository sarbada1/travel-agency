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
                                        <i class="bi bi-plus-circle"></i> Add Team Member
                                        <a href="{{route('manage-team.index')}}"
                                           class="btn btn-primary btn-sm float-end">
                                            <i class="bi bi-eye-fill"></i> Show Teams</a>
                                    </h2>
                                    @include('backend.layouts.message')
                                </div>
                                <div class="col-md-12">
                                    <form action="{{route('manage-team.store')}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="tab-content pt-2">
                                            <div class="tab-pane fade mt-3 show active profile-overview"
                                                 id="profile-overview">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-2">
                                                            <label for="member_type_id">Member Types: <a
                                                                    style="color: red;">{{$errors->first('member_type_id')}}</a></label>
                                                            <select name="member_type_id" id="member_type_id"
                                                                    class="form-control">
                                                                <option value="" readonly selected>Select Member Type
                                                                </option>
                                                                @foreach($membersTypeData as $type)
                                                                    <option
                                                                        value="{{$type->id}}" {{old('member_type_id') == $type->id ? 'selected' : ''}}>{{$type->type}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group mb-2">
                                                            <label for="name">Full Name:
                                                                <a style="color: red;">{{$errors->first('name')}}</a>
                                                            </label>
                                                            <input name="name" type="text" class="form-control"
                                                                   id="name"
                                                                   value="{{old('name')}}">

                                                        </div>


                                                        <div class="form-group mb-2">
                                                            <label for="Email">Email:
                                                                <a style="color: red;">{{$errors->first('email')}}</a>
                                                            </label>
                                                            <input name="email" type="email" class="form-control"
                                                                   id="Email"
                                                                   value="{{old('email')}}">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for="phone">Phone:
                                                                <a style="color: red;">{{$errors->first('phone')}}</a>
                                                            </label>
                                                            <input name="phone" type="text" class="form-control"
                                                                   id="phone"
                                                                   value="{{old('phone')}}">

                                                        </div>

                                                        <div class="form-group mb-2">
                                                            <label for="description">About:
                                                                <a style="color: red;">{{$errors->first('description')}}</a>
                                                            </label>
                                                            <textarea name="description" class="form-control"
                                                                      id="description"
                                                                      style="height: 100px">{{old('description')}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-2">
                                                            <label for="gender">Gender:
                                                                <a style="color: red;">{{$errors->first('gender')}}</a>
                                                            </label>
                                                            <select name="gender" id="gender" class="form-control">
                                                                <option value="" readonly selected>Select Gender
                                                                </option>
                                                                <option
                                                                    value="male" {{old('gender')=='male' ? 'selected':''}}>
                                                                    Male
                                                                </option>
                                                                <option
                                                                    value="female" {{old('gender')=='female' ? 'selected':''}}>
                                                                    Female
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group mb-2">
                                                            <label for="birthday">Birthday:
                                                                <a style="color: red;">{{$errors->first('birthday')}}</a>
                                                            </label>
                                                            <input name="birthday" type="date" class="form-control"
                                                                   id="birthday"
                                                                   value="{{old('birthday')}}">

                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for="country">Country:
                                                                <a style="color: red;">{{$errors->first('country')}}</a>
                                                            </label>
                                                            <input type="text" name="country" value="{{old('country')}}"
                                                                   class="form-control">
                                                        </div>


                                                        <div class="form-group mb-3">
                                                            <label for="Address">Address:
                                                                <a style="color: red;">{{$errors->first('address')}}</a>
                                                            </label>
                                                            <input name="address" type="text" class="form-control"
                                                                   id="Address"
                                                                   value="{{old('address')}}">

                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="Twitter">Twitter </label>
                                                            <input name="twitter" type="text" class="form-control"
                                                                   id="Twitter"
                                                                   value="{{old('twitter')}}">

                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <div class="form-group mb-4">
                                                                <label for="Facebook">Facebook</label>
                                                                <input name="facebook" type="text" class="form-control"
                                                                       id="Facebook"
                                                                       value="{{old('facebook')}}">
                                                            </div>

                                                            <div class="form-group mb-3">
                                                                <label for="Instagram">Instagram</label>
                                                                <input name="instagram" type="text" class="form-control"
                                                                       id="Instagram"
                                                                       value="{{old('instagram')}}">

                                                            </div>

                                                            <div class="form-group mb-3">
                                                                <label for="Linkedin">Linkedin</label>
                                                                <input name="linkedin" type="text" class="form-control"
                                                                       id="Linkedin"
                                                                       value="{{old('linkedin')}}">
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <label for="image"> Image:
                                                                    <a style="color: red;">{{$errors->first('image')}}</a>
                                                                </label>
                                                                <input type="file" name="image" class="form-control"
                                                                       id="image">

                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary w-100">Add Member</button>
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


