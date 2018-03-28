$('#submit-score-btn').on('click', function() {

    let game       = $(this).data('game')
      , player     = $(this).data('player')
      , score      = $('[name=score]').val()
      , totalScore = parseInt($('#total-score').text()) - score;

    axios({
        method: 'PATCH',
        url: '/games/' + game + '/players/' + player + '/score',
        data: {
            score: score
        }
    })
    .then((response) => {

        swal('Woop 🎉', 'Your par score for this hole is ' + response.data.score, 'success');

        $('#active-score').text(response.data.score);
        $('#total-score').text(response.data.total);
        // Vue would come in real handy right about now...

        $('[name=score]').val(0);

    })
    .catch((error) => {

        swal('Uh-oh 😨', 'There was a problem submitting your score, try again in a minute.', 'error');
    });
});
