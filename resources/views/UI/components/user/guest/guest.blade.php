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

				<div class="card flex-grow-1 mb-0 ml-0 ml-lg-3 mr-0 mr-lg-4 mt-5 mb-5">
					<div class="card-body card-body--padding--2">
						<h3 class="card-title">Login</h3>
						<form method="POST" action="{{ url('guest-login') }}" role="form" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="signup-email">Email ID or Contact Number</label>
								<input id="signup-email" type="text" class="form-control @error('phn_or_email') is-invalid @enderror form-control-sm" placeholder="" name="phn_or_email" value="{{ old('email') }}" required autocomplete="email" autofocus>
								@error('phn_or_email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							  
							<div class="form-group mb-0">
								<button type="submit" class="btn btn-primary mt-3">Submit</button>
							</div>
						</form>
						{{-- <div class="account-menu__form-link" style="float:left;"><a href="{{url('/registration')}}">Create An Account ?</a>
						</div>
						<div class="account-menu__form-link" style="float:right;"><a href="{{url('/forget-password')}}">Forget Password ?</a>
						</div> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>