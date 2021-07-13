@extends('layouts.starter')
@section('title', 'Agenda de consulta')

@include ('layouts.sidebar')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Anamneses</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Anamnese</a></li>
              <li class="breadcrumb-item active">Actualizar</li>
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
                        <a href="{{route('exames_fisicos.index')}}" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                <div class="row float-center">
                    <div class="col-sm-12">
                        <h4 class="page-title">Exames fisicos</h4>
                    </div>

                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                    <form action="{{route('exames_fisicos.update', $exame_fisico->id)}}" method="post" class="form-horizontal" id="form">
                    @method('PUT')
                     @csrf
                    <div class="form-row">

<div class="col-md-12">
    <div class="form-group">
        <label> Nome do paciente</label>
        <input type="text" class="form-control @error('paciente') is-invalid @enderror"  value="{{$exame_fisico->consulta->paciente->user->dadosPessoais->nome}}" id="paciente" name="paciente" placeholder="paciente">

@error('paciente')
<div class="invalid-feedback">
    <h6>{{$message}}</h6>
</div>
@enderror

    </div>
</div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="altura">Altura</label>
      <input type="text" class="form-control @error('altura') is-invalid @enderror"  value="{{$exame_fisico->altura}}" id="aura" name="altura" placeholder="altura">
      @error('altura')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
        </div>
    <div class="form-group col-md-6">
      <label for="peso">Peso</label>
      <input type="text" class="form-control @error('peso') is-invalid @enderror"  value="{{$exame_fisico->peso}}" id="peso" name="peso" placeholder="peso">
      @error('peso')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>

  </div>
  <div class="form-row">
  <div class="form-group  col-md-4">
    <label for="pressao_arterial_sistolica">pressao arterial sistolica</label>
    <input type="text" class="form-control @error('pressao_arterial_sistolica') is-invalid @enderror"  value="{{$exame_fisico->pressao_arterial_sistolica}}" id="pressao_arterial_sistolica" placeholder="pressao_arterial_sistolica" name="pressao_arterial_sistolica">
    @error('pressao_arterial_sistolica')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="pressao_arterial_diastolica">pressao arterial diastolica</label>
    <input type="text" class="form-control @error('pressao_arterial_diastolica') is-invalid @enderror"  value="{{$exame_fisico->pressao_arterial_diastolica}}" id="pressao_arterial_diastolica" placeholder="pressao_arterial_diastolica" name="pressao_arterial_diastolica">
    @error('pressao_arterial_diastolica')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="frequencia_cardiaca">frequencia cardiaca</label>
    <input type="text" class="form-control @error('frequencia_cardiaca') is-invalid @enderror"  value="{{$exame_fisico->frequencia_cardiaca}}" id="frequencia_cardiaca" placeholder="frequencia_cardiaca" name="frequencia_cardiaca">
    @error('frequencia_cardiaca')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>

  </div>

<div class="form-row">
<div class="form-group  col-md-12">
    <label for="observacao_gerais">	observacões gerais</label>
   <textarea class="form-control @error('observacao_gerais') is-invalid @enderror"   id="observacao_gerais" placeholder="observacao_gerais" name="observacao_gerais" >
   {{$exame_fisico->observacao_gerais}}
   </textarea>

    @error('observacao_gerais')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
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
<script>
    $('.select').select2();

</script>
<script>
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'

                });
            });
     </script>
     <script>

           $(document).on('change', "select[name='paciente'] ", function(e) {
        e.preventDefault();
        var editForm = $('#form');
        var valor = $('#paciente option:selected').attr('value');
        if(valor != '' &&  valor != null){
        $.ajax({
            url: `<?= url( '/' )?>/${valor}/show`,
            method: 'GET',
            dataType: 'JSON'

        }).done((response) => {
            console.log(response.sexo+response.datanascimento)
           $("#sexo").val(response.sexo);
            $("#datanascimento").val(response.datanascimento);


        }).fail((jqXHR, textStatus, errorThrown) => {
            Toast.fire({
                icon: 'error',
                title: jqXHR.responseJSON.messages.error,
            });
        })} else {
             $("#sexo").val("");
            $("#datanascimento").val("");
        }
    });

     </script>



@endsection

