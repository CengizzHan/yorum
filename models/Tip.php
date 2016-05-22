<?php

namespace backend\modules\yorum\models;

use Yii;

/**
 * This is the model class for table "tip".
 *
 * @property integer $id
 * @property string $isim
 *
 * @property Yorum[] $yorums
 */
class Tip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['isim'], 'required'],
            [['isim'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'isim' => 'Isim',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYorums()
    {
        return $this->hasMany(Yorum::className(), ['tip' => 'id']);
    }
}
