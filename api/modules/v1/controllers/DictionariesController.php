<?php

namespace api\modules\v1\controllers;

/**
 * Class DictionariesController
 * @package api\modules\v1\controllers
 */
class DictionariesController extends \yii\web\Controller
{
    /**
     * @return mixed
     */
    public function actionIncomeIndicators()
    {
        $list = \Yii::$app->params['dictionaries']['incomeIndicators'];

        return $list;
    }
}
