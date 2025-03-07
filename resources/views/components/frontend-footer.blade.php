      <!-- Main Footer -->
      <footer class="footer-style-two style-two" style="background-image: url(/frontend/assets/images/background/10.jpg)">
          <div class="auto-container">
              <!-- Widgets Section -->
              <div class="widgets-section">
                  <div class="row clearfix">
                      <!-- Column -->
                      <div class="big-column col-lg-6 col-md-12 col-sm-12">
                          <div class="row clearfix">
                              <!-- Footer Column -->
                              <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                                  <div class="footer-widget logo-widget">
                                      <div class="widget-content">
                                          <div class="logo">
                                              <a href="index.html"><img src="/frontend/assets/images/logo-3.png"
                                                      alt="" /></a>
                                          </div>
                                          <div class="text">
                                              {{ __('main.footer_industry_text') }}
                                          </div>
                                          <!-- Social Box -->
                                          <ul class="social-box">
                                              <li>
                                                  <a href="https://www.facebook.com/" class="fab fa-facebook-f"></a>
                                              </li>
                                              <li>
                                                  <a href="https://www.twitter.com/" class="fab fa-twitter"></a>
                                              </li>
                                              <li>
                                                  <a href="https://www.linkedin.com/" class="fab fa-linkedin"></a>
                                              </li>
                                              <li>
                                                  <a href="https://youtube.com/" class="fab fa-youtube-play"></a>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>

                              <!-- Footer Column -->
                              <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                                  <div class="footer-widget links-widget">
                                      <h5>{{ __('main.useful_links') }}</h5>
                                      <ul class="list-link">
                                          <li><a href="{{ route('home') }}">{{ __('main.home') }}</a></li>
                                          <li><a href="{{ route('about') }}">{{ __('main.about') }}</a></li>
                                          <li><a href="{{ route('shop') }}">{{ __('main.shop') }}</a></li>
                                          <li><a href="{{ route('blog') }}">{{ __('main.blog') }}</a></li>
                                          <li><a href="{{ route('contact') }}">{{ __('main.contact') }}</a></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>


                      <!-- Column -->
                      <div class="big-column col-lg-6 col-md-12 col-sm-12">
                          <div class="row clearfix">
                              <!-- Footer Column -->
                              <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                                  <div class="footer-widget newsletter-widget">
                                      <h5>{{ __('main.contact_us') }}</h5>

                                      <!-- Subscribe Form -->
                                      <div class="subscribe-form-two">
                                          <form method="post" action="{{ route('contact.store') }}" id="contact-form">
                                              @csrf
                                              <div class="form-group">
                                                  <input type="text" name="name" value=""
                                                      placeholder="{{ __('main.name_placeholder') }}" required />
                                              </div>
                                              <div class="form-group">
                                                  <input type="text" name="phone_number" value=""
                                                      placeholder="{{ __('main.phone_placeholder') }}" required />
                                              </div>
                                              <div class="form-group">
                                                  <input type="text" name="text" value=""
                                                      placeholder="{{ __('main.subject_placeholder') }}" required />
                                              </div>
                                              <div class="form-group text-center">
                                                  <button type="submit" class="theme-btn btn-style-four">
                                                      <span class="txt">{{ __('main.contact_us_now') }}</span>
                                                  </button>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>

                              <!-- Footer Column -->
                              <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                                  <div class="footer-widget gallery-widget">
                                      <h5>Company Images</h5>
                                      <div class="row clearfix">
                                          <div class="image-column col-lg-6 col-md-6 col-sm-6">
                                              <a href="/frontend/assets/images/gallery/1.jpg" data-fancybox="gallery-1"
                                                  data-caption=""><img src="/frontend/assets/images/gallery/19.jpg"
                                                      alt="" /></a>
                                          </div>
                                          <div class="image-column col-lg-6 col-md-6 col-sm-6">
                                              <a href="/frontend/assets/images/gallery/2.jpg" data-fancybox="gallery-1"
                                                  data-caption=""><img src="/frontend/assets/images/gallery/20.jpg"
                                                      alt="" /></a>
                                          </div>
                                          <div class="image-column col-lg-6 col-md-6 col-sm-6">
                                              <a href="/frontend/assets/images/gallery/3.jpg" data-fancybox="gallery-1"
                                                  data-caption=""><img src="/frontend/assets/images/gallery/21.jpg"
                                                      alt="" /></a>
                                          </div>
                                          <div class="image-column col-lg-6 col-md-6 col-sm-6">
                                              <a href="/frontend/assets/images/gallery/4.jpg" data-fancybox="gallery-1"
                                                  data-caption=""><img src="/frontend/assets/images/gallery/22.jpg"
                                                      alt="" /></a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Footer Bottom -->
          <div class="footer-bottom">
              <div class="auto-container">
                  <div class="copyright">
                      &copy; <a href="{{ route('home') }}">Bricks</a> - Copyright 2025. Design by
                      <a href="#">Gayratillo</a>
                  </div>
              </div>
          </div>
      </footer>
      <!-- End Main Footer -->
