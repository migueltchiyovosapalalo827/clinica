

@extends('layouts.starter')
@section('title', 'consulta relaizada')

@include ('layouts.sidebar')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Exames</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Detalhes</a></li>
              <li class="breadcrumb-item active">exame</li>
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
                        <a href="{{ route('exames.index') }}" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="col-md-12">
        <div class="card card-outline">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link  active " href="#detalhes" data-toggle="tab">Detalhe do Exames</a></li>
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
                  <dd class="col-sm-8">{{$exame->hipotise->prontuario->paciente->user->dadosPessoais->nome}}</dd>
                  <dt class="col-sm-4">medico</dt>
                  <dd class="col-sm-8">{{$exame->hipotise->consulta->profissional_saude->User->dadosPessoais->nome}}</dd>
                  <dt class="col-sm-4">Nome do exame</dt>
                  <dd class="col-sm-8">{{$exame->nome_exame}}</dd>
                  <dt class="col-sm-4">	material analizado</dt>
                  <dd class="col-sm-8"> {{$exame->material_analizado}} </dd>
                  <dt class="col-sm-4">finalidade</dt>
                  <dd class="col-sm-8"> {{$exame->finalidade}} </dd>
                  <dt class="col-sm-4">preparação previa</dt>
                  <dd class="col-sm-8"> {{$exame->preparacao_previa}} </dd>
                  <dt class="col-sm-4">valor normais</dt>
                  <dd class="col-sm-8"> {{$exame->valor_normais_descricao}} </dd>
                  <dt class="col-sm-4">valor anormais </dt>
                  <dd class="col-sm-8"> {{$exame->valor_arormaais_segnifica}} </dd>
                  <dt class="col-sm-4">nivel confiablidade</dt>
                  <dd class="col-sm-8"> {{$exame->nivel_confiablidade}} </dd>
                  <dt class="col-sm-4">Data e hora da realização do exame</dt>
                  <dd class="col-sm-8"> {{$exame->created_at}} </dd>
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

