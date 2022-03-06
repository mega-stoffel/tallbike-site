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
    $('body').on('click', '.show_usertours', function() {
        alert("im JS1!")
        var tbuser = $(this).val();
        if(tbuser != '') {
            alert("im JS2!" + tbuser + "--")
            var data = {
                'action': 'get_states_by_ajax',
                'tbuser': tbuser,
                'security': tb_scripts.security
            }
  
            $.post(tb_scripts.ajaxurl, data, function(response) {
                 $('.show_usertours').html(response);
            });
        }
    });
});
