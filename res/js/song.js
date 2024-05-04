function toggleDisplay(id) {
	const element = document.getElementById(id);
	if (element.style.fontSize === "0px" || element.style.fontSize === '') {
		element.style.fontSize = "inherit";
		element.parentElement.style.paddingInline = "var(--lyrics-padding-inline)";
	} else {
		element.style.fontSize = "0px";
		element.parentElement.style.paddingInline = "0px";
	}
}