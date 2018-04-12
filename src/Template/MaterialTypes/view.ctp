<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
    <br/>
    <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_profesores', 'action' => 'index' ]) ?>
    <br/>
</div>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Material Type'), ['action' => 'edit', $materialType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Material Type'), ['action' => 'delete', $materialType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $materialType->name)]) ?> </li>
        <li><?= $this->Html->link(__('List Material Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="materialTypes view large-10 medium-9 columns">
    <h2><?= h($materialType->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($materialType->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($materialType->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($materialType->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($materialType->modified) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Description') ?></h6>
            <?= $this->Text->autoParagraph(h($materialType->description)) ?>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Materials') ?></h4>
    <?php if (!empty($materialType->materials)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Professor') ?></th>
            <th><?= __('Course') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Private') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($materialType->materials as $materials): ?>
        <tr>
            <td><?= h($materials->id) ?></td>
            <td><?= h($materials->professor->full_name) ?></td>
            <td><?= h($materials->course->name) ?></td>
            <td><?= h($materials->name) ?></td>
            <td><?= h($materials->private)? __('Yes') : __('No') ?></td>
            <td><?= h($materials->created) ?></td>
            <td><?= h($materials->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Materials', 'action' => 'view', $materials->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Materials', 'action' => 'edit', $materials->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Materials', 'action' => 'delete', $materials->id], ['confirm' => __('Are you sure you want to delete # {0}?', $materials->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>