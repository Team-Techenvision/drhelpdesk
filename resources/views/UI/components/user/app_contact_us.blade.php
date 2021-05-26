<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  @include('UI.common/main_head_scripts')   
</head> 
<body>
	<style>
		.contact-info-box {
			margin-bottom: 30px;
			position: relative;
			padding-left: 100px;
			z-index: 1;
		}
		.contact-info-box .back-icon {
			position: absolute;
			right: 0;
			bottom: -15px;
			z-index: -1;
			color: var(--blackColor);
			line-height: 1;
			opacity: .04;
			font-size: 100px;
			-webkit-transform: rotate(-5deg);
			transform: rotate(-5deg);
		}
		.contact-info-box .icon {
			width: 75px;
			height: 85px;
			background-color: #f7f7f7;
			border-radius: 3px;
			position: absolute;
			text-align: center;
			left: 0;
			font-size: 40px;
			color: var(--mainColor);
			-webkit-transition: var(--transition);
			transition: var(--transition);
			top: 50%;
			-webkit-transform: translateY(-50%);
			transform: translateY(-50%);
		}
		.contact-info-box h3 {
			margin-bottom: 10px;
			font-size: 25px;
		}
		.contact-info-box p:last-child {
			margin-bottom: 0;
			font-size: 14px;
		}

		.contact-info-box p {
			margin-bottom: 3px;
			font-weight: 600;
		}
		.error{color:red;}
		.bx {
			font-family: 'boxicons'!important;
			font-weight: normal;
			font-style: normal;
			font-variant: normal;
			line-height: 1;
			display: inline-block;
			text-transform: none;
			speak: none;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}
		.contact-info-box .icon i {
			position: absolute;
			left: 0;
			right: 0;
			top: 50%;
			-webkit-transform: translateY(-50%);
			transform: translateY(-50%);
			color: #121943;
		}
		.contact-info-box:hover .icon {
			background-color: #1d99b6;
			color: white;
		}
		.contact-info-box:hover .icon i{
			color: #fafafa;
		}
		.section-title .sub-title {
			display: block;
			margin-bottom: 12px;
			color: var(--mainColor);
			text-transform: uppercase;
			font-size: 15.5px;
			font-weight: 700;
			text-align: center;
		}
		.section-title h2 {
			margin-bottom: 0;
			font-size: 42px;
			text-align: center;
		}
		.section-title p {
			max-width: 600px;
			font-size: 17px;
			font-weight: 600;
			margin-left: auto;
			margin-right: auto;
			margin-top: 12px;
		}
		.contact-image {
			margin-top: 20px;
			text-align: center;
			height: 500px;
			width: 502px;
		}
		.contact-image img{
			width: 100%;
		}
		.contact-form {
			padding: 40px;
			margin-left: 15px;
			-webkit-box-shadow: 0 0 20px rgba(158, 158, 158, 0.16);
			box-shadow: 0 0 20px rgba(158, 158, 158, 0.16);
			background-color: var(--whiteColor);
		}
		.default-btn::before {
			content: '';
			position: absolute;
			left: 0;
			right: 0;
			top: 0;
			bottom: 0;
			border-radius: 5px;
			background-color: #1d99b6;
			z-index: -1;
			-webkit-transition: var(--transition);
			transition: var(--transition);
		}
		.contact-form form .default-btn {
			margin-top: 5px;
			color: white;
		}

		[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
			cursor: pointer;
		}
		.default-btn {
			text-align: center;
			display: inline-block;
			-webkit-transition: var(--transition);
			transition: var(--transition);
			border-radius: 5px;
			border: none;
			padding: 10px 30px;
			position: relative;
			z-index: 1;
			color: var(--whiteColor);
			background-color: var(--blackColor);
			font-size: 17px;
			font-weight: 700;
		}
		@media only screen and (max-width: 480px) {
			.section-title h2 {
				margin-bottom: 0;
				font-size: 25px;
				text-align: center;
			}
			.section-title .sub-title {
				display: block;
				margin-bottom: 0px;
				color: var(--mainColor);
				text-transform: uppercase;
				font-size: 15.5px;
				font-weight: 700;
				text-align: center;
			}
			.section-title p {
				max-width: 600px;
				font-size: 13px;
				font-weight: 600;
				margin-left: auto;
				margin-right: auto;
				margin-top: 12px;
				text-align: center;
			}
			.contact-form {
				padding: 15px;
				margin-left: 0px;
				-webkit-box-shadow: 0 0 20px rgba(158, 158, 158, 0.16);
				box-shadow: 0 0 20px rgba(158, 158, 158, 0.16);
				background-color: var(--whiteColor);
				margin-top: 15px;
			}	
		}	
	</style>
  	<!-- site -->
	<div class="site">  
		<section class="contact-info-area pt-100 pb-70">
			<div class="row">
				<div class="col-md-12">
					<div>
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3431.514445710181!2d76.73885911499003!3d30.675798595425757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fed71ecd0cc05%3A0x9e6ac3da2d4cde09!2sDr.%20HelpDesk%20-%20Delivering%20Health%20Digitally!5e0!3m2!1sen!2sin!4v1598957838106!5m2!1sen!2sin" width="100%" height="450px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
					</div>
					
				</div>
			</div>
		    <div class="container"> 
		        <div class="row">
		            <div class="col-lg-4 col-md-6">
		                <div class="contact-info-box"> 
		                    <div class="icon">
		                       <i class="fas fa-map-marker-alt"></i>
		                    </div>
		                    <h3>Our Address</h3>
		                    <p>Unit No - 401, 4th Floor,Tower - A ,Bestech Business Towers,Mohali, Punjab - 160066</p>
		                </div>
		            </div>

		            <div class="col-lg-4 col-md-6">
		                <div class="contact-info-box"> 
		                    <div class="icon">
		                        <i class="fas fa-phone-alt"></i>
		                    </div>
		                    <h3>Contact</h3> 
		                    <p>Mobile: <a href="tel:91-172-4017566">+91-172-4017566</a><br>
		                                &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="tel:91-9875937503">+91-9875937503</a> 
		                    </p>
							<p>E-mail: <a target="_top" href="mailto:support@drhelpdesk.in">support@drhelpdesk.in</a></p>
		                </div>
		            </div>

		            <div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3">
		                <div class="contact-info-box"> 
		                    <div class="icon">
		                        <i class="far fa-clock"></i>
		                    </div>
		                    <h3>Hours of Operation</h3>
		                    <p>Mon-Sat 10:00am - 7:00pm</p>
		                </div>
		            </div>
		        </div>
		    </div>
		</section>
		<div class="block-space block-space--layout--divider-sm"></div>
		<section class="contact-area pb-100">
		    <div class="container">
		        <div class="section-title">
		            <span class="sub-title">Get in Touch</span>
		            <h2>Ready to Get Started?<span class="overlay"></span></h2>
		            <p>Your email address will not be published. Required fields are marked *</p>
		        </div>

		        <div class="row">
		            <div class="col-lg-6 col-md-12">
		                <div class="contact-image" data-tilt="">
		                    <img src="{{asset('UI/images/contact.png')}}" alt="image">
		                </div>
		            </div>

		            <div class="col-lg-6 col-md-12">
		                <div class="contact-form">
		                    <form  name="contactForm" method="post" action="{{route('submit_contact_us')}}">
		                       <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
		                        <div class="row">
		                            <div class="col-lg-12 col-md-6">
		                                <div class="form-group">
		                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your name">
		                                    
		                                </div>
		                            </div>

		                           <div class="col-lg-12 col-md-6">
		                                <div class="form-group">
		                                    <input type="text" name="email" class="form-control" id="email" placeholder="Your email address">
		                                 
		                            </div></div>
		 
		                            <div class="col-lg-12 col-md-12">
		                                <div class="form-group">
		                                    <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Your phone number">
		                            </div></div>

		                            <div class="col-lg-12 col-md-12">
		                                <div class="form-group">
		                                    <textarea name="message" id="message" class="form-control" cols="30" rows="6" placeholder="Write your message..."></textarea>
		                            </div></div>

		                            <div class="col-lg-12 col-md-12">
		                                <button type="submit" class="default-btn" style="pointer-events: all; cursor: pointer;">Send Message</button>
		                               
		                            </div>
		                        </div>
		                    </form>
		                    @if(session('msg') != null)
		    					<div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
		    						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    						{{session('msg')}}
		    					</div>
							@endif
		                </div>
		            </div>
		        </div>
		    </div>
		</section>
		<div class="block-space block-space--layout--divider-sm"></div>
		@include('UI.common/main_foot_scripts')   
	</div> 
</body>
</html>