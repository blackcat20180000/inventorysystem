@extends('admin.body')
@section('content')
<div class="row">
<div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
            <i class="fa fa-gear" aria-hidden="true" style="align:left;" onclick="func()"></i>
                <div id=x-good style="overflow-x:hidden!important;">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th>no</th>
                            <th>username</th>
                            <th>image</th>
                            <th>email</th>
                            <th>client</th>
                            <th>organization</th>
                            <th>status</th>  
                        </tr>
                        </thead>  
                        <tbody>
                        <?php
                            $no=1;
                        ?>
                            @foreach ($staff as $key => $row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    @if(isset($row->img))
                                        <td><img src="./images/{{$row->img}}" style="widht:40px;height:40px;border-radius:50%;"></td>
                                    @else
                                        <td><img src="{{asset('images/p3.png')}}" style="widht:40px;height:40px;border-radius:50%;"></td>
                                    @endif
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$client[$key][0]->name}}</td>
                                    <td>{{$org[$key][0]->name}}</td>
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