<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<div class="students form large-10 medium-9 columns">
    <?php if($weights->count() !=0){?>
    <?php echo $this->Html->link('Regresar',['controller'=>'lista_alumnos','action'=>'calificaciones'])?>
    <?= $this->Form->create($assignment) ?>
    <fieldset>
        <legend><?= __('Add Assignment') ?></legend>
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
