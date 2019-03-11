@extends('layouts.menu')
 @section('content')
    @include('layouts.menubar')
    <style>
            .qty .count {
    color: #000;
    display: inline-block;
    vertical-align: top;
    font-size: 25px;
    font-weight: 700;
    line-height: 20px;
    padding: 0 2px
    ;min-width: 35px;
    text-align: center;
}
.qty .plus {
    cursor: pointer;
    display: inline-block;
    vertical-align: top;
    color: white;
    width: 20px;
    height: 20px;
    font: 20px/1 Arial,sans-serif;
    text-align: center;
    border-radius: 50%;
    }
.qty .minus {
    cursor: pointer;
    display: inline-block;
    vertical-align: top;
    color: white;
    width: 20px;
    height: 20px;
    font: 20px/1 Arial,sans-serif;
    text-align: center;
    border-radius: 50%;
    background-clip: padding-box;
}
div {
    
}
.minus:hover{
    background-color: #717fe0 !important;
}
.plus:hover{
    background-color: #717fe0 !important;
}
/*Prevent text selection*/
span{
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}
input{  
    border: 0;
    width: 2%;
}
nput::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input:disabled{
    background-color:white;
}
button
{
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    /* vertical-align: middle; */
    /* -webkit-user-select: none; */
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
 }
    </style>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form  method="post" action="{{route('subInvertory')}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Invertory register</h4>
                    </div>
                    <div class="modal-body">
                        
                            @csrf
                            <input type="hidden" name="org_id" id="org_id">
                            <div class="form-group row" style="padding:2em;">
                                
                                <div class="col-md-6">
                                  
                                    <input type="text" name="invertory_name" class="form-control" placeholder="n" require>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> {{ __('Register') }}</button>
                    </div>
                </div>
                
            </div>


        </form>
    </div>
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form  method="post" action="{{route('updateinver')}}">
            <div class="modal-dialog" role="document">
                <div class="moda l-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Invertory update</h4>
                    </div>
                    <div class="modal-body">
                        
                            @csrf
                              <input type="hidden" name="inver_id" id="inver_id">
                            <div class="form-group row" style="padding:2em;">
                             
                                <div class="col-md-6">
                                    <label>name</label>
                                    <input type="text" name="invertory_name" class="form-control" require>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> {{ __('update') }}</button>
      </div>
                </div>
                
            </div>


        </form>
    </div>
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form  method="post" action="{{route('delinver')}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Invertory delete</h4>
                    </div>
                    <div class="modal-body">
                        
                            @csrf
                            <input type="hidden" name="inver_id" id="delinver_id">
                            <div class="form-group row" style="padding:2em;">
                                <label>Do u want to delete this invertory?</label>
                            </div>
                    </div>
                    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> {{ __('delete') }}</button>
      </div>
                </div>
                
            </div>


        </form>
    </div>
    <form action="{{route('moveorder')}}" method="post" >
    @csrf
    <div class="row" style="padding:0.5em;">
        <style>
            .Tools
            {

            }
        </style>
        <ul class="nav nav-pills" style="valign:center;">
        
            <li ><a href="#">STOCK</a></li>
            <li class="active"><a href="#">ALL</a></li>
            <li><a href="#">TOOLS</a></li>
        </ul>
    </div>
    <div class="portlet-grid panel-primary" style="width:100%;padding:1em;border:0px;">
            <div class="panel-heading">
                <h3 class="panel-title">INVENTORY</h3>
            </div>
            <div class="form-group" style="margin-bottom:0.5em;margin-top:0.5em;">
            <label style="margin-bottom:0.5em;">ORGANIZATION</label>
                    <select class="form-control" id="myorg" name="org" onchange="render_invertory(this,1)">
                        @foreach($org_name as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                        
                    </select>
                   
            </div>
            <div class="form-group" style="margin-bottom:0.5em;">
                <label style="margin-bottom:0.5em;">INVENTORY UNIT</label>
                <select class="form-control" name="unit_com" id="unit_com" onchange="render_invertory(this,2)">
             
                    @foreach($unit_group as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                    
                </select>
        
            </div>
            <label>INVENTORY</label><a href="{{route('newinventory')}}"><span class="glyphicon glyphicon-plus-sign"  style="color:#456234;font-size:16pt;padding-left:0.5em;"></span></a>
            <div class="table-responsive" style="margin-bottom:0.5em;">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center"> 
                            <th style="width:10%;" class="text-center"><input type="checkbox" name="check_all" id="item_check_all" style="width:20px;"></th>      
                            <th style="width:30%" class="text-center">ITEM#</th>
                            <th style="width:30%;" class="text-center">NAME</th>
                            <th style="width:10%;" class="text-center">AMOUNT</th>
                            <th width="20%" class="text-center">TRANSFER</th>
                        </tr>
                    </thead>
                        <tbody id="inve_tb">
                            
                            @foreach($item_data as $row)
                                <input type="hidden" name="cur_unit" value="{{$row->unit}}">
                                <tr class="text-center">
                                    <input type="hidden" name="tbl_item_id[]" value="{{$row->id}}">
                                   <td><input type="checkbox" name="neworder[]" class="sel_check" value="{{$row->id}}" style="width:20px;"></td>
                                   <td>#{{$row->number}}</td>
                                   <td>{{$row->Item_Desc}}</td>
                                    <td class="amount">{{intval($row->quantity)}}</td>
                                    <td>
                                        <div class="qty mt-5" style="color:black!important;text-align: center;">
                                                
                                                <span class="minus bg-dark" style="color:white!important;background-color:black;">-</span>
                                                <input type="number" class="count"  value="0" style="font-size:10pt;" style="width:10px;">
                                                <input type="hidden" name="transferamount[]" class="tran_amount" value="0">
                                                <span class="plus bg-dark" style="color:white!important;background-color:black;">+</span>
                                        </div>
                                    </td>
                               </tr>
                            @endforeach

                    
                       
                    </tbody>
                    
                
                </table>
                
            </div>
            <div class="row" >
            <div class="col-xs-6">
                <select name="inventory_unit" class="form-control" id="inventory_unit_item" style="border:0px;" onchange="check_filter(this)">
                    @foreach($unit_com as $row)
                        <option value="{{$row->id}}" data-id="{{$row->uniqe_id}}">{{$row->name}}</option>
                    @endforeach                       
                </select>
            </div>
            <div class="col-xs-6">
                 <input type="text" id="filterj" name="filtervalue" placeholder="240" class="form-control" style="<?php if($unit_com[0]->uniqe_id==4&$unit_com[0]->uniqe_id==5){echo "display:block;";}else{ echo "display:none";}?>display:none" >
            </div>
        </div>
        <div class="row" style="margin-left:0px;margin-right:0px;margin-top:0.5em;">
            <div class="col-xs-4 text-center" style="padding: 9px 16px;">
                <a href="{{route('newinventory')}}"><span style="font-size:14pt;line-height:1.5;color:green;text-align: center;">ADD<span></a>
            </div>
        
            <div class="col-xs-8" style="padding:0px;">
                <button type="submit"  style="float:right;margin:auto;display:block;font-size:14pt;border-radius:10px;padding: 9px 16px;border-radius:2px;color:#fff;background-color:#2ec551;border-color:#2ec551;">ALLOCATE</button>
            </div>
        </div>
    </div>
</form>
 @endsection