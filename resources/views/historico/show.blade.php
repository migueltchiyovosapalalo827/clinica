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
                                <table id="table-prescricao" class="table table-striped custom-table">
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
        $.ajax({
            url: `{{route('historico.create')}}`,
            method: 'GET',
            dataType: 'JSON',

        }).done((response) => {


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
                    return `<span class="badge ${data.estado == 0 ? 'bg-success' : 'bg-danger'}">${data.estado == 0 ? '	confirmado' : '	não confirmado'}</span>`
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


            var tableprescricao = $('#table-prescricao').DataTable({
                destroy: true,
                autoWidth: false,
                order: [[1, 'asc']],
                data:response.prescricao,
                columns:[
                    {
                'data': null
            },

            {
                'data': 'descricao',
            },

            {
                'data': function(data){
                    now = new Date(data.created_at)
                  return now.toGMTString();
                }
            }
            ,           {
                "data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                                <a class="btn btn-primary" href="{{url('prescricao/${data.id}')}}"> <i class="fas fa-id-card m-r-5"></i></a>
                            </div>
                            </td>`
                }
            }


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




        tableprescricao.on('draw.dt', function() {
        var PageInfo = $('#table-prescricao').DataTable().page.info();
        tableprescricao.column(0, {
            page: 'current'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    tableprescricao.on('order.dt search.dt', () => {
        tableprescricao.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();



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


        }).fail((jqXHR, textStatus, errorThrown) => {
            Toast.fire({
                icon: 'error',
                title: jqXHR.responseJSON.messages.error,
            });
        })


    })



  </script>

@endsection
