<div class="header-main" >
                <div class="header-left">
                    <div class="logo-name">
                        <a href="index.html">
                            <h1>Shoppy</h1>
                            <!--<img id="logo" src="" alt="Logo"/>-->
                        </a>
                    </div>
                    <div class="profile_details">
                        <ul>
                            <li class="dropdown profile_details_drop">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <div class="profile_img">
                                        @if(empty(Auth::user()->img))
                                            <span class="prfil-img"><img src="{{ URL::to('/') }}/images/b3.png" alt="" style="width:50%;height:8%;"> </span>
                                        @else
                                            <span class="prfil-img"><img src="{{ URL::to('/') }}/images/{{Auth::user()->img}}" alt=""  style="border-radius:50%;border-style:solid;padding:0.5em;"> </span>
                                         @endif
                                         <div class="user-name">
                                            <p></p>
                                            <span>{{ Auth::user()->name }}</span>
                                        </div>
                                        <i class="fa fa-angle-down lnr"></i>
                                        <i class="fa fa-angle-up lnr"></i>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu drp-mnu">
                                    <li> <a href="{{route('profile')}}"><i class="fa fa-book"></i> Profile</a> </li>
                                    <li> <a href="{{route('organzation')}}"><i class="fa fa-bank"></i> Organazation</a> </li>
                                    <li> <a href="{{route('user')}}"><i class="fa fa-user"></i> User</a> </li>
                                    <li> <a href="{{route('Inventory_unit')}}"><i class="fa fa-truck"></i> Inventory unit</a> </li>
                                    <li> <a href="{{route('inventory')}}"><i class="fa fa-android"></i> Inventory</a> </li>
                                    <li> <a href="{{route('order')}}"><i class="fa fa-car"></i>order</a> </li>
                                    <li> <a href="{{route('neworder')}}"><i class="fa fa-pencil"></i>new order</a> </li>
                                    <li> <a href="{{route('newinventory')}}"><i class="fa fa-edit"></i>add inventory</a> </li>
                                    
                                    <li> <a href="{{route('purchase')}}"><i class="fa fa-money"></i>purchase</a> </li>
                                    <li> <a href="{{route('logoout')}}"><i class="fa fa-sign-out"></i> Logout</a> </li>
                                </ul>
                            </li>
                            
                        </ul>
                    </div>
                  

                    <div class="clearfix"> </div>
                </div>

                <div class="clearfix"> </div>
                
            </div>
            