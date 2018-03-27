$('#join-btn').on('click', function(e) {

    e.preventDefault();

    $('#join-form').attr('action', '/join/' + $('[name=game_code]').val());

    $('#join-form').submit();
});
// Smells funny, but works inline with application design
// - I'm torn
