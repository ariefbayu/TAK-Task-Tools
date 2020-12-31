<?php

namespace console\controllers;

use common\rbac\RbacRule;
use common\models\User;
use common\rbac\RbacConstant;
use Yii;
use yii\console\Controller;


class RbacController extends Controller
{
  public function actionGenerateSuperadmin()
  {

    $user = new User();
    $user->username = 'superadmin';
    $user->email = 'superadmin@kvs-example.com';
    $user->setPassword('autoAWESOME!');
    $user->generateAuthKey();
    $user->save(false);

    // the following three lines were added:
    $auth = Yii::$app->authManager;
    $authorRole = $auth->getRole(RbacConstant::ROLE_SUPERADMIN);
    $auth->assign($authorRole, $user->getId());
  }

  public function actionInit()
  {


    $auth = \Yii::$app->authManager;
    // $auth->removeAll();

    ///////////////////////////////////
    // Create rules ///////////////////
    ///////////////////////////////////

    $userLevelRule = new RbacRule();

    // add all rule to database
    $auth->add($userLevelRule);

    ///////////////////////////////////
    // Create User Role ///////////////
    ///////////////////////////////////

    $supAdmin             = $auth->createRole(RbacConstant::ROLE_SUPERADMIN);
    $supAdmin->ruleName   = $userLevelRule->name;
    $auth->add($supAdmin);

    $keysAdmin            = $auth->createRole(RbacConstant::ROLE_ADMIN);
    $keysAdmin->ruleName  = $userLevelRule->name;
    $auth->add($keysAdmin);

    $keys                = $auth->createRole(RbacConstant::ROLE_COMMON);
    $keys->ruleName      = $userLevelRule->name;
    $auth->add($keys);
  }
}