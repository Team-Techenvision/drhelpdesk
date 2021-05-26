<style> 
      .downoad-app ._3G8YN {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    width: 130px;
    margin-right: 10px;
    height: 40px;
    border: none;
    background-color: #1d99b6;
    opacity: .95;
    border-radius: 5px;
    font-size: 12px;
    font-weight: 500;
    color: #fff;
    padding: 10px 15px;
}         

  .downoad-app ._19UrT {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      margin-top: 10px;
  }
  .downoad-app h2{
    margin-top: 15px;
    font-size: 15px;
  }
  </style>
<footer class="site__footer">
  <div class="site-footer">
  <div class="decor site-footer__decor decor--type--bottom">
    <div class="decor__body">
      <div class="decor__start"></div>
      <div class="decor__end"></div>
      <div class="decor__center"></div>
    </div>
  </div>
  <div class="site-footer__widgets">
    <div class="container">
      <div class="row">
        <div class="col-12 col-xl-4">
          <div class="site-footer__widget footer-contacts">
            <h5 class="footer-contacts__title">Contact Us</h5>
            <!--<div class="footer-contacts__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in feugiat lorem.</div>-->
            <address class="footer-contacts__contacts">
              <dl><dt>Phone Number</dt><dd><a href="tel:91-172-4017566">+91-172-4017566</a><br>
                      <a href="tel:91-9875937503">+91-9875937503</a> 
                      </dd></dl>
              <dl><dt>Email Address</dt><dd><a target="_top" href="mailto:support@drhelpdesk.in">support@drhelpdesk.in</a></dd></dl><dl><dt>Our Location</dt><dd>Unit No - 401 , 4th Floor, Tower - A , Bestech Business Towers , Mohali, Punjab - 160066</dd></dl><dl><dt>Working Hours</dt><dd>Mon-Sat 09:00am - 06:00pm</dd></dl></address>
            </div>
          </div>
          <div class="col-6 col-md-3 col-xl-2">
            <div class="site-footer__widget footer-links">
              <h5 class="footer-links__title">Information</h5>
              <ul class="footer-links__list">
                <li class="footer-links__item"><a href="{{url('about-us')}}" class="footer-links__link">About Us</a>
                </li>
                 <li class="footer-links__item"><a href="{{url('contact-us')}}" class="footer-links__link">Contact Us</a>
                </li>
                <li class="footer-links__item"><a href="{{url('disclaimer')}}" class="footer-links__link">FAQ</a>
                </li>
               
                
                </li>
                <li class="footer-links__item"><a href="{{url('privacy-policy')}}" class="footer-links__link">Privacy Policy</a>
                </li>
                <!-- <li class="footer-links__item"><a href="{{url('return-policy')}}" class="footer-links__link">Return Policy</a>
                </li> -->
                <li class="footer-links__item"><a href="{{url('refund-policy')}}" class="footer-links__link">Refund Policy</a>
                </li>
                <li class="footer-links__item"><a href="{{url('term-conditions')}}" class="footer-links__link">Terms & Conditions</a>
                <!-- <li class="footer-links__item"><a href="{{url('cancellation-policy')}}" class="footer-links__link">Cancellation Policy</a>  -->
              </ul>
            </div>
          </div>
          <div class="col-6 col-md-3 col-xl-2">
            <div class="site-footer__widget footer-links">
              <h5 class="footer-links__title">My Account</h5>
              <ul class="footer-links__list">
                 <li class="footer-links__item"><a href="{{url('brands')}}" class="footer-links__link">Brands</a>
                </li>
<!--                 <li class="footer-links__item"><a href="{{url('lab-tests')}}" class="footer-links__link">Lab Test
                </a>
                </li>
                <li class="footer-links__item"><a href="{{url('store-location')}}" class="footer-links__link">Store Location</a>
                </li> -->
                <li class="footer-links__item"><a href="{{url('user-order-history')}}" class="footer-links__link">Order History</a>
                </li>
              
              	<li class="footer-links__item"><a href="https://goo.gl/maps/QuGkWrSb9HwF5UuWA" class="footer-links__link"><img src="{{asset('UI/images/google-review-logo.png')}}" alt="Google Review"  class="img-fluid"></a>
                </li>
