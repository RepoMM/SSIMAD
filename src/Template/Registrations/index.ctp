<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Registration'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="registrations index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('group_id') ?></th>
            <th><?= $this->Paginator->sort('student_id') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($registrations as $registration): ?>
        <tr>
            <td>
                <?= $registration->has('group') ? $this->Html->link($registration->group->group_number, ['controller' => 'Groups', 'action' => 'view', $registration->group->id]) : '' ?>
            </td>
            <td>
                <?= $registration->has('student') ? $this->Html->link($registration->student->full_name, ['controller' => 'Students', 'action' => 'view', $registration->student->id]) : '' ?>
            </td>
            <td><?= h($registration->created) ?></td>
            <td><?= h($registration->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $registration->student_id,$registration->group_id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $registration->student_id,$registration->group_id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $registration->student_id,$registration->group_id], ['confirm' => __('Are you sure you want to delete # {0} {1}?', [$registration->student->full_name,$registration->group->group_number])]) ?>
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
