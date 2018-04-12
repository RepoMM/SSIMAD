<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<div>
<h3>Agregar Grupo</h3>
    <div>
        <?php echo $this->Html->link('Agregar Entregable', [ 'controller' => 'entregables', 'action'=> 'add' ] )?>
    </div>
<div class="groups form large-10 medium-9 columns">
    <?= $this->Form->create($group) ?>
    <fieldset>
        <legend><?= __('Add Group') ?></legend>
        <?php

            echo $this->Form->input( 'course_id', [ 'options' =>  $courses] );
            echo $this->Form->hidden( 'professor_id',[ 'value' => $professor ] );
            echo $this->Form->input( 'semester_id', [ 'options' => $semester ] );
            echo $this->Form->input( 'group_number' );
            echo $this->Form->input( 'class_schedule' );
            echo $this->Form->input( 'classroom' );

            
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
