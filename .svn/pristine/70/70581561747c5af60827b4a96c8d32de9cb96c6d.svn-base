<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Semester'), ['action' => 'edit', $semester->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Semester'), ['action' => 'delete', $semester->id], ['confirm' => __('Are you sure you want to delete # {0}?', $semester->name)]) ?> </li>
        <li><?= $this->Html->link(__('List Semesters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Semester'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="semesters view large-10 medium-9 columns">
    <h2><?= h($semester->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($semester->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($semester->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Start Date') ?></h6>
            <p><?= h($semester->start_date) ?></p>
            <h6 class="subheader"><?= __('End Date') ?></h6>
            <p><?= h($semester->end_date) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($semester->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($semester->modified) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Groups') ?></h4>
    <?php if (!empty($semester->groups)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Course Id') ?></th>
            <th><?= __('Professor Id') ?></th>
            <th><?= __('Group Number') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($semester->groups as $groups): ?>
        <tr>
            <td><?= h($groups->id) ?></td>
            <td><?= h($groups->course->name) ?></td>
            <td><?= h($groups->professor->full_name) ?></td>
            <td><?= h($groups->group_number) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Groups', 'action' => 'view', $groups->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Groups', 'action' => 'edit', $groups->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Groups', 'action' => 'delete', $groups->id], ['confirm' => __('Are you sure you want to delete # {0}?', $groups->course->name.' '.$groups->group_number)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
