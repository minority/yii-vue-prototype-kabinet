<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\site\Site */

$this->title = 'Обновить сайт: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Площадки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="site-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
