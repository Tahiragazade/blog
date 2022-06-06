<?php

namespace backend\components;
use Yii;
use yii\base\Component;
use backend\models\Logs;
use backend\models\Blog;
use backend\models\BlogSearch;

class Logging extends Component{

	public function writeToLog($params)
    {   
        $log = new Logs();
        $log->before_op = $params['before_op'];
        $log->after_op = $params['after_op'];
        $log->admin_id= (!empty($params['admin_id']) ? $params['admin_id'] : Yii::$app->user->id);
        $log->page_name= $params['page_name'];
        $log->action= $params['page_name'];
        $log->page_id=$params['id'];

        $log->created_at = time();
       // $log->updated_at = time();
        if(!$log->save()) {
            print_r($log->errors);
            die();
        }
   }
   public function nanay(){
    echo "nanay nanay"; 
   }
}


