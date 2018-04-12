<div>
        Bienvenido(a) alumno(a) <?= $this->request->session()->read('Auth.User.full_name')?>
        </br>
        <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_alumnos', 'action' => 'index' ]) ?><br />
</div>
<div class="students form large-10 medium-9 columns">
    <h6 class="subheader"><?= __('Foto') ?></h6>
            <p><?php if($student->photo_mime!=NULL)
                        {
                            $string = stream_get_contents($student->photo);
                            echo '<img width="200px" src="data:image/jpg; base64,'.base64_encode($string).'">';
                            //echo $this->Html->image(array('controller'=>'animes','action'=>'download',$anime->id),array('alt'=>'This is a related file to a project','width'=>'350'));
                        }else{
                            echo 'No hay foto disponible';
                        } ?></p>
    <?= $this->Form->create($student,['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('Perfil') ?></legend>
        <label><?php echo __('Username')?></label><?php echo $student->username;?>
        <?php
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
    
            <?php echo $this->Html->link('Regresar',['controller'=>'menu_alumnos','action'=>'inicio']);?>
</div>
