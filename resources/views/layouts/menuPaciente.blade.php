@can('paciente')

<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
 <li  class="nav-item has-treeview ">
<a class="nav-link "  href="" >
<i class="fas fa-calendar-check "></i>
<p> Agendar consulta <i class="fas fa-angle-left  right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li  class="nav-item">
<a class="nav-link" href="{{route('historico.agendar')}}"        >
<i class="fas fa-fw  fa-calendar-plus"></i>
<p> Agendar consulta </p>
</a>
</li>
</ul>
</li>


<li  class="nav-item has-treeview ">
<a class="nav-link "  href="" >
<i class="fas fa-network-wired "></i>
<p> Serviços Medico <i class="fas fa-angle-left  right"></i>
</p>
</a>
<ul class="nav nav-treeview">

<li  class="nav-item">
<a class="nav-link" href="{{route('servicos.index')}}"        >
<i class="fas fa-calendar-times "></i>
<p> Lista de Serviços Medicos</p>
</a>
</li>
</ul>
</li>


<li class="nav-item">
    <a class="nav-link" href="{{route('historico.create')}}">
    <i class="fa fa-history" aria-hidden="true"></i>
    <p>Historico Medico</p>
    </a>
    </li>
</ul>

@endcan
