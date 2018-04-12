<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<div>
    <div>
        <?php 
        echo $this->Form->create(NULL,['controller'=>'menu_profesor','action'=>'seleccion']);
        echo $this->Form->input('grupo',['options'=>$groups,'onchange'=>'this.form.submit()','empty'=>'Selecciona una asignatura','default'=> empty($info_group)?'empty':$info_group->group_id]);
        echo $this->Form->end();
        <br/>
    </div>
<div class="messages form large-10 medium-9 columns">
    <?= $this->Form->create($message) ?>
    <fieldset>
        <legend><?= __('Add Message') ?></legend>
        <?php
            echo $this->Form->hidden('group_id', ['value' => $group_id]);
            echo $this->Form->input('title');
            echo $this->Form->input('body');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
