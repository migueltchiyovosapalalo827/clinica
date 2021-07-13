@extends('layouts.starter')
@section('title', 'Prescrição realizada')

@include ('layouts.sidebar')

@section('content')
     <!-- Content Header (Page header) -->
     <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="page-title">Lista de Prescrição realizada</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Prescrição</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <section class="content">
  <div class="card card-default">
<div class="card card-default">
    <div class="card-header">
        <div class="card-tools">
            <div class="btn-group">
                <a href="{{ route('prescricao.create') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i>
                  prescriver medicamentos
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
</div>
<!-- /.card -->
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
            url: "{{ route('prescricao.index')}}",
            method: 'GET'
        },
        columnDefs: [{
            orderable: false,
            targets: [0,4]
        }],
        columns: [{
                'data': null
            },
            {
                'data': 'nomepaciente'
            },
            {
                'data': 'descricao'
            },
            {
                'data': 'created_at'
            },
            {
                "data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                                <a class="btn btn-primary" href="{{url('prescricao/${data.id}')}}"> <i class="fas fa-id-card m-r-5"></i></a>
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
                        url: `{{url('prescricao')}}/${$(this).attr('data-id')}`,
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
                            title: error.responseJSON.message,
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
