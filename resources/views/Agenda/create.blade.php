@extends('layouts.starter')
@section('title', 'Agenda de consulta')

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
              <li class="breadcrumb-item active">novo</li>
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
                        <a href="{{route('agenda.index')}}" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
                <div class="row float-center">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Agendar Consulta</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                    <form action="{{route('agenda.store')}}" method="post" class="form-horizontal">
                    <?= csrf_field() ?>
                            <div class="row">

                                <div class="col-md-12">
									<div class="form-group">
										<label> Nome do paciente</label>

                                        <select class="form-control select  @error('paciente') is-invalid @enderror "  name="paciente" >
                                       <option value=""> seleciona o paciente</option>
                             <?php foreach ($pacientes as $paciente) { ?>
                                <option <?= $paciente->id == old('paciente') ? 'selected' : '' ?> value="<?= $paciente->id ?>"><?= $paciente->dadosPessoais ? $paciente->dadosPessoais->nome : $paciente->name ?></option>
                            <?php } ?>
                            </select>
                            @error('paciente')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror

									</div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Medico</label>

                                        <select class="form-control select @error('medico') is-invalid @enderror" name="medico"  data-placeholder="medico" >
                                        <option value=""> seleciona o medico</option>
                                        <?php foreach ($medicos as $medico) { ?>
                                <option <?= $medico->id == old('medico') ? 'selected' : '' ?> value="<?= $medico->id ?>"><?= $medico->dadosPessoais->nome ?></option>
                            <?php } ?>
                            </select>
                            @error('medico')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Especialidade</label>
                                        <select class="form-control select  @error('especialidade') is-invalid @enderror" name="especialidade"  data-placeholder="especialidade" >
                                        <option value=""> seleciona a especialidade</option>
                                        <?php foreach ($especialidades as $especialidade) { ?>
                                <option <?= $especialidade->id == old('especialidade') ? 'selected' : '' ?> value="<?= $especialidade->id ?>"><?= $especialidade->nome ?></option>
                            <?php } ?>
                            </select>

                            @error('especialidade')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Data</label>
                    <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input @error('data') is-invalid @enderror" value="<?= old('data') ?>" name="data" data-target="#datetimepicker4"/>
                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                    </div>
                    @error('data')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                    </div>

                      </div>

                </div>
                     <div class="col-md-6">
                       <div class="form-group">
                         <label>Hora</label>

                  <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input @error('hora') is-invalid @enderror" value="<?= old('hora') ?>"  name="hora" data-target="#datetimepicker3"/>
                    <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-clock"></i></div>
                    </div>

                    @error('hora')
                 <div class="invalid-feedback">
                   <h6>{{$message}}</h6>
                        </div>
                     @enderror
                </div>

                     </div>
                          </div>
                            </div>

                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea cols="30" rows="4" class="form-control  @error('descricao') is-invalid @enderror" name="descricao"> <?=old('descricao')?></textarea>


                                @error('descricao')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label class="display-block">Estado da consulta</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="estado" id="product_active" value="0" checked>
									<label class="form-check-label" for="product_active">
									confirmado
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="estado" id="product_inactive" value="1">
									<label class="form-check-label" for="product_inactive">
									não confirmado
									</label>
								</div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Salvar</button>
                            </div>
                        </form>
                    </div>
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

<script type="text/javascript">
            $(function () {
                $('#datetimepicker4').datetimepicker({
                    format: 'L'
                });
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
            });
        </script>




@endsection



