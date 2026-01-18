 <style>
     .footer-legal-links a:hover {
         opacity: 1 !important;
         color: var(--ngo-green) !important;
         text-decoration: none !important; 
     }
 </style>
 <footer class="pt-5">
     <div class="container">
         <div class="row g-4">
             <div class="col-lg-4 col-md-6">
                 <h5>{{ $settings->site_name }}</h5>
                 <p class="opacity-75">NGO DEMO is a registered NGO dedicated to bringing positive change through
                     education, health, and social welfare in Lucknow.</p>
                 <div class="d-flex gap-3 fs-4 mt-4">
                     <a href="{{ $settings->facebook }}" target="blank" class="text-white"><i
                             class="fab fa-facebook"></i></a>
                     <a href="{{ $settings->instagram }}" class="text-white"><i class="fab fa-instagram"></i></a>
                     <a href="{{ $settings->youtube }}" class="text-white"><i class="fab fa-youtube"></i></a>
                     <a href="{{ $settings->twitter }}" class="text-white"><i class="fab fa-twitter"></i></a>
                 </div>
             </div>

             <div class="col-lg-2 col-md-6">
                 <h5>Quick Links</h5>
                 <a href="{{ route('home.member_apply') }}" class="footer-link">Member Apply</a>
                 <a href="{{ route('home.download_card') }}" class="footer-link">Download ID Card</a>
                 <a href="{{ route('home.audit_report') }}" class="footer-link">Audit Report</a>
                 <a href="{{ route('home.donates') }}" class="footer-link">Donors List</a>
             </div>

             <div class="col-lg-3 col-md-6">
                 <h5>Contact Info</h5>
                 <div class="contact-item"><i class="fa fa-map-marker-alt"></i><span>{{ $settings->address }}</span>
                 </div>
                 <div class="contact-item"><i class="fa fa-phone-alt"></i><span>+91 {{ $settings->phone }}</span></div>
                 <div class="contact-item"><i class="fa fa-envelope"></i><span>{{ $settings->email }}</span></div>
             </div>

             <div class="col-lg-3 col-md-6">
                 <h5>Certifications</h5>
                 {{-- <img src="" class="img-fluid rounded border border-secondary mb-3"> --}}
                 <p class="small text-warning">Donations are tax-exempt under section 80G.</p>
             </div>
         </div>

         <hr class="mt-5 border-secondary">
         <div class="row pb-4 align-items-center">
             <div class="col-md-6 text-center text-md-start">
                 <p class="mb-0 opacity-75">© 2026 {{ $settings->site_name }}. All Rights Reserved.</p>
             </div>

             <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                 <div class="footer-legal-links">
                     <a href="{{ route('home.privacy_policy') }}"
                         class="text-white text-decoration-none small opacity-75 me-3">Privacy Policy</a>
                     <a href="{{ route('home.term_condition') }}"
                         class="text-white text-decoration-none small opacity-75 me-3">Terms & Conditions</a>
                     <a href="{{ route('home.refund_policy') }}"
                         class="text-white text-decoration-none small opacity-75 me-3">Refund Policy</a>
                     <a href="{{ route('home.term_disclaimer') }}"
                         class="text-white text-decoration-none small opacity-75">Disclaimer</a>
                 </div>
             </div>
         </div>
     </div>
 </footer>
