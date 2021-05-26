@php $page='change_password' @endphp
<!-- section start -->
<section class="section-b-space">
   <div class="container">
      <div class="row">
         <div class="col-lg-3">
         @include('UI/components/user/userweb_sidebar')
         </div>
         <div class="col-lg-9">
            <div class="dashboard-right">
               <div class="dashboard">
                  <div class="box-account box-info">
                     <div class="box-head">
                        <div class="row">
                           <div class="col-md-12">
                              
                                 <div class="contact-page">
                                    <form class="theme-form" action="{{url('/user-change-password-submit')}}" method="post" >
                                       <div class="form-row">
                                          <div class="col-md-12">
                                             <label for="name">Old Password</label>
                                             <input type="password" class="form-control" name="old_password" id="name" placeholder="Enter Your Old Password" required="">
                                          </div>
                                          <div class="col-md-12">
                                             <label for="email">New Password</label>
                                             <input type="password" class="form-control" name="new_password" id="last-name" placeholder="Enter Your New Password" required="">
                                          </div>
										   <div class="col-md-12">
                                             <label for="email">Re-enter Your New Password</label>
                                             <input type="password" class="form-control" name="newc_password" id="last-name" placeholder="Re-Enter Your New Password" required="">
                                          </div>
                                          <div class="col-md-12">
                                             <button class="btn btn-sm btn-solid" type="submit">Save </button>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                             
                           </div>
                        </div>
                        
                     </div>
					
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- section end -->
