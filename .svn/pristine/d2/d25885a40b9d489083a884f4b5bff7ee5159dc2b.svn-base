<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Grade'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assignments'), ['controller' => 'Assignments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assignment'), ['controller' => 'Assignments', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="grades index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('student_id') ?></th>
            <th><?= $this->Paginator->sort('assigment_id') ?></th>
            <th><?= $this->Paginator->sort('value') ?></th>
            <th><?= $this->Paginator->sort('upload_date') ?></th>
            <th><?= $this->Paginator->sort('file') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($grades as $grade): ?>
        <tr>
            <td><?= $this->Number->format($grade->id) ?></td>
            <td>
                <?= $grade->has('student') ? $this->Html->link($grade->student->id, ['controller' => 'Students', 'action' => 'view', $grade->student->id]) : '' ?>
            </td>
            <td>
                <?= $grade->has('assignment') ? $this->Html->link($grade->assignment->name, ['controller' => 'Assignments', 'action' => 'view', $grade->assignment->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($grade->value) ?></td>
            <td><?= h($grade->upload_date) ?></td>
            <td><?= h($grade->file) ?></td>
            <td><?= h($grade->created) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $grade->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $grade->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $grade->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grade->id)]) ?>
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
