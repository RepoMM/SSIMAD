<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Professors'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="professors form large-10 medium-9 columns">
    <?= $this->Form->create($professor,['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('Add Professor') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('names');
            echo $this->Form->input('paternal_surname');
            echo $this->Form->input('maternal_surname');
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->label('foto');
            echo $this->Form->file('foto');
            echo $this->Form->error('foto');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
