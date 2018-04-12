<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Assignment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Weights'), ['controller' => 'Weights', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Weight'), ['controller' => 'Weights', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="assignments index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('weight_id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('publication') ?></th>
            <th><?= $this->Paginator->sort('due') ?></th>
            <th><?= $this->Paginator->sort('attachment') ?></th>
            <th><?= $this->Paginator->sort('has_upload') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($assignments as $assignment): ?>
        <tr>
            <td><?= $this->Number->format($assignment->id) ?></td>
            <td>
                <?= $assignment->has('weight') ? $this->Html->link($assignment->weight->name, ['controller' => 'Weights', 'action' => 'view', $assignment->weight->id]) : '' ?>
            </td>
            <td><?= h($assignment->name) ?></td>
            <td><?= h($assignment->publication) ?></td>
            <td><?= h($assignment->due) ?></td>
            <td><?= h($assignment->attachment) ?></td>
            <td><?= h($assignment->has_upload) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $assignment->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assignment->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assignment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assignment->name)]) ?>
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
