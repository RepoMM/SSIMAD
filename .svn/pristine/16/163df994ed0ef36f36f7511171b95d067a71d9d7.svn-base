<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Attendance'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Aclasses'), ['controller' => 'Aclasses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Aclass'), ['controller' => 'Aclasses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="attendances index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('class_id') ?></th>
            <th><?= $this->Paginator->sort('student_id') ?></th>
            <th><?= $this->Paginator->sort('value') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($attendances as $attendance): ?>
        <tr>
            <td>
                <?= $attendance->has('aclass') ? $this->Html->link($attendance->aclass->date, ['controller' => 'Aclasses', 'action' => 'view', $attendance->aclass->id]) : '' ?>
            </td>
            <td>
                <?= $attendance->has('student') ? $this->Html->link($attendance->student->full_name, ['controller' => 'Students', 'action' => 'view', $attendance->student->id]) : '' ?>
            </td>
            <td><?= h($attendance->value)? __('Yes'): __('No') ?></td>
            <td><?= h($attendance->created) ?></td>
            <td><?= h($attendance->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $attendance->class_id,$attendance->student_id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $attendance->class_id,$attendance->student_id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $attendance->class_id,$attendance->student_id], ['confirm' => __('Are you sure you want to delete # {0} {1}?', [$attendance->aclass->date,$attendance->student->full_name])]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
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
