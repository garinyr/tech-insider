<aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- User profile -->
            <div class="user-profile" style="background: url({{ URL::asset('dashboard-material/images/bg-user.jpg') }}) no-repeat;">
                <!-- User profile image -->
                <div class="profile-img"> <img src="{{ URL::asset('dashboard-material/images/Icon Admin.svg')}}" alt="user" /> </div>
                <!-- User profile text-->
               
            </div>
            <!-- End User profile text-->
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
					<li>
						<a href="{{url('admin/')}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu"> Dashboard</span></a>
					</li>
					<li> 
						<a href="{{url('admin/product')}}" aria-expanded="false"><i class="fa fa-cubes"></i><span class="hide-menu"> Product </span></a> 
                    </li>
                    <li> 
						<a href="{{url('admin/custom')}}" aria-expanded="false"><i class="fa fa-cube"></i><span class="hide-menu"> Custom </span></a> 
					</li>
					<li> 
						<a href="{{url('admin/bank')}}" aria-expanded="false"><i class="fa fa-suitcase"></i><span class="hide-menu"> Bank </span></a> 
					</li>
                    <li> 
						<a href="{{url('admin/transaksi')}}" aria-expanded="false"><i class="fa fa-shopping-basket
"></i><span class="hide-menu">Transaksi </span></a>
					</li>   
                    <li> 
						<a href="{{url('admin/user')}}" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu"> User </span></a> 
					</li>  
                    {{-- 
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Dashboard 1</a></li>
                                <li><a href="index2.html">Dashboard 2</a></li>
                                <li><a href="index3.html">Dashboard 3</a></li>
                                <li><a href="index4.html">Dashboard 4</a></li>
                                <li><a href="index5.html">Dashboard 5</a></li>
                                <li><a href="index6.html">Dashboard 6</a></li>
                            </ul>
                        </li>   
                    --}}
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
        <!-- Bottom points-->
     
        <!-- End Bottom points-->
    </aside>