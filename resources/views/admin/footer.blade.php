 <!-- Essential javascripts for application to work-->
 <script src="{{asset('admin/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('admin/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/main.js')}}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{asset('admin/js/plugins/pace.min.js')}}"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="{{asset('admin/js/plugins/chart.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
   <script>
       var on = 0
       function func()
       {
           if(on==0)
           {
                $('#x-good').css('overflow-x','scroll');
                on=1;
           }
           else
           {
                $('#x-good').css('overflow-x','hidden');
                on=0;

           }
           
       }
       function client_delete(id)
       {
           var url="user_delete/"+id;

           $('#mydom').attr("href",url);
          
       }
    </script>