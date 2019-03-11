<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Models\Organization;
use App\Http\Models\Staff;
use App\Http\Models\Invertory;
use App\Http\Models\Unit;
use App\Http\Models\Item;
use App\Http\Models\History;
use DB;
class InvertoryController extends Controller
{
    //
    public $company;
    public $unit;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $id=Auth::user()->id;
        $org_group=Organization::where('owner_id',$id)->get();
        $inver_list="";
        $unit_group=array();
        $item_data=array();
        if(count($org_group)>0)
        {
            $org_id=$org_group[0]->id;
             $unit_group=Unit::where([['uniqe_id','<>',1],['uniqe_id','<>',2],['uniqe_id','<>',3],['org_id','=',$org_id]])->get();
            $inver_list=Invertory::where('org_id',$org_id)->get();
            $unit_com=Unit::where([['uniqe_id','<>',1],['uniqe_id','<>',2],['uniqe_id','<>',3],['org_id','=',$org_id]])->get();
           
            if(count($unit_group)>0)
            {
                $unit_id=$unit_group[0]->id;
                $item_data=Item::where([['Entity','=',$org_id],['unit','=',$unit_id]])->get();
            }
            
        }   
        return view('frontend.invertory',['unit_com'=>$unit_com,'item_data'=>$item_data,'org_name'=>$org_group,'unit_group'=>$unit_group,'inver_list'=>$inver_list,'item_data' => $item_data]);
    }
    public function addinvertory(Request $request)
    {
        $id=$request->org_id;
        $inv_name=$request->invertory_name;
        $checkorg=Organization::where('id',$id)->get();
        if(count($checkorg)>0)
        {
            $owner_id=Auth::user()->id;
            $inver_regdate=date('Y-m-d H:i:s');
           Invertory::where('id',$id)->insert(['name'=>$inv_name,'org_id'=>$id,'owner_id'=>$owner_id,'reg_date'=>$inver_regdate]);
           return redirect('invertory');
        }
    }
    public function changebyorgname(Request $request)
    {
        $org_id=$request->org_id;
       
        $unit_group=Unit::where([['uniqe_id','<>',1],['uniqe_id','<>',2],['uniqe_id','<>',3],['org_id','=',$org_id]])->get();
        $unit_com=$request->unit_com;
        $invergroup=Item::where([['Entity','=',$org_id],['unit','=',$unit_com]])->get();
        $inventory_info=array('unit_group'=>$unit_group,'inventory_group'=>$invergroup);
        echo json_encode($inventory_info);
    
    }
    public function delinver(Request $request)
    {
       $inver_id=$request->inver_id;
       Invertory::where('id',$inver_id)->delete();
       return redirect('invertory');
    }
    public function updateinver(Request $request)
    {
        $inver_id=$request->inver_id;
        $name=$request->invertory_name;
        Invertory::where('id',$inver_id)->update(['name'=>$name]);
        return redirect('invertory');
    }
    public function newinventory(Request $request)
    {
         $id=Auth::user()->id;
         $company=Organization::where('owner_id',$id)->get();
         $unit_com=array();
         if(count($company)>0)
         {
             $org_id=$company[0]->id;
             $unit_com=Unit::where([['owner_id','=',$id],['org_id','=',$org_id]])->get();
         }

         return view('frontend.newinventory',['company'=>$company,'unit_com' => $unit_com]);
    }
    public function hoemdepot_receipt_analyize($url)
    {
        $analyize_tool=new \Smalot\PdfParser\Parser();
        $pdf=$analyize_tool->parseFile($url);
        $pages  = $pdf->getPages();
        $page_count=count($pages);
        $item=array();
        $item_key=0;
        foreach($pages as $key=>$row)
        {
            $content=$row->getText();
            
            if($key==0)
            {
                $store_number_string=$this->target_string("Store","\n",$content);
                $store_array=explode(" ",$store_number_string);
                $store_number=$store_array[1];
                $date_string=$this->target_string("REPRINT","Check",$content);
                $date_arr=explode("\n",$date_string);
                $date_num=$date_arr[1];
                $order_num_string=$this->target_string("No.","\n",$content);
                $job_desc=$this->target_string("Job Description","\n",$content);
                $job_desc_arr=explode("\t",$job_desc);
                $job_desription=$job_desc_arr[1];
                $phone_str=$this->target_string("Phone:","\n",$content);
                // $phone_arr=explode("\t",$phone);
                 $phone_num=str_replace("Phone: ","",$phone_str);
                 
                 $time_arr=explode(" ",$date_num);
               
               
            }
            if($key==0)
            {
                $content=strstr($content,"EXTENSION");
            }
            
            $ext_tab_arr=explode("\n",$content);
           foreach($ext_tab_arr as $row)
           {
               $item_arr=explode("\t",$row);
               if(count($item_arr)==9)
               {
                    $item[$item_key]=$item_arr;
                    $item_key+=1;
               }
           }
           
             
        }
        
        foreach($item as $row)
        {
            $sql="insert into tbl_item (unit,Entity,store,number,price,sku,order_id,Time,Date,phone,Item_Desc,Job_desc,quantity,store_num,um) values('$this->unit','$this->company','Home Depot','$row[0]','$row[6]','$row[1]','$order_num_string','$time_arr[1]','$time_arr[0]','$phone_num','$row[4]','$job_desription','$row[2]','$store_number','$row[3]')";
            DB::insert($sql);
        }
       
       
    }
    public function target_string($st_pattern,$end_pattern,$cont)
    {
        $cont=strstr($cont,$st_pattern);
        $cont = substr($cont, 0, strpos($cont, $end_pattern));
        return $cont;
    }
    public function file_upload(Request $request)
    {
         $file=$request->file('pdffile');
         $company=$request->company;
         $this->company=$company;
         $unit_id=Unit::where([['org_id','=',$company],['uniqe_id','=',1]])->first()->id;
         $this->unit=$unit_id;
        
         if($file)
         {
            $destinationPath = 'uploads';
            $file->move($destinationPath,$file->getClientOriginalName());
            $url="uploads/".$file->getClientOriginalName();
           
            $this->hoemdepot_receipt_analyize($url);
         }
         
            return redirect()->route('purchase');

    }
    public function render_purchase(Request $request)
    {
        $org_id=$request->org_id;
        $unit_group=Unit::where('org_id',$org_id)->get();
        $unit_id=Unit::where([['org_id','=',$org_id],['uniqe_id','=',1]])->first()->id;
        // current unit exist amount 
       //orderid
        $cur_ex_item_order_id=Item::select('order_id')->where('unit',$unit_id)->groupBy('order_id')->get();
        //items
        $cur_unit_item=Item::where('unit',$unit_id)->get();    
        $cur_item_date_arr=array();
        $cur_item_store_arr=array();
        foreach($cur_ex_item_order_id as $key=>$row)
        {
            $cur_item_date_arr[$key]=Item::where([['order_id','=',$row->order_id],['unit','=',$unit_id]])->first()->Date;
            $cur_item_store_arr[$key]=Item::where([['order_id','=',$row->order_id],['unit','=',$unit_id]])->first()->store;
        }

        //history item 
        $history_item_id=History::where('cur_unit_id',$unit_id)->get();
        $history_item=array();
        foreach($history_item_id as $key=>$row)
        {
            $item_id=$row->tbl_item_id;
      
            $history_item[$key]=Item::where('sku',$item_id)->first();
        
        }
      
        $history_order_group=History::select('order_id')->where('cur_unit_id',$unit_id)->groupBy('order_id')->get();
        $history_date_arr=array();
        $history_store_arr=array();
       
        foreach($history_order_group as $key=>$row)
        {
            $history_date_arr[$key]=Item::where('order_id',$row->order_id)->first()->Date;
            $history_store_arr[$key]=Item::where('order_id',$row->order_id)->first()->store;
        }
        $history_group=History::where('cur_unit_id',$unit_id)->get();
        $history_tran_amount=array();
        $history_tran_unit=array();
        
        foreach($history_group as $key=>$row1)
        {
            $unit_id=$row1->tbl_purpos;
            $history_tran_unit[$key]=Unit::where('id',$unit_id)->first()->name;
            $history_tran_amount[$key]=$row1->amount;
            
        }

        $info_arr=array('history_tran_unit'=>$history_tran_unit,'history_tran_amount'=>$history_tran_amount,'cur_order_id_group'=>$cur_ex_item_order_id,"unit_group"=>$unit_group,'cur_ex_item'=> $cur_unit_item,'cur_item_date'=>$cur_item_date_arr,'cur_item_store'=>$cur_item_store_arr,'History_item'=>$history_item,'history_date_arr'=>$history_date_arr,'history_store_arr'=>$history_store_arr,'history_order_id'=>$history_order_group);
        echo json_encode($info_arr);

    }
    public function purchase(Request $request)
    {
        //owner id
        $id=Auth::user()->id;
        
       
        $company=Organization::where('owner_id',$id)->get();
        $unit_com=array();
        $unit=array();
        $history_item_array=array();
        $tran_amount_array=array();
        $unit_array=array();
        $store_arr=array();
        $Date_arr=array();
        $history=array();
    
        if(count($company)>0)
        {   
            //owner is first company
            $org_id=$company[0]->id;
            $cur_purchase=Unit::where([['org_id','=',$org_id],['uniqe_id','=','1']])->get();
            $cur_purchase_id=$cur_purchase[0]->id;
            $history=History::where('cur_unit_id',$cur_purchase_id)->get();
            $history_order_group=History::select('order_id')->where('cur_unit_id',$cur_purchase_id)->groupBy('order_id')->get();
            foreach($history_order_group as $key=>$row)
            {
                $order_id=$row->order_id;
                $Date_arr[$key]=Item::select('Date')->where('order_id',$order_id)->first();                    
                $store_arr[$key]=Item::select('store')->where('order_id',$order_id)->first();                    
                


            }
            foreach($history as $key => $row)
            {
                $moved_id=$row->tbl_item_id;
                $item=Item::where('sku',$moved_id)->first();
                $history_item_array[$key]=$item;
                $tran_amount_array[$key]=$row->amount;
                $unit_array[$key]=Unit::where('id',$row->tbl_purpos)->first();
            }
                $cur_item=Item::where('unit',$cur_purchase_id)->orderBy('id')->get();
            $ordergroup=Item::select('order_id')->where('unit',$cur_purchase_id)->groupBy('order_id')->orderBy('id')->get();
            $date_arr=array();
            $sore_arr=array();
            
            foreach($ordergroup as $key=>$row)
            {
                $data=Item::select('Date','store')->where([['unit','=',$cur_purchase_id],['order_id','=',$row->order_id]])->get();
                $date_arr[$key]=$data[0]->Date;
                $sore_arr[$key]=$data[0]->store;
            
            }
            // $timearr=array()
            $unit=Item::where('unit',$cur_purchase_id)->get();
            //first company_units
            $unit_com=Unit::where('org_id','=',$org_id)->get();
        }
         return view('frontend.purchase',['Date_arr'=>$Date_arr,'Store_arr'=>$store_arr,'tran_unit_array'=>$unit_array,'tran_amount_array'=>$tran_amount_array,'history_item_array'=>$history_item_array,'history_order_group'=>$history_order_group,'company'=>$company,'store_arr'=>$sore_arr,'items'=>$cur_item,'date_arr'=>$date_arr,'unit_com' => $unit_com,'ordergroup'=>$ordergroup,'unit'=>$unit]);
    }

}
