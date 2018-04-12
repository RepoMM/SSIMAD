<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<div>
<?php $i=1;?>
<h3>Material didáctico</h3>
    <div>
        <?php echo $this->Html->link('Agregar Entregable', [ 'controller' => 'entregables', 'action'=> 'add' ] )?>
    </div> 
<div class="materials index large-10 medium-9 columns">
<?php if($materials->count() != 0){?>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= __('id') ?></th>
            <th><?= __('name') ?></th>
            <th><?= __('type') ?></th>
            <th><?= __('description') ?></th>
            <th><?= __('course') ?></th>
            <th><?= __('professor') ?></th>
            <th><?= __('subject') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($materials as $material): ?>
        <tr>
            <td><?= $this->Number->format($i) ?></td>
            <td><?= h($material->name) ?></td>
            <td>
                <?= $material->type ?>
            </td>
            <td>
                <?= $material->description?>
            </td>
            <td>
                <?= $material->course ?>
            </td>
            <td>
                <?= $material->full_name ?>
            </td>
            <td><?= h($material->subject)?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit').'/'.__('Delete'), ['controller'=>'materials','action' => 'view', $material->id]) ?>
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