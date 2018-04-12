<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_alumnos', 'action' => 'index' ]) ?>
    <br/>
</div>
<div class="registrations form large-10 medium-9 columns">
    <?= $this->Form->create($assignments, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Edit Assignments') ?></legend>
        <?php if(!empty($assignments->errors())){?>
        <div class="error-message"><?= $assignments->errors()['status']['isExist']?></div>
        <?php }?>
        <?php
            echo $this->Form->input('name',['default'=>$assignments->name]);
            echo $this->Form->input('description',['default'=>$assignments->description]);
            echo $this->Form->input('weight_id', ['options'=>$weight_id_options]);
            echo $this->Form->input('has_upload',['default'=>$assignments->has_upload]);
            echo $this->Form->input('file_name',['type' => 'file'],['default'=>$assignments->file_name]);
            echo $this->Form->input('publication',['default'=>$assignments->publication]);
            echo $this->Form->input('due',['default'=>$assignments->due]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
