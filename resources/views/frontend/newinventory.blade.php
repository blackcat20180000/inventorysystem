@extends('layouts.menu')
 @section('content')
    @include('layouts.menubar')
    <div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <form  method="post" action="{{route('addunit')}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">product image</h4>
                    </div>
                    <div class="modal-body">
                        
                            @csrf
                            <input type="hidden" name="org_id" id="org_id">
                            <div class="form-group row" style="padding:2em;">
                                
                                <div class="col-md-6 form-group">
                                    <img id="preview" style="width:150px;height:150px;"></img>        
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         
                    </div>
                </div>
                
            </div>


        </form>
    </div>
    
    <div class="modal fade" id="mymodal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <form  method="post" action="{{route('addunit')}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">barcode scan<span id="result"></span></h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="col-md-6">
                            <div class="well" style="display: inline-block;float:left;">
                                <canvas width="120" height="120" id="webcodecam-canvas"></canvas>
                                <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                                <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                                <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                                <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                            </div>
                           
                                    <div class="well" style="display: inline-block;boder:0px;border-style:none;">
                                        <img width="120" height="120" id="scanned-img" src="">
                                    </div>

                              
                    
                        </div>
                        <select class="form-control" id="camera-select" style="display:none;"></select>
                        <div class="form-group" style="margin-top:0.1em;">
                            <input id="image-url" type="text" class="form-control" style="margin-bottom:0.3em;" placeholder="Image url">
                            <button title="Decode Image" class="btn btn-default btn-sm" id="decode-img" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-upload"></span></button>
                            <button title="Image shoot" class="btn btn-info btn-sm disabled" id="grab-img" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-picture"></span></button>
                            <button title="Play" class="btn btn-success btn-sm" id="play" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-play"></span></button>
                            <button title="Pause" class="btn btn-warning btn-sm" id="pause" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-pause"></span></button>
                            <button title="Stop streams" class="btn btn-danger btn-sm" id="stop" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-stop"></span></button>
                         </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         
                    </div>
                </div>
                
            </div>


        
    </div>
    
    <div class="portlet-grid panel-primary" style="width:100%;padding:1em;"> 
    <form method="post" action="{{route('additem')}}">
        @csrf
        <div class="row" style="padding:0.3em;">
            <div class="col-xs-4">
                <select style="font-size:15pt;border:0px;" name="org" id="myorg" onchange="render_unit_tab()" required>
                     @foreach($company as $row)
                          <option value="{{$row->id}}">{{$row->name}}</option>
                     @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            
            <div class="col-xs-6" style="margin:auto;float:none;">
                <style>
                    div
                    {
                        margin:auto;
                    }
                    svg
                    {
                        width:200px;
                    }
                </style>
                
                 <?php
                       echo DNS1D::getBarcodeSVG("4445645656", "C39");
                       echo '<span style="width:250px;letter-spacing:11px;font-style:bold;">4445645656</span>';
                ?>
                  <input type="file" id="scanimg" style="display:none"> 
                  <img src="{{asset('img/barcode.png')}}" style="width:80px;height:80px;margin-left: 30%;" id="scandevice"></img>  

                       
                
            </div>
        </div>
    <div class="row" style="font-size:10pt;margin-top:0.4em;">
          <div class="col-xs-6">
             <select name="resource" id="resource"  class="form-control" style="border:0px;height:30px;" onchange="invent_style(this)"  required>
                  @foreach($unit_com as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                  @endforeach
            </select>
         </div>
         <div class="col-xs-6" style="padding-left:0px;">
            <input type="text" class="form-control" id="filter_val" placeholder="Number" name="ordernumber" style="display:none;" required>
            
        </div>

    </div>
    <div class="row" style="margin-top:0.5em;font-size:10pt;">
          <div class="col-xs-6">
             <input type="text" id="upccodec" class="form-control" placeholder="UPC code" name="upc" required>
         </div>
         <div class="col-xs-6" style="padding-left:0.2em;">
            <input type="text" class="form-control" placeholder="ITEM#" name="item" required>
            
        </div>

    </div>
    <div class="row" style="margin-top:0.5em;">
        <div class="col-xs-12">
            <input type="text" class="form-control" placeholder="NAME" name="itemname" required>
        </div>
    </div>
    <div class="row" style="margin-top:0.5em;">
        <div class="col-xs-12 ">
          <textarea name="itemdesc"  style="display:block;width:100%;height:80px;" required>
          </textarea>
        </div>
    </div>
    <div class="row center" style="margin-top:0.3em;">
         <div class="col-xs-5" style="">
            <label style="float:left;">cost</label>
            <input type="text" class="check1 form-control cost col-xs-3" style="padding-right:0.2em;" value="$"  name="cost" placeholder="" oninput="check_validate(1)" required>
         </div>
         <div class="col-xs-2" style="padding-right:0em;padding-left:0em;">
            <label style="float:left;">%</label>
            <input type="text" class="check2 form-control percent" name="percent" value="%10" style="padding-right:0em;" oninput="check_validate(2)" >
         </div>
         
         <div class="col-xs-5 " style="">
             <label>price</label>
            <input type="text" class="check3 form-control price" name="price" oninput="check_validate(3)"  required>
         </div>
         
        
    </div>
    <div class="row" style="margin-top:0.5em;">
         <input type="file" id="captureimage" accept="image/*" style="display:none">
        <div class="col-xs-2" style="">
            <a class="fileupload"><i class="fa fa-camera" aria-hidden="true" style="display:block;font-size:26pt;"></i></a>
        </div>
        <div class="col-xs-6" style="margin:0em;padding-left:0em;">
            <input type="text" name="qty" class="form-control"  placeholder="QTY" style="" required>
        </div>
        <div class="col-xs-2" style="padding:0em;margin-right:0em;">
           <button type="submit" class="btn" style="background-color:#00468c;color:white;width:100%;margin:0em;">Add</button>
        </div>
        <div class="col-xs-1" style="">
                 <i class="fa fa-exchange" aria-hidden="true" style="display:block;font-size:26pt;"></i>
           
        </div>
           
     
   </div>
    </form>
</div>
@endsection
