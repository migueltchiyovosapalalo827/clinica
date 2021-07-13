@extends('layouts.starter')
@section('title', 'Historico')

@include ('layouts.sidebar')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Historico</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Historico</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="callout callout-info">
            <h5><i class="fab fa-accessible-icon"></i> Seleciona um Paciente para mostrar o seu historico:</h5>
             <!-- SEARCH FORM -->
    <form class="form-horizontal" id="form">
       <div class="row">
        <div class="col-md-8">
              <div class="form-group">
                <select class="form-control select2bs4" style="width: 100%;" name="prontuario" id="prontuario">
                  <option selected="selected"></option>
                  @forelse ($paciente as $pacientes)
                  <option value="{{$pacientes->prontuario->id}}">{{$pacientes->user->name}}</option>
                  @empty
                  <option>não existe paciente cadastro</option>
                  @endforelse

                </select>
              </div>
        </div>
        <div class="col-md-4">
        <button class="btn btn-success" id="buscar"><i class="fas fa-search"></i></button>
        </div>
            </div>
      </form>
          </div>


          <!-- Main content -->

          <div class="col-md-12"  id="historico">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Consultas Agendadas</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">consultas realizadas</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Exames Fisicos</a></li>
                  <li class="nav-item"><a class="nav-link" href="#recieta" data-toggle="tab">Prescrição feita</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="table-agenda" class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Especialidade</th>
                                            <th>Data da consulta</th>
                                            <th>Hora da consulta</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="table-consultas" class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Queixa Principal</th>
                                            <th>problemas renais</th>
                                            <th>problemas resperatorios</th>
                                            <th>reumastismo</th>
                                            <th>alergias</th>
                                            <th>Data e hora </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="table-exames" class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>peso</th>
                                            <th>altura</th>
                                            <th>pressao arterial sistolica</th>
                                            <th>pressao arterial diastolica</th>
                                            <th>frequencia cardiaca</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                   <!-- /.tab-pane -->

                   <div class="tab-pane" id="recieta">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="table-user" class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>descricao</th>
                                            <th>Data</th>
                                            <th >Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->

          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  @endsection
@section('script')
@include ('layouts.datatable')
@parent
<!-- Page script -->
<script>

    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });
    $('#historico').hide();
    })

    $("#buscar").on('click', function(e) {
        e.preventDefault();

        var editForm = $('#form');
        var valor = $('#prontuario option:selected').attr('value');
        if(valor != '' &&  valor != null){
        $.ajax({
            url: `{{route('historico.index')}}`,
            method: 'GET',
            dataType: 'JSON',
            data: editForm.serialize()

        }).done((response) => {

         /*   var tableAgenda = {};
            var tableConsultas =  {};
             var tableExames = {};
             if ($.isEmptyObject(tableAgenda)) {

             } else {

             }*/
            var tableAgenda = $('#table-agenda').DataTable({
                destroy: true,
                autoWidth: false,
                order: [[1, 'asc']],
                data:response.agenda,
                columns:[
                    {
                'data': null
            },

            {
                'data': 'servico.nome',
            },
            {
                'data': 'data_atendimento'
            },
            {
                'data': function(data){
                  return data.inicio_atendimento;
                }
            }
            ,
            {
                'data': function(data) {
                    return `<span class="badge ${data.estado == 1 ? 'bg-success' : 'bg-danger'}">${data.estado == 1 ? 'activo' : 'não activo'}</span>`
                }
            },

                ]
            });

            var tableConsultas = $('#table-consultas').DataTable({
                destroy: true,
                autoWidth: false,
                order: [[1, 'asc']],
                data:response.consultas,
                columns:[
                    {
                'data': null
            },

            {
                'data': 'queixa_principal',
            },
            {
                'data': 'problemas_renais'
            },
            {
                'data': 'problemas_resperatorios'
            },
            {
                'data': 'reumastismo'
            },
            {
                'data': 'alergias'
            },

            {
                'data': function(data){
                    now = new Date(data.created_at)
                  return now.toGMTString();
                }
            }
            ,


                ]
            });
            var tableExames = $('#table-exames').DataTable({
                destroy: true,
                autoWidth: false,
                order: [[1, 'asc']],
                data:response.examesFisicos,
                columns:[
                    {
                'data': null
            },

            {
                'data': 'peso'
            },
            {
                'data': 'altura'
            },
            {
                'data': 'pressao_arterial_sistolica'
            },
            {
                'data': 'pressao_arterial_diastolica'
            },

            {
                'data': 'frequencia_cardiaca'
            },


                ]
            });

            tableAgenda.on('draw.dt', function() {
        var PageInfo = $('#table-agenda').DataTable().page.info();
        tableAgenda.column(0, {
            page: 'current'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    tableAgenda.on('order.dt search.dt', () => {
        tableAgenda.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    tableConsultas.on('draw.dt', function() {
        var PageInfo = $('#table-consultas').DataTable().page.info();
        tableConsultas.column(0, {
            page: 'current'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    tableConsultas.on('order.dt search.dt', () => {
        tableConsultas.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
    tableExames.on('draw.dt', function() {
        var PageInfo = $('#table-exames').DataTable().page.info();
        tableExames.column(0, {
            page: 'current'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    tableExames.on('order.dt search.dt', () => {
        tableExames.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

            $('#historico').show();
        }).fail((jqXHR, textStatus, errorThrown) => {
            Toast.fire({
                icon: 'error',
                title: jqXHR.responseJSON.messages.error,
            });
        })


        } else {

        }
    });


  </script>

@endsection
