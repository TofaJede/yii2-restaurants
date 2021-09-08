<?php
namespace app\models;

use yii\base\Model;

class DataSource extends Model
{
    protected $weekdays = Array(
        'Mo' => 'Closed',
        'Tu' => 'Closed',
        'We' => 'Closed',
        'Th' => 'Closed',
        'Fr' => 'Closed',
        'Sa' => 'Closed',
        'Su' => 'Closed'
    );

    const OPEN_CLOSE_SEPARATOR = ' - ';
}