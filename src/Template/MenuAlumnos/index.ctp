<div>
    <div>
        Bienvenido(a) alumno(a) <?= $this->request->session()->read('Auth.User.full_name')?>
        </br>
    </div>
    <?php 
    echo $this->Form->create(NULL,['controller'=>'menu_alumnos','action'=>'seleccion']);
    echo $this->Form->input('Asignatura',['options'=>$groups,'onchange'=>'this.form.submit()','empty'=>'Selecciona una asignatura','default'=> empty($info_group)?'empty':$info_group->group_id]);
    echo $this->Form->end();?>
    <br/>

    <div class="large-12 medium-9">
        <?php 
            echo $this->Form->create(NULL,['controller'=>'menu_alumnos','action'=>'busqueda']);
            echo $this->Form->input('material',['placeholder'=>'Buscar',]);
            echo $this->Form->button(__('Buscar'),['class'=>'']);
            echo $this->Form->end();
            
            echo $this->Form->create(NULL,['controller'=>'menu_alumnos','action'=>'busqueda']);
            echo $this->Form->input('profesores',['placeholder'=>'Buscar',]);
            echo $this->Form->button(__('Buscar'),['class'=>'']);
            echo $this->Form->end();
            ?>
    </div>
</div>