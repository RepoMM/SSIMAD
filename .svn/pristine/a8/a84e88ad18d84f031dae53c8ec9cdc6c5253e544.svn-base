<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $aclass->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $aclass->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Aclasses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="aclasses form large-10 medium-9 columns">
    <?= $this->Form->create($aclass) ?>
    <fieldset>
        <legend><?= __('Edit Aclass') ?></legend>
        <?php
            echo $this->Form->input('group_id', ['options' => $groups]);
            echo $this->Form->input('date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
