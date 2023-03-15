var formulario = document.getElementById("form-contact");
var formstatus = document.getElementById("form-status");

formulario.addEventListener("submit", function (e) {
	e.preventDefault();
	var formUrl = formulario.getAttribute("action");
	var formMethod = formulario.getAttribute("method");

	//console.log("procesando form");
	var datosform = new FormData(formulario);
	fetch(formUrl, {
		method: formMethod,
		body: datosform,
	})
		.then((res) => res.json())
		.then((data) => {
			//console.log(data);
			if (data.estado === false) {
				formstatus.innerHTML =
					'<div class=flex w-full bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert""><p>se presentaron fallos en la comunicacion ' +
					data.message +
					"</div>";
			} else {
				formstatus.innerHTML =
					'<div class="flex w-full bg-green-200 border border-green-500 text-green-700 px-4 py-3 rounded relative" role="alert""><p>' +
					data.message +
					"</div>";
			}
		});
});
