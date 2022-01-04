$(document).ready(() => {
    missionCheck();
    $("#specialityId").change(function(){missionCheck();})
    $("#countryId").change(function(){missionCheck();})
})

//$speciality('#speciality').change(() => {missionCheck()}) ; 


const missionCheck = function() {
    

    let isConform = $('#isConform');
    isConform.val(1); 
    
    let country=$('#country').text(); 
    if (country ===""){
         country = $('#countryId :selected').text();
         country = country.substring(0, country.length -20);
    }
    //console.log('country/'+country+'/');

    let speciality=$('#speciality').text(); 
    speciality = speciality.substring(0, speciality.length -1);
    if (speciality ==="") // si on est dans editMission.php
    {   
        //speciality = $("#specialityId").children("option:selected").text();  
        speciality = $('#specialityId :selected').text();
        speciality = speciality.substring(0, speciality.length -20);
    }
    //console.log('/'+speciality+'/');
    
    const agents=($('#agents li'));
    const agentsRules = $('#agents .rules') 
    
    const targets=($('#targets li'));
    const targetsRules = $('#targets .rules'); 
    
    const contacts=($('#contacts li'));
    const contactsRules = $('#contacts .rules') 
    
    const hideaways=($('#hideaways li'));
    const hideawaysRules = $('#hideaways .rules') 

    agentsRules.css('display', 'none');   
    targetsRules.css('display', 'none');
    contactsRules.css('display', 'none');
    hideawaysRules.css('display', 'none')
    

    // rules verification for Agents
    // if 0 agent
    if(agents.length===0) 
    {
        agentsRules.css({'color':'red','display':'block'});
        isConform.val(0);
    };

    //check agents & targets country
    
    targets.each(function () {
        $(this).css({'color':'black','display':'list-item'})
        const targetCountry = $(this).find('.targetCountry').text();
        //console.log(targetCountry);
        agents.each(function () {
            const agentCountry = $(this).find('.agentCountry').text();
            //console.log(agentCountry);
             if (targetCountry === agentCountry){
                $(this).css({'color':'red','display':'list-item'});
                agentsRules.css({'color':'red','display':'block'});
                isConform.val(0);
            }
        })
    }) 
    // check agents specialities have mission speciality
    const  agentsSpecialities  = $('.agentSpecialities').text();
    //console.log(agentsSpecialities.search(speciality));
    if(agentsSpecialities.search(speciality)<0) {
        agentsRules.css({'color':'red','display':'block'});
        isConform.val(0);
    } 

    // rules verification for targets
    if(targets.length===0) 
    {
        targetsRules.css({'color':'red','display':'block'});
        isConform.val(0);
    };

// rules verification for contacts     
    if(contacts.length===0) 
    {
        contactsRules.css({'color':'red','display':'block'});
        isConform.val(0);
    };

    contacts.each(function(){
        $(this).css({'color':'black','display':'list-item'})
        const contactCountry = $(this).find('.contactCountry').text();
        //console.log(contactCountry);
        if (contactCountry.search(country) <0){
            $(this).css({'color':'red','display':'list-item'});
            contactsRules.css({'color':'red','display':'block'});
            isConform.val(0);
        };
    })  


// rules verification for hideaways
    hideaways.each(function(){
        $(this).css({'color':'black','display':'list-item'})
        if ($(this).text().search(country) <0){
            $(this).css({'color':'red','display':'list-item'});
            hideawaysRules.css({'color':'red','display':'block'});
            isConform.val(0);
        };
    }) 

    console.log ('checked');
}