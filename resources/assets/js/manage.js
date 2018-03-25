import swal from 'sweetalert';

$('#game-code-btn').on('click', function() {

    $('[name=game-code]').select();

    document.execCommand('Copy');

    window.getSelection().removeAllRanges();

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
    });
    //TODO: Do ajax endpointy stuff
});

$('#penalise-player-btn').on('click', function() {

    let $swalContent = $('#swal-penalise-content-template').clone().css({'display': 'block'});

    swal({
        title: 'Penalise player',
        content: $swalContent[0],
        buttons: [true, 'Send them down!']
    });
    //TODO: Do ajax endpointy stuff
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
    });
    //TODO: Do ajax endpointy stuff
});

$('.edit-hole-btn').on('click', function() {

    let $swalContent = $('#swal-hole-content-template').clone().css({'display': 'block'})
      , holeNumber   = $(this).data('ref');

    swal({
        title: 'Edit hole ' + (holeNumber + 1),
        content: $swalContent[0],
        buttons: [true, 'Save changes']
    });
    //TODO: Do ajax endpointy stuff
});

$('.delete-hole-btn').on('click', function() {

    let holeNumber = $(this).data('ref');

    swal({
        title: 'Delete hole ' + (holeNumber + 1) + '?',
        text: 'This will permanently delete the hole, with all associated scores and data. This is action not recoverable. Continue?',
        icon: 'warning',
        buttons: ['Hell no!', 'Yes, delete the hole'],
        dangerMode: true,
    });
    //TODO: Do ajax endpointy stuff
});
