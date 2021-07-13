@extends('layouts.starter')
@section('title', 'Hipotise')

@include ('layouts.sidebar')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="page-title">Lista de Hipotise Realizada</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Hipotise</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
<div class="card card-default">
    <div class="card-header">
        <div class="card-tools">
            <div class="btn-group">
                <a href="{{route('hipotise.create')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i>
                   Cadastrar Hipotise
                </a>
            </div>

        </div>

    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="table-user" class="table table-striped custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome do paciente</th>
								<th>Medico que atendeu</th>
								<th>hipotise</th>
                                <th>solicitar exame</th>
                                <th>tipo de exame</th>
                                <th>requer iternacao</th>
                                <th>requer urgencia</th>
								<th class="text-right">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
    var tableUser = $('#table-user').DataTable({


        processing: true,
        serverSide: true,
        autoWidth: false,
        order: [[1, 'asc']],

        ajax: {
            url: "{{ route('hipotise.index') }}",
            method: 'GET'
        },
        columnDefs: [{
            orderable: false,
            targets: [0,3,5]
        }],
        columns: [{
                'data': null
            },

            {
                'data': 'nomepaciente'
            },

            {
                'data': 'medico'
            },
            {
                'data': 'hipotise'
            },

            {
                'data': function(data) {
                    return `<span class="badge ${data.solicitar_exame == 1 ? 'bg-success' : 'bg-danger'}">${data.solicitar_exame == 1 ? 'sim' : 'não'}</span>`
                }
            }
            ,
            {
                'data': 'tipo_exame'
            },
            {
                'data': function(data) {
                    return `<span class="badge ${data.requer_iternacao == 1 ? 'bg-success' : 'bg-danger'}">${data.requer_iternacao == 1 ? 'sim' : 'não'}</span>`
                }
            },
            {
                'data': function(data) {
                    return `<span class="badge ${data.reque_urgencia == 1 ? 'bg-success' : 'bg-danger'}">${data.reque_urgencia == 1 ? 'sim' : 'não'}</span>`
                }
            },

            {
                "data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                                <a class="btn btn-primary" href="{{url('hipotise/${data.id}')}}"> <i class="fas fa-id-card m-r-5"></i></a>
                                <a href="{{url('hipotise/${data.id}/edit')}}" class="btn btn-primary btn-edit"><i class="fas fa-user-edit"></i></a>
                                <button class="btn btn-danger btn-delete" data-id="${data.id}"><i class="fas fa-trash"></i></button>
                            </div>
                            </td>`
                }
            }
        ]
    });

    tableUser.on('draw.dt', function() {
        var PageInfo = $('#table-user').DataTable().page.info();
        tableUser.column(0, {
            page: 'current'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    $(document).on('click', '.btn-delete', function(e) {
        Swal.fire({
            title: 'Você tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, exclua!',
                cancelButtonText: 'Cancelar'
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: `{{url('hipotise')}}/${$(this).attr('data-id')}`,
                        method: 'DELETE',
                    }).done((data, textStatus, jqXHR) => {
                        Toast.fire({
                            icon: 'success',
                            title: jqXHR.responseJSON.message,
                        });
                        tableUser.ajax.reload();
                    }).fail((error) => {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.messages,
                        });
                    })
                }
            })
    });

    tableUser.on('order.dt search.dt', () => {
        tableUser.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
</script>
@endsection
