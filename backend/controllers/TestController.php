<?php

namespace backend\controllers;
use yii\web\Session;
use Yii;
use yii\web\Response;
use yii\db\Query;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
    
        return $this->render('index');
    }

     public function actionRequest()
    {
        $request = Yii::$app->request;
        $id = $request->post('id');
        $name = $request->post('name');
        echo $id;
        echo '<br>';

        echo $name;

    }
    public function actionResponse()
    {
    $response = Yii:: $app->response;

    $response->content='Test13';
    //Yii::$app->response->content='nananananan';
    $response->format=response::FORMAT_JSON;

   $query1 = new Query;
    $query1->select('*')
    ->from('blog')
    ->limit(10);
   $row= $query1->all();

    Yii::$app->response->data=$row;
    }
}
