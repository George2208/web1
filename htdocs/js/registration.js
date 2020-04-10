function darkMode() {
	document.body.classList.toggle("dark-mode");
	if(document.body.classList.contains("dark-mode"))
		localStorage.setItem("darkmode", "true");
	else
		localStorage.setItem("darkmode", "false");
}

window.onload = function(){
	if (typeof(Storage) !== "undefined" && localStorage.getItem("darkmode") == "true") {
		document.body.classList.toggle("dark-mode");
	}
}