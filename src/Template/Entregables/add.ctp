<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<div class="assignments form large-10 medium-9 columns">
    <div> 
        <?= $this->Form->create($assignments, ['type' => 'file'])?> 
        <fieldset>
        <legend><?= __('Add Entregables') ?></legend>      
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('weight_id', ['options' => $weight_id]);
            echo $this->Form->input('has_upload');
            echo $this->Form->input('file_name',['type' => 'file']);
            echo $this->Form->input('publication');
            echo $this->Form->input('due');
        ?>
        </fieldset>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>