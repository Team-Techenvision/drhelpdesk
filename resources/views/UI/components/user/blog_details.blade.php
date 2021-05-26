<?php 
    $dt = new DateTime($blog->created_at);
    $tz = new DateTimeZone('Asia/Kolkata'); // or whatever zone you're after

    $dt->setTimezone($tz);
    $start_date = $dt->format("d-m-Y");
    $start_time = $dt->format("H:i:s");
    $blog1 = DB::table('blogs')->take(5)->get();
    $blog2 =  DB::table('blogs')->inRandomOrder()->limit(5)->get();
?>
<!-- breadcrumb start -->
<section class="breadcrumb-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2>BLOG DETAILS</h2>
                </div>
            </div>
            <div class="col-12">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item " aria-current="page"><a href="#">BLOG </a></li>
						 <li class="breadcrumb-item " aria-current="page"><a href="#">BLOG Details </a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb End -->

<!--section start-->
<section class="blog-detail-page blog-page section-b-space ratio2_3">
    <div class="container">
        <div class="row">	
            <div class="col-xl-9 col-lg-8 col-md-7 blog-detail mb-3 h-100"><img src="{{asset($blog->blog_image)}}" class="img-fluid" alt="">
                <h3>{{$blog->blog_title}}</h3>
                <ul class="post-social">                   
                    <li>{{ \Carbon\Carbon::parse($start_date)->format('d M Y')}}</li>
                    <li>Posted By : Admin </li>
                    <!-- <li><i class="fa fa-heart"></i> 5 likes</li> -->
                    
                </ul>
                <p>{!!$blog->blog_description!!}</p>
				<!-- <p> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Along with choosing to buy from trusted E-Commerce Website, make sure you buy the product of a trusted brand. THE ESTABLISHED BRANDS ASSURE QUALITY.<br>
					<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Make sure the product does have MRP MENTIONED WITH MANUFACTURING AND EXPIRY DATE.<br>
					<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> There is NO SPELLING MISTAKE on the packaging of the product.<br>
					<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> An established brand will NEVER COMPROMISE WITH THE QUALITY OF PACKAGING.</p>
				<p>Along with these, you need to keep certain other things in mind to get a perfect match while purchasing beauty cosmetics online. These points are:</p>
				<p><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Stick to already Tried-and-Tested Product.<br>
				   <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Online Testers are not possible. Visit a local store, try testers and then order online at a better price.<br>
				   <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Do not accept the orders if the products are not sealed.<br>
				   <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> To ensure safe and better purchasing, read online reviews or watch review videos.</p>
			    <p>Are you too finding a safe source for your Online Beauty Cosmetics, visit Dr. HelpDesk – a one-stop station for your beauty and wellness needs. Here, get home delivery of great range of assorted cosmetics of established brands which are 100% original and fresh.</p> -->
			</div>
			 <!--Blog sidebar start-->
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="blog-sidebar">
                    <div class="theme-card">
                        <h4>Recent Blog</h4>
                        <ul class="recent-blog">
                            @foreach($blog1 as $blogdata)                    
                            <li>
                               <a href="{{url('/blog-detail/'.$blogdata->blogs_id)}}">  
                               <div class="media"><img class="img-fluid " src="{{asset($blogdata->blog_image)}}" alt="Generic placeholder image">
                                    <div class="media-body align-self-center">
                                        <h6>{{ucfirst($blogdata->blog_title)}}</h6>
                                        <h6>{{ \Carbon\Carbon::parse($start_date)->format('d M Y')}}</h6>
                                        <!-- <p>0 Likes</p> -->
                                    </div>
                                </div>
								</a>
                            </li>
                            @endforeach  
                            <!-- <li>
                               <a href="#">  <div class="media"><img class="img-fluid " src="../assets/images/blog/7.jpg" alt="Generic placeholder image">
                                    <div class="media-body align-self-center">
                                        <h6>5 Dec 2020</h6>
                                        <p>0 Likes</p>
                                    </div>
                                </div>
								</a>
                            </li>
                            <li>
                                <a href="#"> <div class="media"><img class="img-fluid " src="../assets/images/blog/4.jpg" alt="Generic placeholder image">
                                    <div class="media-body align-self-center">
                                        <h6>5 Dec 2020</h6>
                                        <p>0 Likes</p>
                                    </div>
                                </div>
								</a>
                            </li>
                            <li>
                               <a href="#">  <div class="media"><img class="img-fluid " src="../assets/images/blog/7.jpg" alt="Generic placeholder image">
                                    <div class="media-body align-self-center">
                                        <h6>5 Dec 2020</h6>
                                        <p>0 Likes</p>
                                    </div>
                                </div>
								</a>
                            </li>
                            <li>
                               <a href="#">  <div class="media"><img class="img-fluid " src="../assets/images/blog/6.jpg" alt="Generic placeholder image">
                                    <div class="media-body align-self-center">
                                        <h6>5 Dec 2020</h6>
                                        <p>0 Likes</p>
                                    </div>
                                </div>
								</a>
                            </li> -->
                        </ul>
                    </div>
                    <div class="theme-card">
                        <h4>Popular Blog</h4>
                        <ul class="popular-blog">
                        @foreach($blog2 as $blogdata) 
                            <li>
                                <a href="{{url('/blog-detail/'.$blogdata->blogs_id)}}"> <div class="media">
                                    <div class="blog-date text-white text-center">{{ \Carbon\Carbon::parse($start_date)->format('d M')}}</div>
                                    <div class="media-body align-self-center">
                                        <h6>{{ucfirst($blogdata->blog_title)}}</h6>
                                        <!-- <p>0 Likes</p> -->
                                    </div>
                                </div>
                                <!-- <p>it look like readable English. Many desktop publishing text.</p> -->
                                </a>
                            </li>
                            @endforeach 
                            <!-- <li>
                               <a href="#">  <div class="media">
                                    <div class="blog-date"><span>03 </span><span>dec</span></div>
                                    <div class="media-body align-self-center">
                                        <h6>Injected humour the like</h6>
                                        <p>0 Likes</p>
                                    </div>
                                </div>
                                <p>it look like readable English. Many desktop publishing text.</p></a>
                            </li>
                            <li>
                                <a href="#"> <div class="media">
                                    <div class="blog-date"><span>03 </span><span>dec</span></div>
                                    <div class="media-body align-self-center">
                                        <h6>Injected humour the like</h6>
                                        <p>0 Likes</p>
                                    </div>
                                </div>
                                <p>it look like readable English. Many desktop publishing text.</p></a>
                            </li>
                            <li>
                               <a href="#"> <div class="media">
                                    <div class="blog-date"><span>03 </span><span>dec</span></div>
                                    <div class="media-body align-self-center">
                                        <h6>Injected humour the like</h6>
                                        <p>0 Likes</p>
                                    </div>
                                </div>
                                <p>it look like readable English. Many desktop publishing text.</p></a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <!--Blog sidebar start-->
        </div>
        
       
    </div>
</section>
<!--Section ends-->
</div>


