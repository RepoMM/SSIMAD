<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<div class="students form large-10 medium-9 columns">
    <?php echo $this->Html->link('Regresar',['controller'=>'lista_alumnos','action'=>'index'])?>
    <?= $this->Form->create($student,['context' => ['validator' => 'addProf']]) ?>
    <fieldset>
        <legend><?= __('Add Student') ?></legend>
        <?php
            echo $this->Form->hidden('valid',['value'=>$new?1:0]);
            echo $this->Form->input('username',['label'=>__('Número de cuenta')]);
            if($new){
                echo $this->Form->input('names');
                echo $this->Form->input('paternal_surname');
                echo $this->Form->input('maternal_surname');
                echo $this->Form->input('email');
            }
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>