function zeit(){
	var Heute = new Date();
	var Tag = Heute.getDay();
	var Monat = Heute.getMonth();
	var Jahr = Heute.getFullYear();
	var Sekunde = Heute.getSeconds();
	var Minute = Heute.getMinutes();
	var Stunde = Heute.getHours();
	
	Sekunde = checkZeit(Sekunde);
	Minute = checkZeit(Minute);
	Stunde = checkZeit(Stunde);
	
	document.getElementById("time").innerHTML = Stunde+ ':' +Minute+ ':' +Sekunde;

	setTimeout(zeit , 1000);	
}

function checkZeit(i) {
	if (i<10) {
		i = "0" + i;
	}	
	return i;
}