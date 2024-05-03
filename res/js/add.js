let ii = 2;
function transformToEntities(str) {
	let result = "";
	for (let i = 0; i < str.length; i++) {
		if (str[i] == '\n')
			result += "<br>";
		else
			result += `&#${str.charCodeAt(i)};`;
	}
	return result;
}

document.getElementById("songToAdd").addEventListener("submit", function(event) {
	event.preventDefault(); // Prevent form submission
	for (let i = 1; document.getElementById("lyric" + i) != null; i+=1) {
		const inputText = document.getElementById("lyric" + i);
		inputText.value = transformToEntities(inputText.value);
	}
	const inputText = document.getElementById("title0");
	inputText.value = transformToEntities(inputText.value);
	

	// Set the transformed text as the value of a hidden input field
	/*
	const hiddenInput = document.createElement("input");
	hiddenInput.setAttribute("type", "hidden");
	hiddenInput.setAttribute("name", "transformedText");
	hiddenInput.setAttribute("value", transformedText);
	this.appendChild(hiddenInput);*/

	

	// Submit the form
	this.submit();
});

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

	/*
	Code de langue
			<input type="text" id="lyric" name="langCode"><br>
			Paroles
			<textarea type="text" id="lyric" name="inputText0"></textarea><br>
	*/
}