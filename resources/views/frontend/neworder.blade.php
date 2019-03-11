@section('content')
@extends('layouts.menu')
    @include('layouts.menubar')
    <style>
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
        <style>
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
        
    </style>
    <div class="portlet-grid panel-primary" style="width:100%;padding:1em;border:0px;border-style:none;"> 
        <form action="{{route('createorder')}}" method="post">
            @csrf
        <div class="row" style="margin-left:0px;margin-right:0px;margin-bottom:0.5em;">
                <div class="col-xs-12" style="margin-left:0px;margin-right:0px;padding:0px;">
                    <select name="org" class="form-control" style="font-size:10pt;" onchange="neworderorg(this)">
                            @foreach($orggroup as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>

                            @endforeach
                    </select>
                </div>
            </div>
        <div id="mainpart">
        @foreach($neworder_group as $key=>$row)
            <div class="row" style="padding:0em;margin-left:0em;margin-right:0em;">
              <div class="col-xs-4 text-center" style="font-size:10pt;">
                    {{$store_arr[$key]}}
                </div>
                <div class="col-xs-3 text-center" style="font-size:10pt;">
                {{$date_arr[$key]}}
                </div>
                <div class="col-xs-4 text-center" style="font-size:10pt;">
                PO:{{$row->order_id}}
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
                                                @if($row->order_id==$row1->order_id)
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
                             </table>
                    </div>
                  
                </div>              
           @endforeach
            </div>
    
            
            <div class="row" style="margin-left:0px;margin-right:0px;">  
                <div class="col-xs-6" style="padding-left:0px;padding-right:0.2em;">
                
                <select  id="main-filter" name="moveunit" class="form-control">
                    @foreach($neworder as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
                </div>
                <div class="col-xs-6" style="padding-right:0px;padding-left:0.2em;">
                    <input type="text" name="filtervalue" class="form-control" placeholder="number" name="content" required>
                </div>
                <div class="col-xs-6" style="padding-right:0px;margin-top:0.5em;padding-left:0.2em;">
                    <input type="text" name="storename" class="form-control" name="content" placeholder="store" required>
                </div>    
            
            </div>
           
            <div class="row" style="margin-top:0.5em;">
                <div class="col-xs-4" style="line-height:20px;font-size:12pt;">
                    Deliver to :
                </div>
                <div class="col-xs-8" style="line-height:20px;font-size:12pt;text-align:right;color:blue;padding-right:2em;">
                    change
                </div>
            </div>
            <div class="row" style="font-size:14pt;margin-left:0px;margin-right:0px;">
                123 Main street,Miami,Fl3321
            </div>
            <div class="row" style="margin-top:0.5em;margin-left:0px;margin-right:0px;">
                <div class="col-xs-6 text-center" class="text-center" style="color:green;">
                    <a href="{{route('newinventory')}}" style="font-size:12pt;line-height:34px;">Add item</a>
                </div>
                <div class="col-xs-6 text-center" style="padding-right:0px;">
                    <button type="submit" class="text-center" style="margin:auto;display:block;font-size:14px;padding: 9px 16px;float:right;border-radius:2px;color:#fff;background-color:#2ec551;border-color:#2ec551;height:margin:auto;">confirm</button>
                </div>
        
         </div> 
        
       
        </form>
    </div>

@endsection