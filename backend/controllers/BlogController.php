<?php

namespace backend\controllers;

use backend\models\Blog;
use backend\models\Logs;
use backend\models\BlogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\Author;
use yii\web\ForbiddenHttpException;
use backend\controllers\Yii;


/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],


                    ],

                ],
            ]
        );
    }

    /**
     * Lists all Blog models.
     * @return mixed
     */



    

    public function actionIndex()
    {
        $searchModel = new BlogSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
        ]);
    }

    /**
     * Displays a single Blog model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(\Yii::$app->user->can('Create Blog'))
        {
            $model = new Blog();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                // $imageName=$model->name;
                //$model->file=UploadedFile::getInstance($model,'file');
                //$model->photo='uploads/'.$imageName.'.'.$model->file->extension;
                //$model->save();
              //  $model->file->saveAs('uploads/'.$imageName.'.'.$model->file->extension);

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);

        }
        else
        {
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Updates an existing Blog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     *///

    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

        $previous_model = clone $model;
        
        if ($this->request->isPost && $model->load($this->request->post())&&$model->save()) {
            
            $params = [
                'before_op' => serialize($previous_model->toArray()),
                'after_op' => serialize($model->toArray()),
                'id' => $model->id,
                'page_name' => 'UPDATE_BLOG',
            ];               

            \Yii::$app->logging->writeToLog($params);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Blog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
   
}
