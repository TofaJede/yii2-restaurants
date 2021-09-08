const today = new Date().getDay();
const weekdays = new Array(7);
weekdays[0] = "Su";
weekdays[1] = "Mo";
weekdays[2] = "Tu";
weekdays[3] = "We";
weekdays[4] = "Th";
weekdays[5] = "Fr";
weekdays[6] = "Sa";

    // List of restaurants
    $.each(openingHours_data, (index, data) => {
        $.each(data.data, (day, hours) => {
            if (day === weekdays[today]) {
                $('#' + data.id).children().last().append("<p>" + hours + "</p>");
            }
        });
    });

    // Infuse with bootstrap classes
    $('#restaurantsPagination').children().addClass('page-item').children().addClass('page-link')


    // Detail
    $.each(openingHours_data, (day, hours) => {
        if (day === weekdays[today]) {
            $('#openingHours').append("<div class='text-primary'><strong>" + day + "</strong><p>" + hours + "</p></div>" );
        } else {
            $('#openingHours').append("<div class='text-secondary'><strong>" + day + "</strong><p>" + hours + "</p></div>" );
        }
    });
// $('#openingHours')
