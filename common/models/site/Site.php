<?php

namespace common\models\site;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "site".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property SiteIncomeIndicators[] $siteIncomeIndicators
 */
class Site extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_ON_DELETING = 2;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'site';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'url' => 'Адрес',
            'status' => 'Статус',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiteIncomeIndicators()
    {
        return $this->hasMany(SiteIncomeIndicators::class, ['site_id' => 'id']);
    }

    /**
     * @return array
     */
    public function getStatuses()
    {
        return [
            self::STATUS_ACTIVE => 'Активна',
            self::STATUS_ON_DELETING => 'На удаление',
        ];
    }
}
