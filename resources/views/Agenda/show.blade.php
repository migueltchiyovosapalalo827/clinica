

@extends('layouts.starter')
@section('title', 'consulta Agendada')

@include ('layouts.sidebar')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Consulta</a></li>
              <li class="breadcrumb-item active">agenda</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
<div class="row">

    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    <div class="btn-group">
                        <a href="{{ route('agenda.index') }}" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="col-md-12">
        <div class="card card-outline">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link  active " href="#detalhes" data-toggle="tab">Detalhe do agendamento</a></li>
                    @can('medico')
                    <li class="nav-item"><a class="nav-link  " href="#prontuario" data-toggle="tab">Iniciar consulta</a></li>
                    @endcan
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="tab-pane active " id="detalhes">
                <div class="row">
                <div class="col-md-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <dl class="row">
                  <dt class="col-sm-4">Paciente</dt>
                  <dd class="col-sm-8">{{$consulta->paciente->user->dadosPessoais->nome}}</dd>
                  <dt class="col-sm-4">medico</dt>
                  <dd class="col-sm-8">{{ $consulta->profissional_saude->User->dadosPessoais->nome??''}}</dd>
                  <dt class="col-sm-4">dia da consulta</dt>
                  <dd class="col-sm-8">{{$consulta->data_atendimento}}</dd>
                  <dt class="col-sm-4">Hora da consulta</dt>
                  <dd class="col-sm-8"> {{$consulta->inicio_atendimento}} </dd>
                  <dt class="col-sm-4">Motivo</dt>
                  <dd class="col-sm-8"> {{$consulta->descricao}} </dd>
                </dl>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>


                </div>


                    </div>
                    <div class="tab-pane " id="prontuario">
<h3>Cadastro de Prontuário</h3>
<h5><i> Se este for o primeiro o agendamento o cadastro da Anamnese, exame fisico e/ou Hipotese diagnóstica serão armazenados como ficha inicial do paciente. A inclusão do prontuário do paciente a ser cadastrado, contabilizará como uma consulta. * Obs: Para inclusão de hipotese diagnóstica é necessário possui número do conselho a qual pertece ou vincular algum profissional de saúde, caso o cadastrante seja admin do sistema.</i></h5>
       		<hr>
       		 <div class="form-group form-usuario col-md-12">
       		 <h3 class="h3-atendimento">Iniciar aconsulta agora?</h3>

        <p class="p-cartao"><a href="#" class="btn btn-primary botao-card" role="button" data-toggle="modal" data-target="#modal-lg">Iniciar Consulta</a>


           	 </div>

  </div>

     </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
            </div>
        </div>

    </div>
</div>

  <!-- /.modal -->

  <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Selecione ficha do prontuário</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <br>
            <div class="row ">
                <div class="col-sm-4">
                <div class="card " style="width: 18rm;">
                   <img src="{{asset('img/pf1.jpg')}}" alt="" class="card-img-top">
                   <div class="card-body">
                       <h3 class="card-title">Anamnese</h3>
                       <p class="card-text"></p>
                       <a href="{{route('anamnese.criar',$consulta->id)}}" class="btn btn-primary">selecionar</a>
                   </div>
                </div>
                </div>
                <div class="col-sm-4">
                <div class="card " style="width: 18rm;">
                   <img src="{{asset('img/pf2.jpg')}}" alt="" class="card-img-top ">
                   <div class="card-body">
                       <h3 class="card-title">Exame Fisico</h3>
                           <p class="card-text"></p>
                       <a href="{{route('exames_fisicos.criar',$consulta->id)}}" class="btn btn-primary">selecionar</a>
                   </div>
                </div>
                </div>
                <div class="col-sm-4">
                <div class="card " style="width: 18rm;">
                   <img src="{{asset('img/pf3.jpg')}}" alt="" class="card-img-top">
                   <div class="card-body">
                       <h3 class="card-title">Hipotese Diagnóstica</h3>
                       <p class="card-text"></p>
                       <a href="{{route('hipotise.criar',$consulta->id)}}" class="btn btn-primary">selecionar</a>
                   </div>
                </div>
                </div>
                      </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </section>



@endsection
@include ('layouts.datatable')
@section('script')
@parent
<script>
      $( function() {
        $('#datetimepicker4').datetimepicker({
                    format: 'L'
                });
  } );
  $('.select').select2();

</script>
@endsection

