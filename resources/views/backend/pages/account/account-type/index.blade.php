@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mt-3 mb-2">
                            <h2>
                                <i class="bi bi-newspaper"></i> Account Types
                            </h2>
                        </div>
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" method="post" onsubmit="addAccountType(event)">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="name">Type:
                                                <span id="nameError" style="color: red;"></span>
                                            </label>
                                            <input type="text" id="name" class="form-control">
                                        </div>
                                        <div class="form-group mb-3">
                                            <button id="btn_name" class="btn btn-success">
                                                <i class="bi bi-plus-circle"></i> Add Account Type
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mt-3 mb-2">
                            <h2>
                                <i class="bi bi-eye"></i> Show Account Types
                            </h2>

                        </div>
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div id="result-section"></div>
                        </div>

                        <div class="card-body">
                            <div class="modal fade" id="update_section" tabindex="-1" aria-hidden="true"
                                 style="display: none;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <i class="bi bi-pencil-square"></i> Update Account Types</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" id="criteria">
                                            <label for="update_section_name">Name:</label>
                                            <input type="text" class="form-control" id="update_section_name">
                                            <span id="updateNameError" style="color: red;"></span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" onclick="updateSection()" class="btn btn-primary">Save
                                                changes
                                            </button>
                                        </div>
                                    </div>
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

        function addAccountType(e) {
            e.preventDefault();
            let name = document.getElementById('name').value;
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let sendData = {
                name: name
            }
            axios.post('{{route('manage-account-type.store')}}', sendData, {
                headers: {
                    'X-CSRF-TOKEN': token
                }

            }).then(function (response) {
                if (response.data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.data.success,
                        timer: 1500
                    })
                    document.querySelector('form').reset();
                    document.getElementById('nameError').innerText = '';
                }

                getAllData();
            })
                .catch(function (error) {
                    if (error.response.data.errors.name) {
                        document.getElementById('nameError').innerText = error.response.data.errors.name[0];
                    }
                    console.log(error);
                });


        }

        function getAllData() {
            axios.get('{{route('manage-account-type.all-account-type')}}')
                .then(function (response) {
                    let data = response.data;
                    let outPut = '<div class="row">';
                    data.forEach(function (item, index) {
                        outPut += `
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">${item.name}</h5>

                                    <button type="button" class="btn btn-primary btn-sm"  onclick="editSection(${item.id})" data-bs-toggle="modal" data-bs-target="#update_section">
                                        <i class="fa fa-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteSection(${item.id})"> <i class="bi bi-trash"></i></button>
                                </div>
                            </div>

                        </div>
                        `;
                    });
                    outPut += '</div>';
                    document.getElementById('result-section').innerHTML = outPut;

                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        getAllData();

        function deleteSection(id) {
            let sendData = {
                id: id
            }
            axios.post('{{route('manage-account-type.delete')}}', sendData)
                .then(function (response) {
                    if (response.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: response.data.success,
                            timer: 3000
                        })
                        getAllData();
                    } else {
                        console.log(response);
                        Swal.fire({
                            icon: 'error',
                            title: response.data.error,
                        })
                    }

                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        function editSection(id) {
            let sendData = {
                id: id
            }
            axios.post('{{route('manage-account-type.edit')}}', sendData)
                .then(function (response) {
                    let data = response.data;
                    console.log(data);
                    document.getElementById('update_section_name').value = data.name;
                    document.getElementById('criteria').value = data.id;
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        function updateSection() {
            let type = document.getElementById('update_section_name').value;
            let id = document.getElementById('criteria').value;
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            let sendData = {
                id: id,
                name: type
            }
            axios.post('{{route('manage-account-type.update')}}', sendData, {
                headers: {
                    'X-CSRF-TOKEN': token
                }
            })
                .then(function (response) {
                    if (response.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: response.data.success,
                            timer: 3000
                        })
                        getAllData();
                        document.getElementById('updateNameError').innerText = '';
                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: response.data.error,
                        })
                    }
                })
                .catch(function (error) {
                    if (error.response.data.errors.name) {
                        document.getElementById('updateNameError').innerText = error.response.data.errors.name[0];
                    }
                    console.log(error);
                });
        }


    </script>

@endsection


