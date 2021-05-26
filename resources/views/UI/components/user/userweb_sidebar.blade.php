<div class="account-sidebar"><a class="popup-btn">my account</a></div>
                <div class="dashboard-left">
                    <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> back</span></div>
                    <div class="block-content">
                        <ul>
                          <li class="<?php echo ($page == "profile" ? "active" : "")?>"><a href="{{url('/user-profile')}}">My Profile</a></li>
                            <li class="<?php echo ($page == "address" ? "active" : "")?>"><a href="{{url('/user-address')}}">Address Book</a></li>
                            <li class="<?php echo ($page == "orders" ? "active" : "")?>"><a href="{{url('/user-order-history')}}">My Orders</a></li>
                            <li class="<?php echo ($page == "wishlist" ? "active" : "")?>"><a href="{{url('/my-wishlist')}}">My Wishlist</a></li>
                            <li class="<?php echo ($page == "prescription" ? "active" : "")?>"><a href="{{url('/my-prescription')}}">My Prescription</a></li>
                            <li class="<?php echo ($page == "notification" ? "active" : "")?>"><a href="{{url('/my-notification')}}">Notifications</a></li>                         
                            <li class="<?php echo ($page == "change_password" ? "active" : "")?>"><a href="{{url('/user-change-password')}}">Change Password</a></li>
                            <li class="last"><a href="{{url('/logout')}}">Log Out</a></li>
                        </ul>
                    </div>
                </div>