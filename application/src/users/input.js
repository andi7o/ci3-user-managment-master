window.onload = function () {
	let titleInput = document.getElementById("title");
	document.title = titleInput.value;
	document.getElementById("title2").innerHTML = titleInput.value;
};

