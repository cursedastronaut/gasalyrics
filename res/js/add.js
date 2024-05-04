let ii = 2;

function morelyrics() {
	const hiddenInput = document.createElement("input");
    hiddenInput.setAttribute("type", "text");
    hiddenInput.setAttribute("name", "inputText" + ii);
    this.appendChild(hiddenInput);

	const textArea = document.createElement("textarea");
    textArea.setAttribute("type", "text");
    textArea.setAttribute("id", "lyric" + ii);
    textArea.setAttribute("name", "inputText" + ii);
    this.appendChild(textArea); 
	i+=1;
}