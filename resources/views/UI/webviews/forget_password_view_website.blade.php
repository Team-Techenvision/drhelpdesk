@extends('main_master') 
	@section('main_content') 
<!-- breadcrumb start -->
<section class="breadcrumb-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2>forget password</h2>
                </div>
            </div>
            <div class="col-12">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">forget password</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb End -->


<!--section start-->
<section class="pwd-page section-b-space" style="padding-top:0px !important">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 ">
                <h2>Forget Your Password</h2>
                <form class="theme-form" action="{{url('forget-password-submit')}}" method="post" enctype="multipart/form-data" >
                    <div class="form-row">
                        <div class="col-md-12">
                            <input type="text" class="form-control"  name="email"  placeholder="Enter Your Email" required="">
                        </div><button  class="btn btn-solid">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->
@stop 

  