<?php

namespace common\rbac;

use common\rbac\RbacConstant;
use Yii;
use yii\rbac\Rule;

/**
 * Checks if user group matches
 */
class RbacRule extends Rule
{
  public $name = 'userGroup';

  public function execute($user, $item, $params)
  {
    if (!Yii::$app->user->isGuest) {

      $auth = \Yii::$app->authManager;


      $groups = $auth->getRolesByUser($user);

      foreach($groups as $group){
        if($group->ruleName == $item->ruleName){
          return true;
        }
      }

    }
    return false;
  }
}
