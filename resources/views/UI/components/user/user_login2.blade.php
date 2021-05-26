<div class="block-space block-space--layout--after-header"></div>
<div class="block">
	<div class="container container--max--lg">
		@if(session('msg2') != null)
		<div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{session('msg2')}}
		</div>
		@endif
		<div class="row justify-content-center">
			<div class="col-md-6 d-flex mt-4 mt-md-0">

				<div class="card flex-grow-1 mb-0 ml-0 ml-lg-3 mr-0 mr-lg-4">
					<div class="card-body card-body--padding--2">
						<h3 class="card-title">Login</h3>
						<form method="POST" action="{{ url('user-registration') }}" role="form" enctype="multipart/form-data">
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
								<input id="signup-email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="customer@example.com" name="email" required autocomplete="email" value="{{ old('email') }}">
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
								<input id="signup-password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Secret word" name="password" required autocomplete="new-password">
								@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
<!-- 							<div class="form-group">
								<label for="signup-password">Password</label>
								<input id="signup-password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Secret word" name="password" required autocomplete="current-password">
								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div> -->
<!-- 							  <div class="form-group">
								<label for="signup-confirm">User Type</label>
								<select class="form-control" name="user_type">
									<option value="">Select Type</option>
									<option value="2">User</option> -->
									<!-- <option value="3">Doctor</option> -->
<!-- 								</select> -->
								<!-- <input type="radio" name="user_type" value="2">&nbsp;&nbsp;User
								<input type="radio" name="user_type" value="3">&nbsp;&nbsp;Doctor -->
<!-- 							  </div>   -->
							<div class="form-group mb-0">
								<button type="submit" class="btn btn-primary mt-3">Register</button>
							</div>
						</form>
<!-- 						<div class="account-menu__form-link" style="float:left;"><a href="{{url('/registration')}}">Create An Account ?</a>
						</div>
						<div class="account-menu__form-link" style="float:right;"><a href="{{url('/forget-password')}}">Forget Password ?</a>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>