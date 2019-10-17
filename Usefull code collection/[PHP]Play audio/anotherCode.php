function playAudio() {
  var audio = new Audio('http://www.music.helsinki.fi/tmt/opetus/uusmedia/esim/a2002011001-e02.wav');  
  audio.type = 'audio/wav';

  var playPromise = audio.play();

  if (playPromise !== undefined) {
      playPromise.then(function () {
          console.log('Playing....');
      }).catch(function (error) {
          console.log('Failed to play....' + error);
      });
  }
}

<a href="#" onclick="playAudio()">Play Audio</a>