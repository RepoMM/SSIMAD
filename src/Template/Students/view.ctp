<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Student'), ['action' => 'edit', $student->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->username)]) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Attendances'), ['controller' => 'Attendances', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attendance'), ['controller' => 'Attendances', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Grades'), ['controller' => 'Grades', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grade'), ['controller' => 'Grades', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Registrations'), ['controller' => 'Registrations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Registration'), ['controller' => 'Registrations', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="students view large-10 medium-9 columns">
    <h2><?= h($student->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Username') ?></h6>
            <p><?= h($student->username ) ?></p>
            <h6 class="subheader"><?= __('Names') ?></h6>
            <p><?= h($student->names) ?></p>
            <h6 class="subheader"><?= __('Paternal Surname') ?></h6>
            <p><?= h($student->paternal_surname) ?></p>
            <h6 class="subheader"><?= __('Maternal Surname') ?></h6>
            <p><?= h($student->maternal_surname) ?></p>
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= h($student->email) ?></p>
            <h6 class="subheader"><?= __('Password') ?></h6>
            <p><?= h($student->password) ?></p>
            <h6 class="subheader"><?= __('Foto') ?></h6>
            <p><?php if($student->photo_mime!=NULL)
                        {
                            $string = stream_get_contents($student->photo);
                            echo '<img width="200px" src="data:image/jpg; base64,'.base64_encode($string).'">';
                            //echo $this->Html->image(array('controller'=>'animes','action'=>'download',$anime->id),array('alt'=>'This is a related file to a project','width'=>'350'));
                        }else{
                            echo 'No hay foto disponible';
                        } ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($student->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Last Login') ?></h6>
            <p><?= h($student->last_login) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($student->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($student->modified) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Attendances') ?></h4>
    <?php if (!empty($student->attendances)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Class Id') ?></th>
            <th><?= __('Value') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($student->attendances as $attendances): ?>
        <tr>
            <td><?= h($attendances->class_id) ?></td>
            <td><?= h($attendances->value) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Attendances', 'action' => 'view', $attendances->class_id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Attendances', 'action' => 'edit', $attendances->class_id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Attendances', 'action' => 'delete', $attendances->class_id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendances->class_id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Grades') ?></h4>
    <?php if (!empty($student->grades)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Assigment Id') ?></th>
            <th><?= __('Value') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($student->grades as $grades): ?>
        <tr>
            <td><?= h($grades->id) ?></td>
            <td><?= h($grades->assigment_id) ?></td>
            <td><?= h($grades->value) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Grades', 'action' => 'view', $grades->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Grades', 'action' => 'edit', $grades->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Grades', 'action' => 'delete', $grades->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grades->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Registrations') ?></h4>
    <?php if (!empty($student->registrations)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Group Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($student->registrations as $registrations): ?>
        <tr>
            <td><?= h($registrations->group_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Registrations', 'action' => 'view', $registrations->student_id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Registrations', 'action' => 'edit', $registrations->student_id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Registrations', 'action' => 'delete', $registrations->student_id], ['confirm' => __('Are you sure you want to delete # {0}?', $registrations->student_id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
