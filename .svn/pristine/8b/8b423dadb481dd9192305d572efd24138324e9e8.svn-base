<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Professor'), ['action' => 'edit', $professor->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Professor'), ['action' => 'delete', $professor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $professor->username)]) ?> </li>
        <li><?= $this->Html->link(__('List Professors'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Professor'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="professors view large-10 medium-9 columns">
    <h2><?= h($professor->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Rfc') ?></h6>
            <p><?= h($professor->username) ?></p>
            <h6 class="subheader"><?= __('Names') ?></h6>
            <p><?= h($professor->names) ?></p>
            <h6 class="subheader"><?= __('Paternal Surname') ?></h6>
            <p><?= h($professor->paternal_surname) ?></p>
            <h6 class="subheader"><?= __('Maternal Surname') ?></h6>
            <p><?= h($professor->maternal_surname) ?></p>
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= h($professor->email) ?></p>
            <h6 class="subheader"><?= __('Password') ?></h6>
            <p><?= h($professor->password) ?></p>
            <h6 class="subheader"><?= __('Foto') ?></h6>
            <p><?php if($professor->photo_mime!=NULL)
                        {
                            $string = stream_get_contents($professor->photo);
                            echo '<img width="200px" src="data:image/jpg; base64,'.base64_encode($string).'">';
                            //echo $this->Html->image(array('controller'=>'animes','action'=>'download',$anime->id),array('alt'=>'This is a related file to a project','width'=>'350'));
                        }else{
                            echo 'No hay foto disponible';
                        } ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($professor->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Last Login') ?></h6>
            <p><?= h($professor->last_login) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($professor->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($professor->modified) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Groups') ?></h4>
    <?php if (!empty($professor->groups)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Course') ?></th>
            <th><?= __('Semester') ?></th>
            <th><?= __('Group Number') ?></th>
            <th><?= __('Class Schedule') ?></th>
            <th><?= __('Classroom') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($professor->groups as $groups): ?>
        <tr>
            <td><?= h($groups->id) ?></td>
            <td><?= h($groups->course->name) ?></td>
            <td><?= h($groups->semester->name) ?></td>
            <td><?= h($groups->group_number) ?></td>
            <td><?= h($groups->class_schedule) ?></td>
            <td><?= h($groups->classroom) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Groups', 'action' => 'view', $groups->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Groups', 'action' => 'edit', $groups->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Groups', 'action' => 'delete', $groups->id], ['confirm' => __('Are you sure you want to delete # {0}?', $groups->course->name.' '.$groups->group_number )]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Materials') ?></h4>
    <?php if (!empty($professor->materials)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Material Type Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Private') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($professor->materials as $materials): ?>
        <tr>
            <td><?= h($materials->id) ?></td>
            <td><?= h($materials->material_type->name) ?></td>
            <td><?= h($materials->name) ?></td>
            <td><?= h($materials->private)? __('Yes'): __('No') ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Materials', 'action' => 'view', $materials->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Materials', 'action' => 'edit', $materials->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Materials', 'action' => 'delete', $materials->id], ['confirm' => __('Are you sure you want to delete # {0}?', $materials->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
