<!-- scripts -->

<!-- latest jquery-->
 {{-- <script src="{{asset('UI/js/jquery-3.3.1.min.js')}}"></script> --}}


<!-- menu js-->
<script src="{{asset('UI/js/menu.js')}}" defer></script>

<!-- timer js-->
<script src="{{asset('UI/js/flipclock.js')}}"></script>

<!-- popper js-->
<script src="{{asset('UI/js/popper.min.js')}}" ></script>

<!-- slick js-->
<script  src="{{asset('UI/js/slick.js')}}"></script>

<!-- Bootstrap js-->
<script src="{{asset('UI/js/bootstrap.js')}}" ></script>


<!-- Bootstrap Notification js-->
<script src="{{asset('UI/js/bootstrap-notify.min.js')}}"></script>

<!-- Zoom js-->
<script src="{{asset('UI/js/jquery.elevatezoom.js')}}"></script>

<!-- Theme js-->
<script src="{{asset('UI/js/script.js')}}" ></script>

<!-- <script>
    $(window).on('load', function() {
        $('#exampleModal').modal('show');
    });
</script> -->


<!-- modal js-->
<script src="{{asset('UI/js/modal.js')}}" ></script>

	

  
	
	<!-- geoplugin link---->

	<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript">

		

	</script> 

    <!-- payment gateway Button -->
<script>
    $(document).ready(function(){
        $('.razorpay-payment-button').click();
    });
</script>

	<!-- access location popup----> 





<script>
    $(document).on('change', '#deliveryLocaion', function(){
       var delid = $(this).val(); 
       $('#demo').html(delid);
       $('.search__dropdown').removeClass('search__dropdown--open');
       $.ajax({
            type: "post",
            //url: "http://lsne.in/dhd/public/checkaddress",
            url: "{{ url('/checkaddress') }}",
            dataType: "json",
            data: {name:delid},
            success : function(data){
                //alert(data)
              if(data == 0){
              	//$("#rs_phoneno1").html("Your Order Will Be deliver in 24 to 48 hours..!").show()
                $("#rs_phoneno1").html("Guaranteed Delivery").show()
              }else{
              	//$("#rs_phoneno1").html("Your Order Will Be deliver in 60 Min to 90 Min..!").show()
                $("#rs_phoneno1").html("Same Day Delivery").show()
              }
              //window.location.href = "http://lsne.in/dhd/public";
              window.location.reload(true);
            }
        });
    });
