// function imagefun() {
//     var userid = $(this).val();
//     if(userid != '') {
//         alert("im JS!")
//         var data = {
//             'action': 'get_states_by_ajax',
//             'tb_user': userid,
//             'security': blog.security
//         }

//         $.post(blog.ajaxurl, data, function(response) {
//              $('.show_usertours').html(response);
//         });
//     //}
// });
// };

// Vorbild:
// https://artisansweb.net/how-to-use-jquery-ajax-wordpress/

// jQuery(document).ready(function () {
//     jQuery( "selecto" ).change(function () {
//     alert( "Handler for .change() called." ); 
//     var str = "";
//     jQuery( "select option:selected" ).each(function() {
//       str += $( this ).text() + " ";
//     });
//     jQuery( "div" ).text( str );
//   })
//   .change();
// });

jQuery( ".--bike-id" ).change(function() {
    //alert( "Händler for .change() called: " + blog.ajaxurl); // + ajax_object.ajax_url + "..." + blog.ajaxurl);
    var str = "1";
    //str += str;
    alert( "str:" + str);
    var data = {
        'action': 'show_points_form_ajax',
        'bike_id': 5
        //'whatever': ajax_object.we_value      // We pass php values differently!
    };
    //jQuery(".load_points_form").html(response);

    jQuery.post(blog.ajaxurl, data, function(response)
    {
        alert('Got this from the server: ' + response);
    });
});

    // jQuery.ajax({
    //     url : blog.ajaxurl,
    //     type : 'post',
    //     data : {
    //         action : 'show_points_form_ajax',
    //         bike_id : 5
    //     },
    //     success : function( response ) {
    //         jQuery(".load_points_form").html(response);
    //     }
    //     });
    // });

    // jQuery(document).ready(function($) {
    //     var data = {
    //         'action': 'my_action',
    //         'whatever': ajax_object.we_value      // We pass php values differently!
    //     };
    //     // We can also pass the url value separately from ajaxurl for front end AJAX implementations
    //     jQuery.post(ajax_object.ajax_url, data, function(response) {
    //         alert('Got this from the server: ' + response);
    //     });
    // });

    //jQuery.post(blog.ajaxurl, data, function(response) {
        //                  $('.load_points_form').html(response);
        //             }
   // var data = {
    //         'action': 'show_points_form_ajax',
    //         //'country': countryid,
    //         'security': blog.security
    //     }

    //     jQuery.post(blog.ajaxurl, data, function(response) {
    //             jQuery('.load_points_form').html(response);
    //     });
    // jQuery( "load-points-form" ).text( str );
  //});
//});

// jQuery(function($) {
//     alert ("test!");
//     $('body').on('change', '.bike-id', function() {
//         alert ("test!");
//         var countryid = $(this).val();
//         if(countryid != '') {
//             var data = {
//                 'action': 'show_points_form_ajax',
//                 'country': countryid,
//                 'security': blog.security
//             }
  
//             $.post(blog.ajaxurl, data, function(response) {
//                  $('.load_points_form').html(response);
//             });
//         }
//     });
// });

// jQuery.ajax(
//     {
//     type: "POST",
//     url: "/wp-admin/admin-ajax.php",
//     data: "1234",
//     action: 'show_points_form_ajax',
//     success: function(data) {
//       jQuery("#load_points_form").html(data);
//     }
//   });