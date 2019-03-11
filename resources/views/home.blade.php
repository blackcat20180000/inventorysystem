@extends('layouts.menu')
 @section('content')

            <!--header start here-->
           @include('layouts.menubar')
            <div class="inner-block" >
                <div class="market-updates">
                    <div class="col-md-4 market-update-gd">
                        <div class="market-update-block clr-block-1">
                            <div class="col-md-8 market-update-left">
                                <h3><?php echo count($organzation);?></h3>
                                <h4>organization</h4>

                            </div>
                            <div class="col-md-4 market-update-right">
                                <a href="{{route('organzation')}}"><i class="fa fa-file-text-o"> </i></a>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <div class="col-md-4 market-update-gd">
                        <div class="market-update-block clr-block-2">
                            <div class="col-md-8 market-update-left">
                                <h3>@if($staff)
                                       <?php 
                                          echo count($staff);
                                       
                                       ?>
                                    @endif
                                </h3>
                                <h4>Staff</h4>

                            </div>
                            <div class="col-md-4 market-update-right">
                                <a><i class="fa fa-eye"> </i></a>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <div class="col-md-4 market-update-gd">
                        <div class="market-update-block clr-block-3">
                            <div class="col-md-8 market-update-left">
                                <h3>
                                    @if($item)
                                        <?php
                                            echo count($item);
                                        ?>
                                    @endif
                                </h3>
                                <h4>Inventor</h4>

                            </div>
                            <div class="col-md-4 market-update-right">
                               <a><i class="fa fa-envelope-o"> </i></a>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
           
 
@endsection