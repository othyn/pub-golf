$('[name=code]').on('change', function() {

    $('#join-form').attr('action', '/games/' + $(this).val() + '/join');
});
// Smells funny, but works inline with application design
// - I'm torn
