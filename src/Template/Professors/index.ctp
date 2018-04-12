<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Professor'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="professors index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('rfc') ?></th>
            <th><?= $this->Paginator->sort('names') ?></th>
            <th><?= $this->Paginator->sort('paternal_surname') ?></th>
            <th><?= $this->Paginator->sort('maternal_surname') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($professors as $professor): ?>
        <tr>
            <td><?= $this->Number->format($professor->id) ?></td>
            <td><?= h($professor->username) ?></td>
            <td><?= h($professor->names) ?></td>
            <td><?= h($professor->paternal_surname) ?></td>
            <td><?= h($professor->maternal_surname) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $professor->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $professor->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $professor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $professor->username)]) ?>
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
