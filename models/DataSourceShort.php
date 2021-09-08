<?php
namespace app\models;

class DataSourceShort extends DataSource
{
    const OPEN_INDEX = 0;
    const CLOSE_INDEX = 1;

    public $name;
    public $opening;
    private $openingDays = array(
        'Mon' => 'Mo',
        'Tue' => 'Tu',
        'Wed' => 'We',
        'Thu' => 'Th',
        'Fri' => 'Fr',
        'Sat' => 'Sa',
        'Sun' => 'Su'
    );


    public function transformToRestaurant(): restaurant
    {
        $this->transformOpeningDays();

        $restaurant = new restaurant();
        $restaurant->id = $this->generateId();
        $restaurant->name = $this->name;
        $restaurant->cuisine = '';
        $restaurant->opening_hours = json_encode($this->weekdays);
        $restaurant->rating = '';
        $restaurant->location = '';
        $restaurant->description = '';

        return $restaurant;
    }

    private function generateId(): string
    {

        return  str_replace([' ', '\'', '-', '&'], '', $this->name);
    }

    private function transformOpeningDays()
    {
        $dayset = explode('/', $this->opening);

        foreach ($dayset as $index => $day) {
            preg_match_all('/^(mon?)|(tue?)|(wed?)|(thu?)|(fri?)|(sat?)|(sun?)/im', $day, $dayData);
            preg_match_all('/(0?[1-9]?|1[0-2]?):?([0-5]\d)?\s?((?:A|P)\.?M\.?)/im', $day, $timeData);

            $dayData = array_slice($dayData, 0, 1);
            $timeData = array_slice($timeData, 0, 1);

            $dayData = $dayData[0];
            $timeData = $timeData[0];

            $openTime = date('H:i:s', strtotime($timeData[0]));
            $closeTime = date('H:i:s', strtotime($timeData[1]));

            $open = false;

            foreach ($this->weekdays as $weekday => &$openingTime) {
                $openingDay = $this->openingDays[$dayData[self::OPEN_INDEX]];

                if (!isset($dayData[self::CLOSE_INDEX])) {
                    $closingDay = false;
                } else {
                    $closingDay = $this->openingDays[$dayData[self::CLOSE_INDEX]];
                }

                if ( ($closingDay == false || $weekday == $closingDay) && $open) {
                    $openingTime = $openTime . self::OPEN_CLOSE_SEPARATOR . $closeTime;
                    $open = false;
                }

                if ($weekday == $openingDay) {
                    $open = true;
                }

                if ($open == true || $weekday == $openingDay){
                    $openingTime = $openTime . self::OPEN_CLOSE_SEPARATOR . $closeTime;
                }
            }
        }
    }
}
