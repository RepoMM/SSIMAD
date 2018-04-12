<?php


$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}

$this->Html->css(['bootstrap.min']);
$this->Html->script(['jquery-3.2.1.min','bootstrap.min']);


?>
<div class="<?= h($class) ?>"><?= h($message) ?></div>

