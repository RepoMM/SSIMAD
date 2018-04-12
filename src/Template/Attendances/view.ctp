<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Attendance'), ['action' => 'edit', $attendance->class_id,$attendance->student_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Attendance'), ['action' => 'delete', $attendance->class_id,$attendance->student_id], ['confirm' => __('Are you sure you want to delete # {0} {1}?', [$attendance->aclass->date,$attendance->student->full_name])]) ?> </li>
        <li><?= $this->Html->link(__('List Attendances'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attendance'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Aclasses'), ['controller' => 'Aclasses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aclass'), ['controller' => 'Aclasses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="attendances view large-10 medium-9 columns">
    <h2><?= h($attendance->class_id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Aclass') ?></h6>
            <p><?= $attendance->has('aclass') ? $this->Html->link($attendance->aclass->date, ['controller' => 'Aclasses', 'action' => 'view', $attendance->aclass->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Student') ?></h6>
            <p><?= $attendance->has('student') ? $this->Html->link($attendance->student->full_name, ['controller' => 'Students', 'action' => 'view', $attendance->student->id]) : '' ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($attendance->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($attendance->modified) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Value') ?></h6>
            <p><?= $attendance->value ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
</div>
