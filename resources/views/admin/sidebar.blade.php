<aside class="app-sidebar">
    @if(isset(Auth::user()->img))
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ URL::to('/') }}/images/{{Auth::user()->img}}" alt="User Image" style="width:50px;height:50px;">
     @else
     <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ URL::to('/') }}/images/p8.png" alt="User Image">
     @endif
      <div>
          <p class="app-sidebar__user-name">{{Auth::user()->name}}</p>
          <p class="app-sidebar__user-designation">admin</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="{{route('admin.index')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li ><a class="app-menu__item" href="{{route('admin.owner')}}" ><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">owner management</span></a>
         
        </li>
        <li><a class="app-menu__item" href="{{route('admin.staff')}}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Staff management</span></a></li>
        <li ><a class="app-menu__item" href="{{route('admin.invertory')}}"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">invertory management</span></a>
        </li>
        <li ><a class="app-menu__item" href="{{route('admin.orgnaization')}}"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">orgnaization management</span></a>
          
        </li>
        <li ><a class="app-menu__item" href="{{route('admin.logout')}}"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Logout</span></a></li>
      </ul>
    </aside>