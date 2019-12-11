$(document).ready(function(){
    // alert("Hello Himel"); 
$('.preload').fadeOut('5000',function(){
    $('.container').fadeIn('slow');
});

fetch_user();

setInterval(function(){
    fetch_user();
    update_last_activity();
    update_chat_history_data();
    // ............ 10. Group Chat.........................
    fetch_group_chat_history();
},5000);


    function fetch_user()
    {
        $.ajax({
            url:'check/checkFetchUser.php', //fetch_user_details_wo_login($user_id)
            method:"POST",
            dataType:'text', // get response as a text
            success:function(reflection)
            {
                if(reflection != " ")
                {
                    $('#user-details').html(reflection);
                }
            }
        });
        return false;
    }


    function update_last_activity()
    {
        $.ajax({
            url:'check/checkUdtLastActivity.php', //check_update_last_activity($login_details_id)
            method:'POST',
            dataType: 'text',
            success:function(reflection)
            {
                // console.log(reflection);
            }
        });
        return false;
    }

// 5. Make Dynamic Chat Box for Each User in Ajax PHP Chat Application
function make_chat_dialog_box(to_user_id, to_user_name)
 {
  var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">';
  modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
   modal_content += fetch_user_chat_history(to_user_id);
  modal_content += '</div>';
  modal_content += '<div class="form-group">';
  modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message"></textarea>';
  modal_content += '</div><div class="form-group" align="right">';
  modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
  
  $('#user_model_details').html(modal_content);
  
 }

// 5. Make Dynamic Chat Box for Each User in Ajax PHP Chat Application

 $(document).on('click', '.start_chat', function(){
  var to_user_id = $(this).data('touserid');
  var to_user_name = $(this).data('tousername');
  make_chat_dialog_box(to_user_id, to_user_name);
  $("#user_dialog_"+to_user_id).dialog({
   autoOpen:false,
   width:400
  });
  $('#user_dialog_'+to_user_id).dialog('open');


  // 9. emoji plagin run into the textArea.....
     $('#chat_message_'+to_user_id).emojioneArea({
       pickerPosition:"top",
       toneStyle: "bullet"
      });

 });


// tut: 6 .......... Insert Chat Message into Mysql Database..................

 $(document).on('click','.send_chat',function(){

    var to_user_id = $(this).attr('id');
    var chat_message = $('#chat_message_'+to_user_id).val();

    $.ajax({
        url:'check/checkInsertChat.php',  //check_insert_chatting_message($to_user_id,$from_user_id,$chat_message,$status)
        method:'POST',
        data:{to_user_id:to_user_id,chat_message:chat_message},
        dataType: 'text',
        success:function(data)
        {
            // $('#chat_message_'+to_user_id).val(''); 

            //9. after  send_chat button click to remove text and emoji all from the text area 

            var element = $('#chat_message_'+to_user_id).emojioneArea();
            element[0].emojioneArea.setText('');

            $('#chat_history_'+to_user_id).html(data);
            // console.log(data);
        }
    });

    // alert(to_user_id+" --  "+chat_message);
 });

// 7. ........ Auto Refresh Chat Message in PHP Chat Application............

// this function use for update chatting message form form_user_id and to_user_id
function fetch_user_chat_history(to_user_id)
 {
  $.ajax({
  url:'check/fetch_user_chat_history.php',  //fetch_user_chat_history($from_user_id,$to_user_id)
   method:"POST",
   data:{to_user_id:to_user_id},
   dataType:'text',
   success:function(data){
    $('#chat_history_'+to_user_id).html(data);
   }
  })
 }

// 7. Auto Refresh Chat Message in PHP Chat Application............
function update_chat_history_data()
{
    $('.chat_history').each(function(){
        var to_user_id = $(this).data('touserid');
        fetch_user_chat_history(to_user_id);
        // console.log(to_user_id);
    });
}
// 7. Auto Refresh Chat Message in PHP Chat Application............
// // if click cross button form modal then all open pop up dialog will be distroyed
$(document).on('click', '.ui-button-icon', function(){
  // $('.user_dialog').dialog('destroy').remove();
  $(this).dialog('destroy').remove();
 });




// 8. Display Typing Notification to Receiver When Sender Start Type....................
$(document).on('focus','.chat_message',function(){
    var is_type ='yes';
    $.ajax({
        url:'check/check_update_is_type_status.php', //update_is_type_status($login_details_id,$is_type)
        method:'POST',
        data:{is_type:is_type},
        dataType:'text',
        success:function(reflection)
        {
                // console.log(reflection);
        }
    });
    return false;
});

// 8. Display Typing Notification to Receiver When Sender Start Type................
$(document).on('blur','.chat_message',function(){
    
    var is_type = 'no';
    $.ajax({
        url:'check/check_update_is_type_status.php', //update_is_type_status($login_details_id,$is_type)
        method:'POST',
        data:{is_type:is_type},
        dataType:'text',
        success:function(reflection)
        {
                // console.log(reflection);
        }
    });
    return false;


});

 // ............ 10. Group Chat......................... 
 // that's means group_chat_dialog div Always autoOpen false
$('#group_chat_dialog').dialog({
    autoOpen:false,
    width:700
});
 // ............ 10. Group Chat.........................

$(document).on('click','#group_chat',function(){
    $('#group_chat_dialog').dialog('open');
    $('#is_active_group_chat_window').val('yes');
    fetch_group_chat_history();

});
 // ............ 10. Group Chat.........................
$('#send_group_chat').on('click',function(){
    var chat_message = $('#group_chat_message').val();
    var action = "insert_data";

    if(chat_message != " ")
    {
        $.ajax({
              url:'check/check_group_chat.php',
              method:'POST',
              data:{chat_message:chat_message,action:action},
              dataType:'text',
              success:function(reflection)
              {
                $('#group_chat_message').val('');
                $('#group_chat_history').html(reflection);
                // console.log(reflection);
              }
        });
    }

    // console.log(chat_message+" -- === "+action);
});

 // ............ 10. Group Chat.........................
function fetch_group_chat_history()
{
    // console.log('click grou chat');
    var is_active_group_chat_window = $('#is_active_group_chat_window').val();
    var action = "fetch_data";

    if(is_active_group_chat_window == 'yes')
    {
         $.ajax({
              url:'check/check_group_chat.php', //fetch_group_chat_history()
              method:'POST',
              data:{action:action},
              dataType:'text',
              success:function(reflection)
              {    
                $('#group_chat_history').html(reflection);
              }
        });
         // return false;
    }
}

$(document).on('click','.remove_chat',function(){

    var chat_message_id = $(this).attr('id');

    if(confirm('Are you sure to want to delete'))
    {

         $.ajax({
              url:'check/check_remove_chat.php', //fetch_group_chat_history()
              method:'POST',
              data:{chat_message_id:chat_message_id},
              dataType:'text',
              success:function(reflection)
              {    
                // $('#group_chat_history').html(reflection);
                update_chat_history_data();
                console.log(reflection);
              }
        });

    // console.log(chat_message_id); 
    }
});


$(document).on('click','.remove_group_chat',function(){

  var chat_message_id = $(this).attr('id'); 

      if(confirm('Are you sure to want to delete'))
    {

         $.ajax({
              url:'check/check_remove_chat.php', //fetch_group_chat_history()
              method:'POST',
              data:{chat_message_id:chat_message_id},
              dataType:'text',
              success:function(reflection)
              {    
                // $('#group_chat_history').html(reflection);
                fetch_group_chat_history();
              }
        });

    // console.log(chat_message_id); 
    }

  // console.log(chat_message_id); 


});













    
});