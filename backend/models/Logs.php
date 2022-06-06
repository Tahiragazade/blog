<?php

namespace backend\models;

use Yii;
use backend\models\Admin;

/**
 * This is the model class for table "logs".
 *
 * @property int $id
 * @property int $admin_id
 * @property string $page_name
 * @property int $page_id
 * @property string $action
 * @property string $text
 * @property string $date
 *
 * @property Admin $admin
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */



    public static function tableName()
    {
        return 'logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['admin_id', 'page_name', 'page_id', 'action','before_op'], 'required'],
            [['admin_id', 'page_id'], 'integer'],
            // [['text'], 'string'],
            [['date'], 'safe'],
            [['page_name', 'action'], 'string', 'max' => 100],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::className(), 'targetAttribute' => ['admin_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_id' => 'Admin ID',
            'page_name' => 'Page Name',
            'page_id' => 'Page ID',
            'action' => 'Action',
            'text' => 'Text',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Admin]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Admin::className(), ['id' => 'admin_id']);
    }
}
