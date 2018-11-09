<?php

namespace common\models\site;

use Yii;

/**
 * This is the model class for table "site_income_indicators".
 *
 * @property int $id
 * @property int $site_id
 * @property string $type
 * @property int $value
 *
 * @property Site $site
 */
class SiteIncomeIndicators extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'site_income_indicators';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['site_id'], 'required'],
            [['site_id', 'value'], 'integer'],
            [['type'], 'string', 'max' => 255],
            [['site_id'], 'exist', 'skipOnError' => true, 'targetClass' => Site::class, 'targetAttribute' => ['site_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_id' => 'Site ID',
            'type' => 'Type',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::class, ['id' => 'site_id']);
    }
}
