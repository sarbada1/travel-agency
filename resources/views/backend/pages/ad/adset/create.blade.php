@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-plus-circle"></i> Create Ad Set
                                <a href="{{ route('manage-adset.index') }}" class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-arrow-left"></i> Back to Ad Sets
                                </a>
                            </h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @include('backend.layouts.message')
                        <hr>
                    </div>

                    <ul class="nav nav-tabs" id="adSetTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic"
                                type="button" role="tab" aria-controls="basic" aria-selected="true">
                                Basic Information
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="budget-tab" data-bs-toggle="tab" data-bs-target="#budget"
                                type="button" role="tab" aria-controls="budget" aria-selected="false">
                                Budget & Schedule
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="targeting-tab" data-bs-toggle="tab" data-bs-target="#targeting"
                                type="button" role="tab" aria-controls="targeting" aria-selected="false">
                                Targeting
                            </button>
                        </li>
                    </ul>

                    <form action="{{ route('manage-adset.store') }}" method="POST">
                        @csrf
                        <div class="tab-content" id="adSetTabsContent">
                            <!-- Basic Information Tab -->
                            <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                                <div class="pt-3">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="campaign_id" class="form-label">Campaign <span class="text-danger">*</span></label>
                                            <select class="form-select @error('campaign_id') is-invalid @enderror" 
                                                id="campaign_id" name="campaign_id" required>
                                                <option value="">Select Campaign</option>
                                                @foreach($campaigns as $campaign)
                                                    <option value="{{ $campaign->id }}" 
                                                        {{ old('campaign_id', isset($selectedCampaign) ? $selectedCampaign->id : '') == $campaign->id ? 'selected' : '' }}>
                                                        {{ $campaign->name }} - {{ ucfirst($campaign->status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('campaign_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="name" class="form-label">Ad Set Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                id="name" name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select @error('status') is-invalid @enderror" 
                                                id="status" name="status">
                                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="paused" {{ old('status') == 'paused' ? 'selected' : '' }}>Paused</option>
                                                <option value="review" {{ old('status', 'review') == 'review' ? 'selected' : '' }}>Under Review</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="description" class="form-label">Description</label>
                                            <input type="text" class="form-control @error('description') is-invalid @enderror" 
                                                id="description" name="description" value="{{ old('description') }}">
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Budget & Schedule Tab -->
                            <div class="tab-pane fade" id="budget" role="tabpanel" aria-labelledby="budget-tab">
                                <div class="pt-3">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="budget_type" class="form-label">Budget Type <span class="text-danger">*</span></label>
                                            <select class="form-select @error('budget_type') is-invalid @enderror" 
                                                id="budget_type" name="budget_type" required>
                                                <option value="daily" {{ old('budget_type', 'daily') == 'daily' ? 'selected' : '' }}>Daily Budget</option>
                                                <option value="lifetime" {{ old('budget_type') == 'lifetime' ? 'selected' : '' }}>Lifetime Budget</option>
                                            </select>
                                            @error('budget_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="budget_amount" class="form-label">Budget Amount <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" step="0.01" min="0" class="form-control @error('budget_amount') is-invalid @enderror" 
                                                    id="budget_amount" name="budget_amount" value="{{ old('budget_amount', '10.00') }}" required>
                                                @error('budget_amount')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="bid_strategy" class="form-label">Bid Strategy</label>
                                            <select class="form-select @error('bid_strategy') is-invalid @enderror" 
                                                id="bid_strategy" name="bid_strategy">
                                                <option value="lowest_cost" {{ old('bid_strategy', 'lowest_cost') == 'lowest_cost' ? 'selected' : '' }}>Lowest Cost</option>
                                                <option value="target_cost" {{ old('bid_strategy') == 'target_cost' ? 'selected' : '' }}>Target Cost</option>
                                            </select>
                                            @error('bid_strategy')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6" id="bid_amount_container">
                                            <label for="bid_amount" class="form-label">Bid Amount (optional)</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" step="0.01" min="0" class="form-control @error('bid_amount') is-invalid @enderror" 
                                                    id="bid_amount" name="bid_amount" value="{{ old('bid_amount') }}">
                                                @error('bid_amount')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                                id="start_date" name="start_date" value="{{ old('start_date') }}">
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Leave blank to start immediately</small>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                                id="end_date" name="end_date" value="{{ old('end_date') }}">
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Leave blank for no end date</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Targeting Tab -->
                            <div class="tab-pane fade" id="targeting" role="tabpanel" aria-labelledby="targeting-tab">
                                <div class="pt-3">
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle me-2"></i>
                                        Define your audience targeting criteria below to reach your ideal customers.
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Location</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label for="targeting_location" class="form-label">Locations to target</label>
                                                        <select class="form-select" id="targeting_location" name="targeting_specs[location][]" multiple>
                                                            <option value="worldwide" {{ in_array('worldwide', old('targeting_specs.location', [])) ? 'selected' : '' }}>Worldwide</option>
                                                            <option value="nepal" {{ in_array('nepal', old('targeting_specs.location', [])) ? 'selected' : '' }}>Nepal</option>
                                                            <option value="usa" {{ in_array('usa', old('targeting_specs.location', [])) ? 'selected' : '' }}>United States</option>
                                                            <option value="uk" {{ in_array('uk', old('targeting_specs.location', [])) ? 'selected' : '' }}>United Kingdom</option>
                                                            <option value="canada" {{ in_array('canada', old('targeting_specs.location', [])) ? 'selected' : '' }}>Canada</option>
                                                            <option value="australia" {{ in_array('australia', old('targeting_specs.location', [])) ? 'selected' : '' }}>Australia</option>
                                                            <option value="india" {{ in_array('india', old('targeting_specs.location', [])) ? 'selected' : '' }}>India</option>
                                                        </select>
                                                        <small class="text-muted">Hold Ctrl/Cmd to select multiple locations</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Demographics</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Age Range</label>
                                                        <div class="d-flex">
                                                            <select class="form-select me-2" name="targeting_specs[age_min]">
                                                                <option value="">Min Age</option>
                                                                @for($i = 18; $i <= 65; $i++)
                                                                    <option value="{{ $i }}" {{ old('targeting_specs.age_min') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                            <select class="form-select" name="targeting_specs[age_max]">
                                                                <option value="">Max Age</option>
                                                                @for($i = 18; $i <= 65; $i++)
                                                                    <option value="{{ $i }}" {{ old('targeting_specs.age_max') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                                @endfor
                                                                <option value="65+" {{ old('targeting_specs.age_max') == '65+' ? 'selected' : '' }}>65+</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Gender</label>
                                                        <div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="gender_male" 
                                                                    name="targeting_specs[gender][]" value="male"
                                                                    {{ in_array('male', old('targeting_specs.gender', [])) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="gender_male">Male</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="gender_female" 
                                                                    name="targeting_specs[gender][]" value="female"
                                                                    {{ in_array('female', old('targeting_specs.gender', [])) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="gender_female">Female</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Interests</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label for="targeting_interests" class="form-label">Select interests relevant to your audience</label>
                                                        <select class="form-select" id="targeting_interests" name="targeting_specs[interests][]" multiple>
                                                            <option value="travel" {{ in_array('travel', old('targeting_specs.interests', [])) ? 'selected' : '' }}>Travel</option>
                                                            <option value="real_estate" {{ in_array('real_estate', old('targeting_specs.interests', [])) ? 'selected' : '' }}>Real Estate</option>
                                                            <option value="vacation" {{ in_array('vacation', old('targeting_specs.interests', [])) ? 'selected' : '' }}>Vacation</option>
                                                            <option value="hotels" {{ in_array('hotels', old('targeting_specs.interests', [])) ? 'selected' : '' }}>Hotels</option>
                                                            <option value="luxury" {{ in_array('luxury', old('targeting_specs.interests', [])) ? 'selected' : '' }}>Luxury</option>
                                                            <option value="adventure" {{ in_array('adventure', old('targeting_specs.interests', [])) ? 'selected' : '' }}>Adventure</option>
                                                            <option value="family_vacation" {{ in_array('family_vacation', old('targeting_specs.interests', [])) ? 'selected' : '' }}>Family Vacation</option>
                                                            <option value="business_travel" {{ in_array('business_travel', old('targeting_specs.interests', [])) ? 'selected' : '' }}>Business Travel</option>
                                                        </select>
                                                        <small class="text-muted">Hold Ctrl/Cmd to select multiple interests</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Create Ad Set
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            // Handle bid strategy change
            $('#bid_strategy').change(function() {
                const selectedStrategy = $(this).val();
                if (selectedStrategy === 'target_cost') {
                    $('#bid_amount_container').show();
                    $('#bid_amount').prop('required', true);
                } else {
                    $('#bid_amount_container').hide();
                    $('#bid_amount').prop('required', false);
                }
            });
            
            // Handle budget type change
            $('#budget_type').change(function() {
                const selectedType = $(this).val();
                if (selectedType === 'lifetime') {
                    $('#end_date').prop('required', true);
                } else {
                    $('#end_date').prop('required', false);
                }
            });
            
            // Initialize on page load
            $('#bid_strategy').trigger('change');
            $('#budget_type').trigger('change');
        });
    </script>
@endsection