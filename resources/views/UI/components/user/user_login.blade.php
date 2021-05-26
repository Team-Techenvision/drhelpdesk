
<!-- breadcrumb start -->
<section class="breadcrumb-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2>CUSTOMER'S LOGIN</h2>
                </div>
            </div>
            <div class="col-12">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">login</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb End -->


<!--section start-->
<section class="login-page section-b-space" style="padding-top:0px !important">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="title">Login</h3>
                <div class="theme-card">
                    <form class="theme-form" method="POST" action="{{ url('user-login') }}" role="form" enctype="multipart/form-data" >
                    @csrf
                    @if(session('email') != null)
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" placeholder="Email" name="phn_or_email" value="{{session('email')}}" required autocomplete="email" autofocus>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" placeholder="Email" name="phn_or_email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                    @endif
                        <div class="form-group">
                            <label for="review">Password</label>
                            <input type="password" class="form-control" placeholder="Enter your password" name="password" required autocomplete="current-password">
                        </div>
                        
                        <button type="submit" class="btn btn-solid text-white">Login</button> 
                        <!-- <a href="{{ url('/auth/redirect/facebook') }}" type="submit" class="btn btn-solid text-white"><i class="fab fa-facebook-f text-white"></i></a> -->
                        <!-- <a href="{{ url('/auth/redirect/google') }}" type="submit" class="btn btn-solid text-white"><i class="fab fa-google text-white"></i></a> -->
                        </form>
                </div>
            </div>
            <div class="col-lg-6 right-login">
                <h3 class="title">New Customer</h3>
                <div class="theme-card authentication-right">
                    <h6 class="title-font">Create A Account</h6>
                    <p>Sign up for a free account at our store. Registration is quick and easy. It allows you to be able to order from our shop. To start shopping click register.</p><a href="{{ url('/registration') }}" class="btn btn-solid">Create an Account</a></div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->