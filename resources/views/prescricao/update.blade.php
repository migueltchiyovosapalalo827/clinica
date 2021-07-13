

<!-- Include -->
<?= $this->include('App\Views\load\select2') ?>
<!-- Extend from layout index -->
<?= $this->extend('App\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    <div class="btn-group">
                        <a href="<?= base_url('/diagnostico/manage') ?>" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
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
                    <form action="<?= base_url( route_to('diagnostico-update', $diagnostico['diagmedico_id']))?>" method="post" class="form-horizontal" id="form">
                    <?= csrf_field() ?>
                    <input type="hidden" value="<?= $diagnostico['medico'] ?>" name="medico" id="medico"/> 
                        <div class="row">
                            <div class="col-md-12">   
                                
                                    <div class="row">
                                    <div class="col-md-12">
   
                                            <div class="form-group form-focus select-focus">
                        
                                                <label for="inputSkills" class="focus-label">Paciente</label>
                                  
                                <select class=" form-control select floating  <?= session('error.paciente') ? 'is-invalid' : '' ?>"  name="paciente"  data-placeholder="<?= lang('paciente') ?>"  id="paciente">
                                <option>seleciona o paciente</option>
                             
                            <?php foreach ($pacientes as $paciente) { ?>
                                <?php if ($paciente['idp'] == $diagnostico['paciente']) { ?>
                                    <option value="<?= $paciente['idp'] ?>" selected><?= $paciente['nome'] ?></option>
                                <?php } else { ?>
                                    <option value="<?= $paciente['idp'] ?>"><?= $paciente['nome'] ?></option>
                                <?php } ?>
                            <?php } ?>

                            </select>
                            <?php if (session('error.paciente')) { ?>
                                <h6 class="text-danger"><?= session('error.paciente') ?></h6>
                            <?php } ?>

                                            </div>
                                        </div>
                                   
                                        <div class="col-md-6">
                                            <div class="form-group form-focus select-focus">
                                                <p class="text-center"> 
                                                <label class="focus-label"> Data de Nascimento</label>
                                                <div class="cal-icon">
                                                    <input class="form-control floating " type="text" value=""  id="datanascimento" name="data" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus select-focus">
                                                <label class="focus-label ">Genero</label>
                                                <input class="form-control floating" type="text" value="" id="sexo" name="sexo" disabled>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                  
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="focus-label">Motivo da consulta</label>
                                    <input type="text" class="form-control floating <?= session('error.motivo') ? 'is-invalid' : '' ?>" value="<?= $diagnostico['motivo'] ?>"   name="motivo">
                                    <?php if (session('error.motivo')) { ?>
                                <div class="invalid-feedback">
                                    <h6><?= session('error.motivo') ?></h6>
                                </div>
                                <?php } ?>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="focus-label">Historia da doenca actual</label>
                                    <input type="text" class="form-control floating <?= session('error.hda') ? 'is-invalid' : '' ?>" value="<?= $diagnostico['hda'] ?>" name="hda">
                                    <?php if (session('error.hda')) { ?>
                                <div class="invalid-feedback">
                                    <h6><?= session('error.hda') ?></h6>
                                </div>
                                <?php } ?>
                                </div>
                                </div>

                                </div>
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="focus-label">Exames Fisicos</label>
                                    <textarea  rows="6" class="form-control floating <?= session('error.exames_fisicos') ? 'is-invalid' : '' ?>" name="exames_fisicos"><?= $diagnostico['exames_fisicos'] ?> </textarea>

                    <?php if (session('error.exames_fisicos')) { ?>
                                <div class="invalid-feedback">
                                    <h6><?= session('error.exames_fisicos') ?></h6>
                                </div>
                                <?php } ?>      
                
                </div>            
              </div>
                           
                           
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="focus-label">Hipotese de diagnostico</label>
									
						<input type="text" class="form-control floating <?= session('error.hipotese') ? 'is-invalid' : '' ?>" value="<?= $diagnostico['hipotese'] ?>" name="hipotese">
                        <?php if (session('error.hipotese')) { ?>
                                <div class="invalid-feedback">
                                    <h6><?= session('error.hipotese') ?></h6>
                                </div>
                                <?php } ?>
                                </div>
                                
                            </div>
                      
                    <div class="m-t-20 text-center">
                                <button  class="btn btn-primary submit-btn">Salvar</button>
                            </div>
    </form>
                   
                    </div>
                </div>
            
        </div>
    </div>
</div>
</div>
            

<?= $this->endSection() ?>

<?= $this->section('js') ?>
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
            url: `<?= base_url( '/paciente/manage' )?>/${valor}/show`,
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
<?= $this->endSection() ?>

