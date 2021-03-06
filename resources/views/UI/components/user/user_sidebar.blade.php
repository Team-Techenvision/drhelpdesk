@if(Auth::check())
<div class="col-12 col-lg-3"> 
	<div class="dashboard__profile card profile-card">
		<div class="card-body profile-card__body">
			
            <?php
              $image = DB::table('user_details')->where('user_id',Auth::user()->id)->first();
       		// dd($image);
            ?>
			<div class="profile-card__avatar">
        <?php if (!empty($image) && $image->image != null) { ?>
        <img src="{{asset($image->image)}}" alt="">
    <?php } elseif ( !empty($image) && $image->image == null){ ?>
        	<img src="{{asset('UI/images/logo/user.png')}}" alt=""> 
  <?php  } else{} ?>
				
			</div>
			<div class="profile-card__name">{{Auth::user()->name}}</div>
			<div class="profile-card__email">{{Auth::user()->email}}</div>
			
		</div>
	</div>
	<div class="account-nav">
		<ul class="account-nav__list">
			<li class="account-nav__item account-nav__item"><a href="{{url('user-dashboard')}}">Dashboard</a>
			</li>									
			<li class="account-nav__item"><a href="{{url('user-profile')}}">My Profile</a>
			</li>
			<li class="account-nav__item"><a href="{{url('user-order-history')}}">Order History</a>
			</li>
			<li class="account-nav__item"><a href="{{url('user-booking')}}">Lab test/health packages booking</a>
			</li>
<!--             <li class="account-nav__item"><a href="{{url('user-wallet-history')}}">Wallet History</a>
			</li> -->
			<li class="account-nav__item"><a href="{{url('user-address')}}">Addresses</a>
			</li>
        	
			<li class="account-nav__item"><a href="{{url('user-password')}}">Password</a>
			</li>
			<li class="account-nav__divider" role="presentation"></li>
			<li class="account-nav__item"> 
				<a href="{{ route('logout') }}" onclick="event.preventDefault();
		            document.getElementById('logout-form').submit();">
		            <!-- <i class="fas fa-sign-out-alt"></i> -->
					<span>Logout</span>
	          	</a>
	          	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	            	{{ csrf_field() }}
	          	</form> 
			</li>
		</ul>
	</div>
</div>
@endif