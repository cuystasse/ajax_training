$(document).ready(function () {

    $('.loading').hide();

    $('#search').on('keyup', function (e) {
        // ajax request on field changing by user keyup
        let input_search = $(this).val();
        input_search = input_search.replace(" ", "+");

        // waiting cog
        $('.suggest').hide();
        $('.loading').show();

        $.ajax({
            url: `https://api.magicthegathering.io/v1/cards?name=${input_search}`,
            type: 'GET',
            datatype: 'json',

            success: function (response, statut) {
                let cards = response.cards;
                console.log(cards);

                // add suggest to dedicated div
                $('.suggest').empty();
                for (let card of cards) {
                    let name = card.name.replace(input_search, `<strong>${input_search}</strong>`);
                    let li = $('<li></li>').html(name);
                    $('.suggest').append(li);
                    li.on('click', function (e) {
                        $('#search').val(card.name);
                        $('#form-search').submit();
                    });
                }
                $('.suggest').show();
                $('.loading').hide();
            }
        });
    });

});