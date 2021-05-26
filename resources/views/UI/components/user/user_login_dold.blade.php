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
						<form method="POST" action="{{ url('user-login') }}" role="form" enctype="multipart/form-data">
							@csrf
							@if(session('email') != null)

							<div class="form-group">
								<label for="signup-email">Email address</label>
								<input id="signup-email" type="text" class="form-control @error('phn_or_email') is-invalid @enderror form-control-sm" placeholder="" name="phn_or_email" value="{{session('email')}}" required autocomplete="email" autofocus>
								@error('phn_or_email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							@else
							<div class="form-group">
								<label for="signup-email">Email address</label>
								<input id="signup-email" type="text" class="form-control @error('phn_or_email') is-invalid @enderror form-control-sm" placeholder="" name="phn_or_email" value="{{ old('email') }}" required autocomplete="email" autofocus>
								@error('phn_or_email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							@endif
							
							<div class="form-group">
								<label for="signup-password">Password</label>
								<input id="signup-password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" name="password" required autocomplete="current-password">
								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							  {{-- <div class="form-group">
								<label for="signup-confirm">User Type</label>
								<select class="form-control" name="user_type">
									<option value="">Select Type</option>
									<option value="2">User</option> --}}
									<!-- <option value="3">Doctor</option> -->
								{{-- </select> --}}
								<!-- <input type="radio" name="user_type" value="2">&nbsp;&nbsp;User
								<input type="radio" name="user_type" value="3">&nbsp;&nbsp;Doctor -->
							  {{-- </div>   --}}
							<div class="form-group mb-0">
								<button type="submit" class="btn btn-primary mt-3">Login</button>
							</div>
						</form>
						<div class="account-menu__form-link" style="float:left;"><a href="{{url('/registration')}}">Create An Account ?</a>
						</div>
						<div class="account-menu__form-link" style="float:right;"><a href="{{url('/forget-password')}}">Forgot Password ?</a>
						</div>

						<div class="footer-newsletter__social-links social-links mt-3">
                    <ul class="social-links__list list-inline">
                    <li class="social-links__item social-links__item--facebook "><a href="{{ url('/auth/redirect/facebook') }}" ><i class="fab fa-facebook-f text-white"></i></a>
                    </li>
                    <li class="social-links__item social-links__item--facebook "><a href="{{ url('/auth/redirect/google') }}" ><i class="fab fa-google text-white"></i></a>
                    </li>
                  </ul>
                  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>