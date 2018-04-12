<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $registration->student_id,$registration->group_id],
                ['confirm' => __('Are you sure you want to delete # {0} {1}?', [$registration->student_id,$registration->group_id])]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Registrations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="registrations form large-10 medium-9 columns">
    <?= $this->Form->create($registration) ?>
    <fieldset>
        <legend><?= __('Edit Registration') ?></legend>
        <?php if(!empty($registration->errors())){?>
        <div class="error-message"><?= $registration->errors()['status']['isExist']?></div>
        <?php }?>
        <?php
            echo $this->Form->input('student_id',['options' => $students]);
            echo $this->Form->input('group_id',['options' => $groups]);
            echo $this->Form->input('astudent_id',['options' => $students,'default'=>$registration->student_id]);
            echo $this->Form->input('agroup_id',['options' => $groups,'default'=>$registration->group_id]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
