<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Group'), ['action' => 'edit', $group->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Group'), ['action' => 'delete', $group->id], ['confirm' => __('Are you sure you want to delete # {0}?',  $group->course->name.' '.$group->group_number)]) ?> </li>
        <li><?= $this->Html->link(__('List Groups'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Courses'), ['controller' => 'Courses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course'), ['controller' => 'Courses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Professors'), ['controller' => 'Professors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Professor'), ['controller' => 'Professors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Semesters'), ['controller' => 'Semesters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Semester'), ['controller' => 'Semesters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Aclasses'), ['controller' => 'Aclasses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aclass'), ['controller' => 'Aclasses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Messages'), ['controller' => 'Messages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message'), ['controller' => 'Messages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Registrations'), ['controller' => 'Registrations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Registration'), ['controller' => 'Registrations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weights'), ['controller' => 'Weights', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weight'), ['controller' => 'Weights', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="groups view large-10 medium-9 columns">
    <h2><?= h($group->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Course') ?></h6>
            <p><?= $group->has('course') ? $this->Html->link($group->course->name, ['controller' => 'Courses', 'action' => 'view', $group->course->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Professor') ?></h6>
            <p><?= $group->has('professor') ? $this->Html->link($group->professor->id, ['controller' => 'Professors', 'action' => 'view', $group->professor->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Semester') ?></h6>
            <p><?= $group->has('semester') ? $this->Html->link($group->semester->name, ['controller' => 'Semesters', 'action' => 'view', $group->semester->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Group Number') ?></h6>
            <p><?= h($group->group_number) ?></p>
            <h6 class="subheader"><?= __('Class Schedule') ?></h6>
            <p><?= h($group->class_schedule) ?></p>
            <h6 class="subheader"><?= __('Classroom') ?></h6>
            <p><?= h($group->classroom) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($group->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($group->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($group->modified) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Aclasses') ?></h4>
    <?php if (!empty($group->aclasses)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Group Id') ?></th>
            <th><?= __('Date') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($group->aclasses as $aclasses): ?>
        <tr>
            <td><?= h($aclasses->id) ?></td>
            <td><?= h($aclasses->group_id) ?></td>
            <td><?= h($aclasses->date) ?></td>
            <td><?= h($aclasses->created) ?></td>
            <td><?= h($aclasses->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Aclasses', 'action' => 'view', $aclasses->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Aclasses', 'action' => 'edit', $aclasses->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Aclasses', 'action' => 'delete', $aclasses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclasses->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Messages') ?></h4>
    <?php if (!empty($group->messages)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Group Id') ?></th>
            <th><?= __('Title') ?></th>
            <th><?= __('Body') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($group->messages as $messages): ?>
        <tr>
            <td><?= h($messages->id) ?></td>
            <td><?= h($messages->group_id) ?></td>
            <td><?= h($messages->title) ?></td>
            <td><?= h($messages->body) ?></td>
            <td><?= h($messages->created) ?></td>
            <td><?= h($messages->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Messages', 'action' => 'view', $messages->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Messages', 'action' => 'edit', $messages->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Messages', 'action' => 'delete', $messages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $messages->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Registrations') ?></h4>
    <?php if (!empty($group->registrations)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Group Id') ?></th>
            <th><?= __('Student Id') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($group->registrations as $registrations): ?>
        <tr>
            <td><?= h($registrations->group_id) ?></td>
            <td><?= h($registrations->student_id) ?></td>
            <td><?= h($registrations->created) ?></td>
            <td><?= h($registrations->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Registrations', 'action' => 'view', $registrations->student_id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Registrations', 'action' => 'edit', $registrations->student_id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Registrations', 'action' => 'delete', $registrations->student_id], ['confirm' => __('Are you sure you want to delete # {0}?', $registrations->student_id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Weights') ?></h4>
    <?php if (!empty($group->weights)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Group Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Description') ?></th>
            <th><?= __('Weight') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($group->weights as $weights): ?>
        <tr>
            <td><?= h($weights->id) ?></td>
            <td><?= h($weights->group_id) ?></td>
            <td><?= h($weights->name) ?></td>
            <td><?= h($weights->description) ?></td>
            <td><?= h($weights->weight) ?></td>
            <td><?= h($weights->created) ?></td>
            <td><?= h($weights->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Weights', 'action' => 'view', $weights->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Weights', 'action' => 'edit', $weights->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Weights', 'action' => 'delete', $weights->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weights->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
