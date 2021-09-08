$('#searchbox').on('input', () => {
    let search = $('#searchbox').val();

    if (search !== '') {
        $('#suggestionbox').show().empty();
    }

    if (search === '') {
        $('#suggestionbox').hide();
    }

    $.ajax({
        method: "GET",
        url: "index.php",
        data: { r: "api", s: search}
    })
        .done((result) => {
            let { data } = result;
            $.each(data, (key, restaurant) => {
                $('#suggestionbox').append("<a href='/index.php?r=restaurant/detail&id=" + restaurant.id + " '> " + restaurant.name + "</a>");
            });
        });
});
