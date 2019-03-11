@extends('layouts.menu')
 @section('content')
    @include('layouts.menubar')
    <div class="portlet-grid panel-primary" style="width:100%;">
            <div class="panel-heading">
                <h3 class="panel-title">subuser</h3>
            </div>
    </div>
    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form method="post" action="{{route('userpermission')}}">
            @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">View Permissions</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                       
                        <div id="org_view">

                        </div>
                          
                    </div>  
                    <input type="hidden" name="staffid" id="staffid" value="">   
                   
                </div>
                
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  
                </div>
            </div>
        </div>
                        
        </form>
    </div>
    
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form method="post" action="{{route('userpermission')}}">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit permission</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                            <label style="margin-bottom:0.5em;">Orgnazation</label>
                            <select class="form-control" id="mypro" name="org_id" onchange="render_permiss_unit(this)">
                                @foreach($org_name as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                                
                            </select>
                    </div>  
                    <input type="hidden" name="staffid" id="staff_id" value="">
                    <div class="row">  
                        <div class="col-md-6 col-xs-6">
                            <ul style="list-style:none;">
                                <li style="font-size:14pt;line-hight:1.5;"><a href="javascript:selectall()">select all</a></li>
                                <li style="font-size:14pt;"><a href="javascript:selectnone()">select none</a></li>
                            </ul>
                        </div>
                        <div class="form-group col-md-6 col-xs-6">
                            <label>Inventory unit</label>
                                    <ul id="permissioninfo" style="list-style:none;">
                                      
                                    </ul>  
                            
                            
                        </div>
                    </div>
                </div>
                
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"> {{ __('Accept') }}</button>
                </div>
            </div>
        </div>
                        
        </form>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form  method="post" action="{{route('subuser')}}">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">subuser account register</h4>
      </div>
      <div class="modal-body">
          
              @csrf
              
              <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                      
                        <input type="hidden" name="orgnazation" id="org_id">
                        <input type="hidden" name="entity_unit" id="entity_unit">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

         
      </div>
  
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> {{ __('Register') }}</button>
      </div>
    </div>
  </div>
  </form>
</div>
    <div class="row" style="padding-left:2em;padding-right:2em;">
        <div class="form-group" style="margin-bottom:0.5em;">
            <label style="margin-bottom:0.5em;">Orgnazation</label>
            <select class="form-control" id="mypros" onchange="understaff(1)">
                @foreach($org_name as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
                
            </select>
        </div>
        <div class="form-group" style="margin-bottom:0.5em;">
            <label>Inventory unit</label>
            <select class="form-control" id="unit_id" onchange="understaff(2)">
                @foreach($unit_name as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
                
            </select>
        </div>
        <label>subuser</label><span class="glyphicon glyphicon-plus-sign" aria-hidden="true" data-toggle="modal" data-target="#myModal" onclick="addsubuser()" style="color:#456234;font-size:16pt;padding-left:0.5em;top:0px;"></span>
        <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>image</th>
                                      <th>name</th>
                                      <th>email</th>                                   
                                      <th>password</th>
                                    
                                  </tr>
                                  </thead>
                                  <tbody id="tb1">
                                  @foreach($staff as $key=>$row)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            @if(isset($row->img))
                                                <img src="/img/{{$row->img}}" ></img>
                                             @else
                                                <img src="/img/staff.png"  ></img>
                                            @endif
                                        </td>
                                        <td>
                                            {{$row->name}}
                                        </td>
                                        <td>
                                            {{$row->email}}
                                            <br>
                                            <a  data-toggle="modal" data-target="#myModal2" onclick="put_staff_id({{$row->id}})">Edit Permission</a>
                                        </td>
                                        <td>
                                            {{$row->stacas_password}}
                                            <br>
                                            <a data-toggle="modal" data-target="#myModal3" onclick="get_staff_permission({{$row->id}})">view</a>
                                        </td>
                                    </tr>
                                  @endforeach
                               
                          </tbody>
                      </table>
                  </div>
    <div>
   
 @endsection