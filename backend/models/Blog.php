<?php

namespace backend\models;
use backend\models\Author;
use backend\models\Janr;
use Yii;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $name
 * @property int $text
 * @property int $janr_id
 * @property int $author_id
 * @property int $created_time
 * @property int $updated_time
 * @property int $status
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $file;
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'text', 'janr_id', 'author_id', 'created_time', 'updated_time', 'status'], 'required'],
            [['janr_id', 'author_id', 'status'], 'integer'],
            [['text'],'string'],
            // [['file'],'string','skipOnEmpty' => false, 'extensions' => 'png, jpeg, jpg'],
            [['name'], 'string', 'max' => 512],
            [['photo'],'string'],
        ];
    }
    public function getAuthor()
        {
        return $this->hasOne(Author::className(),['id'=>'author_id']);

        }
    public function getJanr()
        {
        return $this->hasOne(Janr::className(),['id'=>'janr_id']);

        }
    

    public function fields(){
        return parent::fields();
    }

}
