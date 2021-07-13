@can('laboratorio')

<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->

<li  class="nav-item has-treeview ">
<a class="nav-link "  href="" >
<i class="fas fa-temperature-low"></i>
<p> Exames Laboratorias  <i class="fas fa-angle-left  right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li  class="nav-item">
<a class="nav-link" href="{{route('exames.create')}}"        >
<i class="fas fa-fw  fa-calendar-plus"></i>
<p> Cadastrar Novo Exames Laboratorias </p>
</a>
</li>
<li  class="nav-item">
<a class="nav-link" href="{{route('exames.index')}}">
<i class="fas fa-calendar-times "></i>
<p> Lista de Exames Laboratorias </p>
</a>
</li>
</ul>
</li>
</ul>

@endcan
