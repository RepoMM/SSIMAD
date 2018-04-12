<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Assignments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Weights'), ['controller' => 'Weights', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Weight'), ['controller' => 'Weights', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="assignments form large-10 medium-9 columns">
    <?= $this->Form->create($assignment) ?>
    <fieldset>
        <legend><?= __('Add Assignment') ?></legend>
        <?php
            echo $this->Form->input('weight_id', ['options' => $weights]);
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('publication');
            echo $this->Form->input('due');
            echo $this->Form->input('attachment');
            echo $this->Form->input('has_upload');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
