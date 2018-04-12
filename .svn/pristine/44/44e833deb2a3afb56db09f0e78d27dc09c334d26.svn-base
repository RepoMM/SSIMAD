<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $grade->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $grade->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Grades'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assignments'), ['controller' => 'Assignments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assignment'), ['controller' => 'Assignments', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="grades form large-10 medium-9 columns">
    <?= $this->Form->create($grade) ?>
    <fieldset>
        <legend><?= __('Edit Grade') ?></legend>
        <?php
            echo $this->Form->input('student_id', ['options' => $students]);
            echo $this->Form->input('assigment_id', ['options' => $assignments]);
            echo $this->Form->input('value');
            echo $this->Form->input('upload_date');
            echo $this->Form->input('file');
            echo $this->Form->input('student_comment');
            echo $this->Form->input('professor_comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
