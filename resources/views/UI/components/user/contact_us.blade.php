
<section class="breadcrumb-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2>contact us</h2>
                </div>
            </div>         
        </div>
    </div>
</section>
<!--section start-->
<section class="contact-page section-b-space pb-0">
    <div class="container">
        <div class="row section-b-space">
            <div class="col-lg-7 map">
            @if(session('msg') != null)
    					<div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
    						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    						{{session('msg')}}
    					</div>
					@endif
                <form class="theme-form"  method="post" action="{{route('submit_contact_us')}}">
                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="name">First Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your name" required="">
                        </div>

                        <div class="col-md-12">
                            <label for="review">Phone number</label>
                            <input type="text" class="form-control"  name="phone_number" placeholder="Enter your number" required="">
                        </div>
                        <div class="col-md-12">
                            <label for="email">Email</label>
                            <input type="text" class="form-control"  name="email" id="email" placeholder="Email" required="">
                        </div>
                        <div class="col-md-12">
                            <label for="review">Write Your Message</label>
                            <textarea class="form-control" placeholder="Write Your Message" name="message" id="message"  rows="4"></textarea>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-solid" type="submit">Send </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-5">
                <div class="contact-right">
                    <ul>
                        <li>
                            <div class="contact-icon"><i class="fa fa-phone" aria-hidden="true"></i>
                                <h6>Contact Us</h6></div>
                            <div class="media-body">
                                <p>+91 172 - 401 - 7566</p>
                                <p>+91 987 - 593 - 7503</p>
				
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <h6>Address</h6></div>
                            <div class="media-body">
                                <p>Unit No - 401, 4th Floor,Tower - A ,Bestech Business Towers,</p>
                                <p>Mohali, Punjab - 160066</p>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon"><i class="fa fa-envelope" aria-hidden="true"></i>
                                <h6>Address</h6></div>
                            <div class="media-body">
                                <p>support@drhelpdesk.in</p>
								 <p>info@drhelpdesk.in</p>
                               
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon"><i class="fa fa-clock-o" aria-hidden="true"></i>
                                <h6>OPeration Hours</h6></div>
                            <div class="media-body">
                                <p>Mon-Sat </p>
                                <p>09:00am - 06:00pm</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
    <div class="container-fluid map px-0">
       <div class="mapouter"><div class="gmap_canvas"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3431.514445710181!2d76.73885911499003!3d30.675798595425757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fed71ecd0cc05%3A0x9e6ac3da2d4cde09!2sDr.%20HelpDesk%20-%20Delivering%20Health%20Digitally!5e0!3m2!1sen!2sin!4v1598957838106!5m2!1sen!2sin" width="100%" height="450px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div><style>.mapouter{position:relative;text-align:right;height:auto;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:auto;width:100%}</style></div>
    </div>
</section>
<!--Section ends-->