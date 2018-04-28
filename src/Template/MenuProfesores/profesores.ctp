<div>
    <?php echo $this->Html->link('Regresar',['controller'=>'menu_profesores','action'=>'index']);?>
    <h3>Profesores</h3>
</div>
<div class="professors index large-10 medium-9 columns">
    <?php echo $this->Form->create(NULL,['controller'=>'menu_profesores','action'=>'enviar_correo','name'=>'profesores']);
          echo $this->Form->hidden('email',['value'=>'']);?>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('profesor(a)') ?></th>
            <th><?= __('email') ?></th>
        </tr>
    </thead>
    <tbody>

    <?php foreach ($professors as $professor): ?>
        <tr>
            <td><?= h($professor->id) ?></td>
            <td><?= h($professor->full_name) ?></td>
            <td><a href="<?= "javascript:document.profesores.email.value='$professor->email';document.profesores.submit();" ?>"><?= $professor->email ?></a></td>
        </tr>

    <?php endforeach; ?>


    </tbody>
    </table>
    <?php echo $this->Form->end();?>
</div>
