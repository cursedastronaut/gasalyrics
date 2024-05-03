function toggleDisplay(id) {
	const element = document.getElementById(id);
	if (element.style.fontSize === "0px" || element.style.fontSize === '') {
		element.style.fontSize = "inherit";
	} else {
		element.style.fontSize = "0px";
	}
}