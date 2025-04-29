@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card py-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
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
                                            <button class="btn btn-success w-100">Add Faq</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card py-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2><i class="bi bi-eye-fill"></i> Faq List </h2>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>S.n</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="faq-list">
                                        </tbody>
                                    </table>
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
            CKEDITOR.replace('answer', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });
            let tableName = '{{ $tableName }}';
            let parentId = '{{ $parentId }}';

            function printLimitText(text, limit = 100) {
                return text.replace(/<[^>]+>/g, ' ').substr(0, limit) + '...';
            }

            function getFaqData() {
                let sendData = {
                    tableName: tableName,
                    parentId: parentId,
                    type: 'get_faqs'
                };

                axios.post('{{ route('ajax-faq-manage') }}', sendData)
                    .then(function (response) {
                        let tBodyData = $('#faq-list')
                        let faqs = response.data
                        let outPut = "";
                        faqs.forEach((faq, index) => {
                            outPut += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${faq.question}</td>
                                    <td>${printLimitText(faq.answer)}</td>
                                    <td style="width: 10%;">
                                        <button class="btn btn-primary btn-sm" onclick="editFaq(${faq.id}, '${faq.question}', '${faq.answer}')">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteFaq(${faq.id})">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </td>
                                </tr>
                            `
                        });
                        tBodyData.html(outPut);
                    })
                    .catch(function (error) {
                        console.error("Error retrieving FAQs:", error);
                    });

            }

            getFaqData();


            $('#faq-form').submit(function (e) {
                e.preventDefault();
                const id = $('#faq-id').val();
                const question = $('#question').val();
                const answer = CKEDITOR.instances['answer'].getData();
                if (question.trim() == '') {
                    alert('Question is required');
                    return;
                }
                if (answer.trim() == '') {
                    alert('Answer is required');
                    return;
                }
                if (id) {
                    updateFaq(id, question, answer);
                } else {
                    createFaq(question, answer);
                }
            });

            function createFaq(question, answer) {
                let data = {
                    tableName: tableName,
                    parentId: parentId,
                    type: 'add_faqs',
                    question: question,
                    answer: answer
                };
                axios.post('{{ route('ajax-faq-manage') }}', data)
                    .then(function (response) {
                        getFaqData();
                        resetForm();
                        Swal.fire({
                            title: "Success!",
                            text: "FAQ added successfully!",
                            icon: "success",
                            timer: 2000
                        });
                    })
                    .catch(function (error) {
                        console.error("Error adding FAQ:", error);
                    });

            }

            function updateFaq(id, question, answer) {

                let tableName = '{{ $tableName }}';
                let sendData = {
                    tableName: tableName,
                    parentId: parentId,
                    id: id,
                    question: question,
                    answer: answer,
                    type: 'update_faqs'
                };

                axios.post('{{ route('ajax-faq-manage') }}', sendData)
                    .then(function (response) {
                        console.log("FAQ updated successfully:", response.data);
                        getFaqData();
                        resetForm();
                    })
                    .catch(function (error) {
                        console.error("Error updating FAQ:", error);
                    });
            }


            function deleteFaq(id) {
                if (!confirm("Are you sure you want to delete this FAQ?")) return;

                let tableName = '{{ $tableName }}';
                let sendData = {
                    tableName: tableName,
                    parentId: parentId,
                    id: id,
                    type: 'delete_faqs'
                };

                axios.post('{{ route('ajax-faq-manage') }}', sendData)
                    .then(function (response) {
                        console.log("FAQ deleted successfully:", response.data);
                        getFaqData();
                    })
                    .catch(function (error) {
                        console.error("Error deleting FAQ:", error);
                    });
            }

            window.editFaq = function (id, question, answer) {
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

