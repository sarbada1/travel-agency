@extends('frontend.app.main')

@section('content')
    <div class="container-fluid full-height d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-md-12 d-flex align-items-center justify-content-center py-5">
                <div class="card border-0 shadow-sm p-4" style="min-width: 400px;">
                    <div class="card-body">
                        <form action="{{route('register')}}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter first name" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter email" required>
                                <div class="form-text">We'll never share your email with anyone else.</div>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
    
                            <!-- Account Type -->
                            <div class="form-group mb-2">
                                <label for="account_type_id">Select Types
                                    <span class="text-danger">*
                                            @error('account_type_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </span>
                                </label>
                                <select class="form-control" id="account_type_id" name="account_type_id">
                                    <option value="">Select Account Type</option>
                                    @foreach($accountTypeData as $accountType)
                                        <option value="{{ $accountType->id }}"
                                            {{ old('account_type_id') == $accountType->id ? 'selected' : '' }}
                                        >{{ $accountType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Create password" required>
                                <div class="form-text">
                                    Password must be at least 8 characters long and include numbers and special characters.
                                </div>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
    
                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
                            </div>
    
                            <!-- Terms and Conditions -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
                                </label>
                            </div>
    
                            <button type="submit" class="btn btn-primary w-100 mb-3">Create Account</button>
    
                            <div class="text-center mt-4">
                                Already have an account? <a href="{{ route('login') }}" class="text-primary text-decoration-none">Sign in</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

