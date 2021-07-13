<?= $this->include('App\Views\load\select2') ?>
<?= $this->include('App\Views\load\datatables') ?>
<!-- Extend from layout index -->
<?= $this->extend('App\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
<!-- SELECT2 EXAMPLE -->

<div class="card card-default">
    <div class="card-header">
        <div class="card-tools">
            <div class="btn-group">
                <a href="<?= base_url('internamento/manage/new') ?>" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i>
                    <?= lang('Internar um paciente') ?>
                </a>
            </div>
            
        </div>
        <div class="col-sm-4 col-3">
                        <h4 class="page-title">Lista de pacientes internados</h4>
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
                                <th>nome do paciente</th>
                                <th>Motivo do Internamento </th>
                                 <th>Dados Positivo Ao Exames</th>
                                <th>Departamento</th>
                                <th>Estado</th>
                                <th>Data </th>
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
<!-- /.card -->
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    var tableUser = $('#table-user').DataTable({
        
       dom: 'Bfrtip',
        buttons: [
           
            {
                extend: 'pdf',
                messageTop: 'Lista de pacientes internados'
                ,
                exportOptions: {
                    columns: [ 1,2, 3, 4, 5 ]
                }
            },
            {
                extend: 'csv',
                messageTop: 'Lista de pacientes internados'
                ,
                exportOptions: {
                    columns: [ 1,2, 3, 4, 5 ]
                }
            },
            {
                extend: 'print',
                messageTop: 'Lista de pacientes internados'
                ,
                exportOptions: {
                    columns: [ 1,2, 3, 4, 5 ]
                }
            },
            {
                extend: 'copy',
                messageTop: 'Lista de pacientes internados'
                ,
                exportOptions: {
                    columns: [ 1,2, 3, 4, 5 ]
                }
            },
        ],
        processing: true,
        serverSide: true,
        autoWidth: false,
        order: [[1, 'asc']],

        ajax: {
            url: '<?= base_url('/internamento/manage') ?>',
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
                'data': 'motivo'
            },
            {
                'data': 'exames'
          
            },
            {
                'data': 'servico'
            },
            {
                'data': 'estado_internacao'
            },
            {
                'data': 'created_at'
            },
           
         
            {
                "data": function(data) {
                    return `<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item  btn-edit" href="<?= base_url(route_to('internamento/manage')) ?>/${data.id}/edit"><i class="fa fa-pencil m-r-5"></i> Editar</a>
                                                    <a class="dropdown-item   btn-delete" data-id="${data.id}"    href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Eliminar</a>
                                                </div>
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
            title: '<?= lang('Você tem certeza?') ?>',
                text: "<?= lang('Você não poderá reverter isso!') ?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?= lang('Sim, exclua!') ?>',
                cancelButtonText: 'Cancelar'
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: `<?= base_url('/internamento/manage') ?>/${$(this).attr('data-id')}`,
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

    tableUser.on('order.dt search.dt', () => {
        tableUser.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
</script>
<?= $this->endSection() ?>