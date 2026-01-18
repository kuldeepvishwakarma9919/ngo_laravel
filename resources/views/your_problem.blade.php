@extends('home.masters.layouts.app')

@section('title', 'Problems We Are Solving')

@section('content')
    <style>
        /* Problem Page Custom Styles */
        .problem-hero {
            background-color: #f8f9fa;
            padding: 60px 0;
            border-bottom: 1px solid #eee;
        }

        .problem-card {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
            background: #fff;
            height: 100%;
        }

        .problem-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .icon-circle {
            width: 60px;
            height: 60px;
            background: #fff5f5; /* Light red for problem focus */
            color: #dc3545;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .stat-badge {
            background: #dc3545;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 15px;
        }

        .emergency-banner {
            background: #343a40;
            color: white;
            border-radius: 15px;
            padding: 40px;
        }
    </style>

    <div class="problem-hero">
        <div class="container text-center">
            <h1 class="fw-bold text-dark">Challenges We Face</h1>
            <p class="text-muted mx-auto" style="max-width: 700px;">
                Humari society mein aaj bhi kai aisi samasyaein hain jo logon ki pragati mein badha banti hain. Inhe samajhna badlav ki pehli sidhi hai.
            </p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4">
            
            <div class="col-md-6 col-lg-4">
                <div class="card problem-card shadow-sm p-4">
                    <div class="stat-badge">Critical Issue</div>
                    <div class="icon-circle">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <h4 class="fw-bold">Bachon ki Ashiksha</h4>
                    <p class="text-secondary">Aaj bhi hazaron bache arthik tangi ke karan school nahi ja paate. Shiksha ke bina unka bhavishya andhera mein hai.</p>
                    <hr>
                    <small class="text-danger fw-bold"><i class="bi bi-graph-down me-1"></i> 20% Drop-out Rate in Slums</small>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card problem-card shadow-sm p-4">
                    <div class="stat-badge">Immediate Action</div>
                    <div class="icon-circle">
                        <i class="bi bi-droplets-fill"></i>
                    </div>
                    <h4 class="fw-bold">Kuposhan (Malnutrition)</h4>
                    <p class="text-secondary">Sahi khan-pan na milne ke karan kai bache aur mahilayein kuposhan ka shikar ho rahi hain, jo unki sehat ko khatre mein daalta hai.</p>
                    <hr>
                    <small class="text-danger fw-bold"><i class="bi bi-graph-down me-1"></i> 1 in 3 Children Affected</small>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card problem-card shadow-sm p-4">
                    <div class="stat-badge">Growth Barrier</div>
                    <div class="icon-circle">
                        <i class="bi bi-person-x-fill"></i>
                    </div>
                    <h4 class="fw-bold">Berozgari</h4>
                    <p class="text-secondary">Hunara hone ke bawajood sahi platform na milne se youth berozgar hai. Unhe skill-based training ki sakht zaroorat hai.</p>
                    <hr>
                    <small class="text-danger fw-bold"><i class="bi bi-graph-down me-1"></i> High Youth Unemployment</small>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card problem-card shadow-sm p-4">
                    <div class="stat-badge">Basic Need</div>
                    <div class="icon-circle">
                        <i class="bi bi-water"></i>
                    </div>
                    <h4 class="fw-bold">Peene ke Paani ki Kami</h4>
                    <p class="text-secondary">Kai gaon mein aaj bhi saaf peene ka paani nahi hai, jis wajah se log gambhir bimariyon ka shikar ho rahe hain.</p>
                    <hr>
                    <small class="text-danger fw-bold"><i class="bi bi-graph-down me-1"></i> Water Borne Diseases</small>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card problem-card shadow-sm p-4">
                    <div class="stat-badge">Service Gap</div>
                    <div class="icon-circle">
                        <i class="bi bi-hospital"></i>
                    </div>
                    <h4 class="fw-bold">Medical Suvidhaon ka Abhav</h4>
                    <p class="text-secondary">Door-daraz ke ilaakon mein hospital na hone ki wajah se chhoti bimariyan bhi jaan-lewa sabit hoti hain.</p>
                    <hr>
                    <small class="text-danger fw-bold"><i class="bi bi-graph-down me-1"></i> Lack of Rural Healthcare</small>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card problem-card shadow-sm p-4">
                    <div class="stat-badge">Social Issue</div>
                    <div class="icon-circle">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h4 class="fw-bold">Mahila Suraksha & Adhikar</h4>
                    <p class="text-secondary">Mahilayon ko samajik aur arthik roop se kamzor samjha jata hai. Unhe apne adhikaaron ke prati jagruk karna zaroori hai.</p>
                    <hr>
                    <small class="text-danger fw-bold"><i class="bi bi-graph-down me-1"></i> Need for Empowerment</small>
                </div>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <div class="emergency-banner shadow-lg">
                    <h2 class="fw-bold mb-3">Kyun Chup Rahein? Saath Milkar Badlav Layein!</h2>
                    <p class="mb-4">In samasyaon ka samadhan tabhi mumkin hai jab hum aur aap ek saath kadam badhayenge.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('event.register.store') }}" class="btn btn-success btn-lg px-4 fw-bold">Be a Volunteer</a>
                        <a href="#" class="btn btn-outline-light btn-lg px-4">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection