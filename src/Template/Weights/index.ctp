<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Weight'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assignments'), ['controller' => 'Assignments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assignment'), ['controller' => 'Assignments', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="weights index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('group_id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('weight') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($weights as $weight): ?>
        <tr>
            <td><?= $this->Number->format($weight->id) ?></td>
            <td>
                <?= $weight->has('group') ? $this->Html->link($weight->group->group_number, ['controller' => 'Groups', 'action' => 'view', $weight->group->id]) : '' ?>
            </td>
            <td><?= h($weight->name) ?></td>
            <td><?= $this->Number->format($weight->weight) ?></td>
            <td><?= h($weight->created) ?></td>
            <td><?= h($weight->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $weight->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $weight->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $weight->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weight->name)]) ?>
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
