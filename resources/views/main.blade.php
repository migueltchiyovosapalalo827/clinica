@extends('adminlte::page')


@section('content_top_nav_right') 

   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
       
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown has-treeview">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-fw fa-user"></i>
          
          Miguel sapalalo
   
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
              <i class="fa fa-user-plus" aria-hidden="true"></i>
         Perfil
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
              <i class="fas fa-exchange-alt "></i>
          Mudar Senha
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ url('/logout') }}"
                      onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" class="dropdown-item">
           <i class="fas fa-sign-out-alt "></i>
            Sair
          </a>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
     
    </ul>
@endsection
@section('content')
@parent
@yield('content')
 
@stop 
