<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<div>
    <div>
    <?php echo $this->Form->create(NULL,['controller'=>'lista_alumnos','action'=>'guardar_calificaciones']);?>
    <?php if(!empty($assignments->toArray())){?>
        <span><?php echo $this->Form->submit('Guardar'); ?></span>
        <span>|</span>
    <?php }?>
    <?php if(!empty($weights)){?>
        <span><?= $this->Html->link('Agregar calificación',['controller'=>'lista_alumnos','action'=>'agregar_calificacion'])?></span>
        <span>|</span>
    <?php }?>
    
    <span><?= $this->Html->link('Conceptos',['controller'=>'lista_alumnos','action'=>'conceptos'])?></span>
    
    

    </div>
    
    <div class=" large-block-grid-12 ">
    <?php if(!empty($assignments->toArray())){?>
        <?php $i = 1;$promedio;?>
        <table cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th><?= __('id') ?></th>
                <th><?= __('Número de cuenta') ?></th>
                <th><?= __('Nombre') ?></th>
                <?php $assignments = $assignments->toArray(); ksort( $assignments, SORT_NATURAL );
                ?>

                <?php foreach ($assignments as $name => $id): ?>
                <th><?= $this->Html->link($name.' ',['controller'=>'lista_alumnos','action'=>'modificar_calificacion',$id]) ?></th>
                <?php endforeach; ?>
                <th><?= __('Promedio') ?></th>
            </tr>
        </thead>
        <tbody>



        <?php foreach ($students_assignments as $student): $promedio=0;  ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= h($student->username) ?></td>
                <td><?= h($student->full_name_a) ?></td>
                        <?php $j=0; foreach ($student->info_grades as $grades):  

                                
                                $aux=$student->toArray(); 
                                $aux = $aux['info_grades'];


                            require_once(ROOT .DS. "vendor/" . DS  . "johann" . DS . "HelperClasses.php"); 
                            
                            $p = new HelperClasses;                           

                            $promediote = $p->promedio( $aux );

                        ?>

                            <!--<td><?//= $this->Form->input('calificaciones['.$grades->grade_id.']',['value'=>$grades->value,'label'=>FALSE],['div'=>FALSE]).' '.$student->id.' '.$grades->assigment_id ?></td>-->
                            <td>
                                <?php 
                                    echo $this->Form->hidden('calificaciones['.$i.']['.$j.'][id]',['value'=>$grades->grade_id]);
                                    echo $this->Form->input('calificaciones['.$i.']['.$j.'][value]',['value'=>$grades->value,'label'=>FALSE]);
                            ?>
                            </td>
                        <?php 
                            $promedio += $grades->value*$grades->weight/100;
                            $j+=1;
                        endforeach;?>
                <td><?= $promediote ?></td>
            </tr>
            <?php $i+=1;?>
            
        <?php endforeach; ?>
        </tbody>
        </table>
    <?php echo $this->Form->end(); ?>
    <?php }else {
        echo 'No se encontraron datos';
    } ?>
</div>
  
</div>