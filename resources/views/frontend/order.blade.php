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
    <div class="portlet-grid panel-primary" style="width:100%;padding:1em;border:0px;">   
<form action="{{route('movestock')}}" method="post">
    @csrf

    <div class="row">
        <div class="col-xs-12" >
            <select name="org" class="form-control" style="font-size:10pt;" onchange="orderbyorg(this)">
                @foreach($org as $row)
                    <option value="{{$row->id}}" >{{$row->name}}</option>
                @endforeach
            </select>
            </div>
          
    </div>
    <div class="main-part">
    @foreach($order_groupid as $key => $row)
        <div class="row"  style="font-size:13pt;padding:0.5em;">

            <div class="col-xs-4 text-center" style="font-size:10pt;">
                {{$store_arr[$key]}}
            </div>
            <div class="col-xs-3 text-center" style="font-size:10pt;">
               {{$date_arr[$key]}}
            </div>
            <div class="col-xs-4 text-center" style="font-size:10pt;">
            order:{{$row->order_id}}
            </div>
            <div class="col-xs-1" >
                <a  data-toggle="collapse" data-target="#demo{{$key}}"><i class="fa fa-level-down"></i></a>
            </div>
        
        </div>
        <div class="row collapse" style="margin-top:0em;padding:0em;" id="demo{{$key}}">
                <div class="table-responsive">
                            <table class="table table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%"><input type="checkbox" id="item_check_all" style="width:20px;"/></th>
                                                <th width="30%" class="text-center">Item#</th>
                                                <th width="30%" class="text-center">Name</th>
                                                <th widdth="10%" class >amount</th>
                                                <th width="20%" class="text-center">transfer</th>
                                            </tr>

                                            @foreach($items as $row1)
                                              @if($row1->order_id==$row->order_id)
                                                <input type="hidden" name="unit_com"  value="{{$row1->unit}}">
                                                 <tr class="text-center">
                                                    <input type="hidden" value="{{$row1->id}}" name="item_id_arr[]">
                                                    <td><input type="checkbox" class="sel_check" name="selcheck[]" value="{{$row1->id}}" style="width:20px;"></td>
                                                    <td>{{$row1->number}}</td>
                                                    <td>{{$row1->Item_Desc}}</td>
                                                    <td class="amount">{{intval($row1->quantity)}} </td>
                                                    <td>
                                                        <div class="qty mt-5" style="color:black!important;text-align: center;">
                                                            <span class="minus bg-dark" style="color:white!important;background-color:black;">-</span>
                                                            <input type="number" class="count"  value="0" style="font-size:10pt;width:10px;" >
                                                            <input type="hidden" name="transfer_amount[]" class="tran_amount" value="0">
                                                            <span class="plus bg-dark" style="color:white!important;background-color:black;">+</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                              @endif
                                            @endforeach
                                        
                                    </thead>
                                    <tbody>
                                     
                                  </tbody>
                            </table>
                </div>

        </div>  
         
     @endforeach
     @foreach($po_item_groupunitid as $key => $row)
        <div class="row"  style="font-size:13pt;padding:0.5em;">

            <div class="col-xs-4 text-center" style="font-size:10pt;">
                {{$po_store_arr[$key]}}
            </div>
            <div class="col-xs-3 text-center" style="font-size:10pt;">
               {{$po_date_arr[$key]}}
            </div>
            <div class="col-xs-4 text-center" style="font-size:10pt;">
            po:{{$row->order_id}}
            </div>
            <div class="col-xs-1" >
                <a  data-toggle="collapse" data-target="#dem{{$key}}"><i class="fa fa-level-down"></i></a>
            </div>
        
        </div>  
        <div class="row collapse" style="margin-top:0em;padding:0em;" id="dem{{$key}}">
                <div class="table-responsive">
                            <table class="table table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%"><input type="checkbox" id="item_check_all" style="width:20px;"/></th>
                                                <th width="30%" class="text-center">Item#</th>
                                                <th width="30%" class="text-center">Name</th>
                                                <th widdth="10%" class >amount</th>
                                                <th width="20%" class="text-center">transfer</th>
                                            </tr>

                                            @foreach($po_items as $row1)
                                              @if($row1->order_id==$row->order_id)
                                                <input type="hidden" name="unit_com"  value="{{$row1->unit}}">
                                                 <tr class="text-center">
                                                    <input type="hidden" value="{{$row1->id}}" name="item_id_arr[]">
                                                    <td><input type="checkbox" class="sel_check" name="selcheck[]" value="{{$row1->id}}" style="width:20px;"></td>
                                                    <td>{{$row1->number}}</td>
                                                    <td>{{$row1->Item_Desc}}</td>
                                                    <td class="amount">{{intval($row1->quantity)}} </td>
                                                    <td>
                                                        <div class="qty mt-5" style="color:black!important;text-align: center;">
                                                            <span class="minus bg-dark" style="color:white!important;background-color:black;">-</span>
                                                            <input type="number" class="count"  value="0" style="font-size:10pt;width:10px;" >
                                                            <input type="hidden" name="transfer_amount[]" class="tran_amount" value="0">
                                                            <span class="plus bg-dark" style="color:white!important;background-color:black;">+</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                              @endif
                                            @endforeach
                                        
                                    </thead>
                                    <tbody>
                                     
                                  </tbody>
                            </table>
                </div>

        </div>  
         
     @endforeach
     </div>


        <div class="row" style="margin-left:0px;margin-right:0px;">
            <div class="col-xs-6" style="padding-left:0px;padding-right:0px;">
                <select name="unit" class="form-control" onchange="check_filter(this)" style="border:0px;">
                 
                </select>
            </div>
            <div class="col-xs-6" style="margin:0px;padding-right:0px;">
                 <input type="text" name="filtervalue" id="filterj" placeholder="234" class="form-control" style="display:none;"  >
            </div>
        </div>
        <div class="row" style="margin-top:0.5em;margin-left:0px;">
            <div class="col-xs-4 text-center" style="padding: 9px 16px;">
                <a href="{{route('newinventory')}}"><span style="font-size:14pt;line-height:1.5;color:green;text-align: center;">ADD<span></a>
  
            </div>
            <div class="col-xs-8">
                <button  style="display:block;float:right;font-size:14pt;float: right; margin: auto;border-radius: 10px; padding: 9px 16px;border-radius: 2px;color: #fff;background-color: #2ec551;border-color: #2ec551;">Allocate</button>
            </div>
        </div>
        <div class="row" style="margin-top:0.5em;margin-left:0px;margin-right:0px;">
            
           <span style="height:40px;background-color: #f2a725 !important;line-height:34px;display:block;text-align:center;text-valign:center;color:white;margin:auto;">Receive all items and allocate later</span>
        </div>
        <div class="row" style="display:block;margin-left:0px;margin-right:0px;background-color:#6f6f6f!important;height:40px;margin-top:0.5em;color:white;">
           <div class="col-xs-4" style="line-height:34px;">
                 HomeDepot
             </div>
             <div class="col-xs-8 " style="line-height:34px;">
                 order:<input type="text" name="bday" size="8"  style="background-color:transparent;border:0px;">
             </div>
       </div>
        <div class="row" style="margin-left:0px;margin-right:0px;color:white;display:block;background-color:#6f6f6f!important;height:40px;margin-top:0.5em;">
          
           <div class="col-xs-4 text-center" style="line-height:34px;">
             HomeDepot
         </div>
         <div class="col-xs-8 " style="line-height:34px;">
             order:<input type="text" name="bday" size="8"  style="background-color:transparent;border:0px;">
         </div>
         
        </div>
        <div class="row" style="margin-left:0px;margin-right:0px;color:white;display:block;background-color:#6f6f6f!important;margin-top:0.5em;">
          
           <div class="col-xs-4 " style="line-height:34px;">
                 HomeDepot
         </div>
         <div class="col-xs-8 " style="line-height:34px;">
             order:<input type="text" name="bday" size="8" style="background-color:transparent;border:0px;">
         </div>
          
        </div>
</div>

@endsection