<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<div>
    <div>
        <h3>Asistencias</h3>
    </div>
    	<?php 

    		//$this->Html->link('Agregar asistencia',['controller'=>'lista_alumnos','action'=>'asistencias'])
    		//echo $this->Html->link('Agregar asistencia',['controller'=>'lista_alumnos','action'=>'asistencias']);
    		echo $this->Html->link(__('Agregar Asistencia'),['controller'=>'lista_alumnos','action' => 'agregar_asistencias']);

            $updates = [];
            $class_student = [];
            $numero_asistencias=0;
        ?>

    <?php 
        echo $this->Form->create($aclass, ['controller' => 'attendances', 'action' => 'update_attendance']);
        $i=0; $j=0;
    ?>

    <table>
        <thead>
            <th>ID</th>
            <th>Número de Cuenta</th>
            <th>Nombre</th>
            <th>Correo</th>
                <?php foreach($aclass as $a):?>
                    <th><?php echo $a['date'].' '.$a['id']?></th>
                <?php endforeach;?>
        </thead>

        <?php 
            foreach($data as $d): 
        ?> 
        <tr>
            <td>
            <?php 
                echo $i+1;
            ?>
            </td>
            <td>
            <?php 
                echo $d['username']
            ?>    
            </td>
            <td>
            <?php 
                echo $d['paternal_surname'].' '.$d['maternal_surname'].' '.$d['names']
            ?>
            </td>
            <td>
            <?php 
                echo $d['email']
            ?>
            </td>

            <!--Iteracion para las asistencias de cada alumno-->
            <?php foreach($aclass as $a):?>
            <td>
                <?php foreach ($data_class as $ac):?>
                    <?php
                    

                    if ($d['id'] == $ac['student_id'] and $a['id'] == $ac['class_id']) {
                        //echo 'ID_CLASS: '.$ac['class_id'].'  ID_S: '.$ac['student_id'].' VALUE: '.$ac['value'];
                        //echo "i= ".$i.' j= '.$j;
                        if ($ac['value']==false) {
                            $ac['value']=true;
                            //var_dump($ac['value']);
                        } elseif ($ac['value']==true) {
                            $ac['value']=false;
                            //var_dump($ac['value']);
                        }
                        //echo $this->Form->hidden('asistencias['.$i.']['.$j.'][id]',['value'=>$ac->id]);
                        echo $this->Form->hidden('asistencias['.$i.']['.$j.'][class_id]',['value'=>$ac->class_id]);
                        echo $this->Form->hidden('asistencias['.$i.']['.$j.'][student_id]',['value'=>$ac->student_id]);
                        echo $this->Form->checkbox('asistencias['.$i.']['.$j.'][value]',['value'=>$ac->value]);
                    }
                    ?>         
                <?php endforeach;
                    $j++;
                ?>
            </td>
            <?php endforeach;?>
            <?php $i++; ?>
        </tr>
       <?php endforeach; ?>
    </table>
    <div>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div> 