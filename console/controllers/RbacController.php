<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\rbac\AuthorRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

//Yorum 
        $yorumekle = $auth->createPermission('yorumekle');
        $yorumekle->description = 'yorum eklemek';
        $auth->add($yorumekle);
		
		  
        $yorumguncelle = $auth->createPermission('yorumguncelle');
        $yorumguncelle->description = 'Yorum guncellemek';
        $auth->add($yorumguncelle);
		
		$yorumsil = $auth->createPermission('yorumsil');
        $yorumsil->description = 'Yorum silmek';
        $auth->add($yorumsil);
		
		

// Tip 
        $tipekle = $auth->createPermission('tipekle');
        $tipekle->description = 'tip eklemek';
        $auth->add($tipekle);
		
		$tipsil = $auth->createPermission('tipsil');
        $tipsil->description = 'tip silmek';
        $auth->add($tipsil);

      
        $tipguncelle = $auth->createPermission('tipguncelle');
        $tipguncelle->description = 'tip guncellemek';
        $auth->add($tipguncelle);
////  
	    
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $yorumekle);
		$auth->addChild($author, $tipekle);

        
        $admin = $auth->createRole('admin');
        $auth->add($admin);
		$auth->addChild($admin, $yorumekle);
        $auth->addChild($admin, $yorumguncelle);
		$auth->addChild($admin, $tipsil);
		 $auth->addChild($admin,$yorumsil);
        $auth->addChild($admin, $author);

        
        $auth->assign($author, 2);
        $auth->assign($admin, 1);
    }
	
	public function actionAuthorRule()
	{
		$auth = Yii::$app->authManager;

	
		$rule = new AuthorRule;
		$auth->add($rule);

		
		$kendiyorum = $auth->createPermission('kendiyorum');
		$kendiyorum->description = 'Kendi yorum guncelle';
		$kendiyorum->ruleName = $rule->name;
		$auth->add($kendiyorum);
		
		$yorumguncelle = $auth->getPermission('yorumguncelle');
		$auth->addChild($kendiyorum, $yorumguncelle);
		
		$author = $auth->getRole('author');
		$auth->addChild($author, $kendiyorum);
	

		
		
		
	}
}