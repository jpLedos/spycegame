const lines = $('.line-mission');

lines.each(function(){
    const statut =  $(this).find('.statut').text();
    const isConform = $(this).find('.isConform').text();
    //console.log (isConform)

    //console.log(statut);
    switch (statut) {
        case 'En preparation':
            if(isConform==0) {
                $(this).addClass('bg-warning')
            } else {
                $(this).addClass('bg-light');
            }
            break;

        case 'en cours':
            $(this).addClass('bg-info');
            break;

        case 'Echec':
            $(this).addClass('bg-danger');
            break;
        
            case 'Terminé':
        $(this).addClass('bg-success');
        break;
    }
})