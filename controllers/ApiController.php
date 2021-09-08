<?php
namespace app\controllers;

use app\models\restaurant;
use yii\web\Controller;
use yii\web\Response;

class ApiController extends Controller
{
    public function actionIndex(){
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $request = \Yii::$app->request;
        $searchValue = $request->get('s');

        // var_dump($searchValue);
        $v = restaurant::find()->where(['like', 'name', $searchValue])->limit(5)->all();

        return ['data' => $v];
    }

}
