@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pull-left">
                                <h2><i class="bi bi-file-earmark-lock-fill"></i> Manage Role</h2>
                            </div>
                            <div class="pull-right">
                                @can('roles_create')
                                    <a class="btn btn-success btn-sm" href="{{ route('roles.create') }}">
                                        <i class="bi bi-bag-plus-fill"></i> Create New Role
                                    </a>
                                @endcan
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="row mt-3 mb-3">
                        @foreach ($roles as $key => $role)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $role->name }}</h5>

                                        <form action="{{route('roles.destroy',$role->id)}}" method="post">
                                            <a class="btn btn-info btn-sm"
                                               href="{{ route('roles.show',$role->id) }}">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            @can('roles_edit')
                                                <a class="btn btn-primary btn-sm"
                                                   href="{{ route('roles.edit',$role->id) }}">
                                                    <i class="bi bi-pencil-square"></i> </a>
                                            @endcan
                                            @can('roles_delete')

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            @endcan
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

@section('scripts')
@endsection

