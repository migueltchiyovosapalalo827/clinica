

@can('medico')

<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
<li  class="nav-item has-treeview ">
<a class="nav-link "  href="" >
<i class="fa fa-bed"></i>
<p> Pacientes <i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li  class="nav-item">
<a class="nav-link" href="{{route('paciente.index')}}"        >
<i class="fas fa-fw   s fa-user-secret    "></i>
<p> Lista de Paciente </p>
</a>
</li>
<li  class="nav-item">
    <a class="nav-link" href="{{route('historico.index')}}">
        <i class="fa fa-history" aria-hidden="true"></i>
        <p>Historico Medico</p>
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
<a class="nav-link" href="{{route('agenda.medico')}}"        >
<i class="fas fa-calendar-times "></i>
<p> Lista de Consulata Agendada</p>
</a>
</li>


</ul>
</li>

<li  class="nav-item has-treeview ">
<a class="nav-link "  href="" >
<i class="fa fa-stethoscope "></i>
<p> Consultas(Anamnese) <i class="fas fa-angle-left  right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li  class="nav-item">
<a class="nav-link" href="{{route('anamnese.create')}}"        >
<i class="fas fa-fw  fa-calendar-plus"></i>
<p> cadastrar consulta </p>
</a>
</li>

<li  class="nav-item">
<a class="nav-link" href="{{route('anamnese.index')}}"        >
<i class="fas fa-calendar-times "></i>
<p> Lista de Consulata realizada</p>
</a>
</li>


</ul>
</li>

<li  class="nav-item has-treeview ">
<a class="nav-link "  href="" >
<i class="fab fa-accessible-icon "></i>
<p> Exames Fisicos<i class="fas fa-angle-left  right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li  class="nav-item">
<a class="nav-link" href="{{ route('exames_fisicos.create') }}"        >
<i class="fas fa-fw  fa-calendar-plus"></i>
<p> Cadastrar exames do paciente </p>
</a>
</li>
<li  class="nav-item">
<a class="nav-link" href="{{route('exames_fisicos.index')}}"        >
<i class="fas fa-calendar-times "></i>
<p> Lista de Exames realizado</p>
</a>
</li>
</ul>
</li>
<li  class="nav-item has-treeview ">
<a class="nav-link "  href="" >
<i class="fa fa-medkit "></i>
<p> hipotise<i class="fas fa-angle-left  right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li  class="nav-item">
<a class="nav-link" href="{{ route('hipotise.create') }}"        >
<i class="fas fa-fw  fa-calendar-plus"></i>
<p> Cadastrar hipotise </p>
</a>
</li>
<li  class="nav-item">
<a class="nav-link" href="{{route('hipotise.index')}}"        >
<i class="fas fa-calendar-times "></i>
<p> Lista de hipotise</p>
</a>
</li>
</ul>
</li>

<li  class="nav-item">
    <a class="nav-link" href="{{route('exames.index')}}">
    <i class="fas fa-calendar-times "></i>
    <p> Lista de Exames Laboratorias </p>
    </a>
 </li>
<li class="nav-item">
<a class="nav-link" href="{{route('prescricao.index')}}"        >
<i class="fas fa-edit "></i>
<p> Prescrição de Medicamento</p>
</a>
</li>

</ul>

@endcan
