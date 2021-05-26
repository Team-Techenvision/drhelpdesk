<?php 
   
    $blog1 = DB::table('blogs')->take(5)->get();
    $blog2 =  DB::table('blogs')->inRandomOrder()->limit(5)->get();
?>
<!-- breadcrumb start -->
<section class="breadcrumb-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="title">Blog</h2>
                </div>
            </div>
			  <div class="col-12">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{url('/blog')}}">BLOG </a></li>
						                     </ol>
                </nav>
            </div>
           
        </div>
    </div>
</section>
<!-- breadcrumb End -->


<!-- section start -->
<section class="section-b-space blog-page ratio2_3">
    <div class="container">
        <div class="row">
            <!--Blog sidebar start-->
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="blog-sidebar">
                    <div class="theme-card">
                        <h4>Recent Blog</h4>
                        <ul class="recent-blog">
                        @foreach($blog1 as $blogdata) 
                   
                            <li>
                               <a href="{{url('/blog-detail/'.$blogdata->blogs_id)}}">  <div class="media"><img class="img-fluid " src="{{asset($blogdata->blog_image)}}" alt="Blog Image">
                                    <div class="media-body align-self-center">
                                        <h6>{{ucfirst($blogdata->blog_title)}}</h6>
                                        <!-- <h6>{{$blogdata->created_at}}</h6> -->
                                        <h6> <?php echo date('d-m-Y', strtotime($blogdata->created_at)); ?></h6>
                                        <!-- <p>0 Likes</p> -->
                                    </div>
                                </div>
								</a>
                            </li>
                            @endforeach  
                            <!-- <li>
                               <a href="#">  <div class="media"><img class="img-fluid " src="../assets/images/blog/7.jpg" alt="Blog Image">
                                    <div class="media-body align-self-center">
                                        <h6>5 Dec 2020</h6>
                                        <p>0 Likes</p>
                                    </div>
                                </div>
								</a>
                            </li>
                            <li>
                                <a href="#"> <div class="media"><img class="img-fluid " src="../assets/images/blog/4.jpg" alt="Blog Image">
                                    <div class="media-body align-self-center">
                                        <h6>5 Dec 2020</h6>
                                        <p>0 Likes</p>
                                    </div>
                                </div>
								</a>
                            </li>
                            <li>
                               <a href="#">  <div class="media"><img class="img-fluid " src="../assets/images/blog/7.jpg" alt="Blog Image">
                                    <div class="media-body align-self-center">
                                        <h6>5 Dec 2020</h6>
                                        <p>0 Likes</p>
                                    </div>
                                </div>
								</a>
                            </li>
                            <li>
                               <a href="#">  <div class="media"><img class="img-fluid " src="../assets/images/blog/6.jpg" alt="Blog Image">
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
                                    <div class="blog-date text-center text-white"><?php echo date('d M', strtotime($blogdata->created_at)); ?></div>
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
            <!--Blog List start-->
            <div class="col-xl-9 col-lg-8 col-md-7 order-sec">
            @foreach($blog as $blogdata)
            <div class="row blog-media">
           
                    <div class="col-xl-6">
                        <div class="blog-left">
                            <a href="{{url('/blog-detail/'.$blogdata->blogs_id)}}"><img src="{{asset($blogdata->blog_image)}}" class="img-fluid  bg-img" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="blog-right">
                            <div>
                                <h6>5 December 2020</h6><a href="{{url('/blog-detail/'.$blogdata->blogs_id)}}"><h4>{{$blogdata->blog_title}}</h4></a>
                                <ul class="post-social">
                                    <li>Posted By : Admin</li>
                                    <!-- <li><i class="fa fa-heart"></i> 5 Likes</li> -->
                                    
                                </ul>
                                <p>{!! substr(strip_tags($blogdata->blog_description), 0, 200) !!}...</p>
                            </div>
                        </div>
                    </div>

                   
                </div>
                @endforeach
                <!-- <div class="row blog-media">
                    <div class="col-xl-6">
                        <div class="blog-left">
                            <a href="#"><img src="../assets/images/blog/2.jpg" class="img-fluid  bg-img" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="blog-right">
                            <div>
                                <h6>5 December 2020</h6><a href="#"><h4>Evolving Indian Men Grooming</h4></a>
                                <ul class="post-social">
                                    <li>Posted By : Admin Admin</li>
                                    <li><i class="fa fa-heart"></i> 5 Likes</li>
                                    
                                </ul>
                                <p>A cultural commentator Mark Simpson coined the term 'Metrosexual', and twenty years later, he introduced the world with the word 'Spornosexual'. Both terms refer to the attitude of men towards men grooming.</p>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="row blog-media">
                    <div class="col-xl-6">
                        <div class="blog-left">
                            <a href="#"><img src="../assets/images/blog/3.jpg" class="img-fluid  bg-img" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="blog-right">
                            <div>
                                <h6>5 December 2020</h6><a href="#"><h4>All you need to know about Lab Tests and its Online Booking</h4></a>
                                <ul class="post-social">
                                    <li>Posted By : Admin Admin</li>
                                    <li><i class="fa fa-heart"></i> 5 Likes</li>
                                    
                                </ul>
                                <p>If we go into the market or especially near any hospital, we can see a plethora of Testing Labs. Presently, because of our existence in the time of cyberspace, on our mobiles and PCs, we can see these laboratories offering the convenience of booking Online Lab Tests as well. Now, what is it exactly! Let us start with knowing what Lab Tests are!</p>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="row blog-media">
                    <div class="col-xl-6">
                        <div class="blog-left">
                            <a href="#"><img src="../assets/images/blog/4.jpg" class="img-fluid  bg-img" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="blog-right">
                            <div>
                                <h6>5 December 2020</h6><a href="#"><h4>Let's talk about Women's Care</h4></a>
                                <ul class="post-social">
                                    <li>Posted By : Admin Admin</li>
                                    <li><i class="fa fa-heart"></i> 5 Likes</li>
                                    
                                </ul>
                                <p>Women's Care directly indicates to the Health of Women. This refers to the diagnosis of the conditions affecting the physical and emotional wellbeing of women and providing the right solution for their treatment.</p>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <!--Blog List start-->
            {{ $blog->appends($page)->links() }}
        </div>
    </div>
</section>
<!-- Section ends -->

