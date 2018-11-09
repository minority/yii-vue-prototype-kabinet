<?php

namespace common\services\site;


use common\models\site\Site;
use common\models\site\SiteIncomeIndicators;
use Yii;

/**
 * Class SiteService
 * @package common\services\site
 */
class SiteService
{
    protected $siteModel;

    /**
     * SiteService constructor.
     * @param Site $siteModel
     */
    public function __construct(Site $siteModel)
    {
        $this->siteModel = $siteModel;
    }

    /**
     * @param array $entities
     * @return bool
     * @throws Exception
     * @throws \yii\db\Exception
     */
    public function saveWithEntities($entities = [])
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (!$this->siteModel->save()) {
                throw new Exception('Не удалось сохранить данные о площадки');
            }

            $id = $this->siteModel->id;
            $incomeIndicators = $this->buildIncomeIndicatorsEntitiesForInsert($entities);

            Yii::$app->db->createCommand()
                ->delete(SiteIncomeIndicators::tableName(), 'site_id = :id', [':id' => $id])
                ->execute();

            if ($incomeIndicators) {
                foreach ($incomeIndicators as $tableName => $item) {
                    Yii::$app->db->createCommand()
                        ->batchInsert($tableName, ['site_id', 'type', 'value'], $item)
                        ->execute();
                }
            }
            $transaction->commit();

            return $id;
        } catch (Exception $e) {
            $transaction->rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return bool
     * @throws Exception
     * @throws \yii\db\Exception
     */
    public function delete()
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $this->siteModel->status = Site::STATUS_ON_DELETING;
            $this->siteModel->save();

            $transaction->commit();

            return true;
        } catch (Exception $e) {
            $transaction->rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $entities
     * @return array
     * @throws Exception
     */
    protected function buildIncomeIndicatorsEntitiesForInsert($entities)
    {
        $id = $this->siteModel->id;

        if (!$id) {
            throw new Exception('При сохранение связанных данных не найден id площадки');
        }

        $result = [];
        if (!empty($entities[SiteIncomeIndicators::tableName()])) {
            foreach ($entities[SiteIncomeIndicators::tableName()] as $type => $value) {
                if ($value) {
                    foreach ($value as $subValue) {
                        $result[SiteIncomeIndicators::tableName()][] = [
                            'site_id' => $id,
                            'type' => $type,
                            'value' => $subValue
                        ];
                    }
                }
            }
        }

        return $result;
    }
}
