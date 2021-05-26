<aside class="main-sidebar"> 
    <section class="sidebar">
        <ul class="sidebar-menu">   
           <!--  <li class="header">MAIN NAVIGATION</li>  -->

           @if(Auth::user()->role == null)
            <li class="treeview">
                <a href="{{ url('admin') }}">
                <i class="fa fa-pie-chart"></i><span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                </a> 
            </li>
            <li class="treeview"> 
                <a href="{{ url('/') }}">
                <i class="fa fa-pie-chart"></i><span>Visit Website</span> <i class="fa fa-angle-left pull-right"></i>
                </a> 
            </li>
        	<li class="treeview"> 
                <a href="{{ url('/edit-header-marquee/1') }}">
                <i class="fa fa-pie-chart"></i><span>Header Marquee Content</span> <i class="fa fa-angle-left pull-right"></i>
                </a> 
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Categories</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-categories')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Categories<span>
                        </a>
                    </li>  
                    <li>
                        <a href="{{url('view-sub-categories')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Sub Categories<span>
                        </a>
                    </li>  
                    <li>
                        <a href="{{url('view-user-categories')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>User Categories<span>
                        </a>
                    </li> 
                    <li>
                        <a href="{{url('view-user-sub-categories')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>User Sub Categories<span>
                        </a>
                    </li>   
                </ul>
            </li>  
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Banners</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-banner')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Banners<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            @if(Auth::user()->id == 1)
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Coupons</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-coupon')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Coupons<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            @endif
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span> Manage User Details</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-user-data')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>User Details<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Language</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-language')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Language<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span> Manage Vendor(Test)</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-vendors')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Vendor<span>
                        </a>
                    </li>  
                </ul>
            </li>
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-male"></i>
                    <span> Manage Delivery Boy</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-delivery-boy')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Delivery Boy<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Blogs</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-blogs')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Blog<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Product</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-product')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Product<span>
                        </a>
                    </li>  
                    <li>
                        <a href="{{url('view-product-review')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Add Product Review<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <!-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-map-marker"></i>
                    <span> Manage Location</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-location')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Location<span>
                        </a>
                    </li>  
                    <li>
                        <a href="{{url('view-lab-location')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Lab Location<span>
                        </a>
                    </li>  
                </ul>
            </li>  -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Testimonials</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-testimonials')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Testimonials<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <!-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Packages</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-packages')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Packages<span>
                        </a>
                    </li>  
                </ul>
            </li>  -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Brand</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-brand')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Brand<span>
                        </a>
                    </li>  
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Order</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-order')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Webstore Order<span>
                        </a>
                    </li> 

                    <li>
                        <a href="{{url('view-shop-order-karnal')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Karnal Shop Order<span>
                        </a>
                    </li> 
                    <!-- <li>
                        <a href="{{url('view-order-tester')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Tester Order<span>
                        </a>
                    </li>   -->
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span> Manage Social Icon</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('edit-social-icon')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Social Icon<span>
                        </a>
                    </li>  
                </ul>
                
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Manage Offers</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('send-offer-view')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Send Offers<span>
                        </a>
                    </li>  
                </ul>
                
            </li>
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Manage NewsLetters</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-news-letter-detail')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>View NewsLetters<span>
                        </a>
                    </li>  
                </ul>
                
            </li>
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Manage ContactUs Query</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-contact-us-detail')}}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>Contact Us Form Query<span>
                        </a>
                    </li>  
                </ul>
            </li>

             <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('get-shipping-settings')}}">
                            <i class="fa fa-cart-plus"></i>
                            <span>Manage Shipping Charges<span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('get-size-list')}}">
                            <i class="fa fa-cart-plus"></i>
                            <span>Manage Size<span>
                        </a>
                    </li>  
                </ul>
            </li> 
                
                <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>Manage Review </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-review')}}">
                            <i class="fa fa-cart-plus"></i>
                            <span>View Review <span>
                        </a>
                    </li>  
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>Manage Prescription </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                    <li>
                        <a href="{{url('view-prescription')}}">
                            <i class="fa fa-cart-plus"></i>
                            <span>View Prescription <span>
                        </a>
                    </li>  
                </ul>
            </li>

        @endif
            <!-- new code rahul -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>Store </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> 
                @if(Auth::user()->role == null)
                    <li>
                        <a href="{{url('add_shop')}}">
                            <i class="fa fa-cart-plus"></i>
                            <span>Add Store <span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('add_shop_manager')}}">
                            <i class="fa fa-cart-plus"></i>
                            <span>Add Store Manager <span>
                        </a>
                    </li>
                    <li>    
                        <a href="{{url('increment_tax')}}">
                            <i class="fa fa-cart-plus"></i>
                            <span>Increment  Tax <span>
                        </a>
                    </li>  
                    @endif  
                    @if(Auth::user()->role == 3)
                    <li>
                        <a href="{{url('add_stock')}}">
                            <i class="fa fa-cart-plus"></i>
                            <span>Add Stock <span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('add_multiple_stock')}}">
                            <i class="fa fa-cart-plus"></i>
                            <span>Add Multiple Stock <span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @if(Auth::user()->id == 1)
            <li class="treeview"> 
                <a href="{{ url('add_stock_manager') }}">
                <i class="fa fa-pie-chart"></i><span>Stock Manager</span> <i class="fa fa-angle-left pull-right"></i>
                </a> 
            </li>
            @endif
        <!-- new code -->

        </ul>
    </section><!-- /.sidebar -->
</aside> 