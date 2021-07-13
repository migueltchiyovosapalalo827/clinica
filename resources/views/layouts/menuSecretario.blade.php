

@can('secretaria')

<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->

<li  class="nav-item has-treeview ">
<a class="nav-link "  href="" >
<i class="fa fa-bed"></i>
<p> Pacientes <i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li  class="nav-item">
<a class="nav-link" href="{{route('paciente.create')}}"        >
<i class="fas fa-fw "></i>
<p> Cadastrar Paciente </p>
</a>
</li>
<li  class="nav-item">
<a class="nav-link" href="{{route('paciente.index')}}"        >
<i class="fas fa-fw   s fa-user-secret    "></i>
<p> Lista de Paciente </p>
</a>
</li>
<li  class="nav-item">
<a class="nav-link" href="{{route('historico.index')}}"        >
<i class="fas fa-book"></i>
<p>historico do paciente </p>
</a>

</li>

</ul>
</li>

<li  class="nav-item has-treeview ">
<a class="nav-link "  href="" >
<i class="fas fa-calendar-check "></i>
<p> Agenda <i class="fas fa-angle-left  right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li  class="nav-item">
<a class="nav-link" href="{{route('agenda.create')}}"        >
<i class="fas fa-fw  fa-calendar-plus"></i>
<p> Agendar consulta </p>
</a>
</li>
<li  class="nav-item">
<a class="nav-link" href="{{route('agenda.index')}}"        >
<i class="fas fa-calendar-times "></i>
<p> Lista de Consulata Agendada</p>
</a>
</li>


</ul>
</li>

</ul>

@endcan
