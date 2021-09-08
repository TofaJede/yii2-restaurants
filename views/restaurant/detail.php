<script>
    let openingHours_data = <?= $restaurant->opening_hours ?>;
</script>

<h1><?= $restaurant->name ?></h1>
<table class="table table">
    <tbody>
        <tr>
            <th>Cuisine</th>
            <th>Description</th>
            <th>Opening Hours</th>
        </tr>
        <tr>
            <th><?= $restaurant->cuisine ?></th>
            <th><?= $restaurant->description ?></th>
            <th><div id="openingHours"></div></th>
        </tr>
    </tbody>
</table>