var x = document.getElementById("demo");
function getLocation(){
    if (navigator.geolocation) {
    //alert('1')
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
function showPosition(position) {
  var locAPI = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+position.coords.latitude +","+position.coords.longitude+"&key=AIzaSyAuLQFXPC_i3ZMhtpEplk3Owv8XGHyPOVM";
 
  $.get({
   url:locAPI,
   success:function(data){
   	x.innerHTML = data.results[0].address_components[4].long_name;
        $.ajax({
            type: "post",
            url: "{{ url('/checkaddress') }}",
            dataType: "json",
            data: {name:x.innerHTML},
            success : function(data){
               // alert(data)
              if(data == 0){
              //	$("#rs_phoneno1").html("Your Order Will Be deliver in 24 to 48 hours..!").show()
              $("#rs_phoneno1").html('<img src="https://webrobotapps.com/wp-content/uploads/2018/07/delivery-aplicativos.png" style="padding-top:0px;padding-bottom:5px;" width="32px" height="32px">Guaranteed Delivery').show()
              }else{
              	//$("#rs_phoneno1").html("Your Order Will Be deliver in 60 Min to 90 Min..!").show()
              	$("#rs_phoneno1").html('<img src="https://drhelpdesk.in/UI/images/logo/same.png">Same Day Delivery').show()
              }
             //window.location.reload(true);
            }
        });

   }
  });


}
	$(document).ready(function() { 
        @if(!Session::get('location_name') || Session::get('location_name') == 'no_location')
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
@endif
    
    
    
    $('#current_loction').on('click', function(){
    	getLocation();
    	//window.location.reload(true);
    	
    });
})
</script>
<script>
window.onload = function () {
    /*if (localStorage.getItem("hasCodeRunBefore") === null) {
        getLocation();
        localStorage.setItem("hasCodeRunBefore", true);
    }*/
 //getLocation();
}

    $(document).on('change','.food_sorting',function(){

        $(this).closest('form').submit();

    });

</script>

<script>

    $(document).on('change','.price_sorting',function(){

        $(this).closest('form').submit();

    });

</script>

<script type="text/javascript">

	$(document).ready(function () {

        $("#addNewaddress").click(function(){

            $(".new-address").show();           

        });	     

    });

</script>

<script type="text/javascript">

		$(document).ready(function() {

		$(".filter-categories span").click(function() {

				var link = $(this);

				var closest_ul = link.closest("ul");

				var parallel_active_links = closest_ul.find(".active")

				var closest_li = link.closest("li");

				var link_status = closest_li.hasClass("active");

				var count = 0;



				closest_ul.find("ul").slideUp(function() {

						if (++count == closest_ul.find("ul").length)

								parallel_active_links.removeClass("active");

				});



				if (!link_status) {

						closest_li.children("ul").slideDown();

						closest_li.addClass("active");

				}

		})

})

	</script>
	 <script>
function sidePop() {
  document.getElementById("sidebarpop").style.display = "block";
}
function sidePop1()
{
  document.getElementById("sidebarpop1").style.display = "block";
}

 var closebtns = document.getElementsByClassName("close");
  var i;

  for (i = 0; i < closebtns.length; i++) {
 closebtns[i].addEventListener("click", function() {
 this.parentElement.style.display = 'none';
 });
 }
</script>
<script>


// $(document).on('change', '#prescription_image', function(e){
//       var formData = new FormData($('#presentationform')[0]);
       
//        $.ajax({
//             type: "post",
//             url: "{{url('/prescription-submit')}}",
//             data:  formData,
//             contentType: false,
//             cache: false,
//             processData:false,
//             success : function(res){
//             if(res=='2') {
//               alert('Something went wrong')
            
//             } else {
//               location.reload(true);
//             }
             
//             }
//         });
//     });
$(document).on('change', '#prescription_image', function(e){
  var formData = new FormData($('#presentationform')[0]);
  $.ajax({
    type: "post",
    url: "{{url('/prescription-submit')}}",
    data:  formData,
    contentType: false,
    cache: false,
    processData:false,
    success : function(res){
      if(res=='2') {
        alert('Something went wrong');
        $('#message').html();

      } else {
        $('#message').html('prescription upload succesfully');
        $('#message').show();
        setTimeout(function(){ location.reload(true); }, 2000);

      }

    }
  });
  });

     $(document).on('click', '#consult_now_add', function(){

      var doc_id = $(this).attr('data-doc_id');
      $('#login_form').append('<input type="hidden" id="doc_id" name="doc_id" value="">');
      $('#doc_id').val(doc_id)
    });
    $(document).on('click', '#voice_call', function(){
      var consult_call = $(this).attr('data-consult_call');
      $('#calling').show();
      $(this).hide();
       $.ajax({
            type: "post",
            url: "{{route('calling')}}",
            dataType: "json",
            data: {"consult_call":consult_call, "_token": "{{ csrf_token() }}"},
            success : function(res){
              if(res=='2') {
                alert('You are unable call, Please contact with admin.');
                $('#calling').hide();
                $('#voice_call').show();
              } else {
                $('#calling').hide();
                $('#voice_call').show();
                location.reload(true);
              }
            }
        });
    });
</script>
<script>
 var foo = [];
 var reating = [];
    $(document).on('click','.CheckCls',function(){
        var check = $(this).is(":checked");
        var catId = $(this).val();
        var containName = catId.includes("rating");
            
        if(check){
            if(containName){
                rate = catId.split('-');
                reating.push(rate['1']);
            }else{
               foo.push(catId); 
            }
             
        }else{
            if(containName){
                rate = catId.split('-');
                reating.splice( $.inArray(rate['1'], reating), 1 );
            }else{
            foo.splice( $.inArray(catId, foo), 1 );    
            }
            
        }
        //for rating
        
        var tokens = $("#_token").val();
        $.ajax({
            type: "post",
            url: "{{url('/doctor-list-ajax')}}",
            data:  {"catId":foo,"reating":reating,"_token":tokens},
            success : function(res){
                 $("#loadingDiv").remove();
            $('.filterData').html(res);
//           
             
            }
        });
        

    });

</script>
<script>
     $(document).ready(function(){
        var check = $('.CheckCls').is(":checked");
        var catId = $('.CheckCls:checked').val();
        if(check){
             foo.push(catId);
        }else{
            foo.splice( $.inArray(catId, foo), 1 );
        }
        console.log(foo);
        var tokens = $("#_token").val();
        $('.gg>.preload').click();
        $.ajax({
            type: "post",
            url: "{{url('/doctor-list-ajax')}}",
            data:  {"catId":foo,"_token":tokens},
            success : function(res){
                 $("#loadingDiv").remove();
            $('.filterData').html(res);
            }
        });
        

    });

</script>  
<script>
$(document).ready(function(){
    $('.ttype').change(function(){
        var iid = $(this).val();
        if(iid == '3'){
            $(".speciality").css("display","block");
            $(".speciality").prop('required',true);
        }else{
            $(".speciality").prop('required',false);
             $(".speciality").css("display","none");
        }
    })
})
</script>
<script>
$(document).ready(function(){
$(document).on('click','.recbutton',function(){
        var likVal = $(this).val();
        var id = $(this).attr('name');
        var tokens = $("#_token").val();
        $.ajax({
            type: "post",
            url: "{{url('/submit-review-ajax')}}",
            data:  {"likeVal":likVal,"id":id,"_token":tokens},
            success : function(res){
                 $("#loadingDiv").remove();
          location.reload(true);
            }
        });
        

    });
})
$(document).ready(function(){
        $(document).on('click', '#consult_now_credit', function(){
          var consult_ids = $(this).attr('data-consult_ids');
          
           $.ajax({
                type: "post",
                url: "{{route('cunsult_now')}}",
                dataType: "json",
                data: {"consult_ids":consult_ids, "_token": "{{ csrf_token() }}"},
                success : function(res){
                  location.reload(true);
                }
            });
        });
});
</script>
<script>
$(document).ready(function(){
$(document).on('click','#SubID',function(){
        var subMail = $("#newslatter_email").val();
         var tokens = $("#_token").val();
         var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(subMail == ""){
           alert("Please Enter Email Id");
           return false;
        }
       if(subMail.match(mailformat))
        {
              $(".preload").click();
              $.ajax({
                type: "post",
                url: "{{url('/save-newslatter')}}",
                data:  {"newslatter_email":subMail,"_token":tokens},
                success : function(res){
                $("#loadingDiv").remove();
                $("#newslatter_email").val("");
                $(".divmsg").css("display","block");
            }
        });
        }else{
            alert('Please Enter Valid EmailId');
            return flase;
        }
        
        
        
       });

    
});

</script>
<script>

$(document).ready(function() {

	
        $('.txtp').showMore({
  minheight: 300,
        animationspeed: 400,
buttontxtmore: "Read more",
  buttontxtless: "Read less",
});
	
	
});

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.js" defer></script>
<script>

$(document).ready(function() {
  
    var route = "{{url('get-prod-list')}}";
    var $input = $(".typeahead");
    $input.typeahead({    
        minLength: 3,
        source:  function (term, process) {
        return $.get(route, { term: term }, function (data) {
          // alert(data);
            return process(data);
        });
    }
    });
	$input.change(function() {
  		var current =$input.typeahead("getActive");
        if (current==$input.val()) {
   		
        $("#search_frm").submit();
           

       	}
  	 });

    });
</script>

      <script src="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js')}}"></script>
      <script type="text/javascript">
        $(document).ready(function(){       
         $('#onloadpopup').modal('show');
        }); 
      </script>





<!-- email validation  -->
 <script type="text/javascript">
 
  // Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='add_address']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      name: "required",
      phone: "required",
      address: "required",
      pin_code: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      
    },
    // Specify validation error messages
    messages: {
      name: "Please enter your name",
      phone: "Please enter your phone",
      email: "Please enter a valid email address",
      pin_code: "Please enter a valid pincode",
      address: "Please enter Street Address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
 </script>

<!-- only number input -->
 <script>
  document.querySelector(".notext").addEventListener("keypress", function (evt) {
    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
    {
        evt.preventDefault();
    }
});
 </script>


<!-- only text no number  -->
 <script>
 $( document ).ready(function() {
                $( ".txtOnly" ).keypress(function(e) {
                    var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }
                });
            });
 </script>



<!-- get city From state -->

<!-- <script>


 $('#state_id').on('change',function(){
  var stateID = $(this).val();  
  if(stateID){
    $.ajax({
      type:"GET",
      url:"{{url('getCity1')}}?state_id="+stateID,
      success:function(res){        
      if(res){
        $("#city").empty();
        $.each(res,function(key,value){
          $("#city").append('<option value="'+key+'">'+value+'</option>');
        });
      
       }
      }
    });
    }
}); 
</script> -->

<!-- review view more functionality start -->

<script>
$(document).ready(function() {
	var showChar = 200;
	var ellipsestext = "...";
	var moretext = "more";
	var lesstext = "less";
	$('.more').each(function() {
		var content = $(this).html();

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar-1, content.length - showChar);

			var html = c + '<span class="moreelipses">'+ellipsestext+'</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">'+moretext+'</a></span>';

			$(this).html(html);
		}

	});

	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
});
</script>

