<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Attendances'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Aclasses'), ['controller' => 'Aclasses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Aclass'), ['controller' => 'Aclasses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="attendances form large-10 medium-9 columns">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Add Attendance') ?></legend>
        <?php if(!empty($attendance->errors())){?>
        <div class="error-message"><?= $attendance->errors()['status']['isExist']?></div>
        <?php }?>
        
        <?php
            echo $this->Form->input('class_id',['options' => $aclasses]);    
            echo $this->Form->input('student_id',['options' => $students]);
        ?>
        <?php
            echo $this->Form->input('value',['type'=>'checkbox']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
