<?php

use yii\db\Migration;

class m160521_185852_create_tip extends Migration
{
    public function up()
    {
        $this->createTable('tip', [
            'id' => $this->primaryKey(),
			'isim'=>$this->string(128),
        ]);
    }

    public function down()
    {
        $this->dropTable('tip');
    }
}
