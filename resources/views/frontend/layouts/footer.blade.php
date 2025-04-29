@section('footer')
    <!-- Bootstrap JS Bundle with Popper -->
    <!-- Footer -->
    <footer id="contact" class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">AdSpot</h5>
                    <p class="text-white">The #1 marketplace for all your needs. Find or sell homes, jobs, services, and
                        more.</p>
                    <div class="d-flex mt-4">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter fs-5"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-linkedin fs-5"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h6 class="fw-bold mb-3">Categories</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('real-estate') }}" class="text-white text-decoration-none">Real Estate</a></li>
                        <li class="mb-2"><a href="{{ route('jobs') }}" class="text-white text-decoration-none">Jobs</a></li>
                        <li class="mb-2"><a href="{{ route('blogs') }}" class="text-white text-decoration-none">Blogs</a></li>
                        <li class="mb-2"><a href="{{ route('hotels') }}" class="text-white text-decoration-none">Hotels</a></li>
                        <li class="mb-2"><a href="{{ route('consultancy') }}" class="text-white text-decoration-none">Consultancy</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h6 class="fw-bold mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('about-us') }}" class="text-white text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Blog</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Privacy Policy</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Terms of Service</a>
                        </li>
                        <li class="mb-2"><a href="{{ route('faq') }}" class="text-white text-decoration-none">FAQ</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h6 class="fw-bold mb-3">Newsletter</h6>
                    <p class="text-white">Subscribe to our newsletter for the latest listings and updates.</p>
                    <form class="mt-3">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Your email address">
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-white">&copy; 2025 AdSpot. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0 text-white">Designed with <i class="bi bi-heart-fill text-danger"></i> for our users</p>
                </div>
            </div>
        </div>
    </footer>


    <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    @auth
        @if (auth()->user()->account_type_id == 3)
            <!-- Add Product Modal -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Add New Listing</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addProductForm" action="{{ route('seller.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- Form Steps Progress -->
                                <div class="wizard-progress mb-4">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <span class="step-indicator active" data-step="1">Basic Info</span>
                                        <span class="step-indicator" data-step="2">Media & Location</span>
                                        <span class="step-indicator" data-step="3">Pricing</span>
                                        <span class="step-indicator" data-step="4">Attributes</span>
                                    </div>
                                </div>

                                <!-- Step 1: Basic Information -->
                                <div class="form-step" id="step-1">
                                    <h5 class="border-bottom pb-2 mb-3">Basic Information</h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="category_id" class="form-label">Category <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="category_id" name="category_id" required>
                                                <option value="">Select Category</option>
                                                @foreach (\App\Models\Category\Category::where('is_main', true)->get() as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="subcategory_id" class="form-label">Subcategory</label>
                                            <select class="form-select" id="subcategory_id" name="subcategory_id" disabled>
                                                <option value="">Select Category First</option>
                                            </select>
                                        </div>

                                        <input type="hidden" id="listing_type" name="listing_type" value="">

                                        <div class="col-12">
                                            <label for="title" class="form-label">Listing Title <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                required>
                                        </div>

                                        <div class="col-12">
                                            <label for="description" class="form-label">Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" id="modal_description" name="description" rows="4" required></textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="contact_email" class="form-label">Contact Email</label>
                                            <input type="email" class="form-control" id="contact_email"
                                                name="contact_email" value="{{ auth()->user()->email }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="contact_phone" class="form-label">Contact Phone</label>
                                            <input type="text" class="form-control" id="contact_phone"
                                                name="contact_phone">
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 2: Media & Location -->
                                <div class="form-step" id="step-2" style="display: none;">
                                    <h5 class="border-bottom pb-2 mb-3">Media & Location</h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="main_image" class="form-label">Main Image <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control" id="main_image" name="main_image"
                                                accept="image/*" required>
                                            <div id="main_image_preview" class="mt-2"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="gallery_images" class="form-label">Additional Images</label>
                                            <input type="file" class="form-control" id="gallery_images"
                                                name="gallery_images[]" accept="image/*" multiple>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="location" class="form-label">Location</label>
                                            <input type="text" class="form-control" id="location" name="location"
                                                placeholder="e.g., Downtown">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control" id="city" name="city">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="state" class="form-label">State/Region</label>
                                            <input type="text" class="form-control" id="state" name="state">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="zip_code" class="form-label">ZIP/Postal Code</label>
                                            <input type="text" class="form-control" id="zip_code" name="zip_code">
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 3: Pricing & Availability -->
                                <div class="form-step" id="step-3" style="display: none;">
                                    <h5 class="border-bottom pb-2 mb-3">Pricing & Availability</h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="price" class="form-label">Price <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" id="price" name="price"
                                                    step="0.01" min="0" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="price_type" class="form-label">Price Type</label>
                                            <select class="form-select" id="price_type" name="price_type">
                                                <option value="fixed">Fixed Price</option>
                                                <option value="per_hour">Per Hour</option>
                                                <option value="per_day">Per Day</option>
                                                <option value="per_night">Per Night</option>
                                                <option value="per_week">Per Week</option>
                                                <option value="per_month">Per Month</option>
                                                <option value="negotiable">Negotiable</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="discount_type" class="form-label">Discount (Optional)</label>
                                            <select class="form-select" id="discount_type" name="discount_type">
                                                <option value="">No Discount</option>
                                                <option value="percentage">Percentage (%)</option>
                                                <option value="fixed">Fixed Amount ($)</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="discount_value" class="form-label">Discount Value</label>
                                            <div class="input-group">
                                                <input type="number" step="0.01" min="0" class="form-control"
                                                    id="discount_value" name="discount_value">
                                                <span class="input-group-text" id="discount-symbol">$</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="availability_start" class="form-label">Available From</label>
                                            <input type="date" class="form-control" id="availability_start"
                                                name="availability_start">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="availability_end" class="form-label">Available Until</label>
                                            <input type="date" class="form-control" id="availability_end"
                                                name="availability_end">
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 4: Attributes & Features -->
                                <div class="form-step" id="step-4" style="display: none;">
                                    <h5 class="border-bottom pb-2 mb-3">Attributes & Features</h5>

                                    <!-- Add New Custom Attribute Button -->
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-outline-primary btn-sm"
                                            id="modal-add-attribute-btn">
                                            <i class="bi bi-plus-circle"></i> Add Custom Attribute
                                        </button>
                                    </div>

                                    <!-- Custom Attributes Container -->
                                    <div id="modal-attributes-list" class="mb-4"></div>

                                    <!-- Category Specific Attributes -->
                                    <h6 class="mb-3">Category-Specific Attributes</h6>
                                    <div id="modal-select-category-message" class="alert alert-info">
                                        Please select a category to load specific fields.
                                    </div>
                                    <div id="modal-attributes-loading" class="text-center d-none">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <p>Loading attributes...</p>
                                    </div>
                                    <div id="modal-attributes-content"></div>
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary" id="prevBtn"
                                        style="display: none;">Previous</button>
                                    <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                                    <button type="submit" class="btn btn-success" id="submitBtn"
                                        style="display: none;">Submit Listing</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .wizard-progress .progress {
                    height: 8px;
                    border-radius: 10px;
                }

                .step-indicator {
                    position: relative;
                    font-size: 0.75rem;
                    color: #6c757d;
                    font-weight: 500;
                    text-align: center;
                }

                .step-indicator.active {
                    color: #0d6efd;
                    font-weight: 600;
                }

                .step-indicator.completed {
                    color: #198754;
                }

                @media (max-width: 768px) {
                    .step-indicator {
                        font-size: 0.65rem;
                    }
                }
            </style>

            <!-- Add Product Form JavaScript -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Step management variables
                    let currentStep = 1;
                    const totalSteps = 4;

                    // Navigation buttons
                    const nextBtn = document.getElementById('nextBtn');
                    const prevBtn = document.getElementById('prevBtn');
                    const submitBtn = document.getElementById('submitBtn');

                    // Progress bar
                    const progressBar = document.querySelector('.wizard-progress .progress-bar');

                    // Navigate to next step
                    nextBtn.addEventListener('click', function() {
                        if (validateStep(currentStep)) {
                            currentStep++;
                            updateFormDisplay();
                        }
                    });

                    // Navigate to previous step
                    prevBtn.addEventListener('click', function() {
                        currentStep--;
                        updateFormDisplay();
                    });

                    // Function to update form display based on current step
                    function updateFormDisplay() {
                        // Hide all steps
                        document.querySelectorAll('.form-step').forEach(step => {
                            step.style.display = 'none';
                        });

                        // Show current step
                        document.getElementById(`step-${currentStep}`).style.display = 'block';

                        // Update progress bar
                        const progressPercentage = ((currentStep - 1) / (totalSteps - 1)) * 100;
                        progressBar.style.width = `${progressPercentage}%`;
                        progressBar.setAttribute('aria-valuenow', progressPercentage);

                        // Update step indicators
                        document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
                            if (index + 1 < currentStep) {
                                indicator.classList.add('completed');
                                indicator.classList.remove('active');
                            } else if (index + 1 === currentStep) {
                                indicator.classList.add('active');
                                indicator.classList.remove('completed');
                            } else {
                                indicator.classList.remove('active', 'completed');
                            }
                        });

                        // Show/hide navigation buttons
                        if (currentStep === 1) {
                            prevBtn.style.display = 'none';
                        } else {
                            prevBtn.style.display = 'block';
                        }

                        if (currentStep === totalSteps) {
                            nextBtn.style.display = 'none';
                            submitBtn.style.display = 'block';
                        } else {
                            nextBtn.style.display = 'block';
                            submitBtn.style.display = 'none';
                        }
                    }

                    // Validation for each step
                    function validateStep(step) {
                        let isValid = true;
                        const currentStepEl = document.getElementById(`step-${step}`);

                        // Check all required fields in current step
                        const requiredFields = currentStepEl.querySelectorAll('[required]');
                        requiredFields.forEach(field => {
                            field.classList.remove('is-invalid');

                            if (!field.value.trim()) {
                                field.classList.add('is-invalid');
                                isValid = false;
                            }
                        });

                        // Step-specific validation
                        if (step === 1) {
                            const categoryField = document.getElementById('category_id');
                            if (!categoryField.value) {
                                categoryField.classList.add('is-invalid');
                                isValid = false;
                            }
                        } else if (step === 2) {
                            const mainImageField = document.getElementById('main_image');
                            if (mainImageField.required && mainImageField.files.length === 0) {
                                mainImageField.classList.add('is-invalid');
                                isValid = false;
                            }
                        } else if (step === 3) {
                            const priceField = document.getElementById('price');
                            if (!priceField.value || isNaN(priceField.value) || parseFloat(priceField.value) <= 0) {
                                priceField.classList.add('is-invalid');
                                isValid = false;
                            }
                        }

                        // If not valid, show general error
                        if (!isValid) {
                            // You can add a nice error toast or message here
                            const errorHtml = `
                    <div class="alert alert-danger mt-3">
                        <i class="bi bi-exclamation-triangle"></i> Please fill in all required fields before proceeding.
                    </div>
                `;

                            // Remove any existing error message
                            const existingError = currentStepEl.querySelector('.alert-danger');
                            if (existingError) {
                                existingError.remove();
                            }

                            // Add new error message
                            currentStepEl.appendChild(document.createRange().createContextualFragment(errorHtml));
                        }

                        return isValid;
                    }

                    // Modal attribute counter
                    let modalAttributeCounter = 0;

                    // Load subcategories when category changes
                    $('#category_id').on('change', function() {
                        const categoryId = $(this).val();
                        const $subcategorySelect = $('#subcategory_id');
                        const $modalSelectMessage = $('#modal-select-category-message');
                        const $modalAttributesContent = $('#modal-attributes-content');
                        const $modalAttributesLoading = $('#modal-attributes-loading');

                        if (!categoryId) {
                            $subcategorySelect.html('<option value="">Select Category First</option>').prop(
                                'disabled', true);
                            $modalAttributesContent.html('');
                            $modalSelectMessage.removeClass('d-none');
                            $('#listing_type').val('');
                            return;
                        }

                        // Hide message, show loading
                        $modalSelectMessage.addClass('d-none');
                        $subcategorySelect.html('<option value="">Loading...</option>').prop('disabled', true);

                        // Fetch subcategories via AJAX
                        $.ajax({
                            url: "/company-backend/subcategories/" + categoryId,
                            type: 'GET',
                            success: function(response) {
                                console.log(response);

                                if (response.success) {
                                    // Set the listing type based on the selected category
                                    $('#listing_type').val(response.category.page_type);

                                    // Load subcategories
                                    let options =
                                        '<option value="">Select Subcategory (Optional)</option>';

                                    if (response.subcategories && response.subcategories.length > 0) {
                                        response.subcategories.forEach(function(subcategory) {
                                            options +=
                                                `<option value="${subcategory.id}">${subcategory.name}</option>`;
                                        });
                                        $subcategorySelect.html(options).prop('disabled', false);
                                    } else {
                                        $subcategorySelect.html(
                                                '<option value="">No subcategories available</option>')
                                            .prop('disabled', true);
                                    }
                                } else {
                                    $subcategorySelect.html(
                                            '<option value="">Error loading subcategories</option>')
                                        .prop('disabled', true);
                                }
                            },
                            error: function() {
                                $subcategorySelect.html(
                                    '<option value="">Error loading subcategories</option>').prop(
                                    'disabled', true);
                            }
                        });

                        // Load category-specific attributes
                        $modalAttributesLoading.removeClass('d-none');
                        $modalAttributesContent.html('');
                    });

                    $.ajax({
                        url: "/seller/get-attributes",
                        type: 'GET',
                        data: {
                            category_id: categoryId
                        },
                        success: function(response) {
                            $modalAttributesLoading.addClass('d-none');

                            if (response.attributes && response.attributes.length > 0) {
                                let html = '<div class="row g-3">';

                                response.attributes.forEach(function(attribute) {
                                    const isRequired = attribute.pivot.is_required;

                                    html += '<div class="col-md-6 mb-3">';
                                    html += '<label class="form-label">' + attribute.name +
                                        (isRequired ?
                                            ' <span class="text-danger">*</span>' : '') +
                                        '</label>';

                                    switch (attribute.input_type) {
                                        case 'text':
                                            html +=
                                                '<input type="text" class="form-control" name="category_attributes[' +
                                                attribute.id + ']" ' + (isRequired ?
                                                    'required' : '') + '>';
                                            break;
                                        case 'number':
                                            html +=
                                                '<input type="number" class="form-control" name="category_attributes[' +
                                                attribute.id + ']" ' + (isRequired ?
                                                    'required' : '') + '>';
                                            break;
                                        case 'select':
                                            html +=
                                                '<select class="form-select" name="category_attributes[' +
                                                attribute.id + ']" ' + (isRequired ?
                                                    'required' : '') + '>';
                                            html +=
                                                '<option value="">Select an option</option>';

                                            // Parse options
                                            let options = [];
                                            if (typeof attribute.options === 'string') {
                                                try {
                                                    options = JSON.parse(attribute.options
                                                        .replace(/'/g, '"'));
                                                } catch (e) {
                                                    options = attribute.options.split(',')
                                                        .map(item => item.trim());
                                                }
                                            } else if (Array.isArray(attribute.options)) {
                                                options = attribute.options;
                                            }

                                            options.forEach(function(option) {
                                                html += '<option value="' + option +
                                                    '">' + option + '</option>';
                                            });

                                            html += '</select>';
                                            break;
                                        default:
                                            html +=
                                                '<input type="text" class="form-control" name="category_attributes[' +
                                                attribute.id + ']" ' + (isRequired ?
                                                    'required' : '') + '>';
                                    }

                                    if (attribute.description) {
                                        html += '<small class="form-text text-muted">' +
                                            attribute.description + '</small>';
                                    }

                                    html += '</div>';
                                });

                                html += '</div>';
                                $modalAttributesContent.html(html);
                            } else {
                                $modalAttributesContent.html(
                                    '<div class="alert alert-info">No specific attributes for this category.</div>'
                                );
                            }
                        },
                        error: function() {
                            $modalAttributesLoading.addClass('d-none');
                            $modalAttributesContent.html(
                                '<div class="alert alert-danger">Error loading attributes. Please try again.</div>'
                            );
                        }
                    });
                });

                // Add custom attribute button
                $('#modal-add-attribute-btn').on('click', function() {
                    const html = `
                        <div class="card mb-3">
                            <div class="card-body pb-2">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label small">Name</label>
                                        <input type="text" class="form-control form-control-sm" name="attribute_names[]" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label small">Value</label>
                                <input type="text" class="form-control form-control-sm" name="attribute_values[]" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label small">Type</label>
                                <select class="form-select form-select-sm" name="attribute_types[]">
                                    <option value="text">Text</option>
                                    <option value="badge">Badge</option>
                                    <option value="icon">Icon</option>
                                    <option value="boolean">Yes/No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="d-flex align-items-end h-100 mb-2">
                                <button type="button" class="btn btn-danger btn-sm remove-attribute">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_searchable[]" value="${modalAttributeCounter}">
                                <label class="form-check-label small">Searchable</label>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
            `;

                    $('#modal-attributes-list').append(html);
                    modalAttributeCounter++;
                });

                // Remove attribute button
                $(document).on('click', '.remove-attribute', function() {
                    $(this).closest('.card').remove();
                });

                // Preview main image in modal
                $('#main_image').on('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            $('#main_image_preview').html(
                                `<img src="${e.target.result}" class="img-fluid mt-2" style="max-height: 100px;">`
                            );
                        }
                        reader.readAsDataURL(file);
                    }
                });

                // Update discount symbol
                $('#discount_type').on('change', function() {
                    const type = $(this).val();
                    if (type === 'percentage') {
                        $('#discount-symbol').text('%');
                    } else {
                        $('#discount-symbol').text('$');
                    }
                });

                // Form validation on submit
                $('#addProductForm').on('submit', function(e) {
                e.preventDefault();

                // Final validation of all steps
                let isValid = true;
                for (let i = 1; i <= totalSteps; i++) {
                    if (!validateStep(i)) {
                        currentStep = i;
                        updateFormDisplay();
                        isValid = false;
                        break;
                    }
                }

                if (isValid) {
                    // Submit the form
                    this.submit();
                }
                });
            </script>
        @endif
    @endauth
    </body>

    </html>
@endsection
@section('scripts')
    <script>
        // Function to track ad click
        function trackAdClick(adId) {
            // Send an AJAX request to record the click
            fetch(`/api/ads/${adId}/click`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });
        }
    </script>
@endsection
