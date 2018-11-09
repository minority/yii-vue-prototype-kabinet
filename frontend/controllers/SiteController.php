<?php

namespace frontend\controllers;

use cheatsheet\Time;
use common\sitemap\ArticleUrlGenerator;
use common\sitemap\PageUrlGenerator;
use common\sitemap\UrlsIterator;
use frontend\models\ContactForm;
use Sitemaped\Element\Urlset\Urlset;
use Sitemaped\Sitemap;
use Yii;
use yii\filters\PageCache;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => PageCache::class,
                'only' => ['sitemap'],
                'duration' => Time::SECONDS_IN_AN_HOUR,
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        //фикс дубля
        if ($_SERVER['REQUEST_URI'] == '/site/index') {
            $this->redirect('/');
        }

        return $this->render('index');
    }
}
