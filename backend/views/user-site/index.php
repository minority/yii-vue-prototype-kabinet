<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SiteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Площадки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Создать сайт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'name',
            'url:url',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status ? $model->getStatuses()[$model->status] : '';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
