const lines = $('.line-agent');

lines.each(function(){
    const isDead =  $(this).find('.isDead').text();
    const isConform = $(this).find('.isConform').text();
    //console.log (isConform+ " / "  + isDead)

    if(isDead==true) {
        $(this).addClass('bg-dark text-white');
    }else if(isConform==false) {
        $(this).addClass('bg-warning')
    }



})