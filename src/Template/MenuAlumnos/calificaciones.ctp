<div>
    <div>
        Bienvenido(a) alumno(a) <?= $this->request->session()->read('Auth.User.full_name')?>
        </br>
        <?php echo $this->Html->link('Regresar al Menu Principal', ['controller' => 'menu_alumnos', 'action' => 'index' ]) ?><br />
    </div>
    <h3>Calificaciones</h3>
    <div>
        <table>
        <thead>
            <th>Concepto</th><th>Nombre</th><th>Calificación</th><th>Descripción</th>
        </thead>
            <?php foreach($infogrades as $if): ?>
                <?php foreach($assweights as $aw): ?>
                    <?php
                        if($aw['id'] == $if['assigment_id']){
                            $description=$aw['description'];
                            $weight = $aw['weight']['name'];
                        }
                    ?>
                <?php endforeach;?>
            <tr>
                    <td><?php echo $weight?> </td>
                    <td><?php  echo $if['name']?></td>
                    <td><?php  echo $if['value']?></td>
                    <td><?php  echo $description?></td>
                <?php endforeach;?>
            </tr>
        </table>
    </div>

    <div>
        <h3>Conceptos</h3>
        <table>
            <thead>
                 <th>Concepto</th><th>Valor(%)</th>
            </thead>
            <?php 
                foreach($weights as $w): ?>
                <tr>
                    <td><?php echo $w['name']?></td>
                    <td><?php echo $w['weight']?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>

            <div>
                <?php 
                    $promedio=0;
                ?>
                <?php foreach($weights as $w): ?>
                    <?php
                        $num_weight=0;
                        $suma_weight=0;
                    ?>
                    <?php foreach($infogrades as $if): ?>
                        <?php
                            if($if['weight'] == $w['weight']){
                                $num_weight = $num_weight +1;
                                $suma_weight = $suma_weight + $if['value'];
                                
                            }
                            //
                            //
                        ?>
                    <?php endforeach;?>
                    <?php $prom_weight = ($suma_weight/$num_weight)*$w['weight']/100;?>
                    <?php //echo $prom_weight."<br>";?>
                    <?php $promedio = $promedio + $prom_weight; ?>
                <?php endforeach;?>
                <h3>Promedio: <?php echo $promedio; ?></h3>
            </div>
</div>