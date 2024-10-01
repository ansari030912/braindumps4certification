<footer class="footer-wrapper footer-layout1 -mb-2">
    <div class="widget-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <div class="widget footer-widget">
                        <div class="th-widget-about">
                            <div class="about-logo">
                                <a href="/">
                                    <span style="font-size: 25px">
                                        Brain Dumps 4 Certification</span>
                                </a>

                            </div>
                            <p class="about-text">
                                Braindumps4Certification.com is an exam-focused site offering detailed information about
                                various certifications and exam dumps. It provides study materials and direct links to
                                purchase dumps, helping users prepare for professional certification exams across
                                different fields.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="widget widget_tag_cloud footer-widget">
                        <h3 class="widget_title">Categories</h3>
                        <div class="tagcloud">
                            @foreach ($categories as $category)
                                <a href="{{ url('/category/' . $category->slug) }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-5">
                    <p class="copyright-text">Copyright <i class="fal fa-copyright"></i> 2024 <a
                            href="home-newspaper.html">braindumps4certification.com</a>. All Rights Reserved.</p>
                </div>
                <div class="col-lg-auto ms-auto d-none d-lg-block">
                    <div class="footer-links">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/about-us">About Us</a></li>
                            <li><a href="/terms-and-conditions">Terms & Conditions</a></li>
                            <li><a href="/contact-us">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll To Top -->
<div class="scroll-top">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
            style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
        </path>
    </svg>
</div>

<!--==============================
    All Js File
============================== -->
<!-- Jquery -->
<script src="{{ asset('public/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<!-- Slick Slider -->
<script src="{{ asset('public/assets/js/slick.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
<!-- Magnific Popup -->
<script src="{{ asset('public/assets/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Counter Up -->
<script src="{{ asset('public/assets/js/jquery.counterup.min.js') }}"></script>
<!-- Range Slider -->
<script src="{{ asset('public/assets/js/jquery-ui.min.js') }}"></script>
<!-- Isotope Filter -->
<script src="{{ asset('public/assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('public/assets/js/isotope.pkgd.min.js') }}"></script>
<!-- Vimeo Player -->
<script src="{{ asset('public/assets/js/vimeo_player.js') }}"></script>
<!-- Main Js File -->
<script src="{{ asset('public/assets/js/main.js') }}"></script>
</body>

</html>
