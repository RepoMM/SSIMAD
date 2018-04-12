<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$group_id = $this->request->session()->read('Auth.User.group_id');
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= 
    $this->Html->css('base.css') ;
    $this->Html->css('bootstrap.min');
    ?>
    <?= 
    $this->Html->css('cake.css') ;
    $this->Html->script(['jquery-3.2.1.min','bootstrap.min']);
    ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <div class="header-title">
            <span><?= $this->fetch('title') ?></span>
        </div>
        <div class="header-help">
            <?php if($group_id != ''):?>
                <span><?= $this->Html->link('Asignatura',['controller'=>'menu_alumnos','action'=>'asignatura'])?></span>
                <span><?= $this->Html->link('Calificaciones',['controller'=>'menu_alumnos','action'=>'calificaciones'])?></span>
                <span><?= $this->Html->link('Asistencia',['controller'=>'menu_alumnos','action'=>'asistencia'])?></span>
                <span><?= $this->Html->link('Entregables',['controller'=>'menu_alumnos','action'=>'entregables'])?></span>
                <span><?= $this->Html->link('Mensajes',['controller'=>'menu_alumnos','action'=>'mensajes'])?></span>
                <span><?= $this->Html->link('Enviar correo',['controller'=>'menu_alumnos','action'=>'enviar_correo'])?></span>
                <span><?= $this->Html->link('Material Didáctico',['controller'=>'menu_alumnos','action'=>'material_didactico'])?></span>
                
            <?php endif;?>
            <span><?= $this->Html->link('Perfil',['controller'=>'students','action'=>'perfil'])?></span>
            <span><?php echo $this->Html->link(__('Logout'),['controller'=>'users','action'=>'logout'])?></span>
        </div>
    </header>
    <div id="container">

        <div id="content">
            <?= $this->Flash->render() ?>

            <div class="row">
                <?= $this->fetch('content') ?>
            </div>
        </div>
        <footer>
        </footer>
    </div>
</body>
</html>
