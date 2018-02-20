function AddVote(id, url)
{
var $tdmspot_vote = jQuery.noConflict();
    // Utilisation d'Ajax / jQuery pour l'envoie
     $tdmspot_vote.ajax({
       type: "POST",
       url: url+"/include/jquery.php",
	 data: "op=addvote&vote_id="+id,
	   success: function(msg){
	   alert(msg);
	}
     });

    // Nous retournons "false" au navigateur afin que la page ne soit pas actualisé
    return false;
}

function RemoveVote(id, url)
{
var $tdmspot_vote = jQuery.noConflict();
    // Utilisation d'Ajax / jQuery pour l'envoie
     $tdmspot_vote.ajax({
       type: "POST",
       url: url+"/include/jquery.php",
	 data: "op=removevote&vote_id="+id,
	   success: function(msg){
		alert(msg);
	}
     });

    // Nous retournons "false" au navigateur afin que la page ne soit pas actualisé
    return false;
}

function masque(id) {

   	var $tdmspot = jQuery.noConflict();
	
	$tdmspot(document).ready(function(){

	 if ($tdmspot("#masque_" +id+ ":visible").length != 0) {
		$tdmspot("#masque_" +id).fadeOut("fast", function() {
            $tdmspot("#masque_" +id).fadeIn("fast").hide();
        });
   
    } else {	    
	$tdmspot("#masque_" +id).fadeOut("fast", function() {
         $tdmspot("#masque_" +id).fadeIn("fast").show();
     });
}

});

}


