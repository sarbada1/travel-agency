<div class="custom-container">
    <div class="row">
        <div class="faq_list mb-3"></div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <h5>Add New FAQ</h5>
            <input type="text" id="faq_question" class="form-control mb-2" placeholder="Enter Question">
            <textarea id="faq_answer" class="form-control mb-2" placeholder="Enter Answer"></textarea>
            <button class="btn btn-success" onclick="addFaq();">Add FAQ</button>
        </div>
    </div>
</div>

<?php
$getColumnName = ['question', 'answer'];
if (is_array($columnName)) {
    $getColumnName = implode(",", $columnName);
}
?>

@section('scripts')
    @parent
    <script>
        function getFaqs() {
            let tableName = '{{ $tableName }}';

            let sendData = {
                tableName: tableName,
                type: 'get_faqs'
            };

            axios.post('{{ route('ajax-faq-manage') }}', sendData)
                .then(function (response) {
                    let faqBox = document.querySelector('.faq_list');
                    faqBox.innerHTML = '';
                    let faqs = response.data.data;

                    if (faqs.length > 0) {
                        faqs.forEach(faq => {
                            faqBox.innerHTML += `
                                <div class="row mb-2">
                                    <div class="col-md-8">
                                        <h6>${faq.question}</h6>
                                        <p>${faq.answer}</p>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <button class="btn btn-primary btn-sm" onclick="editFaq(${faq.id}, '${faq.question}', '${faq.answer}');">Edit</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteFaq(${faq.id});">Delete</button>
                                    </div>
                                </div>
                                <hr>
                            `;
                        });
                    } else {
                        faqBox.innerHTML = `<p>No FAQs available</p>`;
                    }
                })
                .catch(function (error) {
                    console.error("Error retrieving FAQs:", error);
                });
        }

        function addFaq() {
            let tableName = '{{ $tableName }}';
            let question = document.getElementById('faq_question').value;
            let answer = document.getElementById('faq_answer').value;

            if (!question || !answer) {
                alert("Both question and answer are required.");
                return;
            }

            let sendData = {
                tableName: tableName,
                question: question,
                answer: answer,
                type: 'add_faq'
            };

            axios.post('{{ route('ajax-faq-manage') }}', sendData)
                .then(function (response) {
                    console.log("FAQ added successfully:", response.data);
                    document.getElementById('faq_question').value = '';
                    document.getElementById('faq_answer').value = '';
                    getFaqs();
                })
                .catch(function (error) {
                    console.error("Error adding FAQ:", error);
                });
        }

        function editFaq(id, question, answer) {
            let newQuestion = prompt("Edit Question:", question);
            let newAnswer = prompt("Edit Answer:", answer);

            if (newQuestion === null || newAnswer === null) return;

            let tableName = '{{ $tableName }}';
            let sendData = {
                tableName: tableName,
                id: id,
                question: newQuestion,
                answer: newAnswer,
                type: 'update_faq'
            };

            axios.post('{{ route('ajax-faq-manage') }}', sendData)
                .then(function (response) {
                    console.log("FAQ updated successfully:", response.data);
                    getFaqs();
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
                id: id,
                type: 'delete_faq'
            };

            axios.post('{{ route('ajax-faq-manage') }}', sendData)
                .then(function (response) {
                    console.log("FAQ deleted successfully:", response.data);
                    getFaqs();
                })
                .catch(function (error) {
                    console.error("Error deleting FAQ:", error);
                });
        }

        $(document).ready(function () {
            getFaqs();
        });
    </script>
@endsection
