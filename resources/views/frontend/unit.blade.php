@extends('layouts.menu')
 @section('content')
    @include('layouts.menubar')
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form  method="post" action="{{route('addunit')}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Invertory unit register</h4>
                    </div>
                    <div class="modal-body">
                        
                            @csrf
                            <input type="hidden" name="org_id" id="org_id">
                            <div class="form-group row" style="padding:2em;">
                                
                                <div class="col-md-6 form-group">
                                    <label>name:<label>
                                    <input type="text" name="unit_name" class="form-control" placeholder="" required>
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
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form  method="post" action="{{route('updateunit')}}">
            <div class="modal-dialog" role="document">  
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Invertory unit update</h4>
                    </div>
                    <div class="modal-body">
                        
                            @csrf
                            <input type="hidden" name="unit_id" id="up_unit_id">
                            <div class="form-group row" style="padding:2em;">
                                
                                <div class="col-md-6 form-group">
                                    <label>name:<label>
                                    <input type="text" name="unit_name" class="form-control" placeholder="" required>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> {{ __('Update') }}</button>
                    </div>
                </div>
                
            </div>


        </form>
    </div>
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <form  method="post" action="{{route('deleteunit')}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Invertory unit delete</h4>
                    </div>
                    <div class="modal-body">
                        
                            @csrf
                            <input type="hidden" name="unit_id" id="del_unit_id">
                            <div class="form-group row" style="padding:2em;">
                                
                              <p>Are u sure to delete this unit?</p>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary"> {{ __('Yes') }}</button>
                    </div>
                </div>
                
            </div>


        </form>
    </div>
    <div class="portlet-grid panel-primary" style="width:100%;padding:1em;">
            <div class="panel-heading">
                <h3 class="panel-title">Inventory</h3>
            </div>
            <div class="form-group" style="margin-top:0.5em;margin-bottom:0.5em;">
            <label style="margin-bottom:0.5em;">Orgnazation</label>
                    <select class="form-control" id="myorg" onchange="render_unit(this)">
                        @foreach($org_name as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                        
                    </select>
            </div>
            <label style="margin-bottom:0.5em;">unit</label><span class="glyphicon glyphicon-plus-sign" aria-hidden="true" data-toggle="modal" data-target="#myModal" onclick="addunit()" style="color:#456234;font-size:16pt;padding-left:0.5em;"></span>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>            
                            <th style="width:30%">id</th>
                            <th style="width:60%;">Name</th>
                             <th>status</th>
                            
                        </tr>
                    </thead>
                       <tbody id="unitval">
                        @foreach($tbl_unit as $key =>$row)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$row->name}}</td>
                                <td><span class="glyphicon glyphicon-edit" aria-hidden="true"  data-toggle="modal" data-target="#myModal1" onclick="updateunit({{$row->id}})"></span>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-trash" aria-hidden="true" onclick="deleteunit({{$row->id}}) " data-toggle="modal" data-target="#myModal2"></span></td>
                            </tr>

                        @endforeach
                       
                    </tbody>
                    
                    
                
                </table>
            </div>     
    </div>
@endsection