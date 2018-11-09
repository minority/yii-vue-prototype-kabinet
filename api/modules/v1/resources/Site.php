<?php

namespace api\modules\v1\resources;

/**
 * Class Site
 * @package api\modules\v1\resources
 */
class Site extends \common\models\site\Site
{
    public function fields()
    {
        return ['id', 'name', 'url', 'status'];
    }

    public function extraFields()
    {
        return ['siteIncomeIndicators'];
    }
}
