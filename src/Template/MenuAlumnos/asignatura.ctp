<div>
    <div>
        Bienvenido(a) alumno(a) <?= $this->request->session()->read('Auth.User.full_name')?>
        </br>
        <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_alumnos', 'action' => 'index' ]) ?><br />
    </div>
    <h3><?= h('Datos asignatura') ?></h3>
    <div class="groups view large-10 medium-9 columns">
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($group->name) ?></p>
            <h6 class="subheader"><?= __('Full Name') ?></h6>
            <p><?= h($group->full_name) ?></p>
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= h($group->email) ?></p>
            <h6 class="subheader"><?= __('Classroom') ?></h6>
            <p><?= h($group->classroom) ?></p>
            <h6 class="subheader"><?= __('Code') ?></h6>
            <p><?= h($group->code) ?></p>
            <h6 class="subheader"><?= __('Credits') ?></h6>
            <p><?= h($group->credits) ?></p>
            <h6 class="subheader"><?= __('Group Number') ?></h6>
            <p><?= h($group->group_number) ?></p>
            <h6 class="subheader"><?= __('Class Schedule') ?></h6>
            <p><?= h($group->class_schedule) ?></p>  
        </div>  
    </div>
    </div>
</div>