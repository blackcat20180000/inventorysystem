
<script>
    var toggle = true;
                
   
</script>
</script>
<script src="{{asset('js/jquery-2.1.1.min.js')}}"></script> 
<script src="{{asset('js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
        <!--//scrolling js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="{{asset('js/bootstrap.js')}}"> </script>
<script src="{{asset('js/spinner.js')}}"></script>

        <!-- Using jquery version: -->
        <!--
            <script type="text/javascript" src="js/jquery.js"></script>
            <script type="text/javascript" src="js/qrcodelib.js"></script>
            <script type="text/javascript" src="js/webcodecamjquery.js"></script>
            <script type="text/javascript" src="js/mainjquery.js"></script>
        -->
        <script type="text/javascript" src="{{asset('js/barcode/filereader.js')}}"></script>

        <script type="text/javascript" src="{{asset('js/barcode/qrcodelib.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/barcode/webcodecamjs.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/barcode/main.js')}}"></script>
        <!-- Using jquery version: -->
        <!--
            <script type="text/javascript" src="js/jquery.js"></script>
            <script type="text/javascript" src="js/qrcodelib.js"></script>
            <script type="text/javascript" src="js/webcodecamjquery.js"></script>
            <script type="text/javascript" src="js/mainjquery.js"></script>
        -->
       <script>
      const fileInput = document.getElementById('captureimage');
      $("#captureimage").change(function(){
        $('#myModals').modal('show');
         
             readURL(this);
     });
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
       
        reader.onload = function (e) {
            
            $('#preview').attr('src', e.target.result);
            
        }

        reader.readAsDataURL(input.files[0]);
    }
}


    function invent_style(ob)
    {
        var selopval = ob.options[ob.selectedIndex].text;
        if(selopval=="Job"||selopval=="po")
        {
            $('#filter_val').css('display','block');

        }
        else
        {
            $('#filter_val').css('display','none');

        }
    }
    
    $(document).ready(function(){
        $(document).on('click','#imgclick',function()
        {
              $('#scanimg').trigger('click');
        })
        $(document).on('click','#scandevice',function(result)
        {   
            $('#mymodal2').modal('show');
            
        })
       
          $(document).on('click','.fileupload',function()
        {
            $('#captureimage').trigger('click');
        });
        $('#scanimg').change(function()
        {
            alert("okay");
        })
		    $('.count').prop('disabled', true);
   			$(document).on('click','.plus',function(){
                   var ob=$(this).parent().find(".count");
                   var trans=$(this).parent().find(".tran_amount");
                   var cur=$(this).parents("tr").find('.amount');
                   var amount=$(cur).html();
                  
                if(parseInt(amount)>0)
                {
                    $(ob).val(parseInt($(ob).val()) + 1 );
                    $(cur).html(parseInt(amount)-1);
                    $(trans).val(parseInt($(trans).val()) + 1);
                }   
				
    		});
        
            $(document).on('change','#item_check_all',function(ev)
            {
                  
                 var start_ob=ev.target;
                 var check_status=$(start_ob).prop("checked");
                 
                var ch=$(this).parents("table").find(".sel_check");
                console.log(ch);
                 ch.each(function()
                {
                     console.log(check_status);
                    if(check_status==true)
                    {
                        $(this).prop("checked",true);
                    }
                    else
                    {
                        $(this).prop("checked",false);
                        
                    }
                    $(this).trigger("change");
                    
                });
            })
            $(document).on('change','.sel_check',function()
            {
                 var status=$(this).prop("checked");

                 if(status==true)
                 {
                   
                     var amount=$(this).parents("tr").find(".amount").html();

                     var trans_amount=$(this).parents("tr").find(".count").val();
                     var trans=parseInt(amount)+parseInt(trans_amount);
                     $(this).parents("tr").find(".count").val(trans);
                     $(this).parents("tr").find(".tran_amount").val(trans);
                   
                     $(this).parents("tr").find(".amount").html("0");

                 }
                 else
                 {
                     var trans=$(this).parents("tr").find(".count").val();
                     $(this).parents("tr").find(".amount").html(trans);
                     $(this).parents("tr").find(".count").val(0);
                     $(this).parents("tr").find(".tran_amount").val(0);
                 }
            })
        	$(document).on('click','.minus',function(){
                var ob=$(this).parent().find(".count");
                 var cur=$(this).parents("tr").find('.amount');
                 var trans=$(this).parent().find(".tran_amount");
                 var amount=$(cur).html();
                 if($(ob).val()>0)
                 {
                     $(ob).val($(ob).val()-1);
                     $(cur).html(parseInt(amount)+1);
                     $(trans).val(parseInt($(trans).val())-1);
                 }
    	
    	    	});
         });
    function render_purchase()
    {
        var html="";
        var html1="";
        var html2="";
        var id=$('#orginfo').val();
         $.ajax({
             'method':'POST',
             url:"{{route('render_purchase')}}",
             data:{"_token":"{{ csrf_token()}}","org_id":id},
             success:function(result)
             {
                 var res=JSON.parse(result);
                 
                  if(res)
                  {
                      var unit_group=res.unit_group;
                      console.log(res);
                      for(var j=0;j<unit_group.length;j++)
                      {
                          var option=unit_group[j]
                          html+="<option value=\""+option.id+"\">"+option.name+"</option>";
                      }
                      var cur_order_group=res.cur_order_id_group;
                      var cur_item_date=res.cur_item_date;
                      var cur_item_store=res.cur_item_store;
                      var cur_ex_item=res.cur_ex_item;
                      var history_order_id=res.history_order_id;
                      console.log(res);

                      for(var j=0; j<cur_order_group.length;j++)
                      {
                          var order=cur_order_group[j];
                          order_id=order.order_id;
                           if(order.order_id==null)
                           {
                                order_id="";
                           }
                           html1+="<div class=\"row\"  style=\"font-size:13pt;padding:0.5em;\">";

                            html1+="<div class=\"col-xs-4 text-center\" style=\"font-size:10pt;\">"+cur_item_store[j]+"</div>";
                            html1+="<div class=\"col-xs-3 text-center\" style=\"font-size:10pt;\">"+cur_item_date[j]+"</div>";
                            html1+="<div class=\"col-xs-4 text-center\" style=\"font-size:10pt;\">PO:"+order_id+"</div>";
                            html1+="<div class=\"col-xs-1\" ><a  data-toggle=\"collapse\" data-target=\"#demo"+j+"\"><i class=\"fa fa-level-down\"></i></a></div>";
                            html1+="</div>";
                            html1+="<div class=\"row collapse\" style=\"margin-top:0em;padding:0em;\" id=\"demo"+j+"\">";
                            html1+="<div class=\"table-responsive\">"
                            html1+="<table class=\"table table-hover\">";
                            html1+="<thead>";
                            html1+="<tr class=\"text-center\">";
                            html1+="<th width=\"5%\"><input type=\"checkbox\" id=\"item_check_all\" style=\"width:20px;\"/></th>";
                            html1+="<th width=\"30%\" class=\"text-center\">Item#</th>"
                            html1+="<th width=\"30%\" class=\"text-center\">Name</th>"                    
                            html1+="<th width=\"10%\" class=\"text-center\"  >amount</th>";
                            html1+="<th width=\"20%\" class=\"text-center\">transfer</th>";
                            html1+="</tr>";
                            for(var k=0;k<cur_ex_item.length;k++)
                            {
                                var cur_item=cur_ex_item[k];
                                
                                if(cur_item.order_id==order.order_id)
                                {
                                    
                                     html1+="<input type=\"hidden\" name=\"unit_com\"  value=\""+cur_item.unit+"\">";
                                    html1+="<tr class=\"text-center\">";
                                    html1+="<input type=\"hidden\" value=\""+cur_item.id+"\" name=\"item_id_arr[]\">";
                                    html1+="<td><input type=\"checkbox\" class=\"sel_check\" name=\"selcheck[]\" value=\""+cur_item.id+"\" style=\"width:20px;\"></td>";
                                    html1+="<td>"+cur_item.number+"</td>";
                                    html1+="<td>"+cur_item.Item_Desc+"</td>";
                                    html1+="<td class=\"amount\">"+parseInt(cur_item.quantity)+"</td>";
                                    html1+="<td><div class=\"qty mt-5\" style=\"color:black!important;text-align: center;\">";
                                    html1+="<span class=\"minus bg-dark\" style=\"color:white!important;background-color:black;\">-</span>";
                                    html1+="<input type=\"number\" class=\"count\"  value=\"0\" style=\"font-size:10pt;width:10px;\">"
                                    html1+="<input type=\"hidden\" name=\"transfer_amount[]\" class=\"tran_amount\" value=\"0\">"                        
                                    html1+="<span class=\"plus bg-dark\" style=\"color:white!important;background-color:black;\">+</span>";                            
                                    html1+="</div>";       
                                    html1+="</td>";
                                    html1+="</tr>";
                                }
                            
                            }
                            html1+="</thead>";
                            html1+"<tbody></tbody>";
                            html1+="</table>";
                            html1+="</div></div>";
                        
                            


                      }
                      var history_date=res.history_date_arr;
                      var store_arr=res.history_store_arr;
                      var history_item=res.History_item;
                      var history_tran_unit=res.history_tran_unit;
                      var history_tran_amount=res.history_tran_amount;
                  
                      for(var k=0;k<history_order_id.length;k++)
                      {
                        var order_id=history_order_id[k].order_id;

                        if(order_id==null)
                        {
                            order_id="";
                        }
                        if(order_id)
                            html2+="<div class=\"row\"  style=\"font-size:13pt;padding:0.5em;\">";
                            html2+="<div class=\"col-xs-4 text-center\" style=\"font-size:10pt;\">"+store_arr[k]+"</div>";
                            html2+="<div class=\"col-xs-3 text-center\" style=\"font-size:10pt;\">"+history_date[k]+"</div>";
                            html2+="<div class=\"col-xs-4 text-center\" style=\"font-size:10pt;\">PO:"+order_id+"</div>";
                            html2+="<div class=\"col-xs-1\" ><a  data-toggle=\"collapse\" data-target=\"#dem"+k+"\"><i class=\"fa fa-level-down\"></i></a></div>";
                            html2+="</div>";
                            html2+="<div class=\"row collapse\" style=\"margin-top:0.5em;\" id=\"dem"+k+"\">"
                            html2+="<div class=\"table-responsive\">";
                            html2+="<table class=\"table table-hover\">";
                            html2+="<thead>";
                            html2+="<tr class=\"text-center\">";
                            html2+="<th class=\"text-center\">item</th>";
                            html2+="<th class=\"text-center\">name</th>";
                            html2+="<th class=\"text-center\">unit</th>";
                            html2+="<th class=\"text-center\">amount</th>";
                            html2+"</tr>";
                            for(var m=0;m<history_item.length;m++)
                            {
                                var item=history_item[m];
                                if(item.order_id==order_id)
                                {
                                     html2+="<tr>";
                                     html2+="<td class=\"text-center\">"+item.number+"</td>";
                                     html2+="<td class=\"text-center\">"+item.Item_Desc+"</td>";
                                     html2+="<td class=\"text-center\">"+history_tran_unit[m]+"</td>";
                                     html2+="<td class=\"text-center\">"+history_tran_amount[m]+"</td>";
                                     html2+="</tr>";
                                }
                            }
                            html2+="</thead>";
                            html2+="</table>";
                            html2+="</div>";
                            html2+="</div>";
                            
                      }
                   
                      $('#unit_job').html(html);
                      $('.main-part').html(html1);
                      $('.historysection').html(html2);
                
                  }
             }
             
         })
     
        
    }
    function orderbyorg(ob)
    {
        var html2="";
        var org_id=$(ob).val();
        $.ajax({
            method:'post',
            url:'{{route('orderitem')}}',
            data:{orgid:org_id,"_token":"{{ csrf_token()}}"},
            success:function(result)
            {
               console.log(result);
               var res=JSON.parse(result);
               var date_arr=res.date_arr;
               var store_arr=res.store_arr;
               var po_date_arr=res.po_date_arr;
               var po_store_arr=res.po_store_arr;
               var item_groupid=res.item_groupid;
               var po_item_groupunitid=res.po_item_groupunitid;
               var po_item=res.po_item;
               var item=res.item;
               var store_arr=res.store_arr;
             
                for(var j=0;j<item_groupid.length;j++)
                    {
                            var order=item_groupid[j];
                            html2+="<div class=\"row\" style=\"padding:0em;margin-left:0em;margin-right:0em;margin-top:0.5em;\">";
                            html2+="<div class=\"col-xs-4 text-center\" style=\"font-size:10pt;\">";
                            html2+=store_arr[j];
                            html2+="</div>";
                            html2+="<div class=\"col-xs-3 text-center\" style=\"font-size:10pt;\">";
                            html2+=date_arr[j];
                            html2+="</div>";
                            html2+="<div class=\"col-xs-4 text-center\" style=\"font-size:10pt;\">";
                            html2+="PO:"+order.order_id;
                            html2+="</div>";
                            html2+="<div class=\"col-xs-1\">";
                            html2+="<a  data-toggle=\"collapse\" data-target=\"#demo"+j+"\"><i class=\"fa fa-level-down\"></i></a>";
                            html2+="</div>";
                            html2+="</div>";
                            html2+="<div class=\"row collapse\" style=\"margin-top:0em;padding:0em;\" id=\"demo"+j+"\">";
                            html2+="<div class=\"table-responsive\">";
                            html2+="<table class=\"table table-hover\">";
                            html2+="<thead>";
                            html2+="<tr class=\"text-center\">";
                            html2+="<th width=\"5%\"><input type=\"checkbox\" id=\"item_check_all\" style=\"width:20px;\"/></th>";
                            html2+="<th width=\"30%\" class=\"text-center\">Item#</th>";
                            html2+="<th width=\"30%\" class=\"text-center\">Name</th>";
                            html2+="<th widdth=\"10%\" class=\"text-center\">amount</th>";
                            html2+="<th width=\"20%\" class=\"text-center\">transfer</th>";
                            html2+="</tr>";
                         
                            for(k=0;k<item.length;k++)
                            {
                                if(item[k].order_id==order.order_id)
                                {
                                    row=item[k];
                                      html2+="<tr class=\"text-center\">";
                                      html2+="<input type=\"hidden\" value=\""+row.id+"\" name=\"item_id_arr[]\">";
                                      html2+="<td><input type=\"checkbox\" class=\"sel_check\" name=\"selcheck[]\" value=\""+row.id+"\" style=\"width:20px;\"></td>";
                                      html2+="<td>"+row.number+"</td>";
                                      html2+="<td>"+row.Item_Desc+"</td>";
                                      html2+="<td class=\"amount\">"+parseInt(row.quantity)+"</td>";
                                      html2+="<td>";
                                      html2+="<div class=\"qty mt-5\" style=\"color:black!important;text-align: center;\">";
                                      html2+="<span class=\"minus bg-dark\" style=\"color:white!important;background-color:black;\">-</span>";
                                      html2+="<input type=\"number\" class=\"count\"  value=\"0\" style=\"font-size:10pt;width:10px;\" >";
                                      html2+="<input type=\"hidden\" name=\"transfer_amount[]\" class=\"tran_amount\" value=\"0\">";
                                      html2+="<span class=\"plus bg-dark\" style=\"color:white!important;background-color:black;\">+</span>";
                                      html2+="</div>";
                                      html2+="</td>";
                                      html2+="</tr>";
                                }
                                
                            }
                            html2+="</thead>";
                            html2+="</table>";
                            html2+="</div>";    
                            html2+="</div>";

            }
       
            for(var j=0;j<po_item_groupunitid.length;j++)
            {
                            var order=po_item_groupunitid[j];
                            html2+="<div class=\"row\" style=\"padding:0em;margin-left:0em;margin-right:0em;\">";
                            html2+="<div class=\"col-xs-4 text-center\" style=\"font-size:10pt;\">";
                            html2+=po_store_arr[j];
                            html2+="</div>";
                            html2+="<div class=\"col-xs-3 text-center\" style=\"font-size:10pt;\">";
                            html2+=po_date_arr[j];
                            html2+="</div>";
                            html2+="<div class=\"col-xs-4 text-center\" style=\"font-size:10pt;\">";
                            html2+="PO:"+order.order_id;
                            html2+="</div>";
                            html2+="<div class=\"col-xs-1\">";
                            html2+="<a  data-toggle=\"collapse\" data-target=\"#demo"+j+"\"><i class=\"fa fa-level-down\"></i></a>";
                            html2+="</div>";
                            html2+="</div>";
                            html2+="<div class=\"row collapse\" style=\"margin-top:0em;padding:0em;\" id=\"demo"+j+"\">";
                            html2+="<div class=\"table-responsive\">";
                            html2+="<table class=\"table table-hover\">";
                            html2+="<thead>";
                            html2+="<tr class=\"text-center\">";
                            html2+="<th width=\"5%\"><input type=\"checkbox\" id=\"item_check_all\" style=\"width:20px;\"/></th>";
                            html2+="<th width=\"30%\" class=\"text-center\">Item#</th>";
                            html2+="<th width=\"30%\" class=\"text-center\">Name</th>";
                            html2+="<th widdth=\"10%\" class=\"text-center\">amount</th>";
                            html2+="<th width=\"20%\" class=\"text-center\">transfer</th>";
                            html2+="</tr>";

                            for(k=0;k<po_item.length;k++)
                            {
                                if(po_item[k].order_id==order.order_id)
                                {
                                    row=po_item[k];
                                      html2+="<tr class=\"text-center\">";
                                      html2+="<input type=\"hidden\" value=\""+row.id+"\" name=\"item_id_arr[]\">";
                                      html2+="<td><input type=\"checkbox\" class=\"sel_check\" name=\"selcheck[]\" value=\""+row.id+"\" style=\"width:20px;\"></td>";
                                      html2+="<td>"+row.number+"</td>";
                                      html2+="<td>"+row.Item_Desc+"</td>";
                                      html2+="<td class=\"amount\">"+parseInt(row.quantity)+"</td>";
                                      html2+="<td>";
                                      html2+="<div class=\"qty mt-5\" style=\"color:black!important;text-align: center;\">";
                                      html2+="<span class=\"minus bg-dark\" style=\"color:white!important;background-color:black;\">-</span>";
                                      html2+="<input type=\"number\" class=\"count\"  value=\"0\" style=\"font-size:10pt;width:10px;\" >";
                                      html2+="<input type=\"hidden\" name=\"transfer_amount[]\" class=\"tran_amount\" value=\"0\">";
                                      html2+="<span class=\"plus bg-dark\" style=\"color:white!important;background-color:black;\">+</span>";
                                      html2+="</div>";
                                      html2+="</td>";
                                      html2+="</tr>";
                                }
                                
                            }
                            html2+="</thead>";
                            html2+="</table>";
                            html2+="</div>";    
                            html2+="</div>";

            }
            $('.main-part').html(html2);
            }
        })
        
       

    }
    function neworderorg(ob)
    {
        var org_id=$(ob).val()
        var html2="";
        var html3="";
        $.ajax(
            {
                method:'post',
                url:'{{route('jsondata')}}',
                data:{orgid:org_id,"_token":"{{ csrf_token()}}"},
                success:function(result)
                {
                    var json_res=JSON.parse(result);
                    if(json_res)
                    {
                        var unit_com=json_res.order;
                        var item=json_res.items;
                        var ordergroup=json_res.ordergroup;
                        var store_arr=json_res.store_arr;
                        var date_arr=json_res.date_arr;
                        for(var i=0;i<unit_com.length;i++)
                        {
                            var option=unit_com[i];
                             html3+="<option value=\""+option.id+"\">"+option.name+"</option>";
                            
                        }
                        
                        for(var j=0;j<ordergroup.length;j++)
                        {
                            var order=ordergroup[j];
                            html2+="<div class=\"row\" style=\"padding:0em;margin-left:0em;margin-right:0em;\">";
                            html2+="<div class=\"col-xs-4 text-center\" style=\"font-size:10pt;\">";
                            html2+=store_arr[j];
                            html2+="</div>";
                            html2+="<div class=\"col-xs-3 text-center\" style=\"font-size:10pt;\">";
                            html2+=date_arr[j];
                            html2+="</div>";
                            html2+="<div class=\"col-xs-4 text-center\" style=\"font-size:10pt;\">";
                            html2+="PO:"+ordergroup[j].order_id;
                            html2+="</div>";
                            html2+="<div class=\"col-xs-1\">";
                            html2+="<a  data-toggle=\"collapse\" data-target=\"#demo"+j+"\"><i class=\"fa fa-level-down\"></i></a>";
                            html2+="</div>";
                            html2+="</div>";
                            html2+="<div class=\"row collapse\" style=\"margin-top:0em;padding:0em;\" id=\"demo"+j+"\">";
                            html2+="<div class=\"table-responsive\">";
                            html2+="<table class=\"table table-hover\">";
                            html2+="<thead>";
                            html2+="<tr class=\"text-center\">";
                            html2+="<th width=\"5%\"><input type=\"checkbox\" id=\"item_check_all\" style=\"width:20px;\"/></th>";
                            html2+="<th width=\"30%\" class=\"text-center\">Item#</th>";
                            html2+="<th width=\"30%\" class=\"text-center\">Name</th>";
                            html2+="<th widdth=\"10%\" class=\"text-center\">amount</th>";
                            html2+="<th width=\"20%\" class=\"text-center\">transfer</th>";
                            html2+="</tr>";

                            for(k=0;k<item.length;k++)
                            {
                                if(item[k].order_id==order.order_id)
                                {
                                    row=item[k];
                                      html2+="<tr class=\"text-center\">";
                                      html2+="<input type=\"hidden\" value=\""+row.id+"\" name=\"item_id_arr[]\">";
                                      html2+="<td><input type=\"checkbox\" class=\"sel_check\" name=\"selcheck[]\" value=\""+row.id+"\" style=\"width:20px;\"></td>";
                                      html2+="<td>"+row.number+"</td>";
                                      html2+="<td>"+row.Item_Desc+"</td>";
                                      html2+="<td class=\"amount\">"+parseInt(row.quantity)+"</td>";
                                      html2+="<td>";
                                      html2+="<div class=\"qty mt-5\" style=\"color:black!important;text-align: center;\">";
                                      html2+="<span class=\"minus bg-dark\" style=\"color:white!important;background-color:black;\">-</span>";
                                      html2+="<input type=\"number\" class=\"count\"  value=\"0\" style=\"font-size:10pt;width:10px;\" >";
                                      html2+="<input type=\"hidden\" name=\"transfer_amount[]\" class=\"tran_amount\" value=\"0\">";
                                      html2+="<span class=\"plus bg-dark\" style=\"color:white!important;background-color:black;\">+</span>";
                                      html2+="</div>";
                                      html2+="</td>";
                                      html2+="</tr>";
                                }
                                
                            }
                            html2+="</thead>";
                            html2+="</table>";
                            html2+="</div>";    
                            html2+="</div>";

                        }
                        $('#mainpart').html(html2);
                        $('#main-filter').html(html3);
                    }
                }   
            }
        )
    }
    function home_depot(ob)
    {
        var cur_id=$('#orginfo').val();
       
        $('#cur_org_id').val(cur_id);    
    }
    function updateorg(id)
    {
        console.log(id);

       $('#org_id').val(id);
    }
    function deleteorg(id)
    {
        $('#del_id ').val(id);
    }
    function addsubuser()
    {
        var orgid=$('#mypro').val();
        var unit_id=$('#unit_id').val();
        $('#org_id').val(orgid);
        $('#entity_unit').val(unit_id);
      
    }
    function check_filter(sel)
    {
         var uniqe_id=$(sel.options[sel.selectedIndex]).attr("data-id");

         if(uniqe_id==4 || uniqe_id==5)
         {
             $('#filterj').css('display','block');
         }
         else
         {
            $('#filterj').css('display','none');
         }
        
    }
    
    function understaff(id)
    {
        var html=""

       var ob=$('#mypros').val();
       console.log(ob);
       
       var unit_id=$('#unit_id').val();
       if(id==1)
       {
                var html2="";
            $.ajax({
                method:'post',
                url:"{{route('inventory_unit')}}",
                data:{"_token":"{{ csrf_token()}}",'org_id':ob},
                success:function(result)
                {
                    var res=JSON.parse(result);
                    for(var i=0;i<res.length;i++)
                    {
                        html2+="<option value=\""+res[i].id+"\">"+res[i].name+"</option>";
                    }
                    $('#unit_id').html(html2);
                }
            
            });     
       }
       $.ajax({
              method:'post',
              url:"{{route('getorgname')}}",
              data:{"_token":"{{ csrf_token()}}",'orgid':ob,'entityid':unit_id},
              success:function(result)
              {
                
                   var res=JSON.parse(result);
                 
                   if(res)
                   {
                       for(var i=0;i<res.length;i++)
                       {
                            html+="<tr>";
                            html+="<td>"+(i+1)+"</td>";
                            if(res[i].img==undefined)
                            {
                                html+="<td><img src=\"/img/staff.png\" >"
                            }
                            else
                            {
                                html+="<td><img src=\"/img/"+res[i].img+"\"></td>";
                            }
                                html+="<td>"+res[i].name+"</td>";
                                html+="<td>"+res[i].email+"<br>";
                                html+="<a  data-toggle=\"modal\" data-target=\"#myModal2\" onclick=\"put_staff_id("+res[i].id+")\">Edit Permission</a></td>";
                                html+="<td>"+res[i].stacas_password+"<br>";
                                html+="<a data-toggle=\"modal\" data-target=\"#myModal3\" onclick=\"get_staff_permission("+res[i].id+")\">view</a></td>";
                                // html+="<td>"+(i+1)+"</td>";

                       }
                     }
                   $('#tb1').html(html);

              }
       });
   
      
    }
    function render_unit_tab()
    {
     
        var ob=$('#myorg').val();
        var html1="";
            $.ajax({
                method:'post',
                url:"{{route('inventory_unit')}}",
                data:{"_token":"{{ csrf_token()}}",'org_id':ob},
                success:function(result)
                {
                    var res=JSON.parse(result);
                    for(var i=0;i<res.length;i++)
                    {
                        html1+="<option value=\""+res[i].id+"\">"+res[i].name+"</option>";
                    }
                    $('#resource').html(html1);
                }
            
            }); 

    }
    function sel_user(nam)
    {
        console.log(nam);
        $('#mytext').val(nam);
        $('#searchuser').html("");
    }
    function func(ob)
    {
        var html="";
        var con=$(ob).val();
        if(con!='')
        {
            $.ajax({
                method:'post',
                url:'{{route('searchuer')}}',
                data:{"_token":"{{ csrf_token()}}","username":con},
                success:function(result)
                {
                    var res=JSON.parse(result);
                    for(var i=0;i<res.length;i++)
                    {
                        var imgurl="";
                        if(res[i].img==undefined)
                        {
                            imgurl="p6.png";
                        }
                        else
                        {
                            imgurl=res[i].img;
                            
                        }
                       html="<li onclick=\"sel_user(\'"+res[i].name+"\')\"><img src=\"images/"+imgurl+"\" style=\"width:30px;height:30px;\"></img>"+res[i].name+"</li>"
                    }
                    $('#searchuser').html(html);
                }
                
            })
        }
        else
        {
            $('#searchuser').html('');
        }
}
function addsubinvertory()
{
    var org_id=$("#myorg").val();
    $('#org_id').val(org_id);

}
function  update_inver(id)
{
   $('#inver_id').val(id);
   
}
function dele_inver(id)
{
    console.log(id);
    $('#delinver_id').val(id);
}
function render_invertory(ob,target)
{
     console.log("rendering...");
     var org_id=$('#myorg').val();
     var unit_com=$('#unit_com').val();
     var html="";
     $.ajax({
          method:'post',
          url:"{{route('invertory_group')}}",
          data:{"_token":"{{ csrf_token()}}",'org_id':org_id,'unit_com':unit_com},
          success:function(result)
          {
             
              var res=JSON.parse(result);
             
              var unit_com=res.unit_group;
              var  html2="";
              for(var j=0;j<unit_com.length;j++)
              {
                  var option=unit_com[j];
                  html2+="<option value=\""+option.id+"\">"+option.name+"</option>";
                
              }
              $('#inventory_unit_item').html(html2);
              if(target==1)
              {
                    $('#unit_com').html(html2);
                    $('#unit_com').trigger('change');
              }
              var res=res.inventory_group; 
              for(var i=0;i<res.length;i++)
              { 
                  html+="<input type=\"hidden\" name=\"cur_unit\" value=\""+res[i].unit+"\">";
                  html+="<tr>";
                  html+="<input type=\"hidden\" name=\"tbl_item_id[]\" value=\""+res[i].id+"\">";
                  html+="<td><input type=\"checkbox\" name=\"neworder[]\" class=\"sel_check\" value=\""+res[i].id+"\" style=\"width:20px;\"></td>";
                  html+="<td>#"+res[i].number+"</td>";
                  html+="<td>"+res[i].Item_Desc+"</td>";
                  html+="<td class=\"amount\">"+parseInt(res[i].quantity)+"</td>";
                  html+="<td> <div class=\"qty mt-5\" style=\"color:black!important;text-align: center;\"><span class=\"minus bg-dark\" style=\"color:white!important;background-color:black;\">-</span><input type=\"number\" class=\"count\" name=\"qty\" value=\"0\" style=\"font-size:10pt;\">";
                  html+="<input type=\"hidden\" name=\"transferamount[]\" class=\"tran_amount\" value=\"0\">";
                  html+="<span class=\"plus bg-dark\" style=\"color:white!important;background-color:black;\">+</span>";
                  html+="</div></td>"
                  html+="</tr>";

              }
              $('#inve_tb').html(html);

          }
     });
}
function addunit()
{
    var org_id=$("#myorg").val();   
     $('#org_id').val(org_id);   

}
function updateunit(id)
{
    
    $('#up_unit_id').val(id);
}
function deleteunit(id)
{
    
    $('#del_unit_id').val(id);
}
function render_unit()
{
    var org_id=$('#myorg').val();
   
    $.ajax({
        method:'post',
        url:"{{route('inventory_unit')}}",
        data:{"_token":"{{ csrf_token()}}",'org_id':org_id},
        success:function(result)
        {
           var res=JSON.parse(result);
           var html="";
           console.log(res);
           for(var i=0;i<res.length;i++)
           {
               html+="<tr>";
               html+="<td>"+(i+1)+"</td>";
               html+="<td>"+res[i].name+"</td>";
               html+="<td><span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"  data-toggle=\"modal\" data-target=\"#myModal1\" onclick=\"updateunit("+res[i].id+")\"></span>&nbsp;&nbsp;&nbsp;<span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\" onclick=\"deleteunit("+res[i].id+")\" data-toggle=\"modal\" data-target=\"#myModal2\"></span></td>";
               html+="</tr>";
            }
            $('#unitval').html(html);
        }
    });
}
function render_permiss_unit(ob)
{
    var html="";
     var org_id=$(ob).val();
     $.ajax({
         method:"post",
         url:"{{route('inventory_unit')}}",
         data:{"_token":"{{ csrf_token()}}",'org_id':org_id},
         success:function(result)
         {
           var  unitbyorg = JSON.parse(result);
           console.log(unitbyorg);
            var staffid=$('#staff_id').val();
            console.log(staffid);
            $.ajax({
                method:"post",
                        url:"{{route('staffpermissioninfo')}}",
                        data:{"_token":"{{ csrf_token()}}","staff_id":staffid},
                        success:function(result1)
                        {
                            
                            var res=JSON.parse(result1);
                             var unitinfo=res['unit'];
                             
                            var permission_info_org_id=Array();
                            var mm=0;
                            for(var jj=0;jj<unitinfo.length;jj++)
                            {
                                if(unitinfo[jj].org_id==org_id)
                                {
                                    permission_info_org_id[mm]=unitinfo[jj].id;
                                    mm++;
                                }
                            }
                            for(var kk=0;kk<unitbyorg.length;kk++)
                            {
                                 console.log(kk);
                                var unit_id=unitbyorg[kk].id;
                                            if(permission_info_org_id.includes(unit_id))
                                            {

                                                html+="<li><input type=\"checkbox\" class=\"selcheck\" name=\"selpermiss[]\" checked value=\""+unitbyorg[kk].id+"\">"+unitbyorg[kk].name+"</li>";
                                                                                                               
                                            }
                                            else
                                            {
                                                html+="<li><input type=\"checkbox\" class=\"selcheck\" name=\"selpermiss[]\"  value=\""+unitbyorg[kk].id+"\">"+unitbyorg[kk].name+"</li>";
                                            }
                            }
                            $('#permissioninfo').html(html);
                            
                        }
            })

         }
     })
     
    

}
function put_staff_id(id)
{
  var html="";
   $('#staff_id').val(id);

                $.ajax({
                        method:"post",
                        url:"{{route('staffpermissioninfo')}}",
                        data:{"_token":"{{ csrf_token()}}","staff_id":id},
                        success:function(result)
                        {
                           
                        
                            var res=JSON.parse(result);
                            var companyinfo=res['org'];
                            console.log(companyinfo);
                            var unitinfo=res['unit'];
                            var permssion_unit_id=Array();
                            var kk=0;
                            for(var i=0;i<unitinfo.length;i++)
                            {
                                if(unitinfo[i].org_id==companyinfo[0].id)
                                {
                                    permssion_unit_id[kk]=unitinfo[i].id;
                                    kk++;
                                }
                               
                            }   
                         
                            if(companyinfo)
                            {
                                $fir_comp_info=companyinfo[0].id;
                                

                                $.ajax({
                                    method:'post',
                                    url:"{{route('inventory_unit')}}",
                                    data:{"_token":"{{ csrf_token()}}",'org_id':$fir_comp_info},
                                    success:function(result1)
                                    {
                                        console.log(companyinfo);
                                        var org_under_unit=JSON.parse(result1)
                                   
                                        for(var j=0;j<org_under_unit.length;j++)
                                        {
                                            var unit_id=org_under_unit[j].id;
                                            if(permssion_unit_id.includes(unit_id))
                                            {

                                                html+="<li><input type=\"checkbox\" class=\"selcheck\" name=\"selpermiss[]\" checked value=\""+org_under_unit[j].id+"\">"+org_under_unit[j].name+"</li>";
                                                                                                               
                                            }
                                            else
                                            {
                                                html+="<li><input type=\"checkbox\" class=\"selcheck\" name=\"selpermiss[]\"  value=\""+org_under_unit[j].id+"\">"+org_under_unit[j].name+"</li>";
                                            }
                                           
                                        }
                                      
                                        $('#permissioninfo').html(html);
                                        $("#mypro").val($("#mypro option:first").val());
                                    }
                                })
                            }
                        
                            
                        }
                    });
               
        
}
function get_staff_permission(id)
{
    var html1="";
    var html="";
    $.ajax({
        method:"post",
        url:"{{route('staffpermissioninfo')}}",
        data:{"_token":"{{ csrf_token()}}","staff_id":id},
        success:function(result)
        {
           
            var res=JSON.parse(result);
            var companyinfo=res['org'];
            var unitinfo=res['unit'];
            for(var i=0;i<companyinfo.length;i++)
            {   html+="<h3>"+companyinfo[i].name+"</h3>";
                html+="<ul style=\"list-style:none;\">";
                for(var j=0;j<unitinfo.length;j++)
                {
                    if(companyinfo[i].id==unitinfo[j].org_id)
                    {   
                        html+="<li>"+unitinfo[j].name+"</li>";
                    }   
                }
                html+="</ul>";
                
            }

            $('#org_view').html(html);
        }
    })
    
}
var str1,str2,str3;
function selectall()
{
   
    $('.selcheck').each(function()
    {
        
        this.checked=true;
        // $(this).attr('checked',true);
    })
}
function selectnone()
{
    
    $('.selcheck').each(function()
    {
        
        $(this).attr('checked',false);
    })

}
function check_validate(ob)
{
   if(ob==1)
   {
       
         
         var ty=$('.check1').val();
         if(ty.length==0)
         {
            $('.check1').val("$");
           
         }
         else
         {
            var y=ty.substring(0,1); 
            m=ty.substring(ty.length-1,ty.length);
            
            var z=/^([0-9])$/.test(m);
            if(z==true&&y=="$")
            {
    
            }
            else
            {
                var str=$('.check1').val();
                if(str.length==1)
                {
                    $('.check1').val("$")
                }
                else
                {
                    str=str.substring(0, str.length -1);
                     $('.check1').val(str); 
                }
                
            }

         }
    }
   else if(ob==2)
   {
        var tm=$('.check2').val();
         if(tm.length==0)
         {
            $('.check2').val("%");
         }
         else
         {
            var y=tm.substring(0,1);
            m=tm.substring(tm.length-1,tm.length);
            var z=/^([0-9])$/.test(m);
            if(z==true&&y=="%")
            {
    
            }
            else
            {
                var str=$('.check2').val();
                if(str.length==1)
                {
                    $('.check2').val("%");
                }
                else
                {
                    str=str.substring(0, str.length -1);
                    $('.check2').val(str);

                }
                 
            }

         }

   }
   else
   {
     var tx=$('.check3').val();
         if(tx.length==0)
         {
            $('.check3').val("$");
           
         }
         else
         {
            var y=tx.substring(0,1); 
            m=tx.substring(tx.length-1,tx.length);
            
            var z=/^([0-9])$/.test(m);
            if(z==true&&y=="$")
            {
    
            }
            else
            {
                var str=$('.check1').val();
                if(str.length==1)
                {
                    $('.check1').val("$")
                }
                else
                {
                    str=str.substring(0, str.length -1);
                     $('.check1').val(str); 
                }
                
            }

         }
   }
}

</script>   
 @if(!$errors->isEmpty())
    <script>
       
         var ob=document.getElementById('myModal') ;
         $('#myModal').modal();
         
    </script>     
   @endif