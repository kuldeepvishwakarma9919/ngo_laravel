@extends('home.masters.layouts.app')
@section('title', 'Member Apply')
@push('styles')
    <style>
        .apply-header {
            background: linear-gradient(45deg, var(--primary), var(--ngo-green));
            color: white;
            padding: 60px 0;
            text-align: center;
            margin-bottom: -50px;
        }

        .form-container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            border-top: 5px solid var(--accent);
        }

        .section-sub-title {
            color: var(--primary);
            font-weight: 700;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .form-label {
            font-weight: 600;
            color: #444;
            font-size: 14px;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(0, 128, 0, 0.1);
            border-color: var(--ngo-green);
        }

        .upload-box {
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        .upload-box:hover {
            border-color: var(--ngo-green);
            background: #f0fdf0;
        }

        .btn-apply {
            background: var(--ngo-green);
            color: white;
            font-weight: 700;
            padding: 15px 40px;
            border-radius: 50px;
            border: none;
            transition: 0.4s;
        }

        .btn-apply:hover {
            background: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush
@section('content')
    <div class="apply-header">
        <div class="container">
            <h1 class="fw-bold">Member Membership Form</h1>
            <p>Join our mission to create a positive impact in society.</p>
        </div>
    </div>

    <section class="pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="form-container" data-aos="fade-up">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="section-sub-title"><i class="fa fa-user me-2 text-success"></i> Personal Details
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name (हिंदी/English)</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" placeholder="Enter your full name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Father's / Husband's Name</label>
                                    <input type="text" class="form-control @error('father_name') is-invalid @enderror"
                                        name="father_name" placeholder="Enter name" value="{{ old('father_name') }}">
                                    @error('father_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                        name="dob" value="{{ old('dob') }}">
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Gender</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Blood Group</label>
                                    <select class="form-select" name="blade_group">
                                        <option>Select</option>
                                        <option>A+</option>
                                        <option>A-</option>
                                        <option>B+</option>
                                        <option>B-</option>
                                        <option>O+</option>
                                        <option>O-</option>
                                        <option>AB+</option>
                                        <option>AB-</option>
                                    </select>
                                </div>
                            </div>

                            <div class="section-sub-title mt-5"><i class="fa fa-phone me-2 text-success"></i> Contact &
                                Occupation</div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">WhatsApp Number</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone') }}">

                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Occupation (व्यवसाय)</label>
                                    <input type="text" class="form-control" placeholder="e.g. Teacher, Business, Student"
                                        name="occupation">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Education Qualification</label>
                                    <input type="text" class="form-control" placeholder="Highest Degree"
                                        name="educational">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="number" class="form-control" placeholder="Mobile Number" name="mobile_no">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Aadhaar Number</label>
                                    <input type="number" class="form-control" placeholder="Aadhaar Number"
                                        name="aadhaar_no">
                                </div>


                                <div class="col-md-4">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" placeholder="State" name="state">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" placeholder="City" name="city">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Pincode</label>
                                    <input type="number" class="form-control" placeholder="Pincode" name="pincode">
                                </div>


                                <div class="col-12">
                                    <label class="form-label">Full Residential Address</label>
                                    <textarea class="form-control" rows="3" placeholder="Street, City, Pincode" name="address"></textarea>
                                </div>
                            </div>

                            <div class="section-sub-title mt-5"><i class="fa fa-cloud-upload-alt me-2 text-success"></i>
                                KYC
                                Documents</div>
                            <div class="row g-3">
                                <div class="col-md-6 text-center">
                                    <label class="form-label">Passport Size Photo</label>
                                    <div class="upload-box" onclick="document.getElementById('photo').click()">
                                        <i class="fa fa-image fa-2x text-muted mb-2"></i>
                                        <p class="small mb-0">Click to Upload Photo</p>
                                        <input type="file" id="photo" name="photo" hidden accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-6 text-center">
                                    <label class="form-label">Aadhar Card (Front & Back)</label>
                                    <div class="upload-box" onclick="document.getElementById('aadhar').click()">
                                        <i class="fa fa-id-card fa-2x text-muted mb-2"></i>
                                        <p class="small mb-0">Click to Upload Aadhar</p>
                                        <input type="file" id="aadhar" name="adhaar_card" hidden
                                            accept="image/*,application/pdf">
                                    </div>
                                </div>
                            </div>
                            <div class="section-sub-title mt-5"><i class="fa fa-cloud-upload-alt me-2 text-success"></i>
                                Other Document</div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Select Id Card</label>
                                    <select name="select_id" id="select_id" class="form-control">
                                        <option value="">Select Your Id Card</option>
                                        <option value="adhaar_card">Adhar Card</option>
                                        <option value="pan_card">Pan Card</option>
                                        <option value="votar_card">Votar Card</option>
                                        <option value="driving_lincence">Driving Licence</option>
                                        <option value="rashion_card">Rashion Card</option>
                                        <option value="10th_marksheet">Class 10th Marksheet</option>
                                    </select>
                                </div>
                                <div class="col-md-4 text-center">
                                    <label class="form-label">Front</label>
                                    <div class="upload-box" onclick="document.getElementById('front').click()">
                                        <i class="fa fa-image fa-2x text-muted mb-2"></i>
                                        <p class="small mb-0">Click to Upload Photo</p>
                                        <input type="file" id="front" name="front" hidden accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <label class="form-label">Back</label>
                                    <div class="upload-box" onclick="document.getElementById('back').click()">
                                        <i class="fa fa-id-card fa-2x text-muted mb-2"></i>
                                        <p class="small mb-0">Click to Upload Aadhar</p>
                                        <input type="file" id="back" name="back" hidden
                                            accept="image/*,application/pdf">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 p-3 bg-light rounded border">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms">
                                    <label class="form-check-label small" for="terms">
                                        I hereby declare that the information provided above is true to the best of my
                                        knowledge. I agree to follow the rules and regulations of <b>NGO DEMO</b> and work
                                        towards the welfare of society.
                                    </label>
                                </div>
                            </div>



                            <div class="section-sub-title mt-5">
                                <i class="fa fa-credit-card me-2 text-success"></i> Membership Fee
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Membership Type</label>
                                    <select name="membership_type" class="form-select" required>
                                        <option value="">Select Membership</option>
                                        <option value="annual">Annual Membership – ₹500</option>
                                        <option value="lifetime">Lifetime Membership – ₹2000</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Amount (₹)</label>
                                    <input type="number" name="amount" class="form-control" readonly>
                                </div>
                            </div>



                            <div class="text-center mt-5">
                                <button type="submit" class="btn-apply shadow-lg">SUBMIT APPLICATION <i
                                        class="fa fa-paper-plane ms-2"></i></button>
                                <p class="text-muted mt-3 small">After submission, our team will verify your details within
                                    48 hours.</p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        document.querySelector('[name="membership_type"]').addEventListener('change', function() {
            let amount = 0;
            if (this.value === 'annual') amount = 500;
            if (this.value === 'lifetime') amount = 2000;
            document.querySelector('[name="amount"]').value = amount;
        });
    </script>


  
  

@endsection
