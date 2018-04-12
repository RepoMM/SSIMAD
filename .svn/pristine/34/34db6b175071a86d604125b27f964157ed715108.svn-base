<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $weight->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $weight->name)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Weights'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assignments'), ['controller' => 'Assignments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assignment'), ['controller' => 'Assignments', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="weights form large-10 medium-9 columns">
    <?= $this->Form->create($weight) ?>
    <fieldset>
        <legend><?= __('Edit Weight') ?></legend>
        <?php
            echo $this->Form->input('group_id', ['options' => $groups]);
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('weight');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
