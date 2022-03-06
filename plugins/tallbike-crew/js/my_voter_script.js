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

//  function apiPostXhr(url, action, data) {
//    let request = new XMLHttpRequest();

//    request.open('POST', url, true);
//    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
//    request.onload = function () {
//        if (this.status >= 200 && this.status < 400) {
//            // Response success
//        } else {
//            // Response error
//        }
//    };
//    request.onerror = function() {
//        // Connection error
//    };
//    request.send('action=' + action + data);
// }

//  jQuery(document).ready( function() {

//    jQuery(".show_usertours").click( function(e) {
//       e.preventDefault(); 
//       tbuser = jQuery(this).attr("tbuser")
//       nonce = jQuery(this).attr("data-nonce")

//       jQuery.ajax({
//          type : "post",
//          dataType : "json",
//          url : myAjax.ajaxurl,
//          data : {action: "tb_show_usertours", tbuser : tbuser, nonce: nonce},
//          success: function(response) {
//             if(response.type == "success") {
//                jQuery("#show_usertours").html(response.usertours)
//                alert("im if")
//             }
//             else {
//                alert("Es gab Probleme, diese Touren zu finden!")
//             }
//          }
//       })   

//    })

// })