<?php           

namespace App\Http\Controllers;

use Illuminate\Http\Request;
    use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Organization;
use App\Http\Models\Staff;
use App\Http\Models\Invertory;
use App\Http\Models\Unit;
use App\Http\Models\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
class OrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
   /// return order blade.php
    public function  index()
    {    
         $id=Auth::user()->id;
        $org=Organization::where('owner_id',$id)->orderBy('id')->get();
        // var_dump($org->toArray());
        // exit;
        $org_id=Organization::where('owner_id',$id)->first()->id;
        $unit=Unit::where([['org_id','=',$org_id],['uniqe_id','=',2]])->first();
        $pounit=Unit::where([['org_id','=',$org_id],['uniqe_id','=',5]])->first();
        
        $item=array();
        $po_item=array();
        $item_groupunitid=array();
        $po_item_groupunitid=array();
        $date_arr=array();
        $store_arr=array();
        $po_date_arr=array();
        $po_store_arr=array();
        
        if($unit)
        {
            $unit_id=$unit->id;
            $po_unit_id=$pounit->id;
            $item=Item::where('unit',$unit_id)->get();
            $po_item=Item::where('unit',$po_unit_id)->get();
            $item_groupunitid=Item::select('order_id')->where('unit',$unit_id)->groupBy('order_id')->get();
            // var_dump($item_groupunitid);
            // exit;
            $po_item_groupunitid=Item::select('order_id')->where('unit',$po_unit_id)->groupBy('order_id')->get();
            foreach($item_groupunitid as $key=>$row)
            {
                $date_arr[$key]=Item::where('order_id',$row->order_id)->first()->Date;
                $store_arr[$key]=Item::where('order_id',$row->order_id)->first()->store;
            }
            foreach($po_item_groupunitid as $key=>$row)
            {
                $po_date_arr[$key]=Item::where('order_id',$row->order_id)->first()->Date;
                $po_store_arr[$key]=Item::where('order_id',$row->order_id)->first()->store;
            } 
        }        
      return view('frontend.order',['po_item_groupunitid'=>$po_item_groupunitid,'org'=>$org,'order_groupid'=>$item_groupunitid,'po_date_arr'=>$po_date_arr,'po_store_arr'=>$po_store_arr,'date_arr'=>$date_arr,'store_arr'=>$store_arr,'items'=>$item,'po_items'=>$po_item]);
        
    }
    public function neworder(Request $request)
    {
         $id=Auth::user()->id;
         $org=Organization::where('owner_id',$id)->get();
         $fir_org_id=Organization::where('owner_id',$id)->first()->id;
       
         $new_orderbyorg=Unit::where([['org_id','=',$fir_org_id],['uniqe_id','=',3]])->first();
         $orderbyorg=Unit::where([['org_id','=',$fir_org_id],['uniqe_id','=',2]])->orwhere([['org_id','=',$fir_org_id],['uniqe_id','=',5]])->get();
         $neworderid=$new_orderbyorg->id;
         $items=Item::where('unit',$neworderid)->get();
         $new_ordergroup_id=Item::select('order_id')->where('unit',$neworderid)->groupBy('order_id')->get();
         $date_arr=array();
         $store_arr=array();
         foreach($new_ordergroup_id as $key=>$row)
         {

            $date_arr[$key]=Item::where('order_id',$row->order_id)->first()->Date;
            $store_arr[$key]=Item::where('order_id',$row->order_id)->first()->store;
         }
         return view('frontend.neworder',['neworder'=>$orderbyorg,'orggroup'=>$org,'items'=>$items,'neworder_group'=>$new_ordergroup_id,'date_arr'=>$date_arr,'store_arr'=>$store_arr]);

         //  $date
        //  foreach($new_ordergroup_id as $key=>$row)
        //  {

        //  }
        
      
    }
    public function orderitem(Request $request)
    {
        $org_id=$request->orgid;
        $unit=Unit::where([['org_id','=',$org_id],['uniqe_id','=',2]])->first();
        $pounit=Unit::where([['org_id','=',$org_id],['uniqe_id','=',5]])->first();
           
        $item=array();
        $po_item=array();
        $item_groupunitid=array();
        $po_item_groupunitid=array();
        $date_arr=array();
        $store_arr=array();
        $po_date_arr=array();
        $po_store_arr=array();
        
        if($unit)
        {
            $unit_id=$unit->id;
            $po_unit_id=$pounit->id;
            $item=Item::where('unit',$unit_id)->get();
            $po_item=Item::where('unit',$po_unit_id)->get();
            $item_groupunitid=Item::select('order_id')->where('unit',$unit_id)->groupBy('order_id')->get();
            // var_dump($item_groupunitid);
            // exit;
            $po_item_groupunitid=Item::select('order_id')->where('unit',$po_unit_id)->groupBy('order_id')->get();
            foreach($item_groupunitid as $key=>$row)
            {
                $date_arr[$key]=Item::where('order_id',$row->order_id)->first()->Date;
                $store_arr[$key]=Item::where('order_id',$row->order_id)->first()->store;
            }
            foreach($po_item_groupunitid as $key=>$row)
            {
                $po_date_arr[$key]=Item::where('order_id',$row->order_id)->first()->Date;
                $po_store_arr[$key]=Item::where('order_id',$row->order_id)->first()->store;
            } 
        }
        $info_arr=array('po_date_arr'=>$po_date_arr,'po_store_arr'=>$po_store_arr,'date_arr'=>$date_arr,'store_arr'=>$store_arr,'po_item'=>$po_item,'item'=>$item,'item_groupid'=>$item_groupunitid,'po_item_groupunitid'=>$po_item_groupunitid);       
        echo json_encode($info_arr);
    }
    public function getneworderbyogrid(Request $request)
    {
        $id=Auth::user()->id;
        $orgid=$request->orgid;        
      
        $new_orderbyorg=Unit::where([['org_id','=',$orgid],['uniqe_id','=',3]])->first();
        $orderbyorg=Unit::where([['org_id','=',$orgid],['uniqe_id','=',2]])->orWhere([['org_id','=',$orgid],['uniqe_id','=',5]])->get();
        $neworderid=$new_orderbyorg->id;
        $items=Item::where('unit',$neworderid)->get();
        $new_ordergroup_id=Item::select('order_id')->where('unit',$neworderid)->groupBy('order_id')->get();
        $date_arr=array();
        $store_arr=array();
        foreach($new_ordergroup_id as $key=>$row)
        {

           $date_arr[$key]=Item::where('order_id',$row->order_id)->first()->Date;
           $store_arr[$key]=Item::where('order_id',$row->order_id)->first()->store;
        }
        $info_arr=array("order"=>$orderbyorg,'ordergroup'=>$new_ordergroup_id,'items'=>$items,'date_arr'=>$date_arr,'store_arr'=>$store_arr);
        echo json_encode($info_arr);
    }

}
