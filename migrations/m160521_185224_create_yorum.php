<?php

use yii\db\Migration;

class m160521_185224_create_yorum extends Migration
{
    public function up()
    {
        $this->createTable('yorum', [
            'id' => $this->primaryKey(),
			'baslik'=>$this->string(128),
			'icerik'=>$this->string(128),
			'tip'=>$this->integer(),
			'yazan'=>$this->integer(),
        ]);

   
        $this->createIndex(
            'idx-tip',
            'yorum',
            'tip'
        );


        $this->addForeignKey(
            'tip',
            'yorum',
            'tip',
            'tip',
            'id',
            'CASCADE',
			'CASCADE'
        );

       
        $this->createIndex(
            'idx-yazan',
            'yorum',
            'yazan'
        );

        $this->addForeignKey(
            'yazan',
            'yorum',
            'yazan',
            'user',
            'id',
            'CASCADE',
			'CASCADE'
        );
    }

    

    public function down()
    {
        $this->dropTable('yorum');
    }
}
