@extends('layouts.starter')
@section('title', 'Exames')

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
              <li class="breadcrumb-item"><a href="#">Exames</a></li>
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
                        <a href="{{route('exames.index')}}" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                <div class="row float-center">
                    <div class="col-sm-12">
                        <h4 class="page-title">Exames</h4>
                    </div>

                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                    <form action="{{route('exames.update',$exame->id)}}" method="post" class="form-horizontal" id="form">
                    @csrf
                    @method('put')
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Nome do paciente</label>
                        <input class="form-control @error('paciente') is-invalid @enderror" type="text" name="paciente" disabled value="{{$exame->hipotise->consulta->paciente->user->dadosPessoais->nome}}">
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
      <label for="nome_exame">nome do exame</label>
      <input type="text" class="form-control @error('nome_exame') is-invalid @enderror"  value="{{$exame->nome_exame}}" id="nome_exame" name="nome_exame" placeholder="nome_exame">
      @error('nome_exame')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror </div>
    <div class="form-group col-md-6">
      <label for="finalidade">finalidade</label>
      <input type="text" class="form-control @error('finalidade') is-invalid @enderror"  value="{{$exame->finalidade}}" id="finalidade" name="finalidade" placeholder="finalidade">
      @error('finalidade')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>
  </div>

  <div class="form-row">
  <div class="form-group  col-md-4">
    <label for="material_analizado">material analizado</label>
    <input type="text" class="form-control @error('material_analizado') is-invalid @enderror"  value="{{$exame->material_analizado}}" id="material_analizado" placeholder="material analizado " name="material_analizado">
    @error('material_analizado')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="preparacao_previa">preparação previa</label>
    <input type="text" class="form-control @error('preparacao_previa') is-invalid @enderror"  value="{{$exame->preparacao_previa}}" id="preparacao_previa" placeholder="preparação previa" name="preparacao_previa">
    @error('preparacao_previa')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="nivel_confiablidade">nivel de confiablidade</label>
    <input type="text" class="form-control @error('nivel_confiablidade') is-invalid @enderror"  value="{{$exame->nivel_confiablidade}}" id="nivel_confiablidade" placeholder="nivel de confiablidade" name="nivel_confiablidade">
    @error('nivel_confiablidade')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>

  </div>


  <div class="form-row">
    <div class="form-group  col-md-4">
      <label for="valor_normais_descricao">valor normais </label>
      <input type="text" class="form-control @error('valor_normais_descricao') is-invalid @enderror"  value="{{$exame->valor_normais_descricao}}" id="valor_normais_descricao" placeholder="valor normais" name="valor_normais_descricao">
      @error('valor_normais_descricao')
           <div class="invalid-feedback">
            <h6>{{$message}}</h6>
           </div>
           @enderror
    </div>
    <div class="form-group  col-md-4">
      <label for="valor_arormaais_segnifica">	valor arormais</label>
      <input type="text" class="form-control @error('valor_arormaais_segnifica') is-invalid @enderror"  value="{{$exame->valor_arormaais_segnifica}}" id="valor_arormaais_segnifica" placeholder="valor arormais" name="valor_arormaais_segnifica">
      @error('valor_arormaais_segnifica')
           <div class="invalid-feedback">
            <h6>{{$message}}</h6>
           </div>
           @enderror
    </div>
    <div class="form-group  col-md-4">
      <label for="prazo_resultado"> prazo do resultado</label>
      <input type="number" class="form-control @error('prazo_resultado') is-invalid @enderror"  value="{{$exame->prazo_resultado}}" id="prazo_resultado" placeholder="prazo do resultado" name="prazo_resultado">
      @error('prazo_resultado')
           <div class="invalid-feedback">
            <h6>{{$message}}</h6>
           </div>
           @enderror
    </div>

    </div>


<div class="form-row">
<div class="form-group  col-md-12">
    <label for="descricao_exame">	descrição</label>
   <textarea class="form-control @error('descricao_exame') is-invalid @enderror"   id="descricao_exame" placeholder="descricao_exame" name="descricao_exame" >
   {{$exame->descricao_exame}}
   </textarea>

    @error('descricao_exame')
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



@endsection

