<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Assignment'), ['action' => 'edit', $assignment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assignment'), ['action' => 'delete', $assignment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assignment->name)]) ?> </li>
        <li><?= $this->Html->link(__('List Assignments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assignment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weights'), ['controller' => 'Weights', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weight'), ['controller' => 'Weights', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="assignments view large-10 medium-9 columns">
    <h2><?= h($assignment->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Weight') ?></h6>
            <p><?= $assignment->has('weight') ? $this->Html->link($assignment->weight->name, ['controller' => 'Weights', 'action' => 'view', $assignment->weight->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($assignment->name) ?></p>
            <h6 class="subheader"><?= __('Attachment') ?></h6>
            <p><?= h($assignment->attachment) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($assignment->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Publication') ?></h6>
            <p><?= h($assignment->publication) ?></p>
            <h6 class="subheader"><?= __('Due') ?></h6>
            <p><?= h($assignment->due) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($assignment->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($assignment->modified) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Has Upload') ?></h6>
            <p><?= $assignment->has_upload ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Description') ?></h6>
            <?= $this->Text->autoParagraph(h($assignment->description)) ?>
        </div>
    </div>
</div>
