<!-- breadcrumb start -->
<section class="breadcrumb-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2>register</h2>
                </div>
            </div>
            <div class="col-12">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">register</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb End -->


<!--section start-->
<section class="register-page section-b-space" style="padding-top:0px !important">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="title pt-0">create account</h3>
                <div class="theme-card">
                    <form class="theme-form" method="post" action="{{ url('user-registration') }}" role="form" enctype="multipart/form-data" onsubmit="return myFun()">
                    <input type="hidden" name="user_type" value="2">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="email">First Name</label>
                                <input type="text" class="form-control" id="name" placeholder="First Name"  name="name" value="{{ old('name') }}" required autocomplete="name">
                            </div>
                            <div class="col-md-6">
                                <label for="review">Mobile no.</label>
                                <input type="text" class="form-control" id="mobile" placeholder="Mobile number" name="phone" required autocomplete="phone" value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="email">Email (optional)</label>
                                <input type="email" id="signup-email" class="form-control" placeholder="Email" name="email" autocomplete="email" value="{{ old('email') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="review">Password</label>
                                <input type="password" class="form-control"  placeholder="Enter your password" name="password" required autocomplete="new-password">
                            </div><button class="btn btn-solid text-white" type="submit">create Account</button></div>
                            
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->

<script>
      function myFun() {
        var a = document.getElementById("mobile").value;
        if(a==""){
        document.getElementById("message").innerHTML="** Please Fill mobile number";
        return false;
         }
         
        if(isNaN(a)){
        //is not anumber
        document.getElementById("message").innerHTML="** only numbers are allowed"
          return false;
       }

      if(a.length<10){
        document.getElementById("message").innerHTML="** Mobile Number must be 10 digit";
       return false;  
      }

      if(a.length>10){
        document.getElementById("message").innerHTML="** Mobile Number must be 10 digit"
       return false;
      }

      if((a.charAt(0)!=9)&&(a.charAt(0)!=8)&&(a.charAt(0)!=7)&&(a.charAt(0)!=6)){

        document.getElementById("message").innerHTML="** Mobile Number must start with 9, 8 ,7 and 6";
           return false;
      }

    }
</script>