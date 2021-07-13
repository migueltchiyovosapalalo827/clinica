@extends('layouts.starter')
@section('title', 'actualizar')

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
              <li class="breadcrumb-item"><a href="#">Usuario</a></li>
              <li class="breadcrumb-item active">actualizar</li>
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
                        <a href="{{ route('user.index') }}" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="col-md-12">
        <div class="card card-outline">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link  active " href="#settings" data-toggle="tab">{{'Dados de Acesso'}}</a></li>
                    <li class="nav-item"><a class="nav-link  " href="#funcionarios" data-toggle="tab">{{'Dados Pessoais'}}</a></li>
                    <li class="nav-item"><a class="nav-link  " href="#profissionais" data-toggle="tab">{{'Dados Profissionais'}}</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="tab-pane active " id="settings">
                    <form action="{{route('user.update',$user->id) }}" method="post" class="form-horizontal">
                           @method('PUT')
                           @csrf

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label">{{'email'}}</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value=" {{$user->email}}" placeholder="email" autocomplete="off">
                                  @error('email')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label">{{'nome'}}</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}" placeholder="{{'nome'}}" autocomplete="off">
                               @error('name')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                        <label for="inputSkills" class="col-sm-3 col-form-label"><?= ('Tipo de Utilizador') ?></label>
                        <div class="col-sm-7">
                            <select class="form-control select" name="tipo"  data-placeholder="<?= ('Tipo de Utilizador') ?>" style="width: 100%;">
                            <?php foreach ($permissions as $permission) { ?>

                                <option <?= in_array($permission, [$user->tipo]) ? 'selected' : '' ?> value="<?= $permission ?>"><?= $permission ?></option>
                            <?php } ?>
                            </select>
                            @error('tipo')

                                <h6 class="text-danger">{{$message}}</h6>

                                @enderror

                        </div>
                    </div>

                    </div>
                    <div class="tab-pane " id="funcionarios">

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nomeCompleto">Nome completo</label>
      <input type="text" class="form-control @error('nome') is-invalid @enderror"  value="{{$dadosPessoais->nome}}" id="nomeCompleto" placeholder="Nome completo" name="nome">

                               @error('nome')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
    </div>
    <div class="form-group col-md-6">
      <label for="bi">Numero do Bi</label>
      <input type="text" class="form-control @error('bi') is-invalid @enderror"  value="{{$dadosPessoais->bi}}" id="bi" placeholder="Numero do Bi" name="bi">
      @error('bi')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="nacionalidade">Nacionalidade</label>
      <input type="text" class="form-control @error('nacionalidade') is-invalid @enderror"  value="{{$dadosPessoais->nacionalidade}}" id="nacionalidade" name="nacionalidade">
      @error('nacionalidade')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>
    <div class="form-group col-md-4">
      <label for="sexo">Sexo</label>
      <select id="sexo" class="form-control @error('sexo') is-invalid @enderror"  value="{{$dadosPessoais->sexo}}" name="sexo">
        <option selected>Seleciona...</option>
        <option value="masculino"  {{ "masculino" == $dadosPessoais->sexo ? 'selected' : ''}}  > masculino</option>
        <option value="femenino"  {{ "femenino" == $dadosPessoais->sexo ? 'selected' : ''}} >femenino</option>
      </select>
      @error('sexo')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>
    <div class="form-group col-md-4 ">
        <label >Data de Nascimento</label>
        <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-inputfloat-right @error('data_nasc') is-invalid @enderror"  name="data_nasc" data-target="#datetimepicker4"/>
                      <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                      </div>
                  </div>

                  @error('data_nasc')
           <div class="invalid-feedback">
            <h6>{{$message}}</h6>
           </div>
           @enderror

      </div>

  </div>

  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="provincia">Provincia</label>
      <input type="text" class="form-control @error('provincia') is-invalid @enderror"  value="{{$dadosPessoais->provincia}}" id="provincia" name="provincia">
      @error('provincia')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror </div>
    <div class="form-group col-md-4">
      <label for="municipio">Municipio</label>
      <input type="text" class="form-control @error('municipio') is-invalid @enderror"  value="{{$dadosPessoais->municipio}}" id="municipio" name="municipio">
      @error('municipio')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>
    <div class="form-group col-md-4">
      <label for="bairro">Bairro</label>
      <input type="text" class="form-control @error('bairro') is-invalid @enderror"  value="{{$dadosPessoais->bairro}}" id="bairro" name="bairro">
      @error('bairro')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror

    </div>
  </div>
  <div class="form-row">
  <div class="form-group  col-md-6">
    <label for="telefone">Telefone Principal</label>
    <input type="text" class="form-control @error('telefone') is-invalid @enderror"  value="{{$dadosPessoais->telefone}}" id="telefone" placeholder="Telefone principal" name="telefone">
    @error('telefone')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-6">
    <label for="telefone_secundario">Telefone Secundario</label>
    <input type="text" class="form-control @error('telefone_secundario') is-invalid @enderror"  value="{{$dadosPessoais->telefone_secundario}}" id="telefone_secundario" placeholder="Telefone principal" name="telefone_secundario">
    @error('telefone_secundario')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  </div>
  </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane " id="profissionais">
                    <div class="card card-default">
          <!-- /.card-header -->
          <div class="card-body">

  <div class="form-row">
  <div class="form-group  col-md-6">
    <label for="tipo_conselho">Ttipo conselho / Ordem</label>
    <input type="text" class="form-control @error('nome') is-invalid @enderror"  value="{{$dadosProfissionais->tipo_conselho}}" id="tipo_conselho" placeholder="tipo conselho" name="tipo_conselho">
    @error('tipo_conselho')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-6">
    <label for="numero_registro">numero registro</label>
    <input type="text" class="form-control @error('numero_registro') is-invalid @enderror"  value="{{$dadosProfissionais->numero_registro}}" id="numero_registro" placeholder="numero de registro" name="numero_registro">
    @error('numero_registro')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  </div>

  <div class="form-row">
  <div class="form-group  col-md-6">
    <label for="profissao">profissao</label>
    <input type="text" class="form-control @error('profissao') is-invalid @enderror"  value="{{$dadosProfissionais->profissao}}" id="profissao" placeholder="profissao" name="profissao">
    @error('profissao')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror

  </div>
  <div class="form-group  col-md-6">
    <label for="especialidade">especialidade</label>
    <input type="text" class="form-control @error('especialidade') is-invalid @enderror"  value="{{$dadosProfissionais->especialidade}}" id="especialidade" placeholder="especialidade" name="especialidade">
    @error('especialidade')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          <div class="form-group row">
                           <div class="col-sm-10">
                               <div class="float-right">
                                   <div class="btn-group">
                                       <button type="submit" class="btn btn-sm btn-block btn-primary">
                                       {{'salvar'}}
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>
          </div>
        </div>
     </form>
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
    </section>
@endsection
@include ('layouts.datatable')
@section('script')
@parent
<script>
      $( function() {
        $('#datetimepicker4').datetimepicker({
                  defaultDate:"{{$dadosPessoais->data_nasc}}",
                    format: 'L'
                });
  } );
  $('.select').select2();

</script>
@endsection

