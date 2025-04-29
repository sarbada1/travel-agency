@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-2 mt-3 mb-4">
                                    <h2><i class="bi bi-plus-circle"></i> Manage Faq Section </h2>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="faq-form">
                                        <input type="hidden" id="faq-id">
                                        <div class="form-group mb-3">
                                            <label for="question">Question:</label>
                                            <input type="text" id="question" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="answer">Answer:</label>
                                            <textarea id="answer" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <button class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div id="faq-list"></div>
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
            CKEDITOR.replace('answer', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });

            loadFaqs();

            $('#faq-form').submit(function (e) {
                e.preventDefault();
                const id = $('#faq-id').val();
                const question = $('#question').val();
                const answer = CKEDITOR.instances['answer'].getData();

                if (id) {
                    updateFaq(id, question, answer);
                } else {
                    createFaq(question, answer);
                }
            });
            function createFaq(question, answer) {
                $.ajax({
                    url: "{{route('manage-faqs.store')}}",
                    method: 'POST',
                    data: {question, answer},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        loadFaqs();
                        resetForm();
                    }
                });
            }

            function updateFaq(id,question, answer) {
                let url = "{{route('manage-faqs.update', ':id')}}";
                $.ajax({
                    url: url.replace(':id', id),
                    method: 'PUT',
                    data: {question, answer},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        loadFaqs();
                        resetForm();
                    }
                });
            }

            function deleteFaq(id) {
                $.ajax({
                    url: "{{route('manage-faqs.destroy', ':id')}}".replace(':id', id),
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        loadFaqs();
                        console.log(response);
                    }
                });
            }

            function loadFaqs() {
                $.get("{{route('all-faqs')}}", function (faqs) {
                    let html = '';
                    faqs.forEach(faq => {
                        html += `
                            <div>
                                <h3>${faq.question}</h3>
                                <p>${faq.answer}</p>
                                <button class="btn btn-primary btn-sm" onclick="editFaq(${faq.id}, '${faq.question}', '${faq.answer.replace(/'/g, "\\'")}')">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteFaq(${faq.id})">Delete</button>
                            </div>
                        `;
                    });
                    $('#faq-list').html(html);
                });
            }

            window.editFaq = function (id,question, answer) {
                $('#faq-id').val(id);
                $('#question').val(question);
                CKEDITOR.instances['answer'].setData(answer);
            }

            function resetForm() {
                $('#faq-id').val('');
                $('#question').val('');
                CKEDITOR.instances['answer'].setData('');
            }
            window.deleteFaq = deleteFaq;
        });
    </script>
@endsection
