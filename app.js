function updateTable(day, start, end, data, color) {
	var pDay = ["mon", "tue", "wed", "thu", "fri", "sat", "sun"];
	for(var i = start+1 ; i <= end ; i++) {
		$('#'+pDay[day]+i).remove();
	}

	var elemt = document.getElementById(pDay[day]+start);
	elemt.colSpan = (end - start) + 1;
	elemt.innerHTML = "<center style='color: #000;'>" + data[4] + "<br>" + data[3] + " | " + data[8] + "</center>";
	elemt.style.backgroundColor = color;
}
