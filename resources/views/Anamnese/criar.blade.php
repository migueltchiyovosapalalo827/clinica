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
                        <a href="{{route('anamnese.index')}}" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                <div class="row float-center">
                    <div class="col-sm-12">
                        <h4 class="page-title">Annaminese</h4>
                    </div>

                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                    <form action="{{route('anamnese.store')}}" method="post" class="form-horizontal" id="form">
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
      <label for="queixa_principal">Queixa principal</label>
      <input type="text" class="form-control @error('queixa_principal') is-invalid @enderror"  value="{{old('queixa_principal')}}" id="queixa_principal" name="queixa_principal" placeholder="queixa_principal">
      @error('queixa_principal')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror </div>
    <div class="form-group col-md-6">
      <label for="problemas_renais">Problemas renais</label>
      <input type="text" class="form-control @error('problemas_renais') is-invalid @enderror"  value="{{old('problemas_renais')}}" id="problemas_renais" name="problemas_renais" placeholder="problemas_renais">
      @error('problemas_renais')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>

  </div>
  <div class="form-row">
  <div class="form-group  col-md-6">
    <label for="reumastismo">Reumastismo</label>
    <input type="text" class="form-control @error('reumastismo') is-invalid @enderror"  value="{{old('reumastismo')}}" id="reumastismo" placeholder="reumastismo principal" name="reumastismo">
    @error('reumastismo')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-6">
    <label for="alergias">Alergias</label>
    <input type="text" class="form-control @error('alergias') is-invalid @enderror"  value="{{old('alergias')}}" id="alergias" placeholder="Telefone principal" name="alergias">
    @error('alergias')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>


  </div>
<div class="form-row">
<div class="form-group  col-md-6">
    <label for="problemas_grasticos">Problemas grasticos	</label>
    <input type="text" class="form-control @error('problemas_grasticos') is-invalid @enderror"  value="{{old('problemas_grasticos')}}" id="problemas_grasticos" placeholder="problemas_grasticos" name="problemas_grasticos">
    @error('problemas_grasticos')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group col-md-6">
      <label for="problemas_resperatorios">Problemas resperatorios</label>

  <input type="text" class="form-control @error('problemas_resperatorios') is-invalid @enderror"  value="{{old('problemas_resperatorios')}}" id="problemas_resperatorios" name="problemas_resperatorios"  placeholder="problemas_resperatorios">

      @error('problemas_resperatorios')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror

    </div>
</div>
  <div class="form-row">
  <div class="form-group  col-md-6">
    <label for="hepatite">hepatite</label>
  <select name="hepatite" id="hepatite" class="form-control @error('hepatite') is-invalid @enderror">
  <option >Seleciona um estado</option>
  <option value="1">tem</option>
  <option value="0">não</option>
  </select>
    @error('hepatite')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-6">
    <label for="diabetes">diabetes</label>
   <select class="form-control @error('diabetes') is-invalid @enderror"  id="diabetes" placeholder="diabetes" name="diabetes">
   <option >Seleciona um estado</option>
   <option value="1">tem</option>
   <option value="0">não</option>
   </select>

    @error('diabetes')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>

  </div>
<div class="form-row">
<div class="form-group  col-md-12">
    <label for="historia">historia</label>
   <textarea class="form-control @error('historia') is-invalid @enderror"   id="historia" placeholder="historia" name="historia" >
   {{old('historia')}}
   </textarea>

    @error('historia')
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

