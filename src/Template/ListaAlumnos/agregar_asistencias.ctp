<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<div>
	<div>
		<span>
			Hola Profesor <?= $this->request->session()->read('Auth.User.full_name')?> 
			<br />
		    <?php echo $this->Html->link('Regresar',['controller'=>'lista_alumnos','action'=>'asistencias'])?>
		    <?= $this->Form->create($aclasses)?> 
		</span>
	</div>

	<div>
		
		<fieldset>
			<legend><?= __('Añadir Asistencia') ?></legend>
			<?php
			   	echo $this->Form->input('date');
			   	echo $this->Form->hidden('group_id',['value' => $group_id]);
			?>
		</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>