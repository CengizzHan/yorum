<?php

namespace backend\modules\yorum\models;

use Yii;
use common\models\User;
/**
 * This is the model class for table "yorum".
 *
 * @property integer $id
 * @property string $baslik
 * @property string $icerik
 * @property integer $tip
 * @property integer $yazan
 *
 * @property Tip $tip0
 * @property User $yazan0
 */
class Yorum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yorum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['baslik', 'icerik'], 'required'],
            [['icerik'], 'string'],
            [['tip', 'yazan'], 'integer'],
            [['baslik'], 'string', 'max' => 128]
			
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'baslik' => 'Baslik',
            'icerik' => 'Icerik',
            'tip' => 'Tip',
            'yazan' => 'Yazan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTips()
    {
        return $this->hasOne(Tip::className(), ['id' => 'tip']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYazans()
    {
        return $this->hasOne(User::className(), ['id' => 'yazan']);
    }
}
