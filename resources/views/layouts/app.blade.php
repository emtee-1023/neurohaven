<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'NeuroHaven')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- DataTables CSS (shared) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        body.dark-mode .dataTables_wrapper,
        body.dark-mode .table,
        body.dark-mode .table-striped,
        body.dark-mode .table-bordered {
            background-color: #18181b !important;
            color: #f3f4f6 !important;
        }

        body.dark-mode th,
        body.dark-mode td {
            background-color: #18181b !important;
            color: #f3f4f6 !important;
        }

        body.dark-mode .dataTables_length,
        body.dark-mode .dataTables_filter,
        body.dark-mode .dataTables_info,
        body.dark-mode .dataTables_paginate {
            color: #f3f4f6 !important;
        }
    </style>

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @livewireStyles

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>

    @yield('content')


    <footer id="footer" class="footer">
        <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h4>Stay Connected with NeuroHaven</h4>
                        <p>Subscribe to our newsletter for expert tips, resources, and updates on college planning for
                            students with learning differences.</p>
                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="php-email-form">
                            @csrf
                            <div class="newsletter-form">
                                <input type="email" name="email" placeholder="Your Email" required>
                                <input type="submit" value="Subscribe">
                            </div>
                            @if (session('success'))
                                <div class="sent-message">{{ session('success') }}</div>
                            @endif
                            @if ($errors->has('email'))
                                <div class="error-message">{{ $errors->first('email') }}</div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index" class="d-flex align-items-center">
                        <span class="sitename">NeuroHaven</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Empowering students for a successful transition to college.</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+254 000 000 000</span></p>
                        <p><strong>Email:</strong> <a style="font-size: small"
                                href="mailto:info@neurohaven.africa">info@neurohaven.africa</a>
                        </p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#hero">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#about">About</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#services">Services</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#cta">Consult</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="service-details#service-details">Comprehensive
                                Assessment</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="service-details#service-details">College &
                                Program Matching</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="service-details#service-details">Application &
                                Essay Support</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="service-details#service-details">Transition
                                Preparation</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Connect with Us</h4>
                    <p>Follow NeuroHaven for the latest insights and resources on college planning.</p>
                    <div class="social-links d-flex">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">NeuroHaven</strong> <span>All Rights
                    Reserved</span></p>
            <div class="credits">
                Website by <a href="https://inlaw-legal.tech/">Lucror</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            @if (session('Success'))
                toastr.success("{{ session('Success') }}");
            @endif
            @if ($errors->any())
                toastr.error("{{ implode(' ', $errors->all()) }}");
            @endif
        });
    </script>
    @livewireScripts
</body>

</html>
