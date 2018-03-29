$('#code-btn').on('click', function() {

    var $temp = $('<input>');

    $('body').append($temp);

    $temp.val('https://pub-golf.othyn.com/games/' + $('[name=code]').val() + '/join').select();

    document.execCommand('copy');

    $temp.remove();

    $(this).removeClass('is-info')
           .addClass('is-success')
           .text('Copied!');
});

$('#active-hole-btn').on('click', function() {

    let $swalContent = $('#swal-active-hole-content-template').clone().css({'display': 'block'});

    swal({
        title: 'Set active hole',
        content: $swalContent[0],
        buttons: [true, 'Let\'s go!']
    })
    .then((value) => {

        if (value) {

            let game = $(this).data('game')
              , hole = $('.swal-content').find('[name=active_hole]').val();

            axios({
                method: 'PUT',
                url: '/games/' + game + '/active-hole/' + hole
            })
            .then((response) => {

                swal('Hole set 👌', `The active hole is now ${response.data.location}, drinking ${response.data.drink} with a par of ${response.data.par}`, 'success');

            })
            .catch((error) => {

                swal('Uh-oh 😨', 'There was a problem changing the hole, try again in a minute.', 'error');
                // TODO: Could do with displaying validation errors
            });

        }

    });
});

$('#edit-game-btn').on('click', function() {

    let $swalContent = $('#swal-edit-game-content-template').clone().css({'display': 'block'});

    swal({
        title: 'Edit game',
        content: $swalContent[0],
        buttons: [true, 'Save changes']
    });
    //TODO: Do ajax endpointy stuff
});

$('#create-hole-btn').on('click', function() {

    let $swalContent = $('#swal-hole-content-template').clone().css({'display': 'block'});

    swal({
        title: 'New hole',
        content: $swalContent[0],
        buttons: [true, 'Create hole']
    })
    .then((value) => {

        if (value) {

            let game     = $(this).data('game')
              , location = $('.swal-content').find('[name=hole_location]').val()
              , drink    = $('.swal-content').find('[name=hole_drink]').val()
              , par      = $('.swal-content').find('[name=hole_par]').val();

            axios({
                method: 'POST',
                url: '/games/' + game + '/hole',
                data: {
                    location: location,
                    drink: drink,
                    par: par
                }
            })
            .then((response) => {

                swal('Hole created ⛳', 'Hole is now available to play!', 'success');

                $('#hole-tbody').html(response.data);

            })
            .catch((error) => {

                swal('Uh-oh 😨', 'There was a problem changing the hole, try again in a minute.', 'error');
                // TODO: Could do with displaying validation errors
            });

        }

    });
});

$('#hole-tbody').on('click', '.edit-hole-btn', function() {

    let $swalContent = $('#swal-hole-content-template').clone().css({'display': 'block'})
      , location     = $(this).data('location')
      , drink        = $(this).data('drink')
      , par          = $(this).data('par');

    $swalContent.find('[name=hole_location]').val(location);
    $swalContent.find('[name=hole_drink]').val(drink);
    $swalContent.find('[name=hole_par]').val(par);

    swal({
        title: `Edit ${location}`,
        content: $swalContent[0],
        buttons: [true, 'Save changes']
    })
    .then((value) => {

        if (value) {

            let game     = $(this).data('game')
              , hole     = $(this).data('hole')
              , location = $('.swal-content').find('[name=hole_location]').val()
              , drink    = $('.swal-content').find('[name=hole_drink]').val()
              , par      = $('.swal-content').find('[name=hole_par]').val();

            axios({
                method: 'POST',
                url: '/games/' + game + '/hole/' + hole,
                data: {
                    location: location,
                    drink: drink,
                    par: par
                }
            })
            .then((response) => {

                swal('Hole updated ⛳', 'The stuff you wrote has been saved somewhere, i\'ll find it later.', 'success');

                $('#hole-tbody').html(response.data);

            })
            .catch((error) => {

                swal('Uh-oh 😨', 'There was a problem changing the hole, try again in a minute.', 'error');
                // TODO: Could do with displaying validation errors
            });

        }

    });
});

$('#hole-tbody').on('click', '.delete-hole-btn', function() {

    let $swalContent = $('#swal-hole-content-template').clone().css({'display': 'block'})
      , location     = $(this).data('location');

    swal({
        title: `Delete ${location}?`,
        text: 'This will permanently delete the hole, with all associated scores and data. This is action not recoverable. Continue?',
        icon: 'warning',
        buttons: ['Hell no!', 'Yes, delete the hole'],
        dangerMode: true,
    })
    .then((value) => {

        if (value) {

            let game = $(this).data('game')
              , hole = $(this).data('hole');

            axios({
                method: 'DELETE',
                url: '/games/' + game + '/hole/' + hole
            })
            .then((response) => {

                swal('Hole deleted 💔', 'We\'ll miss you, hole.', 'success');

                $('#hole-tbody').html(response.data);

            })
            .catch((error) => {

                swal('Uh-oh 😨', 'There was a problem changing the hole, try again in a minute.', 'error');
                // TODO: Could do with displaying validation errors
            });

        }

    });
});

$('.penalise-player-btn').on('click', function() {

    let $swalContent = $('#swal-player-content-template').clone().css({'display': 'block'})
      , player       = $(this).data('ref')
      , playerName   = $(this).data('name');

    swal({
        title: `Penalise ${playerName}`,
        content: $swalContent[0],
        buttons: [true, 'Send them down!']
    });
    //TODO: Do ajax endpointy stuff
});

$('.delete-player-btn').on('click', function() {

    let player     = $(this).data('ref')
      , playerName = $(this).data('name');

    swal({
        title: `Delete ${playerName}?`,
        text: 'This will permanently delete the player and their score. This is action not recoverable. Continue?',
        icon: 'warning',
        buttons: ['Hell no!', 'Yes, delete them'],
        dangerMode: true,
    });
    //TODO: Do ajax endpointy stuff
});
