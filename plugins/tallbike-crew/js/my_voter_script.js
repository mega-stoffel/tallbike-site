jQuery(document).ready( function() {

    jQuery(".user_vote").click( function(e) {
       e.preventDefault(); 
       post_id = jQuery(this).attr("data-post_id")
       tbuser = jQuery(this).attr("tbuser")
       nonce = jQuery(this).attr("data-nonce")
 
       jQuery.ajax({
          type : "post",
          dataType : "json",
          url : myAjax.ajaxurl,
          data : {action: "tb_addme_tour", post_id : post_id, tbuser : tbuser, nonce: nonce},
          //data : {action: "my_user_vote", post_id : post_id, nonce: nonce},
          success: function(response) {
             if(response.type == "success") {
                jQuery("#vote_counter").html(response.vote_count)
             }
             else {
                alert("Es gab Probleme, dich zu dieser Tour zu registrieren.")
             }
          }
       })   
 
    })
 
 })