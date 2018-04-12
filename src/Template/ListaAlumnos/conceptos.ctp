<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<?php $i = 0; $total = 0; ?>
<div class="students form large-12 medium-9 columns">
    <br/>
    Si la asistencia tiene un valor porcentual dentro de la calificación final, agregue el concepto de asistencia y asígnele el porcentaje correspondiente;por otro lado, si quiere que tanto el alumno como usted vean el porcentaje de asistencias, pero esta no tiene valor dentro de la calificación, agregue el concepto de asistencia y asígnele un porcentaje de 0. El porcentaje total de los conceptos debe ser igual a 100. También puede poner conceptos que tengan un valor de 0 anexos a los que sumen el 100%. 
</div>

<div class="weights form large-12 columns">
    <?= $this->Form->create(NULL) ?>
    <fieldset>
        <legend><?= __('Conceptos') ?></legend>
        
        <table>
            <thead>
                <tr>
                    <th>Concepto</th>
                    <th>Porcentaje %</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($array_weights as $weight): ?>


                <tr>
                    <td>
                        <?= $this->Form->hidden('weights['.$i.'][nw]',['value'=>$i]); ?>
                        <?= $this->Form->hidden('name',['disable'=>TRUE]); ?>

                        <?=
                            
                                   (empty($weight->name)) ? $this->Form->input('weights['.$i.'][name]',['value'=>$weight->name,'label'=>FALSE]) : $this->Form->input('weights['.$i.'][name]',['value'=>$weight->name,'label'=>FALSE, 'disabled' => 'disabled']); 
                           
                                    // $this->Form->input('weights['.$i.'][name]',['value'=>$weight->name,'label'=>FALSE]);                                  
                        ?>




                        <?php 
                        if(!empty($weight->errors()['name'])){
                            foreach ($weight->errors()['name'] as $key => $text)
                                echo $text.' ';
                        }
                            ?>
                    </td>
                    <td>
                        <?= 
                                    (empty($weight->name)) ? $this->Form->input('weights['.$i.'][weight]',['value'=>$weight->weight,'label'=>FALSE, 'div'=>['class'=>'hola']]) : $this->Form->input('weights['.$i.'][weight]',['value'=>$weight->weight,'label'=>FALSE, 'disabled'=>'disabled', 'div'=>['class'=>'hola']]); 

                        ?>
                        <?php 
                        if(!empty($weight->errors()['weight'])){
                            foreach ($weight->errors()['weight'] as $key => $text)
                                echo $text.' ';
                        }
                            ?>
                    </td>
                    <td>
                        <?php if(!is_null($weight->name) && !is_null($weight->weight)){
                            //echo $weight->id; 
                            echo $this->Html->link(__('Delete'),['controller'=>'lista_alumnos','action' => 'borrar_concepto', $weight->id],['confirm' => __('Are you sure you want to delete # {0}?', $weight->name)]);
                        }  else
                                //if( $total < 100  )
                                {
                                 echo $this->Form->button(__('Agregar'),['name' => 'agregar','value'=>'add']);
                            
                        }
                            ?>
                    </td>
                </tr>




                <?php 
                    $i += 1;
                    $total = $total + $weight->weight;
                    endforeach; 
                ?>


                <tr>
                    <td>Procentaje total debe ser igual a 100</td>
                    <td>Total:<?= $total ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
            
    </fieldset>
    
    <?php 

    //$this->request->session()->read('warning' );
                        
            if($total >= 100)
            {
                   echo $this->Form->button(__('Terminar'),['name' => 'terminar','value'=>'end']);
            }

            if( $total > 100 )
            {
    ?>
            <h3><h2>Advertencia:</h2>El porcentaje total debe ser igual a 100.</h3>

    <?php
            }
               
    ?>
    
    <?= $this->Form->end() ?>
            
</div>

