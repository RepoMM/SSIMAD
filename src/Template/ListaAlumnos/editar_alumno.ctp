<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<div class="students form large-10 medium-9 columns">
    <?= $this->Form->create($student,['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('Edit Student') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('names');
            echo $this->Form->input('paternal_surname');
            echo $this->Form->input('maternal_surname');
            echo $this->Form->input('email');
            echo $this->Form->input('password',['value' => '', 'placeholder'=>'******']);
            echo $this->Form->label('foto');
            echo $this->Form->file('foto');
            echo $this->Form->error('foto');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
