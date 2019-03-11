@extends('layouts.menu')
 @section('content')
    @include('layouts.menubar')
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form  method="post" action="{{route('profileupdate')}}" enctype="multipart/form-data">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">profile update model</h4>
      </div>
      <div class="modal-body">
          
              @csrf
              
                     <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      
                        <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('profile image') }}</label>

                            <div class="col-md-6">
                                <input type="file" name="profileimage" require  />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="review" class="col-md-4 col-form-label text-md-right">{{ __('profile content') }}</label>

                            <div class="col-md-6">
                              <textarea name="usercontent" width="100%;height:20%;" class="form-control">
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="review" class="col-md-4 col-form-label text-md-right">{{ __('company history') }}</label>

                            <div class="col-md-6">
                              <textarea name="companycontent" width="100%;height:20%;" class="form-control">
                                </textarea>
                            </div>
                        </div>

                    
         
      </div>
  
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> {{ __('update') }}</button>
      </div>
    </div>
  </div>
  </form>
</div>
    <div class="page-container">
        <div class="row" style="padding:1em;">
        <div class="col-md-12 chart-layer1-right"> 
			<div class="user-marorm">
			<div class="malorum-top">				
            </div>
            
			<div class="malorm-bottom">
                @if($user_type=='owner')
                     @if(isset($user->img))
                        <span class="malorum-pro" style="background:url('/images/{{$user->img}}');background-size:100%;"> </span>
                     @else
                        <span class="malorum-pro"> </span>
                     @endif
                    
                    <h4>name:{{$user->name}}  email:{{$user->email}}</h4>
                    <h2>{{$user_type}}</h2>
                    <h4>orgnazation:{{count($org)}}</h4>
                    <h4>Invertory:{{count($inver)}}</h4>
                    <h4>staff:{{count($mystaff)}}</h4>
                    
                   <h4>content:
                         
                            @if(count($profile)>0)
                                {{$profile[0]->profile_content}}
                             @else
                                 <font style="color:red">update content</font>
                            @endif
                        
                    </h4>
                    <h4>
                        company history:
                        @if(count($profile)>0)
                                {{$profile[0]->company_history}}
                             @else
                                 <font style="color:red">update content</font>
                            @endif

                        
                    </h4>
                @else
                  
                @endif
            </div>
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    {{ __('update') }}
            </button>
		   </div>
		</div>
        </div>
    </div>
 @endsection