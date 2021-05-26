@extends('main_master') 
	@section('main_content')   
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
						<h3 class="card-title">Otp Verification</h3>
						<form method="POST" action="{{ url('otp-submit') }}" role="form" enctype="multipart/form-data" onsubmit="return myFun()">
                            @csrf 
							<div class="form-group">
								<label for="signup-mobile">OTP</label>
								<input   type="tel" class="form-control @error('otp') is-invalid @enderror" placeholder="otp" name="otp" required autocomplete="otp" value="{{ old('otp') }}">
								<span id="message" style="color: red;"></span>
								<span style="float:right;font-size:12px;"><a style="color:#007bff;" href="javascript:void(0);" id="resendOtp">Resend OTP</a></span>
								@error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div> 
							<div class="form-group mb-0">
								<button type="submit" class="btn btn-primary mt-3">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).on('click', '#resendOtp', function(){
       $.ajax({
           url:'{{url("resendotp")}}',
           type: 'GET',
           success: function(data){
               if(data == '1'){
                   alert('Otp resend successfully.');
               }else{
                   alert('Something went wrong');
               }
           }
       }) 
    });
</script>
@stop 