function getErrors(data) {
	let errors = [];
	if(data.responseJSON){
		let data_errors = data.responseJSON.errors;
		if(data_errors == undefined) {
			errors.push({type: "erreur", messages: [data.responseJSON.message]});
		} else {
			$.each(data_errors, function(key, value) {
				errors.push({type: key, messages: value});
			});
		}
	}
	return errors;
}

function isSuccessStatus(status) {
	return status == 200 || status == 201 || status == 204;
}
