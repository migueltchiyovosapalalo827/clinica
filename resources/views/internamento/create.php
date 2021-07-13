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
                        <h4 class="page-title">Formulário de internamento </h4>
                    </div>

                </div>
            </div>
            <div class="card-body">
         
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                    <form action="<?= base_url('internamento/manage') ?>" method="post" class="form-horizontal" id="form">
                    <?= csrf_field() ?>
                    <input type="hidden" value="<?= $medico ?>" name="medico" id="medico"/> 
                        <div class="row">
                            <div class="col-md-12">   
                                
                                    <div class="row">
                                    <div class="col-md-12">
   
                                            <div class="form-group ">
                        
                                                <label for="inputSkills" class="focus-label">Paciente</label>
                                  
                                <select class=" form-control select floating  <?= session('error.paciente') ? 'is-invalid' : '' ?>"  name="paciente"   id="paciente">
                                <option value="">seleciona o paciente</option>
                             <?php foreach ($pacientes as $paciente) { ?>
                                <option <?= $paciente['idp'] == old('paciente') ? 'selected' : '' ?> value="<?= $paciente['idp'] ?>"><?= $paciente['nome'] ?></option>
                            <?php } ?>
                            
                            </select>
                            <?php if (session('error.paciente')) { ?>
                                <h6 class="text-danger"><?= session('error.paciente') ?></h6>
                            <?php } ?>

                                            </div>
                                        </div>
                                   
                                     
                                    </div>
                                </div>
                            </div>
                    
                  
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="focus-label">Motivo do internamento</label>
                                    <input type="text" class="form-control floating <?= session('error.motivo') ? 'is-invalid' : '' ?>" value="<?= old('motivo') ?>"   name="motivo">
                                    <?php if (session('error.motivo')) { ?>
                                <div class="invalid-feedback">
                                    <h6><?= session('error.motivo') ?></h6>
                                </div>
                                <?php } ?>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                              
                            <div class="form-group ">
                        
                        <label  class="focus-label">Especialidade</label>
          
        <select class=" form-control select   <?= session('error.servico') ? 'is-invalid' : '' ?>"  name="servico">
        <option value="">seleciona a especialidade</option>
     <?php foreach ($servicos as $servico) { ?>
        <option <?= $servico['nome'] == old('servico') ? 'selected' : '' ?> value="<?= $servico['nome'] ?>"><?= $servico['nome'] ?></option>
    <?php } ?>
    
    </select>
   
    <?php if (session('error.servico')) { ?>
        <div class="invalid-feedback">
                                    <h6><?= session('error.servico') ?></h6>
                                </div>
                            <?php } ?>

                    </div>
          </div>

  </div>


                                <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="focus-label">Estado do Paciente No Momento de Internamento :</label>
                                    <select class="select form-control floating <?= session('error.estado') ? 'is-invalid' : '' ?>" name="estado">
<option value="">Escolhe um estado</option>
<option  value="melhorado"   <?= "melhorado" == old('estado') ? 'selected' : '' ?>> Melhorado</option>
<option  value="mesmo estado" <?= "mesmo estado" == old('estado') ? 'selected' : '' ?>> mesmo estado</option>
<option value="Agudizado"   <?= "Agudizado" == old('estado') ? 'selected' : '' ?>> Agudizado</option>
<option value="operação"  <?= "operação" == old('estado') ? 'selected' : '' ?>> Operação </option>
                                                </select> 
                                                
                                                <?php if (session('error.estado')) { ?>
                                <h6 class="text-danger"><?= session('error.estado') ?></h6>
                            <?php } ?>                               
                
                </div>            
              </div> 


                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="focus-label">Exames Fisicos</label>
                                    <textarea  rows="6" class="form-control floating <?= session('error.exames') ? 'is-invalid' : '' ?>" name="exames"> <?=old('exames')?></textarea>

                    <?php if (session('error.exames')) { ?>
                                <div class="invalid-feedback">
                                    <h6><?= session('error.exames') ?></h6>
                                </div>
                                <?php } ?>      
                
                </div>            
              </div>
              <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="focus-label">Resumo Sindrômico</label>
                                    <textarea  rows="6" class="form-control floating <?= session('error.resumo') ? 'is-invalid' : '' ?>" name="resumo"> <?=old('resumo')?></textarea>

                    <?php if (session('error.resumo')) { ?>
                                <div class="invalid-feedback">
                                    <h6><?= session('error.resumo') ?></h6>
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
    
<?= $this->endSection() ?>

