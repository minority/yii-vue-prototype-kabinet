<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\site\Site */

$this->title = 'Создать сайт';
$this->params['breadcrumbs'][] = ['label' => 'Площадки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
