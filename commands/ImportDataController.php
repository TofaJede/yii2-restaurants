<?php

namespace app\commands;

use app\models\DataSourceShort;
use app\models\restaurant;
use yii\console\Controller;
use yii\console\ExitCode;

use app\models\DataSourceLong;

class ImportDataController extends Controller
{
    /**
     * @throws \Exception
     */
    public function actionIndex()
    {
        echo "------------------------".PHP_EOL;
        echo "| IMPORT DATA STARTING | ".PHP_EOL;
        echo "------------------------".PHP_EOL;

        $files = array_diff(scandir('data/'), array('.', '..'));

        foreach ($files as $filename) {
            echo "Processing file: ";
            echo $filename;

            $re = '/(\d+)/m';
            preg_match($re, $filename, $matches);
            // Identify source
            foreach ($matches as $match => $source) {

                echo " from source: ".$source;
                echo PHP_EOL;
                echo PHP_EOL;

                switch ($source) {
                    case '1':
                        $csv = array_map('str_getcsv', file('data/'.$filename));
                        foreach ($csv as $index => $item) {
                            if ($index === 0) { continue; }
                            $itemEntity = new DataSourceLong();

                            $itemEntity->name = $item[0];
                            $itemEntity->id = $item[1];
                            $itemEntity->cuisine = $item[2];
                            $itemEntity->opens = $item[3];
                            $itemEntity->closes = $item[4];
                            $itemEntity->daysOpen = $item[5];
                            $itemEntity->price = $item[6];
                            $itemEntity->rating = $item[7];
                            $itemEntity->location = $item[8];
                            $itemEntity->description = $item[9];

                            $this->saveEntity($itemEntity);
                        }
                        break;

                    case '2':
                        $csv = array_map('str_getcsv', file('data/'.$filename));
                        foreach ($csv as $index => $item) {

                            $itemEntity = new DataSourceShort();
                            $itemEntity->name = $item[0];
                            $itemEntity->opening = $item[1];

                            $this->saveEntity($itemEntity);
                        }
                        break;
                    default:
                        throw new \Exception('Unknown source');
                }
            }
        }

        echo PHP_EOL;
        echo PHP_EOL;
        return ExitCode::OK;
    }

    private function saveEntity($itemEntity)
    {
        $restaurantEntity = $itemEntity->transformToRestaurant();

        if ($exists = restaurant::findOne(['id' => $restaurantEntity->id])) {
            $exists->id = $restaurantEntity->id;
            $exists->name = $restaurantEntity->name;
            $exists->cuisine = $restaurantEntity->cuisine;
            $exists->opening_hours = $restaurantEntity->opening_hours;
            $exists->rating = $restaurantEntity->rating;
            $exists->location = $restaurantEntity->location;
            $exists->description = $restaurantEntity->description;

            $exists->save();
        } else {
            $restaurantEntity->save();
        }
        echo "Processing... ";
        echo $itemEntity->name.PHP_EOL;
    }
}
