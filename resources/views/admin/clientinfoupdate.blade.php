@extends('admin.body')
@section('content')
<div class="row">
<div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">update</h3>
            <div class="tile-body">
              <form class="form-horizontal" method="post" action="{{route('owner.change')}}" enctype="multipart/form-data" >
               @csrf
               <input type="hidden" name="client_id" value="{{$client[0]->id}}" >
               <div class="form-group row">
                  <label class="control-label col-md-3">username</label>
                  <div class="col-md-8">
                        <input class="form-control" name="username" type="text" placeholder="Enter full name" value="{{$client[0]->name}}" require>
                        @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                         @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">email</label>
                  <div class="col-md-8">
                    <input class="form-control col-md-8" name="email" type="email" placeholder="Enter email address" value="{{$client[0]->email}}">
                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif 
                </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Address</label>
                  <div class="col-md-8">
                    <textarea class="form-control" rows="4" name="address" placeholder="Enter your address" require>{{$client[0]->address}}</textarea>
                    @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address')}}</strong>
                                    </span>
                    @endif 
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">account</label>
                  <div class="col-md-9">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="ac_status" value="0" require>activity
                      
                    </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="1" name="ac_status">inactivity
                      </label>
                   
                    </div>
                    @if ($errors->has('ac_status'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('ac_status')}}</strong>
                          </span>
                         @endif   
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">user image</label>
                  <div class="col-md-8">
                    <input class="form-control" name="useravatar" type="file" require>
                    @if ($errors->has('useravatar'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('useravatar')}}</strong>
                                    </span>
                         @endif   
                  </div>
                </div>
                <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <button type="submit" class="btn btn-primary" ><i class="fa fa-fw fa-lg fa-check-circle"></i></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{route('admin.owner')}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
              </div>
              </form>
            </div>
            <div class="tile-footer">
              
            </div>
          </div>
        </div>
</div>
@endsection