@section('footer')
    <!-- Footer -->
    <footer class="pt-5 pb-3 text-white footer-section bg-dark">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-4">Wanderlust</h5>
                    <p>Your trusted partner for unforgettable travel experiences since 2010. We specialize in creating personalized journeys that match your travel style.</p>
                    <div class="mt-3 social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-4">Quick Links</h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Destinations</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Tour Packages</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Blog</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-4">Contact Info</h5>
                    <ul class="list-unstyled footer-contact">
                        <li class="mb-3"><i class="fas fa-map-marker-alt me-2"></i> 123 Travel Street, New York, NY 10001</li>
                        <li class="mb-3"><i class="fas fa-phone-alt me-2"></i> +1 (234) 567-8900</li>
                        <li class="mb-3"><i class="fas fa-envelope me-2"></i> info@wanderlust.com</li>
                        <li><i class="fas fa-clock me-2"></i> Mon-Fri: 9AM - 6PM</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-4">We Accept</h5>
                    <div class="payment-methods">
                        <i class="mb-2 fab fa-cc-visa fa-2x me-2"></i>
                        <i class="mb-2 fab fa-cc-mastercard fa-2x me-2"></i>
                        <i class="mb-2 fab fa-cc-amex fa-2x me-2"></i>
                        <i class="mb-2 fab fa-cc-paypal fa-2x"></i>
                    </div>
                    <h5 class="mt-4 mb-3">Download Our App</h5>
                    <div class="app-buttons">
                        <a href="#" class="mb-2 btn btn-outline-light me-2"><i class="fab fa-apple me-2"></i> App Store</a>
                        <a href="#" class="mb-2 btn btn-outline-light"><i class="fab fa-google-play me-2"></i> Google Play</a>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-3">
            <div class="row">
                <div class="mb-3 col-md-6 mb-md-0">
                    <p class="mb-0">&copy; 2025 Wanderlust. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-white text-decoration-none me-3">Terms & Conditions</a>
                    <a href="#" class="text-white text-decoration-none">FAQ</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top btn btn-primary rounded-circle" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ url('assets/js/main.js') }}"></script>

</body>
</html>
@endsection
