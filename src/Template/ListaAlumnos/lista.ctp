<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<div> 
    <div class="students form large-10 medium-9 columns">
        <?= $this->Form->create(NULL,['enctype' => 'multipart/form-data']) ?>
        <fieldset>
            <legend><?= __('Cargar Lista de Alumnos') ?></legend>
            <?php
                echo $this->Form->file('archivo-a-subir');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Seleccionar archivo')) ?>
        <?= $this->Form->end() ?>

    </div>
    <div class="students form large-10 medium-9 ">
        El archivo se puede conseguir de la página de USECAD en la sección de profesores. Por el momento sólo se acepta en este formato.
    </div>
    <br/>
    <div class="students form large-10 medium-9 ">
        <span>Importante: Al momento de bajar el archivo de USECAD se debe guardar sin abrirlo para conservar el formato original (HTML). Si se abre el archivo y se guarda, el SIAEFI marcará error al cargarlo.</span>
    </div>






  
</div>