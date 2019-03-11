@extends('admin.body')
@section('content')
<div class="row">
<div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
                <div id=x-good style="overflow-x:hidden!important;">
                <i class="fa fa-gear" aria-hidden="true" style="align:left;padding:0.5em;" onclick="func()"></i>more
                
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>no</th>
                     <th>orgnaization</th>
                     <th>client</th>
                     <th>staff</th>
                    <th>invertory</th>
                    <th>status</th>  
                </tr>
                </thead>
                <tbody>
                  <?php
                       $no=1;
                  ?>
                  @foreach($org_data as $key => $row)
                    <tr> 
                        <td>{{$key+1}}</td>
                        <td>{{$row->name}}</td>
                        @if(isset($client[$key]))
                            <td>{{$client[$key][0]->name}}</td>
                        @else
                            <td>undefined</td>
                        @endif

                        <td>
                            {{count($org_staff[$key])}}
                        </td>
                        <td>
                            {{count($org_inver[$key])}}
                        </td>
                        <td><a href="../icon/external-link"><i class="fa fa-external-link" aria-hidden="true"></i> <span class="sr-only">Example of </span>Edit</a></td>
                        
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