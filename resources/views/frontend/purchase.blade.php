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
    <form  method="post" action="{{route('receiptupload')}}" enctype="multipart/form-data">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">receipt upload</h4>
      </div>
      <div class="modal-body">
          
              @csrf
              <div class="form-group">
                  <input type="hidden" name="company" id="cur_org_id">
                 <input type="file" class="form-control" name="pdffile" required/>
                
             </div>
               
        
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">upload</button>
      </div>
    </div>
  </div>  
  </form>   
</div>
<div class="portlet-grid panel-primary" style="width:100%;padding:1em;border:0px;">
    <form action="{{route('movpurchase')}}" method="post">
        </style>
        @csrf
    <div style="padding: 0.5em;">
    <div class="row" style="font-size:13pt;">

        <div class="col-xs-12" style="padding:0px;">
           <label>orgnaization</label>
                <select name="org" class="form-control" id="orginfo" onchange="render_purchase()">
                    @foreach($company as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                
                </select>
            </div>
            <div class="col-xs-6" style="font-size:13pt;valign:bottom;">
              
            </div>
    </div>
        <div class="row" style="margin-top:0.5em;font-size:16pt;" >
             <div class="table-responsive">
                <table class="table table-hover">
                     <thead>
                         <tr >
                            <td width="35%" class="text-center">company</td>
                            <td width="25%" class="text-center">date</td>
                            <td width="30%" class="text-center">number</td>
                            <td width="10%"></td> 
                        </tr>
                     </thead>
                    
                </table>
             </div>
        </div>
        <div class="main-part">      
        @foreach($ordergroup as $key => $row)
        <div class="row"  style="font-size:13pt;padding:0.5em;">

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

                                            @foreach($unit as $row1)
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
    
 
  



       
        <div class="row" style="padding-top:0.5em;">
            <div class="col-xs-6">
                
                <select name="moveunit" class="form-control" id="unit_job" onchange="check_filter(this)">
                     @foreach($unit_com as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                     @endforeach
                </select>  
            
            </div>
            <div class="col-xs-6">
                 <input type="text" name="filtervalue" id="filterj" placeholder="240" style="display:none" class="form-control" >
            </div>
        </div>
        <div class="row" style="margin-top:0.5em;padding:0em;">
            <div class="col-xs-6 text-center">
                <a data-toggle="modal" data-target="#myModal"  style="margin-top:0.3em;" onclick="home_depot(this)"><span style="font-size:15pt;color:green;text-align: center;">Add<span></a>
            </div>
            
            <div class="col-xs-6" style="padding-right:0px;">
                <button type="submit"  style="margin:auto;display:block;font-size:14px;padding: 9px 16px;float:right;border-radius:2px;color:#fff;background-color:#2ec551;border-color:#2ec551;">Allocate</button>
            </div>
        </div>
        <div class="row" style="margin-top:1em;">
            
           <span style="height:38px;background-color:blue;display:block;text-align:center;text-valign:center;color:white;  vertical-align: middle;">Receive all items and allocate later</span>
        </div>
        <div class="historysection">
        @foreach($history_order_group as $key => $row1)
        <div class="row"  style="font-size:13pt;padding:0.5em;">

            <div class="col-xs-4 text-center" style="font-size:10pt;">
            {{$Store_arr[$key]->store}}               
            </div>
            <div class="col-xs-3 text-center" style="font-size:10pt;">
                {{$Date_arr[$key]->Date}}   
            </div>
            <div class="col-xs-4 text-center" style="font-size:10pt;">
               {{$row1->order_id}}
            </div>
            <div class="col-xs-1" >
                <a  data-toggle="collapse" data-target="#dem{{$key}}"><i class="fa fa-level-down"></i></a>
            </div>
        
        </div>
        <div class="row collapse" style="margin-top:0.5em;" id="dem{{$key}}">
            <div class="table-responsive">
                 <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center">item</th>
                            <th class="text-center">name</th>
                            <th class="text-center">unit</th>
                            <th class="text-center">amount</th>

                        </tr>

                        @foreach($history_item_array as $key1 => $row)
                           @if($row->order_id==$row1->order_id)
                           
                                <tr>
                                    <td class="text-center">{{$row->number}}</td>
                                    <td class="text-center">{{$row->Item_Desc}}</td>
                                    <td class="text-center">{{$tran_unit_array[$key1]->name}}</td>
                                    <td class="text-center">{{$tran_amount_array[$key1]}}</td>
                                    
                            
                                </tr>
                         
                           @endif
                        @endforeach
                    </thead>
                
                </table>
            </div>
            
        
    </div>    
        @endforeach
        </div>
       
</form>
</div>
@endsection