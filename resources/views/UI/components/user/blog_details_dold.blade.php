<?php 
    $dt = new DateTime($blog->created_at);
    $tz = new DateTimeZone('Asia/Kolkata'); // or whatever zone you're after

    $dt->setTimezone($tz);
    $start_date = $dt->format("d-m-Y");
    $start_time = $dt->format("H:i:s");
    $blog1 = DB::table('blogs')->take(5)->get();

?>
<!-- site__body -->
<div class="site__body">
    <section class="b-blog">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="b-blog-txt">Blog-Detail</h3>
                </div>
            </div>
        </div>
    </section>
    <div class="sp">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="image2">
                                    <img src="{{asset($blog->blog_image)}}" class="img-fluid" alt="women" /> </div>
                                    <div class="card-body">
                                        <h3 class="card-title">{{$blog->blog_title}}<br>
                                            <span><small>Posted by : DHD &nbsp;&nbsp; {{$start_date}}</small></span></h3>
                                            <p style="text-align:justify;">{!!$blog->blog_description!!}</p>
                                        </div>
                                    </div>  
                                </div>
                            </div>  
                           <!--  <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <b> Share : </b>
                                            <div class="links">
                                                <ul>
                                                    <li><a href="#"><img src="{{asset('images/team/f.jpg')}}" alt="f" class="img-fluid"></a></li>
                                                    <li><a href="#"><img src="{{asset('images/team/t.jpg')}}" alt="f" class="img-fluid"></a></li>
                                                    <li><a href="#"><img src="{{asset('images/team/i.jpg')}}" alt="f" class="img-fluid"></a></li>
                                                    <li><a href="#"><img src="{{asset('images/team/u.jpg')}}" alt="f" class="img-fluid"></a></li>
                                                    <li><a href="#"><img src="{{asset('images/team/r.jpg')}}" alt="f" class="img-fluid"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <div class="comments">
                                        <h5 class="uppercase">3 Comments</h5>
                                        <ul class="comments-list">
                                            <li>
                                                <div class="avatar">
                                                    <img alt="Avatar" src="images/team/avatar1.png">
                                                </div>
                                                <div class="comment">
                                                    <span class="uppercase author">Jane Lovell, August 8</span>
                                                    <a class="btn btn-sm" href="#">Reply</a>
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                    </p>
                                                </div>
                                                <ul>
                                                    <li>
                                                        <div class="avatar">
                                                            <img alt="Avatar" src="images/team/avatar2.png">
                                                        </div>
                                                        <div class="comment">
                                                            <span class="uppercase author">Tim Jackson, August 8</span>
                                                            <a class="btn btn-sm" href="#">Reply</a>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                            </p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <div class="avatar">
                                                    <img alt="Avatar" src="images/team/avatar3.png">
                                                </div>
                                                <div class="comment">
                                                    <span class="uppercase author">Roland Sims, August 9</span>
                                                    <a class="btn btn-sm" href="#">Reply</a>
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                        <hr>
                                        <h5 class="uppercase">Leave A Comment</h5>
                                        <form >
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="name">Name:</label>
                                                    <input type="text" class="form-control" placeholder="Enter Name" id="pwd">
                                                </div>
                                                <label for="email">Email address:</label>
                                                <input type="email" class="form-control" placeholder="Enter email" id="email">
                                            </div>

                                            <div class="form-group ">
                                                <label for="comment">Comment:</label>
                                                <textarea class="form-control" rows="5" id="comment"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Leave Coment</button>
                                        </form>
                                    </div>
                                </div>
                            </div> -->




                        </div>
                        <div class="col-md-4">
                            <div class="card2">
                                <!-- <div class="row">
                                    <div class="col-sm-10 offset-sm-1">
                                        <h4>Search Blog</h4>
                                        <hr>
                                        <input type="text" class="form-control" placeholder="Search">
                                    </div>
                                </div> -->

                                <div class="row" style="margin-top:5%">
                                    <div class="col-sm-10 offset-sm-1">
                                        <h4>Recent Blogs</h4>
                                        <hr>
                                        <div class="b-links">
                                            <ul>
                                                @foreach($blog1 as $blogdata) 
                                                <li><a href="{{url('/blog-detail/'.$blogdata->blogs_id)}}">{{ucfirst($blogdata->blog_title)}} ></a></li>
                                                @endforeach  
                                            </ul>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>


                </div>
            </div>            
        </div>

        <!-- site__body / end --> 