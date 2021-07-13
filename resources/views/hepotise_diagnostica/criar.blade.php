@extends('layouts.starter')
@section('title', 'hipotise')

@include ('layouts.sidebar')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>hipotises</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">hipotise</a></li>
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
                        <a href="{{route('hipotise.index')}}" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                <div class="row float-center">
                    <div class="col-sm-12">
                        <h4 class="page-title">hipotise</h4>
                    </div>

                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                    <form action="{{route('hipotise.store')}}" method="post" class="form-horizontal" id="form">
                    <?= csrf_field() ?>
                    <div class="form-row">

<div class="col-md-12">
    <div class="form-group">
        <label> Nome do paciente</label>

        <select class="form-control select  @error('consulta_id') is-invalid @enderror "  name="consulta_id" >
            @foreach ($consulta as $consultas)
            @if($loop->first)
            <option value=""> seleciona o paciente</option>
            @break
            @endif
            @endforeach

@foreach ($consulta as $consultas)
<option {{ $consultas->id == old('consulta_id') ? 'selected' : '' }} value="{{ $consultas->id }}">{{ $consultas->paciente->user->dadosPessoais->nome}}</option>
@endforeach
</select>
@error('consulta_id')
<div class="invalid-feedback">
    <h6>{{$message}}</h6>
</div>
@enderror

    </div>
</div>
</div>


<div class="form-row">
    <div class="form-group col-md-6">
      <label for="hipotise">hipotise</label>
      <input type="text" class="form-control @error('hipotise') is-invalid @enderror"  value="{{old('hipotise')}}" id="hipotise" name="hipotise" placeholder="hipotise">
      @error('hipotise')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
         </div>
    <div class="form-group col-md-6">
      <label for="tipo_exame">tipo exame</label>
      <input type="text" class="form-control @error('tipo_exame') is-invalid @enderror"  value="{{old('tipo_exame')}}" id="tipo_exame" name="tipo_exame" placeholder="tipo_exame">
      @error('tipo_exame')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>

  </div>


  <div class="form-row">
  <div class="form-group  col-md-4">
    <label for="solicitar_exame">solicitar exame</label>
  <select name="solicitar_exame" id="solicitar_exame" class="form-control @error('solicitar_exame') is-invalid @enderror">
  <option >Seleciona uma resposta</option>
  <option value="1">sim</option>
  <option value="0">não</option>
  </select>
    @error('solicitar_exame')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="requer_iternacao">requer iternacao</label>
   <select class="form-control @error('requer_iternacao') is-invalid @enderror"  id="requer_iternacao" placeholder="requer_iternacao" name="requer_iternacao">
   <option >Seleciona uma resposta</option>
   <option value="1">sim</option>
   <option value="0">não</option>
   </select>

    @error('requer_iternacao')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="reque_urgencia">requer urgencia</label>
   <select class="form-control @error('reque_urgencia') is-invalid @enderror"  id="reque_urgencia" placeholder="reque_urgencia" name="reque_urgencia">
   <option >Seleciona uma resposta</option>
   <option value="1">sim</option>
   <option value="0">não</option>
   </select>

    @error('reque_urgencia')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  </div>
<div class="form-row">
<div class="form-group  col-md-12">
    <label for="diagnostico_final">diagnostico final</label>
   <textarea class="form-control @error('diagnostico_final') is-invalid @enderror"   id="diagnostico_final" placeholder="diagnostico_final" name="diagnostico_final" >
   {{old('diagnostico_final')}}
   </textarea>

    @error('diagnostico_final')
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

