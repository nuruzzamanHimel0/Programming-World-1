var btn = document.getElementById("buttn");

btn.addEventListener('click',myFunction);

function myFunction()
{
	var mn = document.querySelector('#mn').value;
	var dis = document.querySelector('#dis').value;
	modal(mn,dis);
}

function modal(mn,dis)
{
	var overlay = document.createElement('div');
	overlay.style.height="100%";
	overlay.style.width ="100%";
	overlay.style.position = "absolute";
	overlay.style.background = "rgba(0,0,0,0.3)";
	overlay.style.top = "0px";
	overlay.style.bottom = "0px";
	document.body.appendChild(overlay);


	var main = document.createElement('div');
	main.style.background ='red';
	main.style.height = '400px';
	main.style.width = '600px';
	main.style.margin = '0 auto';
	main.style.padding = '18px';
	// main.style.display = 'relative';
	// main.style.top ="80%";
	// main.style.borderRadius = '5px';
	main.style.transform = "translateY(20%)";
	overlay.appendChild(main);

// DESCRIPTION DIV.....................

	var tt1 = document.createElement("h2");
	tt1.innerHTML = mn;
	tt1.style.margin="0px";
	tt1.style.marginBottom="10px";
	tt1.style.padding="0px";
	main.appendChild(tt1);

	var d = document.createElement('p');
	d.innerHTML = dis;
	d.style.margin="0px";
	d.style.marginBottom="10px";
	d.style.padding="0px";

	main.appendChild(d);

	for(i = 0; i<3;i++)
	{
		var brakrow = document.createElement('br');
		main.appendChild(brakrow);
	}

	var clearb = document.createElement('input');
	clearb.setAttribute('type','button');
	clearb.setAttribute('value','cancel');
	main.appendChild(clearb);

	clearb.addEventListener('click',function(){
		document.body.removeChild(overlay);
	});

	for(i = 0; i<2;i++)
	{
		var brakrow = document.createElement('br');
		main.appendChild(brakrow);
	}

	var t = document.createElement('p');
	t.innerHTML = "Domain name:";
	t.fontSize = '18px';
	main.appendChild(t);

	var ip = document.createElement('input');
	ip.setAttribute('type','text');
	ip.setAttribute('placeholder','Domain name');
	main.appendChild(ip);

	var brakrow = document.createElement('br');
		main.appendChild(brakrow);

	var go = document.createElement('input');
	go.setAttribute('type','button');
	go.setAttribute('value','go');
	main.appendChild(go);
	go.addEventListener('click',function(){
		window.location = 'https://'+ip.value;
		document.body.removeChild(overlay);

	});



}