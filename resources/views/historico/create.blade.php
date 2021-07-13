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
                <div class="row float-center">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Agendar Consulta</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                    <form id="form" method="post" class="form-horizontal">
                    <?= csrf_field() ?>

                            <div class="row">

                                <div class="col-md-12">
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
                        <div class="input-group-prepend" data-target="#datetimepicker4" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                        </div>
                     <input type="text" class="form-control datetimepicker-input " value="<?= old('data') ?>" name="data" data-target="#datetimepicker4"/>


                    </div>

                      </div>

                </div>
                     <div class="col-md-6">
                       <div class="form-group" >
                         <label>Hora</label>

                  <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                    <div class="input-group-prepend" data-target="#datetimepicker3" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-clock"></i></div>
                    </div>
                    <input type="text" class="form-control datetimepicker-input " value="<?= old('hora') ?>"  name="hora" data-target="#datetimepicker3"/>

                </div>

                     </div>
                          </div>
                            </div>

                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea cols="30" rows="4" class="form-control " name="descricao"> <?=old('descricao')?></textarea>

                            </div>

                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" id="btnSave"><i class="fa fa-save"></i> salvar</button>
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


  $(document).on('click','#btnSave' ,function (e) {
        e.preventDefault();
        var  editForm = $('#form');
        var btnSave = $(this);
         $(btnSave).attr('disabled', true);
        $(btnSave).html('<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            url: `{{url('api/agenda')}}`,
            method: 'POST',
            data: editForm.serialize()
        }).done((data, textStatus, jqXHR) => {
            Toast.fire({
                icon: 'success',
                title: jqXHR.responseJSON.message,
            });
            btnSave.attr('disabled', false);
            btnSave.html('<i class="fa fa-save"></i> ' + "salvar");
        }).fail(( error) => {
            console.log(error);
          $.each(error.responseJSON.data, (elem, data) => {

                editForm.find('input[name="' + elem + '"]').addClass('is-invalid').after(
                    '<div class="invalid-feedback"><h6>'+data+'</h6></div>');
                    editForm.find('textarea[name="' + elem + '"]').addClass('is-invalid').after(
                    '<div class="invalid-feedback"><h6>'+data+'</h6></div>');
                });

            btnSave.attr('disabled', false);
            btnSave.html('<i class="fa fa-save"></i> ' + "salvar");
        })
    });



        </script>

@endsection



