  @extends('layouts.menu')
 @section('content')
    @include('layouts.menubar')
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form  method="post" action="{{route('updateorg')}}">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">change organazation</h4>
      </div>
      <div class="modal-body">
          
              @csrf
              <div class="form-group">
                 <input type="text" class="form-control" name="orgname" required/>
                
             </div>
                <input type="hidden" name="orgid" id="org_id" />
        
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>  
  </form>   
</div>
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form  method="post" action="{{route('deleteorg')}}">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">organazation delete</h4>
      </div>
      <div class="modal-body">
            <h5>Do u want to delete this model?</h5>
              @csrf
              
                <input type="hidden" name="orgid" id="del_id" />
                
        
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">delete</button>
      </div>
    </div>
  </div>
  </form>
</div>
<div class="portlet-grid panel-primary" style="width:100%;padding:1em;border:0px;">   
<div class="row" style="margin:0px;">
    <form action="{{route('addorgnazation')}}" method="post" style="margin-bottom:0.5em;">
         @csrf  
        <div class="form-group" style="margin-bottom:0.5em;">
            
            <label for="orgnazation" style="margin-bottom:0.5em;">organazation</label>
            <input type="text" class="form-control" name="orgname" required/>
        </div>
        <button type="submit" class="btn btn-primary hvr-skew-backwards">add</button>
    </form>
</div>
<div class="col-md-12 chit-chat-layer1-left">
               <div class="work-progres">
                            <div class="chit-chat-heading">
                                  Recent organazation
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>orgnazation</th>
                                      <th>Manager</th>                                   
                                      <th>date</th>
                                      <th>status</th>                            
                                    </tr>
                                    @foreach($org_data as $key=>$row)
                                      <tr>
                                        <td>{{$key+1}}</td> 
                                        <td>{{$row->name}}</td> 
                                        <td>{{Auth::user()->name}}</td>
                                        <td>{{$row->orgdate}}</td>
                                        <td><span class="glyphicon glyphicon-edit" aria-hidden="true"  data-toggle="modal" data-target="#myModal" onclick="updateorg({{$row->id}})"></span>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-trash" aria-hidden="true" onclick="deleteorg({{$row->id}}) " data-toggle="modal" data-target="#myModal1"></span></td>
                                     </tr>                 
                                    @endforeach
                              </thead>
                              <tbody>
                               
                          </tbody>
                      </table>
                  </div>
             </div>
      </div>
</div>
 @endsection