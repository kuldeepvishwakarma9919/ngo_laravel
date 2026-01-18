
@extends('home.masters.layouts.app')

@section('title', 'Team Member Profile')

@push('styles')
    <style>
        /* Hero Section with consistent style */
        .member-hero {
            background: linear-gradient(rgba(26, 42, 108, 0.9), rgba(204, 0, 0, 0.8)), 
                        url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069');
            background-size: cover;
            background-position: center;
            padding: 120px 0;
            color: white;
            text-align: center;
            clip-path: ellipse(150% 100% at 50% 0%);
        }

        /* Profile Card Overlay */
        .profile-card {
            margin-top: -120px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
            overflow: hidden;
            border: none;
            transition: transform 0.3s ease;
        }

        .member-img-container {
            position: relative;
            padding: 15px;
        }

        .member-img {
            width: 100%;
            height: 450px;
            object-fit: cover;
            border-radius: 15px;
        }

        /* Skills Progress Bar */
        .skill-header { display: flex; justify-content: space-between; font-weight: 600; margin-bottom: 8px; }
        .skill-bar { height: 10px; border-radius: 10px; background-color: #f0f0f0; margin-bottom: 25px; }
        .skill-progress { 
            height: 100%; 
            border-radius: 10px; 
            background: linear-gradient(90deg, #1a2a6c, #cc0000); 
            position: relative;
        }

        /* Experience Timeline */
        .timeline-item {
            padding-left: 30px;
            border-left: 2px solid #1a2a6c;
            position: relative;
            padding-bottom: 30px;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -9px;
            top: 0;
            width: 16px;
            height: 16px;
            background: #cc0000;
            border-radius: 50%;
        }

        .social-links a {
            width: 45px;
            height: 45px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 10px;
            margin: 0 5px;
            color: #1a2a6c;
            transition: all 0.3s;
            font-size: 1.2rem;
        }

        .social-links a:hover {
            background: #1a2a6c;
            color: #fff;
            transform: translateY(-5px);
        }

        .contact-short-form {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
        }
    </style>
@endpush

@section('content')
    <section class="member-hero">
        <div class="container" data-aos="fade-down">
            <h1 class="display-4 fw-bold">Professional Profile</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="#" class="text-white text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active text-white-50" aria-current="page">Team Detail</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="card profile-card">
                        <div class="member-img-container">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=1974" alt="Member Name" class="member-img">
                        </div>
                        <div class="card-body text-center pb-4">
                            <h2 class="fw-bold mb-1">John Doe</h2>
                            <p class="text-danger fw-semibold mb-3">Senior Software Architect</p>
                            <div class="social-links mb-4">
                                <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                                <a href="#" title="Github"><i class="fab fa-github"></i></a>
                            </div>
                            <hr>
                            <div class="text-start px-3 mt-4">
                                <p class="mb-2"><strong><i class="fas fa-envelope me-2 text-primary"></i></strong> john.doe@company.com</p>
                                <p class="mb-2"><strong><i class="fas fa-phone me-2 text-primary"></i></strong> +1 (555) 000-1234</p>
                                <p class="mb-0"><strong><i class="fas fa-map-marker-alt me-2 text-primary"></i></strong> New York, USA</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-short-form mt-4" data-aos="fade-up">
                        <h5 class="fw-bold mb-3">Quick Inquiry</h5>
                        <form>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Your Name">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="3" placeholder="How can John help you?"></textarea>
                            </div>
                            <button class="btn btn-danger w-100 py-2">Send Message</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-8 mt-5 pt-lg-4" data-aos="fade-left">
                    <div class="ps-lg-5">
                        <h3 class="fw-bold border-bottom pb-2 mb-4">Biography</h3>
                        <p class="text-muted fs-5 mb-4">
                            With over a decade of experience in the tech industry, I have led multiple high-profile projects from conception to deployment. My expertise lies in architecting robust backend systems and mentoring junior developers to achieve excellence.
                        </p>

                        <div class="row mt-5">
                            <div class="col-12">
                                <h4 class="fw-bold mb-4"><i class="fas fa-graduation-cap me-2 text-danger"></i>Professional Expertise</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="skill-header"><span>Backend Development</span><span>95%</span></div>
                                <div class="skill-bar"><div class="skill-progress" style="width: 95%"></div></div>
                                
                                <div class="skill-header"><span>System Design</span><span>90%</span></div>
                                <div class="skill-bar"><div class="skill-progress" style="width: 90%"></div></div>
                            </div>
                            <div class="col-md-6">
                                <div class="skill-header"><span>Cloud Computing</span><span>85%</span></div>
                                <div class="skill-bar"><div class="skill-progress" style="width: 85%"></div></div>
                                
                                <div class="skill-header"><span>Team Leadership</span><span>88%</span></div>
                                <div class="skill-bar"><div class="skill-progress" style="width: 88%"></div></div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <h4 class="fw-bold mb-4"><i class="fas fa-briefcase me-2 text-danger"></i>Work Experience</h4>
                            <div class="timeline">
                                <div class="timeline-item">
                                    <h5 class="fw-bold mb-1">Lead Developer @ Tech Giants Inc.</h5>
                                    <span class="text-danger small fw-bold">2020 - Present</span>
                                    <p class="text-muted mt-2">Managing a team of 15 developers and overseeing the transition to microservices architecture.</p>
                                </div>
                                <div class="timeline-item">
                                    <h5 class="fw-bold mb-1">Senior Web Developer @ Creative Agency</h5>
                                    <span class="text-danger small fw-bold">2016 - 2020</span>
                                    <p class="text-muted mt-2">Developed over 50+ custom web applications for clients worldwide using Laravel and React.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection