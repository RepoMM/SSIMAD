<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<div>
    <span><?= $this->Html->link('Agregar alumno',['controller'=>'lista_alumnos','action'=>'agregar_alumno'])?></span>
    <span>|</span>
    <span><?= $this->Html->link('Cargar lista de alumnos',['controller'=>'lista_alumnos','action'=>'lista'])?></span>
    <?php if($students->count() != 0){?>
        <span>|</span>
        <span><?= $this->Html->link('Calificaciones',['controller'=>'lista_alumnos','action'=>'calificaciones'])?></span>
        <span>|</span>
        <span><?= $this->Html->link('Asistencias',['controller'=>'lista_alumnos','action'=>'asistencias'])?></span>
    <?php }?>

</div>

<div class="students index large-10 medium-9 columns">
    <?php if($students->count() != 0){?>
    <?php $i = 1;?>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= __('id') ?></th>
            <th><?= __('Número de cuenta') ?></th>
            <th><?= __('Nombre') ?></th>
            <th><?= __('email') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= h($student->username) ?></td>
            <td><?= h($student->full_name_a) ?></td>
            <td><?= h($student->email) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['controller'=>'lista_alumnos', 'action'=>'editar_alumno', $student->id] );?>
                <?= $this->Form->postLink(__('Delete'), ['controller'=>'lista_alumnos','action' => 'borrar_alumno', $student->id, $group_id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->username)]) ?>
            </td>
        </tr>
        <?php $i+=1;?>
    <?php endforeach; ?>
    </tbody>
    </table>
    <?php }else {
        echo 'No se encontraron datos';
    } ?>
</div>

  
