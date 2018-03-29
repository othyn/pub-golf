$(function() {

    function pollForHoleChange() {

        axios.get('/games/' + game + '/active-hole')
            .then((response) => {

                if (response.data.hole != currentHole) {

                    let location = response.data.location
                      , drink    = response.data.drink;

                    swal('Moving on 🏃', `Now on to ${location}, drinking ${drink}.`, 'success');

                    $('#game-location').text(location);
                    $('#game-drink').text(drink);
                    $('[name=score]').val(response.data.par);
                    // Vue would come in real handy right about now...

                    currentHole = response.data.hole;
                }

            })
            .catch((error) => {

                swal('Uh-oh 😨', 'There was a problem refreshing the game, please refresh the page.', 'error');

                clearInterval(holePoll);
            });
    }

    function pollForLeaderboard() {

        axios.get('/games/' + game + '/leaderboard')
            .then((response) => {

                $('#leaderboard').html(response.data);
                // Such a heavy way of doing it

            })
            .catch((error) => {

                swal('Uh-oh 😨', 'There was a problem refreshing the leaderboard, please refresh the page.', 'error');

                clearInterval(leaderboardPoll);
            });
    }

    if (window.location.href.split('/')[5] == 'play') {

        let holePoll        = setInterval(pollForHoleChange, 10000);
        let leaderboardPoll = setInterval(pollForLeaderboard, 30000);
    }
    // Quick fix for not-crossed-my-mind-this-would-happen module bundling
});


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

        swal('Woop 🎉', `Your par score for this hole is ${response.data.score}`, 'success');

    })
    .catch((error) => {

        swal('Uh-oh 😨', 'There was a problem submitting your score, try again in a minute.', 'error');
        // TODO: Could do with displaying validation errors
    });
});
