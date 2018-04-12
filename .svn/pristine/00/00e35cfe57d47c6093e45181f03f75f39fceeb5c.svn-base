<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Aclass'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="aclasses index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('group_id') ?></th>
            <th><?= $this->Paginator->sort('date') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($aclasses as $aclass): ?>
        <tr>
            <td><?= $this->Number->format($aclass->id) ?></td>
            <td>
                <?= $aclass->has('group') ? $this->Html->link($aclass->group->id, ['controller' => 'Groups', 'action' => 'view', $aclass->group->id]) : '' ?>
            </td>
            <td><?= h($aclass->date) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $aclass->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $aclass->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $aclass->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclass->id)]) ?>
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
