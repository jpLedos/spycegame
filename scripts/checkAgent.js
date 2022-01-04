$(document).ready(() => {
    agentCheck();
//     $("#specialityId").change(function(){Check();})
//     $("#countryId").change(function(){missionCheck();})
 })

const agentCheck = function() {
    

    let isConform = $('#isConform');
    isConform.val(1); 
 
    const specialities=($('#specialities li'));
    const specialitiesRules = $('#specialities .rules') 

    specialitiesRules.css('display', 'none');   
    
// rules verification for speciality 
 // if 0 speciality    
    if(specialities.length===0) 
    {
        specialitiesRules.css({'color':'red','display':'block'});
        isConform.val(0);
    };
 
    console.log ('checked');
}