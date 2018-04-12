<html>
<head>
	<title>Entregables</title>
</head>
<body>
	<?php  //var_dump($grades);?>
<div class="assigments index large-10 medium-9 columns">
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
    <div>
        <?php echo $this->Html->link('Agregar Entregable', [ 'controller' => 'entregables', 'action'=> 'add' ] )?>
    </div>
    <?php 
    	/*foreach ($grades as $g) {
            echo $g;
        }*/
    ?>
    <div class="assigments index large-10 medium-9 columns">
    	<table cellpadding="0" cellspacing="0">
	    	<thead>
		        <tr>
		            <th><?= $this->Paginator->sort('Name') ?></th>
		            <th><?= $this->Paginator->sort('Description') ?></th>
		            <th><?= $this->Paginator->sort('Publication') ?></th>
		            <th><?= $this->Paginator->sort('Due') ?></th>
		            <th><?= $this->Paginator->sort('Weight') ?></th>
		            <th><?= $this->Paginator->sort('File') ?></th>
		            <th class="actions"><?= __('Actions') ?></th>
		        </tr>
		    </thead>
	    	<tbody>
		    <?php foreach ($assignments as $assignments): ?>
		        <tr> <?php //name description created link_file Actions?>
		        	<td>
			        	<a href='/ssimad/entregables?assignment_id=<?= h($assignments->id)?>'>
			        			<?= h($assignments->name)?>		
			        	</a>
		            <td>
		                <?= h($assignments->description)?>
		            </td>
		            <td>
		                <?= h($assignments->publication)?>
		            </td>
		            <td>
		                <?= h($assignments->due)?>
		            </td>
		            <td><?=$assignments->has('weight') ? $this->Html->link($assignments->weight->name, ['controller' => 'Weights', 'action' => 'view', $assignments->weight->id]) : '' ?>
            		</td>
            		<td>
            			<?php
		        			if (h($assignments->attachment)==NULL) {
		        				echo 'Not file';	
		        			} else{
		        				echo $this->Html->link(
		                		'Download',
		                		'/files/assignments/file_name/'.h($assignments->attachment).'/'.h($assignments->file_name)
		                		);
		        			}
		        		?>
            		</td>
		            <td class="actions">
		            	<?= $this->Html->link(__('Edit'), ['action' => 'edit', $assignments->id]) ?>
		                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assignments->id], ['confirm' => __('Are you sure you want to delete # {0}?', [$assignments->name])]) ?>
		            </td>
		        </tr>
		    <?php endforeach; ?>
			</tbody>
	    </table>
	</div>
	<?php //Seccion destinada a mostrar la lista de los alumnos, para calificar la actividad?>
	<?php  
		if ($assignment_id!=NULL) {
	?>
	<?php  
		//Vamos a crear el form para poder realizar cambios en la tabla Grades
		$i=0;
		echo $this->Form->create($grades, ['controller' => 'entregables', 'action' => 'update_grades']);
	?>

	<div>
		<table cellpadding="0" cellspacing="0">
			<thead>
			    <tr>
				<th><?= $this->Paginator->sort('username') ?></th>
				<th><?= $this->Paginator->sort('name') ?></th>
				<th><?= $this->Paginator->sort('grade') ?></th>
				<th><?= $this->Paginator->sort('proffesor_comment') ?></th>
				</tr>
			</thead>
			<tbody>
			<div class="assigments index large-10 medium-9 columns">
				<?php
					foreach ($grades_info as $g){ 
						//var_dump($g);
						//echo $g['Grades.proffesor_comment'];
				?>
				<tr>
					<td>
					    <?php echo $g['student']['username']; ?>
					</td>
					<td>
					    <?php echo $g['student']['names'].' '.$g['student']['paternal_surname'].' '.$g['student']['maternal_surname'];?>
					</td>
					
					<td>
						<?php 
						echo $this->Form->hidden('updates_value['.$i.'][id]',['value'=>$g->id]);
						echo $this->Form->input('updates_value['.$i.'][value]',['value' => $g->value,'label'=>FALSE]);
						?>
					</td>
					<td>
						<?php

						//echo $this->Form->hidden('updates_pcomment['.$i.'][id]',['value'=>$g->id]);
						echo $this->Form->input('updates_value['.$i.'][professor_comment]',['value' => $g->professor_comment,'label'=>FALSE]);

						$i++;
						?>
					</td>
				</tr>
				<?php 
					} 
				?>
			</div>
			</tbody>
	</table>	
</div>	
<?php } ?>
<div>
	<?php //if(!empty($grades->toArray())){?>
		<?= $this->Form->button('Submit') ?>
		<?= $this->Form->end() ?>
	<?php//}?>
</div>
</body>
</html>