<div>
    <div>
        Bienvenido(a) alumno(a) <?= $this->request->session()->read('Auth.User.full_name')?>
        </br>
        <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_alumnos', 'action' => 'index' ]) ?><br />
    </div>
<h3>Material Didáctico</h3>
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
                    if (h($material->url)==NULL) {
                        h($material->name_file);  
                    } elseif (h($material->url)!=NULL) {
                        echo $this->Html->link(
                        h($material->name_file),
                        '/files/materials/name/'.h($material->url).'/'.h($material->name)
                        );
                    }
                ?>
            </td>
            <td><?= $material->has('material_type') ? $this->Html->link($material->material_type->name, ['controller' => 'MaterialTypes', 'action' => 'view', $material->material_type->id]) : '' ?></td>
            <td><?= h($material->description) ?></td>
            <td><?= $material->has('course') ? $this->Html->link($material->course->name, ['controller' => 'Courses', 'action' => 'view', $material->course->id]) : '' ?></td>
            <td><?= $material->has('professor') ? $this->Html->link($material->professor->full_name, ['controller' => 'Professors', 'action' => 'view', $material->professor->id]) : '' ?></td>
            <td><?= h($material->subject) ?></td>
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
</div>
