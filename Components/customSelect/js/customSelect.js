jQuery.document_ready (function() {

    $('.md-select').on('click', function() {
        $(this).toggleClass('active');
        $('.block').toggleClass('visible');
    });

    $('.block').on('click', function() {
        $('.md-select').removeClass('active');
        $(this).removeClass('visible');
    });

    $('.md-select ul li').on('click', function() {
        var v = $(this).text();
        $('.md-select ul li').not($(this)).removeClass('active');
        $(this).addClass('active');
        $(this).parent().siblings("label").text(v);
        $(this).parent().parent().siblings("input").attr('value', v);
    });

});
