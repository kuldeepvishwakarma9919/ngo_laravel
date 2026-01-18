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


        .filter-container {
            margin-bottom: 40px;
            text-align: center;
        }

        .filter-btn {
            padding: 10px 25px;
            border-radius: 50px;
            border: 2px solid var(--ngo-green);
            background: transparent;
            color: var(--ngo-green);
            font-weight: 600;
            margin: 5px;
            transition: 0.3s ease;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: var(--ngo-green);
            color: white;
        }

        .gallery-card {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
            cursor: pointer;
        }

        .gallery-card img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            transition: 0.6s ease;
        }

        .gallery-card:hover img {
            transform: scale(1.1) rotate(2deg);
        }

        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: 0.4s;
        }

        .gallery-card:hover .card-overlay {
            opacity: 1;
        }

        .card-overlay i {
            color: white;
            font-size: 30px;
        }

        /* --- POPUP IMAGE SIZE FIX --- */
        .glightbox-container .gslide-image img {
            max-height: 90vh !important;
            /* Popup height 90% of screen */
            width: auto !important;
            max-width: 95vw !important;
            /* Width 95% of screen */
            object-fit: contain;
            border-radius: 8px;
        }

        .gslide-description {
            background: #fff !important;
            color: #333 !important;
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


    <section class="py-5 mt-5">
        <div class="container">
            <div class="row" id="gallery-grid">
                @foreach ($galleries as $gallery)
                    <div class="col-lg-4 col-md-6 gallery-item edu" data-aos="fade-up">
                        <div class="gallery-card">
                            <a href="{{ asset($gallery->file_path) }}"
                                class="glightbox" data-gallery="gallery1" data-title="Education Support"
                                data-description="Distributing books.">
                                <img src="{{ asset($gallery->file_path) }}"
                                    alt="Education">
                                <div class="card-overlay"><i class="fa fa-expand"></i></div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- <div class="filter-container" data-aos="fade-up">
                <button class="filter-btn active" onclick="filterGallery('all', this)">All Photos</button>
                <button class="filter-btn" onclick="filterGallery('edu', this)">Education</button>
                <button class="filter-btn" onclick="filterGallery('health', this)">Health Care</button>
                <button class="filter-btn" onclick="filterGallery('food', this)">Food Drive</button>
            </div>

            <div class="row" id="gallery-grid">
                <div class="col-lg-4 col-md-6 gallery-item edu" data-aos="fade-up">
                    <div class="gallery-card">
                        <a href="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1000" class="glightbox"
                            data-gallery="gallery1" data-title="Education Support" data-description="Distributing books.">
                            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1000"
                                alt="Education">
                            <div class="card-overlay"><i class="fa fa-expand"></i></div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item health" data-aos="fade-up">
                    <div class="gallery-card">
                        <a href="https://images.unsplash.com/photo-1584515933487-779824d29309?q=80&w=1000" class="glightbox"
                            data-gallery="gallery1" data-title="Health Camp">
                            <img src="https://images.unsplash.com/photo-1584515933487-779824d29309?q=80&w=1000"
                                alt="Health">
                            <div class="card-overlay"><i class="fa fa-expand"></i></div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item food" data-aos="fade-up">
                    <div class="gallery-card">
                        <a href="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1000" class="glightbox"
                            data-gallery="gallery1" data-title="Food Drive">
                            <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1000"
                                alt="Food">
                            <div class="card-overlay"><i class="fa fa-expand"></i></div>
                        </a>
                    </div>
                </div> 
            </div> --}}
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
        const lightbox = GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            zoomable: true,
            draggable: true,
            width: '90vw', // Forced Width
            height: 'auto', // Maintain Aspect Ratio
        });

        function filterGallery(category, btn) {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const items = document.querySelectorAll('.gallery-item');
            items.forEach(item => {
                if (category === 'all' || item.classList.contains(category)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
            AOS.refresh();
        }
    </script>
@endpush
