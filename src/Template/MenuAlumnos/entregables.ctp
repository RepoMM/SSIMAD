<!DOCTYPE html>
<html>
<head>
	<title>Entregables</title>
</head>
<body>
	<div>
        Bienvenido(a) alumno(a) <?= $this->request->session()->read('Auth.User.full_name')?>
        </br>
        <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_alumnos', 'action' => 'index' ]) ?><br />
    </div>
    <h3>Entregables</h3>
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
	        <th><?= $this->Paginator->sort('File') ?></th>
	        <th><?= $this->Paginator->sort('Weight') ?></th>     
	    </tr>
	</thead>
	<tbody>
		<?php foreach ($assignments as $assignments): ?>
		<tr> <?php //name description created link_file Actions?>
		   	<td>
			    <a href='/ssimad/menu_alumnos/entregables?assignment_id=<?= h($assignments->id)?>'>
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
            <td><?=$assignments->has('weight') ? $this->Html->link($assignments->weight->name, ['controller' => 'Weights', 'action' => 'view', $assignments->weight->id]) : '' ?>
            </td>
		    </tr>
		<?php endforeach; ?>
	</tbody>
	</table>
	<?php  
	if ($assignment_true!=NULL) {
	?>
		<div class="assignments form large-10 medium-9 columns">
			<?php 
			foreach ($grades as $g):
				foreach ($assignment_info_id as $ai):
			?>
			<h3><?php echo $ai['name'];  ?></h3>
			<?php 
			//Vamos a verificar que el entregable aun este en fecha
			$fecha_actual = date("Y|m|d|H|i|s");
			$da=explode("|", $fecha_actual);
			//var_dump($da);
			if ($ai['due']!=NULL) {
				$de=explode("|",date_format($ai['due'], 'Y|m|d|H|i|s'));
				//var_dump($de);
				for ($i=0; $i < 6; $i++) { 
					if ($de[$i]>=$da[$i] && $i==2){
						echo 'Subir Entregable';
						if($ai['has_upload']==0) { ?>
							<h6><? echo 'Debes entregarlo directamente con tu profesor'; ?></h6>
							<?php		
						}else{
							//Debemos crear un formulario ?>
							<div>
							<?= $this->Form->create($grades, ['type' => 'file'])?> 
							<fieldset>
							<?php
							if(!empty($assignments->errors())){?>
        					<div class="error-message"><?= $assignments->errors()['status']['isExist']?></div> <?php }
							//echo $this->Form->hidden('student_id',['value' =>$student_id]);
							//echo $this->Form->hidden('assigment_id',['value'=>$assignment_id]);
							$fecha_upload = date('Y-m-d');
								echo $this->Form->input('student_comment');
								echo "Date Upload: ".$fecha_upload;
								echo $this->Form->hidden('upload_date',['default' => $fecha_actual]);
								echo $this->Form->input('file',['type' => 'file']);
							?>
							<h6><? echo 'La calificación actual de este entregable es: '.$g['value'];?></h6>
							</fieldset>
							<?= $this->Form->button('Submit') ?>
							<?= $this->Form->end() ?>
							</div>
				<?php
						}
					}else{
					if ($de[$i]<$da[$i]  && $i==2) { ?>
						<h5><?php echo 'Ya paso la fecha de entrega de esta tarea'; ?></h5>
						<h6><?php echo 'La calificación actual de este entregable es: '.$g['value'];?></h6>
						<?php break; }?>	
			<?php			
					}
			}
		}
			?>
		<?php 
			if ($g['professor_comment'!=NULL]) {
			 	echo $g['professor_comment']; 
			}
		endforeach; 
		endforeach;   
	}?>	
	</div>
</html>