<?php

namespace common\rbac;

use yii\base\BaseObject;

class RbacConstant extends BaseObject
{
    const ROLE_SUPERADMIN = 'Super Admin';
    const ROLE_ADMIN      = 'Admin';
    const ROLE_COMMON     = 'Common User';
}
