@extends('layouts.starter')
@section('title', 'home')

@include ('layouts.sidebar')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>home</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Clinica Esmelralda</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
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
            url: "{{ route('user.index') }}",
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
              'data': 'name'
            },
            {
                'data': 'tipo'
            },
            {
                'data': 'email'
            },
           {"data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                                <a href="{{url('user/${data.id}/edit')}}" class="btn btn-primary btn-edit"><i class="fas fa-pencil-alt"></i></a>
                                <button class="btn btn-danger btn-delete" data-id="${data.id}"><i class="fas fa-trash"></i></button>
                            </div>
                            </td>`
                }
            }
        ]
    });

    $(document).on('click', '.btn-delete', function(e) {
        Swal.fire({
                title: 'usuario',
                text: "Apagar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tens certeza que pretendes eliminar este usuario. está ação é irreversivel'
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: `{{ url('user')}}/${$(this).attr('data-id')}`,
                        method: 'DELETE',
                    }).done((data, textStatus, jqXHR) => {
                        Toast.fire({
                            icon: 'success',
                            title: jqXHR.statusText,
                        });
                        tableUser.ajax.reload();
                    }).fail((error) => {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.messages.error,
                        });
                    })
                }
            })
    });

    tableUser.on('draw.dt', function() {
        var PageInfo = $('#table-user').DataTable().page.info();
        tableUser.column(0, {
            page: 'current'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
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
