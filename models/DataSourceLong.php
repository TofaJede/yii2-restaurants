<?php
namespace app\models;


class DataSourceLong extends DataSource
{
    public $name;
    public $id;
    public $cuisine;
    public $opens;
    public $closes;
    public $daysOpen;
    public $price;
    public $rating;
    public $location;
    public $description;

    protected $weekdays = Array(
        'Mo' => 'Closed',
        'Tu' => 'Closed',
        'We' => 'Closed',
        'Th' => 'Closed',
        'Fr' => 'Closed',
        'Sa' => 'Closed',
        'Su' => 'Closed'
    );


    /**
     * @return restaurant
     */
    public function transformToRestaurant()
    {
        $this->transformOpeningDays();

        $restaurant = new restaurant();
        $restaurant->id = $this->id;
        $restaurant->name = $this->name;
        $restaurant->cuisine = $this->cuisine;
        $restaurant->opening_hours = json_encode($this->weekdays);
        $restaurant->rating = $this->rating;
        $restaurant->location = $this->location;
        $restaurant->description = $this->description;

        return $restaurant;
    }

    /**
     * @return void
     */
    private function transformOpeningDays()
    {
        $openingTimes = explode(',', $this->daysOpen);
        foreach ($this->weekdays as $day => &$dayOpening) {
            if (in_array($day, $openingTimes)){
                $dayOpening = $this->opens . self::OPEN_CLOSE_SEPARATOR . $this->closes;
            }
        }
    }

}
