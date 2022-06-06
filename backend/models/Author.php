<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $name
 * @property string $photo
 * @property int $ststusu
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $file;
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'ststusu'], 'required'],
            [['ststusu'], 'integer'],
            [['file'],'file','skipOnEmpty' => false, 'extensions' => 'png, jpeg, jpg'],
            [['name'], 'string', 'max' => 120],
           // [['photo'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'Photo' => 'file',
            'ststusu' => 'Ststusu',
        ];
    }
}
