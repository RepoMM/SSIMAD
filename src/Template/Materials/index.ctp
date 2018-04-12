<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Material'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Material Types'), ['controller' => 'MaterialTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material Type'), ['controller' => 'MaterialTypes', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="materials index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('#') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('material_type_id') ?></th>
            <th><?= $this->Paginator->sort('description') ?></th>
            <th><?= $this->Paginator->sort('course_id') ?></th>
            <th><?= $this->Paginator->sort('professor_id') ?></th>
            <th><?= $this->Paginator->sort('subject') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>

    <tbody>
    <?php $id=0; foreach ($materials as $material){
        $id++;
    ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td>
                <?php  
                    echo $this->Html->link(
                        h($material->name_file),
                        'C:/wamp64/www/ssimad/webroot/files/materials/name/'.h($material->url)
                    );
                ?>    
            </td>
            <td><?= $material->has('material_type') ? $this->Html->link($material->material_type->name, ['controller' => 'MaterialTypes', 'action' => 'view', $material->material_type->id]) : '' ?></td>
            <td><?= h($material->description) ?></td>
            <td><?= $material->has('course') ? $this->Html->link($material->course->name, ['controller' => 'Courses', 'action' => 'view', $material->course->id]) : '' ?></td>
            <td><?= $material->has('professor') ? $this->Html->link($material->professor->full_name, ['controller' => 'Professors', 'action' => 'view', $material->professor->id]) : '' ?></td>
            <td><?= h($material->subject) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $material->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $material->id], ['confirm' => __('Are you sure you want to delete # {0}?', $material->name)]) ?>
            </td>
        </tr>

    <?php }?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
