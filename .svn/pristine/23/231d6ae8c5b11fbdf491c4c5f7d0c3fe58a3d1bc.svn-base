<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $attendance->class_id,$attendance->student_id],
                ['confirm' => __('Are you sure you want to delete # {0} {1}?', [$attendance->class_id,$attendance->student_id])]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Attendances'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Aclasses'), ['controller' => 'Aclasses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Aclass'), ['controller' => 'Aclasses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="attendances form large-10 medium-9 columns">
    <?= $this->Form->create($attendance) ?>
    <fieldset>
        <legend><?= __('Edit Attendance') ?></legend>
        <?php if(!empty($attendance->errors())){?>
        <div class="error-message"><?= $attendance->errors()['status']['isExist']?></div>
        <?php }?>
        <?php
            echo $this->Form->input('class_id',['options' => $aclasses]);
            echo $this->Form->input('student_id',['options' => $students]);
            echo $this->Form->input('aclass_id',['options' => $aclasses,'default'=>$attendance->class_id]);
            echo $this->Form->input('astudent_id',['options' => $students,'default'=>$attendance->student_id]);
            
        ?>
        <?php
            echo $this->Form->input('value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
