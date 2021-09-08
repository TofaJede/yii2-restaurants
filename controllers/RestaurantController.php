<?php
namespace app\controllers;


use app\models\restaurant;
use yii\data\Pagination;
use yii\web\Controller;

class RestaurantController extends Controller
{
    public function actionIndex()
    {

        $query = restaurant::find();
        $countQuery = clone $query;

        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $restaurants = $query->offset($pages->offset)->limit($pages->limit)->orderBy('id')->all();



        return $this->render('index', [
            'restaurants' => $restaurants,
            'pages' => $pages
        ]);
    }

    public function actionDetail()
    {
        $request = \Yii::$app->request;
        $id = $request->get('id');

        $restaurant = restaurant::findOne(['id' => $id]);

        return $this->render('detail', ['id' => $id, 'restaurant' => $restaurant]);
    }
}
