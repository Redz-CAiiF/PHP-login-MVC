function bind(){
    var index = 0;
    $('.md-select').on('click', function() {
        if(index===0){
            $(this).addClass('active');
            $('.block').addClass('visible');
            index++;
        }else{
            index=0;
        }
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
        //rimuovo la classe active e visible
        $('.md-select').removeClass('active');
        $('.block').removeClass('visible');
    });
}
function unbind(){
    $('.md-select').unbind();
    $('.block').unbind();
    $('.md-select ul li').unbind();
}

$(document).ready (bind);
$(document).ajaxComplete (function(){
    unbind();
    bind();
});