<!-- emoji Script -->
<script>
      $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: '{{asset('UI/img/')}}',
          popupButtonClasses: 'far fa-smile'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
      });

     
    </script>
    <script>
        $(".topbar__link ").each(function() {   
    if (this.href == window.location.href) {
        $(this).addClass("active");
    }
});

$(".main-menu__list li a ").each(function() {   
    if (this.href == window.location.href) {
        $(this).addClass("active");
    }
});
    </script>

<script type="text/javascript">
    function removeProduct(id) {
  //  alert(id);
  $.ajax({
    url: "{{url('/remove-product')}}",
    data:"cart_id="+id,
    type: 'get',
    success: function(response){
      window.location.reload();
      // alert('product successfully deleted from cart');
    }
  });
  };
</script>




<script type="text/javascript">
    function removeWishlist(id) {
      // alert(id);
	  	$.ajax({
	  		url: "{{url('/remove-wishlist')}}",
	  		data:"product_id="+id,
	  		type: 'get',
	  		success: function(response){            
	                    window.location.reload();
	  			//alert('product successfully deleted from cart');
				  
	  		}
	  	});
	  	// document.getElementById('record-'+id).style.display="none";
	  	//for total cart amount calculation
	  	// document.getElementById('total').innerHTML= parseInt(document.getElementById('total').innerHTML) - parseInt(document.getElementById('price-'+id).innerHTML);
	  	// document.getElementById('grand-total').innerHTML= parseInt(document.getElementById('grand-total').innerHTML) - parseInt(document.getElementById('price-'+id).innerHTML);
	}
		
