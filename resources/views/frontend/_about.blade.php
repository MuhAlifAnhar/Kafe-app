<section id="about">
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow bounceInUp">
                    <img src="{{ asset('frontend/assets') }}/img/about.jpg" class="img-fluid rounded" alt="">
                </div>
                <div class="col-lg-7 wow bounceInUp" data-wow-delay="0.3s">
                    <small
                        class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">About
                        Us</small>
                    <h1 class="display-5 mb-4">Trusted By 200 + satisfied clients</h1>
                    <p class="mb-4">Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore eit
                        esdioilore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullaemco laboeeiris nisi ut aliquip ex ea commodo consequat.
                        Duis
                        aute
                        irure
                        dolor iesdein reprehendeerit in voluptate velit esse cillum dolore.</p>
                    <div class="row g-4 text-dark mb-5">
                        <div class="col-sm-6">
                            <i class="fas fa-share text-primary me-2"></i>Fresh and Fast food Delivery
                        </div>
                        <div class="col-sm-6">
                            <i class="fas fa-share text-primary me-2"></i>24/7 Customer Support
                        </div>
                        <div class="col-sm-6">
                            <i class="fas fa-share text-primary me-2"></i>Easy Customization Options
                        </div>
                        <div class="col-sm-6">
                            <i class="fas fa-share text-primary me-2"></i>Delicious Deals for Delicious Meals
                        </div>
                    </div>
                    <a href="" class="btn btn-primary py-3 px-5 rounded-pill">About Us<i
                            class="fas fa-arrow-right ps-2"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid faqt py-5">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-7">
                    <div class="row g-4">
                        <div class="col-sm-4 wow bounceInUp" data-wow-delay="0.3s">
                            <div class="faqt-item bg-primary rounded p-4 text-center">
                                <i class="fas fa-users fa-4x mb-4 text-white"></i>
                                <h1 class="display-4 fw-bold" data-toggle="counter-up">689</h1>
                                <p class="text-dark text-uppercase fw-bold mb-0">Happy Customers</p>
                            </div>
                        </div>
                        <div class="col-sm-4 wow bounceInUp" data-wow-delay="0.5s">
                            <div class="faqt-item bg-primary rounded p-4 text-center">
                                <i class="fas fa-users-cog fa-4x mb-4 text-white"></i>
                                <h1 class="display-4 fw-bold" data-toggle="counter-up">107</h1>
                                <p class="text-dark text-uppercase fw-bold mb-0">Expert Chefs</p>
                            </div>
                        </div>
                        <div class="col-sm-4 wow bounceInUp" data-wow-delay="0.7s">
                            <div class="faqt-item bg-primary rounded p-4 text-center">
                                <i class="fas fa-check fa-4x mb-4 text-white"></i>
                                <h1 class="display-4 fw-bold" data-toggle="counter-up">253</h1>
                                <p class="text-dark text-uppercase fw-bold mb-0">Events Complete</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 wow bounceInUp" data-wow-delay="0.1s">
                    <div class="video">
                        <button type="button" class="btn btn-play" data-bs-toggle="modal"
                            data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Video -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen
                            allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Video End --}}
</section>
