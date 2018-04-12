<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<div class="students form large-10 medium-9 columns">
    <?php if($weights->count() !=0){?>
    <?php echo $this->Html->link('Regresar',['controller'=>'lista_alumnos','action'=>'calificaciones'])?>
    <?php echo $this->Form->postLink('Borrar calificacion',['controller'=>'lista_alumnos','action'=>'borrar_calificacion',$assignment->id],['confirm' => __('Are you sure you want to delete # {0}?', $assignment->name)])?>
    <?= $this->Form->create($assignment) ?>
    <fieldset>
        <legend><?= __('Modificar calificación') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('weight_id', ['options' => $weights]);
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <?php }else{
        echo 'No hay conceptos agregados';
    }
?>
</div>