</script> 




<script type="text/javascript">
    @if(!empty($totaltype1Amount)) 
	    @if($totaltype1Amount < 549 && $type1totalitem != 0)
	        var pendingamount = {{ceil(549 - $totaltype1Amount)}};
	        document.getElementById('amountPending').innerHTML = 'You add Rs.'+pendingamount+' products for free shipping.';
	    @endif
    @endif
	function counterUpdate(type, id) {
      // alert(type);
    	if(type == 1) {
    		if(parseInt(document.getElementById('input-quantity-'+id).value) > 1) {
    			document.getElementById('input-quantity-'+id).value = parseInt(document.getElementById('input-quantity-'+id).value) - 1;
                //for total cart amount calculation
                document.getElementById('total').innerHTML= parseInt(document.getElementById('total').innerHTML) - parseInt(document.getElementById('price-'+id).innerHTML);
                document.getElementById('grand-total').innerHTML= parseInt(document.getElementById('grand-total').innerHTML) - parseInt(document.getElementById('price-'+id).innerHTML);
            }
        } else {
        	document.getElementById('input-quantity-'+id).value = parseInt(document.getElementById('input-quantity-'+id).value) + 1;
                //for total cart amount calculation
                document.getElementById('total').innerHTML= parseInt(document.getElementById('total').innerHTML) + parseInt(document.getElementById('price-'+id).innerHTML);
                document.getElementById('grand-total').innerHTML= parseInt(document.getElementById('grand-total').innerHTML) + parseInt(document.getElementById('price-'+id).innerHTML);
            }
            save_to_db(id);
        //for amount calculation in row on the basis of id/product quantity incre/decre.
        // document.getElementById('sub-total-'+id).innerHTML =  parseInt(document.getElementById('input-quantity-'+id).value) * parseInt(document.getElementById('price-'+id).innerHTML);
    }

    function save_to_db(cart_id) {
        //console.log(document.getElementById('input-quantity-'+cart_id).value);
        // alert();
        $.ajax({
        	url : "cart-update",
        	data : "cart_id="+cart_id+"&new_quantity="+document.getElementById('input-quantity-'+cart_id).value,
        	type : 'get',
        	success : function(response) {
                    window.location.reload();
                // alert(response);
            }
        });
    }
    </script>
