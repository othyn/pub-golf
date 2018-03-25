$('#game-code-btn').on('click', function() {

    $('[name=game-code]').select();

    document.execCommand('Copy');

    window.getSelection().removeAllRanges();

    $(this).removeClass('is-info')
           .addClass('is-success')
           .text('Copied!');
});
