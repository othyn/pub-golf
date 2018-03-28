$('[name=code]').on('change', function() {

    $('#join-form').attr('action', '/game/join/' + $(this).val());
});
// Smells funny, but works inline with application design
// - I'm torn
