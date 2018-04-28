<div>
    <div>
        Bienvenido(a) alumno(a) <?= $this->request->session()->read('Auth.User.full_name')?>
        </br>
        <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_alumnos', 'action' => 'index' ]) ?><br />
    </div>
    <h3>Mensajes<h3>
    	<table>
    		<thead>
    			<tr>
    				<th>Titulo</th>
    				<th>Contenido</th>
    				<th>Fecha Publicacion</th>
    			</tr>
    		</thead>
    		<tbody>
                <?php
                    if( isset( $messages ) )
                    {
                ?>
    			<?php foreach( $messages as $msn  ): ?>
    			<tr>
    				<td><?php echo $msn->title?></td>
    				<td><?php echo $msn->body?></td>
    				<td><?php echo $msn->created ?></td>
    			</tr>
    			<?php endforeach; ?>
                <?php } ?>
    		</tbody>
    	</table>
</div>
