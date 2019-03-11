<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Organization;
use App\Http\Models\Staff;
use App\Http\Models\Invertory;
use App\Http\Models\Unit;
use App\Http\Models\History;
use App\Http\Models\Item;
use Illuminate\Foundation\Auth\RegistersUsers;
use Redirect;
use Carbon\Carbon;
// use Carbon;
class InvertoryUnitController extends Controller
{
    use RegistersUsers; 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
 

    public function __construct()
    {
        $this->middleware('auth');
     
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owner_id=Auth::user()->id;
        $org_name=Organization::where('owner_id',$owner_id)->get();
        $tbl_unit=array();
        if(count($org_name)>0)
        {
            $org_id=$org_name[0]->id;
            $tbl_unit=Unit::where(['owner_id' => $owner_id,'org_id' => $org_id])->get();
        }
        return view('frontend.unit',['org_name' => $org_name,'tbl_unit' => $tbl_unit]);
       
    }
    public function Addunit(Request $request)
    {
       
        $org_id=$request->org_id;
        $owner_id=Auth::user()->id;
        $unit_name=$request->unit_name;
       
        $unit_check=Unit::where([['owner_id','=',$owner_id],['org_id','=',$org_id],['name','=',$unit_name]])->get();
        
        if(count($unit_check)>0)
        {
            return Redirect::back();
        }
        else
        {
            Unit::insert(['owner_id' => $owner_id,'org_id' => $org_id,'name' => $unit_name]);
            return  Redirect::back();
        }
    }
    public function updateunit(Request $request)
    {
            $unit_id=$request->unit_id;
            $unit_name=$request->unit_name;
            Unit::where('id',$unit_id)->update(['name' => $unit_name]);
            return Redirect::back();
    }
    public function deleteunit(Request $request)
    {
        $unit_id=$request->unit_id;
       
        Unit::where('id',$unit_id)->delete();
        return  Redirect::back();
    }
    public function getunit(Request $request)
    {
        $org_id=$request->org_id;
        
        $owner_id=Auth::user()->id;
        $unit_name=Unit::where([['owner_id','=',$owner_id],['org_id','=',$org_id]])->get();
        return json_encode($unit_name);
    }
    public function additem(Request $request)
    {
        $org=$request->org;
        $resource=$request->resource;
        $unit=Unit::where('id',$resource)->get();
        $unti_name=$unit[0]->name;
        $ordernumber=$request->ordernumber;
        $upc=$request->upc;
        $item=$request->item;
        $itemname=$request->itemname;
        $itemdesc=$request->itemdesc;
        $cost=$request->cost;
        $percent=$request->percent;
        $price=$request->price;
        $qty=$request->qty;
        Item::insert(['Entity'=>$org,'unit'=>$resource,'number'=>$ordernumber,'UPC'=>$upc,'sku'=>$item,'Item_Desc'=>$itemname,'item_detail'=>$itemdesc,'price'=>$cost,'quantity'=>$qty]);
        if($unti_name=="order")
        {
            return redirect()->route('order');
        }
        elseif($unti_name=="purchaser")
        {
            return redirect()->route('purchase');
        }
        elseif($unti_name=="New order")
        {
            return redirect()->route('neworder');
        }
        else
        {
            return redirect()->route('inventory');
        }
        
        
    }
    public function movepurchase(Request $request)
    {
         
         $move_unit=$request->moveunit;

         $org=Unit::where('id',$move_unit)->first()->org_id;
         
         $cur_unit=$request->unit_com;
         $qty=$request->transfer_amount;
         $sel_item_id=$request->selcheck;
         $filtervalue=$request->filtervalue;
         $item_id_arr=$_POST['item_id_arr'];

            if($cur_unit==$move_unit)
         {
             return redirect()->route('purchase');
         }
         foreach($item_id_arr as $key => $row)
         {
             $item_history=new History();
             if($qty[$key]==0)
             {
                 continue;
             }
             else
             {

               
                $item_history->tbl_item_id=Item::where('id',$row)->first()->sku;
                $item_history->tbl_purpos=$move_unit;
                $item_history->amount=$qty[$key];
                $item_history->cur_unit_id=$cur_unit;
                $item_history->order_id=Item::where('id',$row)->first()->order_id;
                
                $item_history->save();

                $item=Item::where('id',$row)->first();
                
                 if($item->quantity==$qty[$key])
                 {
                    $item->delete();
                    
                 }
                 else
                 {
                    $item->quantity=$item->quantity-$qty[$key];
                    $item->save();
                 }
                 $sku=$item->sku;
                 $order_id=$item->order_id;
                 $ch_item=Item::where([['sku','=',$sku],['order_id','=',$order_id],['unit','=',$move_unit]])->first();
                 if($ch_item)
                 {
                    $ch_item->quantity+=$qty[$key];
                    $ch_item->save();
                 }
                 else
                 {
                  
                   
                    $new_item=new Item();
                    $new_item->quantity=$qty[$key];
                    $new_item->unit=$move_unit;
                    $new_item->number=$item->number;
                    $new_item->price=$item->price;
                    $new_item->sku=$item->sku;
                    $new_item->order_id=$item->order_id;
                    $new_item->Time=$item->Time;
                    $new_item->Date=$item->Date;
                    $new_item->phone=$item->phone;
                    $new_item->Email=$item->Email;
                    $new_item->UPC=$item->UPC;
                    $new_item->Item_Desc=$item->Item_Desc;
                    $new_item->Address=$item->Address;
                    $new_item->Job_desc=$item->Job_desc;
                    $new_item->Runner_name=$item->Runner_name;
                    $new_item->store_num=$item->store_num;
                    $new_item->item_detail=$item->item_detail;
                    $new_item->filter=$item->filter;
                    $new_item->jbpo_number=$item->jbpo_number;
                    $new_item->store=$item->store;  
                    $new_item->Entity=$item->Entity;                 
                    $new_item->destunit=$item->destunit;
                    $new_item->um=$item->um;
                    $new_item->save();                 
                }
              
             }

         }

        
         return redirect()->route('purchase');
         
    }
    public function moveorder(Request $request)
    {
        $unit_com=$request->unit_com;
        $uniqe_id=Unit::where('id',$unit_com)->first()->uniqe_id;
        if($uniqe_id==4||$uniqe_id==5||$uniqe_id==7)
        {
            return redirect()->route('inventory');
        }
        $org_name=$request->org;
        $filtervalue=$request->filtervalue;
        $move_unit=$request->inventory_unit;
        $move_uniqe_id=Unit::where('id',$move_unit)->first()->uniqe_id;
        if($move_unit==$unit_com)
        {
            return redirect()->route('inventory');
        }
        $item_id=$request->tbl_item_id;
        $trans_amount=$request->transferamount;
       
        foreach($item_id as $key=>$row)
        {
            $item=Item::where('id',$row)->first();
            $amount=$trans_amount[$key];
            if($amount==0)
            {
                continue;
            }
            if($item->quantity==$amount)
            {
                $item->delete();
            }
            else
            {
                $item->quantity-=$amount;
                $item->save();   
            }
            $sku=$item->sku;
            $order_id=$item->order_id;
            $ch_item=Item::where([['sku','=',$sku],['order_id','=',$order_id],['unit','=',$move_unit]])->first();
            if($ch_item)
            {
                $ch_item->quantity+=$amount;
                $ch_item->save();

            }
            else
            {
                $new_item=new Item();
                $new_item->quantity=$amount;
                $new_item->unit=$move_unit;
                $new_item->number=$item->number;
                $new_item->price=$item->price;
                $new_item->sku=$item->sku;
                $new_item->order_id=$item->order_id;
                $new_item->Time=$item->Time;
                $new_item->Date=$item->Date;
                $new_item->phone=$item->phone;
                $new_item->Email=$item->Email;
                $new_item->UPC=$item->UPC;
                $new_item->Item_Desc=$item->Item_Desc;
                $new_item->Address=$item->Address;
                $new_item->Job_desc=$item->Job_desc;
                $new_item->Runner_name=$item->Runner_name;
                $new_item->store_num=$item->store_num;
                $new_item->item_detail=$item->item_detail;
                $new_item->filter=$item->filter;
                $new_item->jbpo_number=$item->jbpo_number;
                $new_item->store=$item->store;  
                $new_item->Entity=$item->Entity;                 
                $new_item->destunit=$item->destunit;
                $new_item->um=$item->um;
                $new_item->save();                 

            }
            if($move_uniqe_id==4||$move_uniqe_id==5||$move_uniqe_id==7)
            {
                $new_item=new Item();
                $new_item->quantity=$amount;
                $new_item->unit=Unit::where([['org_id','=',$org_name],['uniqe_id','=',3]])->first()->id;
                $new_item->number=$item->number;
                $new_item->price=$item->price;
                $new_item->sku=$item->sku;
                $new_item->order_id=$item->order_id;
                $new_item->Time=$item->Time;
                $new_item->Date=$item->Date;
                $new_item->phone=$item->phone;
                $new_item->Email=$item->Email;
                $new_item->UPC=$item->UPC;
                $new_item->Item_Desc=$item->Item_Desc;
                $new_item->Address=$item->Address;
                $new_item->Job_desc=$item->Job_desc;
                $new_item->Runner_name=$item->Runner_name;
                $new_item->store_num=$item->store_num;
                $new_item->item_detail=$item->item_detail;
                $new_item->filter=$item->filter;
                $new_item->jbpo_number=$filtervalue;
                $new_item->store=$item->store;  
                $new_item->Entity=$item->Entity;                 
                $new_item->destunit=$item->destunit;
                $new_item->um=$item->um;
                $new_item->save();


            }        
        }
        return redirect()->route('inventory');


    }
    public function movecreateorder(Request $request)
    {
         $org_id=$request->org;
         $item_id_arr=$request->item_id_arr;
         $trans_amount=$request->transfer_amount;
         $move_unit=$request->moveunit;
         $filtervalue=$request->filtervalue;
         $storename=$request->storename;
         $now=Carbon::now();
             $date=Carbon::now()->format('Y-m-d');
         $time=Carbon::now()->format('H:i:s');
          foreach($item_id_arr as $key=>$row)
         {
            $item=Item::where('id',$row)->first();
            $amount=$trans_amount[$key];
          
            if($amount==0)
            {
                continue;
            }
            if($item->quantity==$amount)
            {
                $item->delete();
            }
            else
            {
                $item->quantity-=$amount;
            }
            
            $sku=$item->sku;
            $order_id=$item->order_id;
            $ch_item=Item::where([['sku','=',$sku],['order_id','=',$order_id],['unit','=',$move_unit]])->first();
            if($ch_item)
            {
                $ch_item+=$amount;
                $ch_item->save();
            }
            else
            {
                $new_item=new Item();
                $new_item->quantity=$amount;
                $new_item->unit= $move_unit;    
                $new_item->price=$item->price;
                $new_item->number=$item->number;
                $new_item->sku=$item->sku;
                $new_item->order_id=$filtervalue;
                $new_item->Time=$time;
                $new_item->Date=$date;
                $new_item->phone=$item->phone;
                $new_item->Email=$item->Email;
                $new_item->UPC=$item->UPC;
                $new_item->Item_Desc=$item->Item_Desc;
                $new_item->Address=$item->Address;
                $new_item->Job_desc=$item->Job_desc;
                $new_item->Runner_name=$item->Runner_name;
                $new_item->store_num=$item->store_num;
                $new_item->item_detail=$item->item_detail;
                $new_item->filter=$item->filter;
                 $new_item->store= $storename;  
                $new_item->Entity=$item->Entity;                 
                $new_item->destunit=$item->destunit;
                $new_item->um=$item->um;
                $new_item->save();

            }

         }
         return redirect()->route('neworder');

    }
    public function movestock(Request $request)
    {
        $org=$request->org;
        $unit_time=$request->unit;
        $checki=$request->checki;
        $filtervalue=$request->filtervalue;
        $filter="PO";

        foreach($checki as $row)
        {
            Item::where('id',$row)->update(['unit'=>$unit_time,'Entity'=>$org,'filter'=>$filter,'jbpo_number'=>$filtervalue]);
        }
        return redirect()->route('inventory');

    }
  

 
}