<script>
	$('.owl-carousel').mouseover(function(){
      owl_product.trigger('stop.owl.autoplay');
  })

  $('.owl-carousel').mouseleave(function(){
      owl_product.trigger('play.owl.autoplay',[1000]);
  })
  </script>
  
  <!-- ckeditor -->
  <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
  <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
    CKEDITOR.replace('review-text', {
        filebrowserUploadUrl: "{{url('product-review-submit', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    </script> 

    <script>
      $(document).ready(
    function(){
        $("#addNewaddressprescription").click(function () {
            $("#new-address-prescription").toggle();
        });
    });
    </script>




    <!-- Razorpay payment gateway -->
    <script>
    $('#rzp-footer-form').submit(function (e) {
        var button = $(this).find('button');
        var parent = $(this);
        alert();
        button.attr('disabled', 'true').html('Please Wait...');
        $.ajax({
            method: 'get',
            url: this.action,
            data: $(this).serialize(),
            complete: function (r) {
                console.log('complete');
                console.log(r);
            }
        })
        return false;
    })
</script>

<script>
    function padStart(str) {
        return ('0' + str).slice(-2)
    }

    function demoSuccessHandler(transaction) {
        // You can write success code here. If you want to store some data in database.
        $("#paymentDetail").removeAttr('style');
        $('#paymentID').text(transaction.razorpay_payment_id);
        var paymentDate = new Date();
        $('#paymentDate').text(
                padStart(paymentDate.getDate()) + '.' + padStart(paymentDate.getMonth() + 1) + '.' + paymentDate.getFullYear() + ' ' + padStart(paymentDate.getHours()) + ':' + padStart(paymentDate.getMinutes())
                );

        $.ajax({
            method: 'post',
            url: "{{url('/dopayment')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "razorpay_payment_id": transaction.razorpay_payment_id
            },
            complete: function (r) {
                console.log('complete');
                console.log(r);
            }
        })
    }
</script>
<script>
    var options = {
        key: "{{ env('RAZORPAY_KEY') }}",
        amount: '247500',
        name: 'CodesCompanion',
        description: 'TVS Keyboard',
        image: 'https://i.imgur.com/n5tjHFD.png',
        handler: demoSuccessHandler
    }
</script>
<script>
    window.r = new Razorpay(options);
    document.getElementById('paybtn').onclick = function () {
        r.open()
    }
</script>

<!-- checkout page script -->

  
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

  if((a.charAt(0)!=9)&&(a.charAt(0)!=8)&&(a.charAt(0)!=7)){

    document.getElementById("message").innerHTML="** Mobile Number must start with 9, 8 and 7";
       return false;
  }

}
</script>
<script> 
  document.getElementById("field_terms").setCustomValidity("Please check this to accept the Terms and Conditions"); 
</script>
<script>
	var a = $('#field_terms').val()
