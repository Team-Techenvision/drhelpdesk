<div class="block-space block-space--layout--after-header"></div>
<div class="block">
	<div class="container container--max--lg">
		@if(session('msg') != null)
			<div class="alert alert-success alert-dismissable" style="margin-top: 25px;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				 {{session('msg')}} 
			</div>
		@endif
		<div class="row justify-content-center">  
			<div class="col-md-6 d-flex mt-4 mt-md-0">
				
				<div class="card flex-grow-1 mb-0 ml-0 ml-lg-3 mr-0 mr-lg-4">
					<div class="card-body card-body--padding--2">
						<h3 class="card-title">Register your account</h3>
						<form method="POST" action="{{ url('user-registration') }}" role="form" enctype="multipart/form-data" onsubmit="return myFun()">
                            @csrf
							<div class="form-group">
								<label for="signup-name">Full Name</label>
								<input id="signup-name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" name="name" value="{{ old('name') }}" required autocomplete="name">
								@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="form-group">
								<label for="signup-email">Email address</label>
								<input id="signup-email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="customer@example.com" name="email" autocomplete="email" value="{{ old('email') }}">
								@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="form-group">
								<label for="signup-mobile">Mobile No</label>
								<input  id="mobile" type="tel" class="form-control @error('phone') is-invalid @enderror" placeholder="Mobile no" name="phone" required autocomplete="phone" value="{{ old('phone') }}">
								<span id="message" style="color: red;"></span> 
								@error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="form-group">
								<label for="signup-password">Password</label>
								<input id="signup-password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" name="password" required autocomplete="new-password">
								@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							
							<div class="form-group">
								<label for="signup-refer_code">Referral Code (optional)</label>
								<input type="text" class="form-control @error('refer_code') is-invalid @enderror" placeholder="Referral Code" name="refer_code" value="{{ old('refer_code') }}"  autocomplete="off">
								@error('refer_code')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
                        	<input type="hidden" name="user_type" value="2">
							<!--<div class="form-group">
								<label for="signup-confirm">User Type</label>
                                                                <select required="required" class="form-control ttype" name="user_type">
									<option value="">Select</option>
									<option  value="2" >User</option>
									<option  value="3">Doctor</option> 
								</select>
								
							</div>-->
                            
                                                         <?php
                                                                    $speciality_name = DB::table('categories')->where('parent_id',16)->pluck('title','categories_id'); 
                                                                  
                                                                    ?>
                            
                                                            <div  class="form-group ">
								
                                                                <select style="display:none" class=" speciality form-control" name="speciality">
									<option value="">Select Speciality</option>
									@foreach($speciality_name as $kay => $speciality)
                                                                        <option  value="{{$kay}}">{{$speciality}}</option>
                                                                        @endforeach
								</select>
							</div>
							<div class="form-group mb-0">
								<button type="submit" class="btn btn-primary mt-3">Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>

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