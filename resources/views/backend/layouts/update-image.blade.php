<style>
    .custom-container {
        border: 1px solid #ccc;
        padding: 5px;
    }

    .show_image img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .custom-file-input {
        display: inline-block;
        position: relative;
    }

    .custom-file-input input[type="file"] {
        position: absolute;
        left: -9999px;
    }

    .custom-file-input label {
        display: inline-block;
        padding: 8px 12px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        border-radius: 4px;
    }

    .file-name {
        margin-left: 10px;
    }
</style>

<div class="custom-container">
    <div class="row">
        <div class="show_image mb-3"></div>
    </div>
</div>

<?php
$getColumnName = $columnName;
if (is_array($columnName)) {
    $getColumnName = implode(",", $columnName);
}
?>

@section('scripts')
    @parent
    <script>
        function getFile() {
            let tableName = '{{ $tableName }}';
            let id = '{{ $id }}';
            let columnName = '{{ $getColumnName ?? "image" }}';

            let sendData = {
                tableName: tableName,
                columnName: columnName,
                id: id,
                type: 'get_file'
            };

            axios.post('{{ route('ajax-file-manage') }}', sendData)
                .then(function (response) {
                    const length = Object.keys(response.data.data).length;
                    let show_box = document.querySelector('.show_image');
                    show_box.innerHTML = '';
                    
                    if (length > 1) {
                        // Multiple images/fields case
                        let data = Object.keys(response.data.data).map(function (key) {
                            return [key, response.data.data[key]];
                        });
                        let imagePath = '<div class="row">';

                        data.map(function (item) {
                            let fieldName = item[0];
                            let imageUrl = item[1];
                            
                            imagePath += `
                            <div class="col-md-6">
                                <label>${fieldName}</label>
                                <img src="${imageUrl}" alt="${fieldName}" style="height: 200px; display: block;">
                                <div class="btn btn-danger btn-sm mt-1" title="Delete Image" onclick="deleteFile('${imageUrl}','${fieldName}');">
                                    <i class="bi bi-trash-fill"></i>
                                </div>
                                <div class="custom-file-input float-end">
                                    <input type="file" class="form-control mb-2 float-end" id="upload_file_${fieldName}" onchange="uploadFile(event, '${imageUrl}','${fieldName}');">
                                    <label for="upload_file_${fieldName}" class="file-label">
                                        <i class="bi bi-image-fill"></i> Update
                                    </label>
                                    <span class="file-name"></span>
                                </div>
                            </div>`;
                        });
                        
                        imagePath += '</div>';
                        show_box.innerHTML = imagePath;
                    } else {
                        // Single image/field case
                        let data = response.data.data;
                        console.log(data);
                        
                        // Get the actual field name instead of using hardcoded 'image'
                        let actualFieldName = Object.keys(data)[0]; // This will be 'logo' or whatever the field name is
                        let imageUrl = data[actualFieldName];
                        
                        let imagePath = `
                            <div class="row">
                                <div class="col-md-12">
                                    <img src='${imageUrl}' style="height: 200px;">
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="btn btn-danger btn-sm mt-1" title="Delete Image" onclick="deleteFile('${imageUrl}','${actualFieldName}');">
                                            <i class="bi bi-trash-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="custom-file-input float-end">
                                            <input type="file" id="upload_file" class="form-control mb-2 float-end" onchange="uploadFile(event, '${imageUrl}','${actualFieldName}');">
                                            <label for="upload_file">
                                                <i class="bi bi-image-fill"></i> Update</label>
                                            <span class="file-name"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        show_box.innerHTML = imagePath;
                    }
                })
                .catch(function (error) {
                    console.log("Error retrieving file:", error);
                });
        }

        function deleteFile(imagePath, columnName) {
            let tableName = '{{ $tableName }}';
            let id = '{{ $id }}';
            let sendData = {
                tableName: tableName,
                columnName: columnName || 'image', // Use provided columnName or fallback to 'image'
                id: id,
                type: 'delete_file',
                imagePath: imagePath
            };
            
            axios.post('{{route('ajax-file-manage')}}', sendData)
                .then(function (response) {
                    console.log("File deleted:", response.data);
                    getFile();
                })
                .catch(function (error) {
                    console.log("Error deleting file:", error);
                });
        }

        function uploadFile(event, currentImage, columnName) {
            let file = event.target.files[0];
            if (!file) return;

            let tableName = '{{ $tableName }}';
            let id = '{{ $id }}';
            console.log("Uploading for column:", columnName);
            
            let formData = new FormData();
            formData.append('file', file);
            formData.append('tableName', tableName);
            formData.append('columnName', columnName || 'image'); // Use provided columnName or fallback to 'image'
            formData.append('id', id);
            formData.append('currentImage', currentImage);
            formData.append('type', 'upload_file');

            axios.post('{{route('ajax-file-manage')}}', formData)
                .then(function (response) {
                    console.log("File uploaded successfully:", response.data);
                    getFile();
                })
                .catch(function (error) {
                    console.error("Error uploading file:", error);
                });
        }

        $(document).ready(function () {
            getFile();
        });
    </script>
@endsection
