@extends('admin.body')
@section('content')
<style>
   
</style>
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">record delete</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Do u want to delete this user?
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        <a href="" id="mydom"><button type="button" class="btn btn-danger" >delete</button></a>  
          <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
        </div>
        
      </div>
    </div>
  </div>
<div class="row">
<div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
            
                <div id=x-good style="overflow-x:hidden!important;">
                    <i class="fa fa-gear" aria-hidden="true" style="align:left;" onclick="func()"></i>
                   
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th>no</th>
                            <th>username</th>
                            <th>image</th>
                            <th>email</th>
                            <th>organization</th>
                            <th>user</th>
                            <th>invertory</th>
                            <th>update</th>
                            <th>delete</th>  
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $no=1;
                        ?>
                            @foreach($owner as $key => $row)
                                <td>{{$no+$key}}</td>
                                <td>{{$row->name}}</td>
                                @if(isset($row->img))
                                    <td><img src="./images/{{$row->img}}"  style="height:40px;width:50px;border-raidus:50%;"></td>
                                @else
                                    <td ><img src="{{assset('images/p3.png')}}" style="height:40px;width:50px;border-raidus:50%;"></td>
                                @endif        
                                <td>{{$row->email}}</td>
                                <td>{{count($org_data[$key])}}</td>
                                <td>{{count($inver_data[$key])}}</td>
                                <td>{{count($staff_data[$key])}}</td>
                                <td><a href="{{route('edit',$row->id)}}"><i class="fa fa-external-link" aria-hidden="true"></i> <span class="sr-only">Example of </span></a></td><td> <a data-toggle="modal" data-target="#myModal" onclick="client_delete({{$row->id}})"><i class="fa fa-remove" aria-hidden="true"></i> <span class="sr-only">Example of </span>   <span class="text-muted"></span></a> </td>
                            @endforeach

                            </tbody>
                    </table>
                </div>  
            </div>
          </div>
        </div>
      </div>
@endsection