<!--                 <li class="footer-links__item"><a href="{{url('all-package')}}" class="footer-links__link">Health Package</a>
                </li> -->
               <!--  <li class="footer-links__item"><a href="#" class="footer-links__link">Newsletter</a>
                </li> -->
<!--                 <li class="footer-links__item"><a href="{{url('delivery-Information')}}" class="footer-links__link">Delivery Information</a>
                </li> -->
               
              </ul>
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-4">
            <div class="site-footer__widget footer-newsletter">
              <h5 class="footer-newsletter__title">Newsletter</h5>
              <div class="footer-newsletter__text">Enter your email address below to subscribe to our newsletter and keep up to date with discounts and special offers.</div>
<!--             <form name="news_latter" method="post" action="{{route('save_newslatter')}}" class="footer-newsletter__form">-->

                 <label class="sr-only" for="footer-newsletter-address">Email Address</label>
                <input id="_token" type="hidden" value="{{csrf_token()}}" name="_token">
                <input id ="newslatter_email" type="email" name="newslatter_email"  class="footer-newsletter__form-input" id="footer-newsletter-address" placeholder="Email Address...">
                <button id="SubID" style="padding: 10px;" type="button" class="footer-newsletter__form-button">Subscribe</button>
<!--              </form>-->
              <div style="display: none;" class="divmsg" style="color:green">
                  <strong style="color:green;">Thank You For Subscribe Newsletter!!</strong>
              </div>
<button class="preload" style="display:none">cc</button>

               @php
                $social= DB::table('social_icons')->where('id',1)->first();   
              @endphp
              <div class="footer-newsletter__text footer-newsletter__text--social">Follow us on social networks</div>
              <div class="footer-newsletter__social-links social-links">
                <ul class="social-links__list">
                  <li class="social-links__item social-links__item--facebook"><a href="{{$social->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                  </li>
                  <li class="social-links__item social-links__item--twitter"><a href="{{$social->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a>
                  </li>
                  @if($social->youtube != null)
                  <li class="social-links__item social-links__item--youtube"><a href="{{$social->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a>
                  </li>
                  @endif
                  
                  <li class="social-links__item social-links__item--instagram"><a href="{{$social->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a>
                  </li>
                  @if($social->skype != null)
                  <li class="social-links__item social-links__item--rss"><a href="{{$social->skype}}" target="_blank"><i class="fas fa-rss"></i></a>
                  </li>
                  @endif
                </ul>
              </div>
               <div class="downoad-app">
                  <div><h2>Download the App for Free</h2></div>
                  <div class="_19UrT"><a href="https://play.google.com/store/apps/details?id=com.expertwebtech.mydhd.dhd" class="_3G8YN" target="_blank" rel="noopener noreferrer"><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/3380aedc.png" alt="Google Play" class="iQq1x"><div class="Ut8SA">Google Play</div></a><a href="https://play.google.com/store/apps/details?id=com.expertwebtech.mydhd.dhd" class="_3G8YN" target="_blank" rel="noopener noreferrer"><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/9bf5c576.png" alt="App Store" class="iQq1x"><div class="Ut8SA">App Store</div></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="site-footer__bottom">
      <div class="container">
        <div class="site-footer__bottom-row">
          <div class="site-footer__copyright">
            <!-- copyright -->&copy; 2020 Dr. Helpdesk, All rights reserved.
            <!-- copyright / end -->
          </div>
          <div class="site-footer__payments">
             <img src="{{asset('UI/images/payment_method.svg')}}" alt="Payment"  class="img-fluid">
          
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
  
 