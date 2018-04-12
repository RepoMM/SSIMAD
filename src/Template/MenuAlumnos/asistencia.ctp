<div>
    <div>
        Bienvenido(a) alumno(a) <?= $this->request->session()->read('Auth.User.full_name')?>
        </br>
        <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_alumnos', 'action' => 'index' ]) ?><br />
    </div>
    <h3>Asistencia</h3>
    <table>
        <thead>
        <th>Fecha</th><th>Registro</th>
        </thead>
        <?php 
        $asist_t=0;
        $asist_v=0;
        foreach($asistencias as $a): ?>
        <tr>
            <td><?php echo $a['aclass']['date']?></td>
            <td><?php 
                if($a['value'] == 1){
                    echo "Asistencia";
                    $asist_t=$asist_t+1;
                    $asist_v=$asist_v+1;
                }elseif($a['value'] == 0){
                    echo "Falta";
                    $asist_t=$asist_t+1;
                }
                ?>
            </td>
        </tr>
       <?php endforeach; 
        ?>
    </table>
    <?php
    if ($asist_t == 0) {
        echo "No tienes asistencias registradas.";
    } else{
        $percent = ($asist_v*100)/$asist_t;
        echo "Total: ".$asist_t." Asistencias (".$percent."%)";   
    }
    ?>
</div>