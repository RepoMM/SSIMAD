<div>
    Bienvenido(a) profesor(a) <?= $this->request->session()->read('Auth.User.full_name')?>
</div>
<div>
    <div>
        <?php 
        echo $this->Form->create(NULL,['controller'=>'menu_profesor','action'=>'seleccion']);
        echo $this->Form->input('grupo',['options'=>$groups,'onchange'=>'this.form.submit()','empty'=>'Selecciona una asignatura','default'=> empty($info_group)?'empty':$info_group->group_id]);
        echo $this->Form->end();

        echo $this->Html->link(__('Agregar grupo'),['controller'=>'menu_profesores','action'=>'agregar_grupo']);
        ?>
        <br/>
    </div>
    <div class="large-10 medium-9 columns">
        <?php
        if(!empty($info_group)):
        echo $this->Html->link(__('Editar grupo'),['controller'=>'menu_profesores','action'=>'editar_grupo']);
        ?>
        <div class="groups view large-10 medium-9 columns">
        <h2><?= h('Datos asignatura') ?></h2>
        <div class="row">
            <div class="large-5 columns strings">
                <h6 class="subheader"><?= __('Semester') ?></h6>
                <p><?= h($info_group->semester) ?></p>
                <h6 class="subheader"><?= __('Name') ?></h6>
                <p><?= h($info_group->name) ?></p>
                <h6 class="subheader"><?= __('Classroom') ?></h6>
                <p><?= h($info_group->classroom) ?></p>
                <h6 class="subheader"><?= __('Code') ?></h6>
                <p><?= h($info_group->code) ?></p>
                <h6 class="subheader"><?= __('Credits') ?></h6>
                <p><?= h($info_group->credits) ?></p>
                <h6 class="subheader"><?= __('Group Number') ?></h6>
                <p><?= h($info_group->group_number) ?></p>
                <h6 class="subheader"><?= __('Class Schedule') ?></h6>
                <p><?= h($info_group->class_schedule) ?></p>

            </div>

        </div>
        </div>
        <?php endif;?>
        
        
    </div>
    <div class="large-10 medium-10">
        <?php 
            echo $this->Form->create(NULL,['controller'=>'menu_profesores','action'=>'busqueda']);
            echo $this->Form->input('material',['placeholder'=>'Buscar',]);
            echo $this->Form->button(__('Buscar'),['class'=>'']);
            echo $this->Form->end();
            echo $this->Form->create(NULL,['controller'=>'menu_profesores','action'=>'busqueda']);
            echo $this->Form->input('profesores',['placeholder'=>'Buscar',]);
            echo $this->Form->button(__('Buscar'),['class'=>'']);
            echo $this->Form->end();
        ?>
    </div>
</div>