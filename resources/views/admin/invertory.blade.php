@extends('admin.body')
@section('content')
<div class="row">
    <ul class="nav nav-pills">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Menu 1</a></li>
      <li><a href="#">Menu 2</a></li>
      <li><a href="#">Menu 3</a></li>
    </ul>
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
                     <th>itemname</th>
                     <th>client</th>
                    <th>organaization</th>
                    <th>status</th>  
                </tr>
                </thead>
                <tbody>
                  <?php
                       $no=1;
                  ?>
                  @foreach($invertory as $key => $row)
                      <tr>
                        <td>{{$no+$key}}</td>
                        <td>{{$row->name}}</td>
                         @if(isset($client[$key]))
                          <td>{{$client[$key][0]->name}}</td>
                         @else
                           <td>Not found</td>
                         @endif
                         @if(isset($org_data[$key]))
                          <td>{{$org_data[$key][0]->name}}</td>
                         @else
                           <td>Not found</td>
                         @endif
                        <td><a href="../icon/pencil-square-o"><i class="fa fa-edit" aria-hidden="true"></i> <span class="sr-only">Example of </span>edit </a></td>
                    </tr> 
                 @endforeach
                
                </tbody>
              </table>
                </div>  
            </div>
          </div>
        </div>
      </div>
@endsection