@extends('layouts.starter')
@section('title', 'Prescrição de medicamento')

@include ('layouts.sidebar')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Prescrição de medicamento</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Prescrição de medicamento</a></li>
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
                        <a href=" {{ route('prescricao.index') }}" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                <div class="row float-center">
                    <div class="col-sm-12">
                        <h4 class="page-title">prescrição Medica</h4>
                    </div>

                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                    <form action=" {{ route('prescricao.store') }}" method="post" class="form-horizontal" id="form">
                    <?= csrf_field() ?>
                    <div class="form-row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Nome do paciente</label>

                                <select class="form-control select  @error('paciente') is-invalid @enderror "  name="paciente" >
                               <option value=""> seleciona o paciente</option>
                        <?php foreach ( $consulta as $consultas) { ?>
                        <option <?= $consultas->id == old('paciente') ? 'selected' : '' ?> value="<?= $consultas->id ?>"><?= $consultas->paciente->user->dadosPessoais->nome?></option>
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

                 <div id="invoice_entry">
                    <div class="form-row">
                        <div class="form-group  col-md-4">
                          <label for="medicamento">medicamento</label>
                          <input type="text" class="form-control"   id="medicamento" placeholder="medicamento" name="medicamento[]">

                        </div>
                        <div class="form-group  col-md-4">
                          <label for="apresentacao">apresentacao</label>
                          <input type="text" class="form-control"   id="apresentacao" placeholder="apresentação" name="apresentacao[]">

                        </div>
                        <div class="form-group  col-md-4">
                          <label for="unidade">unidade</label>
                          <input type="text" class="form-control"   id="unidade" placeholder="unidade" name="unidade[]">

                        </div>


                            <div class="form-group  col-md-4">
                              <label for="valor">valor</label>
                              <input type="text" class="form-control  " id="valor" placeholder="valor " name="valor[]">

                            </div>
                            <div class="form-group  col-md-4">
                              <label for="posologia">posologia</label>
                              <input type="text" class="form-control "   id="posologia" placeholder="posologia" name="posologia[]">
                              @error('posologia')
                                   <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                   </div>
                                   @enderror
                            </div>
                             <div class="form-group col-md-4 ">
                                <label for="">remover campo</label>
                                 <button type="button"   class="btn form-control btn-danger" onclick="deleteParentElement(this)">- Campos</button>
                             </div>

                            </div>


                  </div>

                  <div class="row">
                  <div class="form-group col-md-12 ">
                            <label class="control-label">Obeservação</label>

                                <textarea name="obs" placeholder="Obeservação" class="form-control @error('obs') is-invalid @enderror" id="obs" placeholder="Obeservação">
                                {{old('obs')}}
                                </textarea>
                                @error('obs')
                                <div class="invalid-feedback">
                                 <h6>{{$message}}</h6>
                                </div>
                                @enderror

                        </div>
                  </div>

                    <div class="m-t-20 text-center">
                         <div class="modal-footer">
            <div class="text-sucess" id="texto"></div>
                <button type="button" id="btnadd" onclick="add_entry()" class="btn  btn-success"><i class="fa fa-plus "></i> mais campos</button>
                <button  class="btn btn-primary ">Salvar</button>

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
   var  blank_invoice_entry = "";

            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'

                });

    blank_invoice_entry = $('#invoice_entry').html();
            });
     </script>
     <script>

function add_entry()
    {
        $("#invoice_entry").append(blank_invoice_entry);
    }

function deleteParentElement(n) {
        n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
    }


     </script>

@endsection

