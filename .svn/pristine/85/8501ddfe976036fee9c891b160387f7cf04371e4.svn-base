<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Aclass'), ['action' => 'edit', $aclass->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Aclass'), ['action' => 'delete', $aclass->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclass->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Aclasses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aclass'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="aclasses view large-10 medium-9 columns">
    <h2><?= h($aclass->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Group') ?></h6>
            <p><?= $aclass->has('group') ? $this->Html->link($aclass->group->id, ['controller' => 'Groups', 'action' => 'view', $aclass->group->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($aclass->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Date') ?></h6>
            <p><?= h($aclass->date) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($aclass->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($aclass->modified) ?></p>
        </div>
    </div>
</div>
