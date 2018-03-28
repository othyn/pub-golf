$('#submit-score-btn').on('click', function() {

    let game   = $(this).data('game')
      , player = $(this).data('player')
      , score  = $('[name=score]').val();

    axios({
        method: 'PATCH',
        url: '/games/' + game + '/players/' + player + '/score',
        data: {
            score: score
        }
    })
    .then((response) => {

        swal('Yay!', 'Your par score for this hole is currently ' + response.data.score + '!', 'success');

    })
    .catch((error) => {

        swal('Uh-oh 😨', 'There was a problem submitting your score, try again in a minute.', 'error');
    });
});
