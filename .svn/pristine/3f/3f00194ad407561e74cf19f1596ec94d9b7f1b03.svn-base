<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Weight'), ['action' => 'edit', $weight->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Weight'), ['action' => 'delete', $weight->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weight->name)]) ?> </li>
        <li><?= $this->Html->link(__('List Weights'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weight'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assignments'), ['controller' => 'Assignments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assignment'), ['controller' => 'Assignments', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="weights view large-10 medium-9 columns">
    <h2><?= h($weight->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Group') ?></h6>
            <p><?= $weight->has('group') ? $this->Html->link($weight->group->group_number, ['controller' => 'Groups', 'action' => 'view', $weight->group->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($weight->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($weight->id) ?></p>
            <h6 class="subheader"><?= __('Weight') ?></h6>
            <p><?= $this->Number->format($weight->weight) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($weight->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($weight->modified) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Description') ?></h6>
            <?= $this->Text->autoParagraph(h($weight->description)) ?>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Assignments') ?></h4>
    <?php if (!empty($weight->assignments)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Description') ?></th>
            <th><?= __('Publication') ?></th>
            <th><?= __('Due') ?></th>
            <th><?= __('Attachment') ?></th>
            <th><?= __('Has Upload') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($weight->assignments as $assignments): ?>
        <tr>
            <td><?= h($assignments->id) ?></td>
            <td><?= h($assignments->name) ?></td>
            <td><?= h($assignments->description) ?></td>
            <td><?= h($assignments->publication) ?></td>
            <td><?= h($assignments->due) ?></td>
            <td><?= h($assignments->attachment) ?></td>
            <td><?= h($assignments->has_upload)? __('Yes'): __('No') ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Assignments', 'action' => 'view', $assignments->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Assignments', 'action' => 'edit', $assignments->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Assignments', 'action' => 'delete', $assignments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assignments->name)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
