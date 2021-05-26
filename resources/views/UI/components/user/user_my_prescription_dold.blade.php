<?php  
$location_name = DB::table('locations')->where('location_name',$map_location)->first(); 
?>

<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--current"><a href="{{url('/my-prescription')}}" class="breadcrumb__item-link">My Prescription</a>
					</li> 
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
		</div>
	</div>
    
</div>

<div class="block">
	<div class="container"> 
		<div class="row cart">
 
            @if(Auth::check())
                   @if($result != null)                 
					<div class="col-sm-12 col-md-12 col-lg-12 cart__table cart-table">
                        <div id="amountPending" style="font-weight: 600;font-size: 17px;color:red;"></div>
						<table id="example1" class="cart-table__table test001">
							<thead class="cart-table__head">
								<tr class="cart-table__row">										
									<th class="text-left">Prescription</th>
									<th class="text-center">Medicine</th>
									<th class="cart-table__column cart-table__column--remove">Status</th>
								</tr>
							</thead>
							<tbody class="cart-table__body test001">
                            @foreach($result as  $r1)                 
						    <tr>
							<td class="cart-table__column cart-table__column--image">
												<a href="{{ asset($r1->prescription_image) }}" target="_blank">
													<img src="{{asset($r1->prescription_image)}}" alt="" class="img-fluid">
												</a>
											</td>
                            <td class="text-center"> {{$r1->comment}}
								</td>
                                
                                <td class="text-center"> 
                                <a href="#" class="btn btn-success btn-xs">Approve</a>
								</td> 
                            </tr>
                            @endforeach
							</tbody>
							
						</table>
					</div>
				@else 
					<div class="ps-section__cart-bottom p-4 mb-4" style="text-align:center;">
                    <h4 class="text-danger">No Prescription Uploded</h4> 
						<a class="ps-btn" href="{{url('/')}}"><i class="icon-arrow-right"></i> Continue Shopping</a>
					</div>				
				@endif  
			@endif
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
