<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Registration'), ['action' => 'edit',  $registration->student_id,$registration->group_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $registration->student_id,$registration->group_id], ['confirm' => __('Are you sure you want to delete # {0} {1}?', [$registration->student->full_name,$registration->group->group_number])]) ?></li>
        <li><?= $this->Html->link(__('List Registrations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Registration'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="registrations view large-10 medium-9 columns">
    <h2><?= h($registration->student_id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Student') ?></h6>
            <p><?= $registration->has('student') ? $this->Html->link($registration->student->full_name, ['controller' => 'Students', 'action' => 'view', $registration->student->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Group') ?></h6>
            <p><?= $registration->has('group') ? $this->Html->link($registration->group->group_number, ['controller' => 'Groups', 'action' => 'view', $registration->group->id]) : '' ?></p>
            
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($registration->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($registration->modified) ?></p>
        </div>
    </div>
</div>
