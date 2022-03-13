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

jQuery(function($) {
    alert "test!"
    $('body').on('change', '.bike-id', function() {
        alert "test!"
        var countryid = $(this).val();
        if(countryid != '') {
            var data = {
                'action': 'show_points_form_ajax',
                'country': countryid,
                'security': blog.security
            }
  
            $.post(blog.ajaxurl, data, function(response) {
                 $('.load_points_form').html(response);
            });
        }
    });
});

jQuery.ajax(
    alert "test123"
    {
    type: "POST",
    url: "/wp-admin/admin-ajax.php",
    data: "1234",
    action: 'show_points_form_ajax',
    success: function(data) {
      jQuery("#load_points_form").html(data);
    }
  });