<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Grade'), ['action' => 'edit', $grade->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Grade'), ['action' => 'delete', $grade->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grade->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Grades'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grade'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assignments'), ['controller' => 'Assignments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assignment'), ['controller' => 'Assignments', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="grades view large-10 medium-9 columns">
    <h2><?= h($grade->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Student') ?></h6>
            <p><?= $grade->has('student') ? $this->Html->link($grade->student->id, ['controller' => 'Students', 'action' => 'view', $grade->student->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Assignment') ?></h6>
            <p><?= $grade->has('assignment') ? $this->Html->link($grade->assignment->name, ['controller' => 'Assignments', 'action' => 'view', $grade->assignment->id]) : '' ?></p>
            <h6 class="subheader"><?= __('File') ?></h6>
            <p><?= h($grade->file) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($grade->id) ?></p>
            <h6 class="subheader"><?= __('Value') ?></h6>
            <p><?= $this->Number->format($grade->value) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Upload Date') ?></h6>
            <p><?= h($grade->upload_date) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($grade->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($grade->modified) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Student Comment') ?></h6>
            <?= $this->Text->autoParagraph(h($grade->student_comment)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Professor Comment') ?></h6>
            <?= $this->Text->autoParagraph(h($grade->professor_comment)) ?>
        </div>
    </div>
</div>
