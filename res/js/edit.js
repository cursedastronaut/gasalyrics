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
    const elements = document.querySelectorAll('[id^="lyric"]'); // Select elements whose ID starts with 'lyric'
    elements.forEach(inputText => {
        inputText.value = transformToEntities(inputText.value);
    });

    const inputText = document.getElementById("title0");
    inputText.value = transformToEntities(inputText.value);

    // Submit the form
    this.submit();
});


