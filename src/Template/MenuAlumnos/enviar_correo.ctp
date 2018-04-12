<div>
    <div>
        Bienvenido(a) alumno(a) <?= $this->request->session()->read('Auth.User.full_name')?>
        </br>
        <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_alumnos', 'action' => 'index' ]) ?><br />
    </div>
    <h3>Enviar Correo</h3>
    <div>
    	<?php
    	   echo $this->Form->create( false, ['type' => 'text' ] );

    		echo $this->Form->input( 'De:' );
    		echo $this->Form->input( 'Para:' );
    		echo $this->Form->input( 'Asunto:' );
    		echo $this->Form->input( 'body', array( 'type' => 'textarea' ) );
    		echo $this->Form->button(__('Submit'));
    		echo $this->Form->end( );
    	?>
    <div>
</div>