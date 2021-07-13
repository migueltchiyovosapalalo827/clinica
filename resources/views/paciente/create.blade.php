@extends('layouts.starter')
@section('title', 'novo usuario')

@include ('layouts.sidebar')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Novo paciente</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">paciente</li>
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
                        <a href="{{ route('paciente.index') }}" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
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
                    <li class="nav-item"><a class="nav-link  " href="#profissionais" data-toggle="tab">{{'dados familiares'}}</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="tab-pane active " id="settings">
                    <form action="<?= route('paciente.store') ?>" method="post" class="form-horizontal">
                           {{ csrf_field()}}
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label">{{'email'}}</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value=" {{old('email')}}" placeholder="email" autocomplete="off">
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
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="{{'nome'}}" autocomplete="off">
                               @error('name')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-3 col-form-label">{{'password'}}</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" name="password" class="form-control @error('password') ? is-invalid @enderror" placeholder="{{'password'}}" autocomplete="off">
                                          @error('password')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-3 col-form-label">{{'repitir Password'}}</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="<?=('Password')?>" autocomplete="off">
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                                    </div>
                                </div>
                            </div>


                    </div>
                    <div class="tab-pane " id="funcionarios">

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nomeCompleto">Nome completo</label>
      <input type="text" class="form-control @error('nome') is-invalid @enderror"  value="{{old('nome')}}" id="nomeCompleto" placeholder="Nome completo" name="nome">

                               @error('nome')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
    </div>
    <div class="form-group col-md-6">
      <label for="bi">Numero do Bi</label>
      <input type="text" class="form-control @error('bi') is-invalid @enderror"  value="{{old('bi')}}" id="bi" placeholder="Numero do Bi" name="bi">
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
      <input type="text" class="form-control @error('nacionalidade') is-invalid @enderror"  value="{{old('nacionalidade')}}" id="nacionalidade" name="nacionalidade">
      @error('nacionalidade')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>
    <div class="form-group col-md-4">
      <label for="sexo">Sexo</label>
      <select id="sexo" class="form-control @error('sexo') is-invalid @enderror"  value="{{old('sexo')}}" name="sexo">
        <option selected>Seleciona...</option>
        <option value="masculino">masculino</option>
        <option value="femenino">femenino</option>
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
      <input type="text" class="form-control @error('provincia') is-invalid @enderror"  value="{{old('provincia')}}" id="provincia" name="provincia">
      @error('provincia')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror </div>
    <div class="form-group col-md-4">
      <label for="municipio">Municipio</label>
      <input type="text" class="form-control @error('municipio') is-invalid @enderror"  value="{{old('municipio')}}" id="municipio" name="municipio">
      @error('municipio')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>
    <div class="form-group col-md-4">
      <label for="bairro">Bairro</label>
      <input type="text" class="form-control @error('bairro') is-invalid @enderror"  value="{{old('bairro')}}" id="bairro" name="bairro">
      @error('bairro')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror

    </div>
  </div>
  <div class="form-row">
  <div class="form-group  col-md-4">
    <label for="telefone">Telefone Principal</label>
    <input type="text" class="form-control @error('telefone') is-invalid @enderror"  value="{{old('telefone')}}" id="telefone" placeholder="Telefone principal" name="telefone">
    @error('telefone')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="	telefone_secundario">Telefone Secundario</label>
    <input type="text" class="form-control @error('telefone_secundario') is-invalid @enderror"  value="{{old('telefone_secundario')}}" id="telefone_secundario" placeholder="Telefone principal" name="telefone_secundario">
    @error('telefone_secundario')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="naturalidade">naturalidade	</label>
    <input type="text" class="form-control @error('naturalidade') is-invalid @enderror"  value="{{old('naturalidade')}}" id="naturalidade" placeholder="naturalidade" name="naturalidade">
    @error('naturalidade')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>

  </div>

  <div class="form-row">
  <div class="form-group  col-md-4">
    <label for="estadocivil">estado civil</label>
    <input type="text" class="form-control @error('estadocivil') is-invalid @enderror"  value="{{old('estadocivil')}}" id="estadocivil" placeholder="Estado civil" name="estadocivil">
    @error('estadocivil')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="escolaridade">escolaridade	</label>
    <input type="text" class="form-control @error('escolaridade') is-invalid @enderror"  value="{{old('escolaridade')}}" id="escolaridade" placeholder="escolaridade" name="escolaridade">
    @error('escolaridade')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="profissao">profissao</label>
    <input type="text" class="form-control @error('profissao') is-invalid @enderror"  value="{{old('profissao')}}" id="profissao" placeholder="Estado civil" name="profissao">
    @error('profissao')
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
  <div class="form-group  col-md-8">
    <label for="tipo_conselho">nome</label>
    <input type="text" class="form-control @error('nome_f') is-invalid @enderror"  value="{{old('nome_f')}}" id="nome_f" placeholder="nome" name="nome_f">
    @error('nome_f')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="numero_registro">idade</label>
    <input type="text" class="form-control @error('idade') is-invalid @enderror"  value="{{old('idade')}}" id="idade" placeholder="idade" name="idade">
    @error('idade')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  </div>

  <div class="form-row">
  <div class="form-group  col-md-4">
    <label for="profissao">	parentesco</label>
    <input type="text" class="form-control @error('parentesco') is-invalid @enderror"  value="{{old('parentesco')}}" id="parentesco" placeholder="parentesco" name="parentesco">
    @error('parentesco')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror

  </div>
  <div class="form-group  col-md-4">
    <label for="email_f">email</label>
    <input type="email" class="form-control @error('email_f') is-invalid @enderror"  value="{{old('email_f')}}" id="email_f" placeholder="email" name="email_f">
    @error('email_f')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>

  <div class="form-group  col-md-4">
    <label for="telefone_f">telefone</label>
    <input type="text" class="form-control @error('telefone_f') is-invalid @enderror"  value="{{old('telefone_f')}}" id="telefone_f" placeholder="telefone" name="telefone_f">
    @error('telefone_f')
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
                    format: 'L'
                });
  } );

  $('.select').select2();

</script>
@endsection

