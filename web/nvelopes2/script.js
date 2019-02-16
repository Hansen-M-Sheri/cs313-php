function addTransaction(envelopeID, userID, date, details, amount) {
	$.post('./ajax.php',
		{"envelopeID": envelopeID, "userID": userID, "date": date, "details":details, "amount": amount},
			function (returnedData) {
				console.log(returnedData);

		}, 'json');
}