</script>

	<script>
	$(document).ready(function() {
	  $(".search__button--start").prop("disabled", true);
	
});

	</script> 


  
<script>
// function copyUrl(type){
//   // alert(type);
// 		var url = "{{Request::url()}}";
     
// 		$.get('/share/product')
// 		.done(function(data) {
//       // alert(data);
//       var shair = (url+'?refer_code='+data);
//       alert(shair);
//       switch(type){
//         case "facebook" : 
//           //API Facebbok
//          window.open("https://www.facebook.com/sharer.php?u="+shair, '_blank');
//           break;
//           case "whatsup" : 
//           //API Facebbok
//          window.open("https://wa.me/?text="+shair, '_blank');
//           break;
                  
//       }
// 			// alert(shair);     
// 		})
// 	}

  function copyUrl(type){
            
            // token = $('#_token').val();
            var url = "{{Request::url()}}";
            token = $('#_token').val();
            products_id = $('#product_id_detail_page').val();
            // alert(products_id);
            $.ajax({
              
                    type: "post",
                    data:{'_token':token, 'product_id':products_id},
                    url:"{{ url('share/product') }}",
                    success : function(data){
                      // alert(data);
                      var shair = (url+'?refer_code='+data);
                      switch(type){
                      case "facebook" : 
                        //API Facebbok
                      window.open("https://www.facebook.com/sharer.php?u="+shair, '_blank');
                        break;
                        case "whatsup" : 
                        //API Facebbok
                      window.open("https://wa.me/?text="+shair, '_blank');
                        break;      
                    }
                    }
                });
          }
</script>


<!-- Checkout page script start -->

<script>
 $('.myCuppon').click(function(){
            cupon = $('#coupon-id').val();
            token = $('#_token').val();
           $('#coupon_error').hide();
            $.ajax({
                    type: "post",
                    data:{'coupon_code':cupon,'_token':token},
                    url:"{{ url('my-cart-ajax') }}",
                    success : function(data){
						// alert(data);
                    if(data=='1') {
                    	 window.location.reload(true);
                    } else {
                    	$('#coupon_error').show();
                    }
                    }
                });
          })
    
    	  $('#remove_coupon').click(function(){
            token = $('#_token').val();
            $.ajax({
                    type: "post",
                    data:{'_token':token},
                    url:"{{ url('remove-coupon') }}",
                    success : function(data){
                     window.location.reload(true);
                    }
                });
          })
</script>

<!-- Fetch Attribute data  -->
<script>
function fetch_attributes(attribute_id){
  // alert(attribute_id);
  token = $('#_token').val();
  $.ajax({
                    type: "get",
                    data:{'_token':token, attribute_id:attribute_id},
                    url:"{{ url('product-attribute-detail') }}",
                    success : function(data){
                      // alert(data.attributes[0].id);
                    //  window.location.reload(true);
                    if(data.attributes[0].special_price){
                    $('#product_price_attribute').text(data.attributes[0].special_price);
                    }else{
                    $('#product_price_attribute').text(data.attributes[0].price);
                    }
                    $('#attribute_id_detail_page').val(data.attributes[0].id);
                    $('#attribute_id_wishlist').val(data.attributes[0].id);
                    }
                });
  
}
</script>

<script>
function fetch_product_details(products_id){
  // alert(products_id );
  var url = "{{url('/')}}"; 
  // alert(url);
  $.ajax({
                    type: "get",
                    data:{products_id:products_id},
                    url:"{{ url('product-module-detail') }}",
                    success : function(data){
                      // alert(data.product['products_id']);
                    //  window.location.reload(true);
                    $('#model_product_title').text(data.product['product_name']);
                    $('#model_product_description').text(data.product['short_description']);
                    $('#model_product_id').val(data.product['products_id']);
                    $('#model_attribute_id').val(data.product['id']);
                    $('#model_image').attr('src',url+'/'+data.product['product_image']);
                    if(data.product['special_price']){
                    $('#model_product_price').text(data.product['special_price']);
                    }else{
                    $('#model_product_price').text(data.product['price']);
                    }
                    }
                });
  
}
</script>





    

