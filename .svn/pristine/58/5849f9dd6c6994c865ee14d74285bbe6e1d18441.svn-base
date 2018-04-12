<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Course'), ['action' => 'edit', $course->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Course'), ['action' => 'delete', $course->id], ['confirm' => __('Are you sure you want to delete # {0}?', $course->code)]) ?> </li>
        <li><?= $this->Html->link(__('List Courses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="courses view large-10 medium-9 columns">
    <h2><?= h($course->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Code') ?></h6>
            <p><?= h($course->code) ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($course->name) ?></p>
            <h6 class="subheader"><?= __('Syllabus Url') ?></h6>
            <p><?= h($course->syllabus_url) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($course->id) ?></p>
            <h6 class="subheader"><?= __('Credits') ?></h6>
            <p><?= $this->Number->format($course->credits) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($course->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($course->modified) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Groups') ?></h4>
    <?php if (!empty($course->groups)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Course Id') ?></th>
            <th><?= __('Professor Id') ?></th>
            <th><?= __('Semester Id') ?></th>
            <th><?= __('Group Number') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($course->groups as $groups): ?>
        <tr>
            <td><?= h($groups->id) ?></td>
            <td><?= h($groups->course_id) ?></td>
            <td><?= h($groups->professor_id) ?></td>
            <td><?= h($groups->semester_id) ?></td>
            <td><?= h($groups->group_number) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Groups', 'action' => 'view', $groups->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Groups', 'action' => 'edit', $groups->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Groups', 'action' => 'delete', $groups->id], ['confirm' => __('Are you sure you want to delete # {0}?', $groups->id)]) ?>

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
    <?php if (!empty($course->materials)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Material Type Id') ?></th>
            <th><?= __('Professor Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Private') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($course->materials as $materials): ?>
        <tr>
            <td><?= h($materials->id) ?></td>
            <td><?= h($materials->material_type_id) ?></td>
            <td><?= h($materials->professor_id) ?></td>
            <td><?= h($materials->name) ?></td>
            <td><?= h($materials->private)? __('Yes') : __('No') ?></td>

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
