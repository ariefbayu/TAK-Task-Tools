<?php

use common\rbac\RbacConstant;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager'      => [
            'class'        => 'yii\rbac\DbManager',
            'defaultRoles' => [
              RbacConstant::ROLE_SUPERADMIN,
              RbacConstant::ROLE_ADMIN,
              RbacConstant::ROLE_COMMON,
            ]
          ],
    ],
];
