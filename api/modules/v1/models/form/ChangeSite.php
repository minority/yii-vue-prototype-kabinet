<?php

namespace api\modules\v1\models\form;

use \api\modules\v1\resources\Site;
use common\models\site\SiteIncomeIndicators;
use Yii;
use yii\base\Model;
use common\services\site\SiteService;

/**
 * Class ChangeSite
 * @package api\modules\v1\models\form
 */
class ChangeSite extends Model
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_EDIT = 'edit';

    public $id;
    public $url;
    public $name;
    public $context;
    public $teaser;
    public $cpa;
    public $links;
    public $other;
    public $cost;
    public $saveItemId;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'string', 'max' => 50, 'min' => 3, 'tooLong' => 'Поле "Адрес сайта" может содержать максимум 50 символов', 'tooShort' => 'Поле "Адрес сайта" может содержать минемум 3 символов'],
            [['name'], 'string', 'max' => 150, 'min' => 3, 'tooLong' => 'Поле "Краткое наименование" может содержать максимум 150 символов', 'tooShort' => 'Поле "Краткое наименование" может содержать минемум 3 символов'],
            [['name', 'url'], 'required', 'message' => 'Не заполнены обязательные поля'],
            //[['name'], 'match',  'pattern' => '/^[A-z0-9А-яё\-\s]+$/ui', 'message' => 'Поле "Краткое наименование" может содежать только буквы, цифры, (пробел, -)'],
            [['name', 'url'], 'filter', 'filter' => function ($value) {
                return trim(htmlentities(strip_tags($value), ENT_QUOTES, 'UTF-8'));
            }],
            ['url', 'url', 'validSchemes' => array('https', 'http')],
            ['context', 'in', 'allowArray' => true, 'range' => array_keys(\Yii::$app->params['dictionaries']['incomeIndicators']['context'])],
            ['teaser', 'in', 'allowArray' => true, 'range' => array_keys(\Yii::$app->params['dictionaries']['incomeIndicators']['teaser'])],
            ['cpa', 'in', 'allowArray' => true, 'range' => array_keys(\Yii::$app->params['dictionaries']['incomeIndicators']['cpa'])],
            ['links', 'in', 'allowArray' => true, 'range' => array_keys(\Yii::$app->params['dictionaries']['incomeIndicators']['links'])],
            ['other', 'in', 'allowArray' => true, 'range' => array_keys(\Yii::$app->params['dictionaries']['incomeIndicators']['other'])],
            ['cost', 'in', 'allowArray' => true, 'range' => array_keys(\Yii::$app->params['dictionaries']['incomeIndicators']['cost'])]
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['url', 'name', 'context', 'teaser', 'cpa', 'links', 'other', 'cost'],
            self::SCENARIO_EDIT => ['id', 'name', 'context', 'teaser', 'cpa', 'links', 'other', 'cost'],
        ];
    }

    /**
     * @return bool
     */
    public function save()
    {
        try {
            $site = !empty($this->id) ? Site::findOne((int) $this->id) : new Site();

            if (empty($this->id)) {
                $site->url = $this->url;
            }

            $site->name = $this->name;
            $site->status = Site::STATUS_ACTIVE;

            $entities = [
                SiteIncomeIndicators::tableName() => [
                    'context' => $this->context,
                    'teaser' => $this->teaser,
                    'cpa' => $this->cpa,
                    'links' => $this->links,
                    'other' => $this->other,
                    'cost' => $this->cost,
                ]
            ];

            $siteService = new SiteService($site);
            $id = $siteService->saveWithEntities($entities);
            $this->saveItemId = $id;

            return true;
        } catch (\Exception $e) {
            $this->addError('name', $e->getMessage());
        }
    }

    /**
     * @return array|string
     */
    public function getError()
    {
        $errors = $this->getFirstErrors();
        $error = $errors
            ? current($errors)
            : 'Произошла не известная ошибка, обратитесь к администратору системы или попробуйте позже';
        return $error;
    }

    /**
     * @return mixed
     */
    public function getSaveItem()
    {
        if (!$this->saveItemId) {
            return null;
        }

        $site = Site::find()
            ->select(['id', 'name', 'url', 'status'])
            ->with('siteIncomeIndicators')
            ->where(['id' => (int)$this->saveItemId])
            ->asArray()
            ->one();

        return $site;
    }
}
