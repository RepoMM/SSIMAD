<div>
    <?php echo $this->Html->link('Agregar mensaje',['controller'=>'menu_profesores','action'=>'agregar_mensaje'])?>
    <?php echo $this->Html->link('Regresar',['controller'=>'menu_profesores','action'=>'index'])?>
    <div class="messages index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= __('title') ?></th>
            <th><?= __('body') ?></th>
            <th><?= __('created') ?></th>
            <th class="actions"><?= __('Delete menssage') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($messages as $message): ?>
        <tr>
            <td><?= h($message->title) ?></td>
            <td><?= h($message->body) ?></td>
            <td><?= h($message->created) ?></td>
            <td class="actions">
                <?= $this->Form->postLink(__('Delete'), ['controller'=>'messages','action' => 'borrar_mensaje', $message->id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    
</div>
</div>