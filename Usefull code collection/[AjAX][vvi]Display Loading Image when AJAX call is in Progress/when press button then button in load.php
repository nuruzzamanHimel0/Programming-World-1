URL: https://makitweb.com/display-loading-image-when-ajax-call-is-in-progress/

<script type='text/javascript'>

$(document).ready(function(){
 
 $("#but_search").click(function(){
  var search = $('#search').val();

  $.ajax({
   url: 'fetch_deta.php',
   type: 'post',
   data: {search:search},
   beforeSend: function(){
    // Show image container
    $("#loader").show();
   },
   success: function(response){
    $('.response').empty();
    $('.response').append(response);
   },
   complete:function(data){
    // Hide image container
    $("#loader").hide();
   }
  });
 
 });
});
</script>

<input type='text' id='search'>
<input type='button' id='but_search' value='Search'><br/>

<!-- Image loader -->
<div id='loader' style='display: none;'>
  <img src='reload.gif' width='32px' height='32px'>
</div>
<!-- Image loader -->

<div class='response'></div>