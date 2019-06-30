BLOG LINK : http://www.developphp.com/video/JavaScript/Button-Sound-Effects-Tutorial-Audible-Menu-Systems

youtube link: https://www.youtube.com/watch?v=VlwSz2dXK_8

<!DOCTYPE html>
<html>
<head>
<style>
nav#nav1{ margin-top: 24px; }
</style>
<script>

function maleVoice(){
	var male = new Audio();
	male.src = "male-speech.mp3";
    male.play(); // Play button sound now
    // var div1 = document.getElementById("div1");
    // div1.innerHTML = "Loaded content for section "+string;
}

function femaleVoice(){
	var female = new Audio();
	female.src = "female-speech.mp3";
    female.play(); // Play button sound now
    // var div1 = document.getElementById("div1");
    // div1.innerHTML = "Loaded content for section "+string;
}

</script>
</head>
<body>
  <nav id="nav1">
    <button onclick="maleVoice()">Male voice</button>
    <button onclick="femaleVoice()">Female voice</button>
    
  </nav>
  <div id="div1">Default content ...</div>
</body>
</html>

<!-- OR............................................

<!DOCTYPE html>
<html>
<head>
<style>
nav#nav1{ margin-top: 24px; }
nav#nav1 > a{ background:#B9E1FF; color:#000; padding:10px; text-decoration:none; border-radius:5px; font-family:"Arial Black", Gadget, sans-serif; }
nav#nav1 > a:hover{ background: #BBEA00; }
nav#nav1 > a:active{ background: #EEFFA8; }
</style>
<script>
var bleep = new Audio();
bleep.src = 'female-speech.mp3';
</script>
</head>
<body>
  <nav id="nav1">
    <a href="#" onmousedown="bleep.play()">Home</a>
    <a href="#" onmousedown="bleep.play()">About Us</a>
    <a href="#" onmousedown="bleep.play()">Services</a>
    <a href="#" onmousedown="bleep.play()">Contact</a>
  </nav>
</body>
</html>



OR ........................................


<!DOCTYPE html>
<html>
<head>
<style>
nav#nav1{ margin-top: 24px; }
</style>
<script>
var bleep = new Audio();
bleep.src = "female-speech.mp3";
function loadContent(num){
    bleep.play(); // Play button sound now
    var div1 = document.getElementById("div1");
    div1.innerHTML = "Loaded content for section "+num;
}
</script>
</head>
<body>
  <nav id="nav1">
    <button onclick="loadContent(1)">Section 1</button>
    <button onclick="loadContent(2)">Section 2</button>
    <button onclick="loadContent(3)">Section 3</button>
  </nav>
  <div id="div1">Default content ...</div>
</body>
</html> -->