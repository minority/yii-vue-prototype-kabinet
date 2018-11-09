<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\site\Site */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Площадки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-view">

    <p>
        <?php echo Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'url:url',
            [
                'attribute' => 'status',
                'label' => 'Статус',
                'value' => function ($model) {
                    return (isset($model->status)) ? $model->getStatuses()[$model->status] : '';
                }
            ],
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
