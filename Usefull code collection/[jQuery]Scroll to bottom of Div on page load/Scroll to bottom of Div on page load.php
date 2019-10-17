url: https://stackoverflow.com/questions/10503606/scroll-to-bottom-of-div-on-page-load-jquery
Here is the correct version:

$('#div1').scrollTop($('#div1')[0].scrollHeight);

or jQuery 1.6+ version:

var d = $('#div1');
d.scrollTop(d.prop("scrollHeight"));

Or animated:

$("#div1").animate({ scrollTop: $('#div1').prop("scrollHeight")}, 1000)