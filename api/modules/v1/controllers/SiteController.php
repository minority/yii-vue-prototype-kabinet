<?php

namespace api\modules\v1\controllers;

use api\modules\v1\models\form\ChangeSite;
use api\modules\v1\resources\Site;
use common\services\site\SiteService;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\rest\IndexAction;
use yii\rest\OptionsAction;
use yii\rest\Serializer;
use yii\rest\ViewAction;
use yii\web\HttpException;
use Yii;
use yii\filters\VerbFilter;

/**
 * Class SiteController
 * @package api\modules\v1\controllers
 */
class SiteController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'api\modules\v1\resources\Site';
    /**
     * @var array
     */
    public $serializer = [
        'class' => Serializer::class,
        'collectionEnvelope' => 'items'
    ];

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'create' => ['post'],
                    'index'  => ['get'],
                    'update' => ['post'],
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => [$this, 'prepareDataProvider']
            ],
            'options' => [
                'class' => OptionsAction::class
            ]
        ];
    }

    /**
     * @return array
     */
    public function actionCreate()
    {
        $form = new ChangeSite(['scenario' => ChangeSite::SCENARIO_CREATE]);
        if ($form->load(Yii::$app->request->post(), '')) {
            if ($form->validate() && $form->save()) {
                return ['status' => true, 'item' => $form->getSaveItem()];
            }
        }

        return ['status' => false, 'msg' => $form->getError()];
    }

    /**
     * @return array
     */
    public function actionUpdate()
    {
        //@todo Проверка кто редатирует !!!

        $form = new ChangeSite(['scenario' => ChangeSite::SCENARIO_EDIT]);
        if ($form->load(Yii::$app->request->post(), '')) {
            if ($form->validate() && $form->save()) {
                return ['status' => true, 'item' => $form->getSaveItem()];
            }
        }

        return ['status' => false, 'msg' => $form->getError()];
    }

    /**
     * @param $id
     * @return array
     * @throws HttpException
     * @throws \common\services\site\Exception
     * @throws \yii\db\Exception
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model) {
            $siteService = new SiteService($model);
            $siteService->delete();

            return ['status' => true];
        }

        return ['status' => false];
    }

    /**
     * @return ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        return new ActiveDataProvider(array(
            'query' => Site::find()
                ->where(['status' => Site::STATUS_ACTIVE]),
            'pagination' => false,
        ));
    }

    /**
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     * @throws HttpException
     */
    public function findModel($id)
    {
        $model = Site::find()
            ->where(['status' => Site::STATUS_ACTIVE])
            ->andWhere(['id' => (int)$id])
            ->one();
        if (!$model) {
            throw new HttpException(404);
        }
        return $model;
    }
}
