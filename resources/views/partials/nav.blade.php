{{-- <nav class="bg-gray-100 py-4 px-6 shadow-md flex justify-between">
    <a href="{{ url('/') }}" class="font-bold text-lg">Home</a>
    <ul class="flex gap-4">
        <li><a href="{{ url('/book-session') }}">Book Session</a></li>
        <li><a href="{{ url('/calendly/events') }}">Events</a></li>
        @auth
            <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @endauth
    </ul>
</nav> --}}

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="assets/img/logo.jpg" alt="">
            {{-- <h1 class="sitename">NeuroHaven</h1> --}}
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('landing') }}" class="active">Home</a></li>
                <li><a href="home#about">About</a></li>
                <li><a href="home#services">Services</a></li>
                <li><a href="home#testimonials">Testimonials</a></li>
                <li><a href="{{ route('blog') }}">Blog</a></li>
                <!-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Dropdown 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="#">Deep Dropdown 1</a></li>
                                <li><a href="#">Deep Dropdown 2</a></li>
                                <li><a href="#">Deep Dropdown 3</a></li>
                                <li><a href="#">Deep Dropdown 4</a></li>
                                <li><a href="#">Deep Dropdown 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Dropdown 2</a></li>
                        <li><a href="#">Dropdown 3</a></li>
                        <li><a href="#">Dropdown 4</a></li>
                    </ul>
                </li> -->
                <li><a href="home#contact">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="{{ route('bookSession') }}">Book Session</a>

    </div>
</header>
