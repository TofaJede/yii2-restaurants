<?php
use yii\widgets\LinkPager;
?>

<h1>List of restaurants</h1>
<script type="text/javascript">
    let openingHours_data = new Array();
</script>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Cuisine</th>
        <th scope="col">Rating</th>
        <th scope="col">Location</th>
        <th scope="col">Today opening hours</th>
    </tr>
    </thead>
    <pre>
    <tbody id="restaurants">
    <?php
        foreach ($restaurants as $restaurant) {
                echo "
                    
                        <tr id='" . $restaurant->id . "'>
                            <script type='text/javascript'>
                                openingHours_data.push({ id: '$restaurant->id', data: $restaurant->opening_hours});
                            </script>
                            <th scope=\"row\" class='name' >
                            " . \yii\helpers\Html::a($restaurant->name, ['/restaurant/detail', 'id' => $restaurant->id]) . "
                            </th>
                            
                            <td class='cuisine'>$restaurant->cuisine</td>
                            <td class='rating'>$restaurant->rating</td>
                            <td class='location'>$restaurant->location</td>
                            <td class='openingHours w-100'></td>
                        </tr>
                    ";

        }
    ?>
    </tbody>
</table>

<nav>
<?php
echo LinkPager::widget([
        'options' => ['class' => 'pagination', 'id' => 'restaurantsPagination'],
        'pagination' => $pages,
]);
?>
</nav>
