var upperCase= new RegExp('[A-Z]');
var lowerCase= new RegExp('[a-z]');
var numbers = new RegExp('[0-9]');
var space = new RegExp('[ ]');
var correctEmail = new RegExp('[@]');
var nonword = new RegExp('\W');

function checkSubmitValidity() {

		if($('#firstnameMessage').text()!="" || $('#lastnameMessage').text()!="" || $('#emailaddMessage').text()!="" || $('#mobileMessage').text()!="" ||  $('input[name="firstname"]').val()=="" || $('input[name="lastname"]').val()=="" || $('input[name="emailadd"]').val()=="" || $('input[name="mobile"]').val()=="") {
				$('#register').attr('disabled', 'disabled');
		}
		else {
				$('#register').removeAttr('disabled');
		}

}

$('input[type="submit"]').ready(function() {
		checkSubmitValidity();
});

$('input[name="username"]').keyup(function() {
		var inputVal = $(this).val();

		function checkValidity(ss) {
				var message = "";

				if(ss!="") {

						if(ss.match(upperCase)){
								message = "No uppercase";
						}

						if(ss.match(space)){
								if(message=="") {
										message = "No space";
								}
								else {
										message += " and space";
								}
						}

						if(ss.length < 5) {
								if(message=="") {
										message = "At least 5 characters";
								}
								else {
										message += " and atleast 5 characters";
								}
						}

						if(ss.length > 30) {
								if(message=="") {
										message = "Not more than 30 characters";
								}
								else {
										message += " and not more than 30 characters";
								}
						}
				}
				else {
						message = "Enter your username";
				}

				if(message!="") {
						message += " please!";
						$('input[type="submit"]').attr('disabled', 'disabled');
						$('#usernameMessage').css('color', 'red');
				}
				else {

						var xmlHttp = createXmlHttpRequestObject();

						process();

						function createXmlHttpRequestObject() {
								var xmlHttp;

								if(window.ActiveXObject) {
										try{
												xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
										}
										catch(e) {
												xmlHttp = false;
										}
								}
								else {
										try {
												xmlHttp = new XMLHttpRequest();
										}
										catch(e) {
												xmlHttp = false;
										}
								}
								if(!xmlHttp) {
										alert("Can't create object!");
								}
								else {
										return xmlHttp;
								}
						}

						function process() {
								if(xmlHttp.readyState == 0 || xmlHttp.readyState == 4) {
//					theVal = encodeURIComponent(document.getElementById("username").value);
										xmlHttp.open("GET", "queries/checkuser.php?username=" +inputVal, true);
										xmlHttp.onreadystatechange = handleServerResponse;
										xmlHttp.send(null);
								}
								else {
										setTimeout('process()', 1000);
								}
						}

						function handleServerResponse() {
								if(xmlHttp.readyState == 4) {
										if(xmlHttp.status==200) {
												xmlRespose = xmlHttp.responseXML;
												xmlDocumentElement = xmlRespose.documentElement;
												message = xmlDocumentElement.firstChild.data;
												if(message=="Username available!") {
														$('#usernameMessage').css('color', 'green');
												}
												else {
														$('#usernameMessage').css('color', '#f00');
												}
												$('#usernameMessage').text(message);
												setTimeout('process()', 1000);
										}
										else {
												alert("Something went wrong!");
										}
								}
						}

				}

				return message;
		}

		$('#usernameMessage').text(checkValidity(inputVal));
		checkSubmitValidity();

});

$('input[name="password"]').keyup(function() {
		var inputVal = $(this).val();

		function checkValidity(ss) {
				var message = "";

				if(ss!="") {
						if(ss.length < 5) {
								if(message=="") {
										message = "Atleast 5 characters";
								}
								else {
										message += " and atleast 5 characters";
								}
						}
						if(ss.length > 15) {
								if(message=="") {
										message = "Not more than 15 characters";
								}
								else {
										message += " and not more than 15 characters";
								}
						}
				}
				else {
						message = "Enter your password";
				}

				if(message!="") {
						message += " please!";
						$('input[type="submit"]').attr('disabled', 'disabled');
				}

				return message;
		}

		$('#passwordMessage').text(checkValidity(inputVal));
		checkSubmitValidity();

});

$('input[name="firstname"]').keyup(function() {

		var inputVal = $(this).val();

		function checkValidity(ss) {
				var message = "";

				if(ss!="") {
						if(ss.substring(0,2).match(space)) {
								message = "No space on first and second characters";
						}
						else {
								if(ss.length < 2) {
										if(message=="") {
												message = "Atleast 2 characters";
										}
										else {
												message += " and atleast 2 characters";
										}
								}
								else if(ss.length > 20) {
										if(message=="") {
												message = "Maximum of 20 characters only";
										}
										else {
												message += " and maximum of 20 characters only";
										}
								}
/*				else {
										if(ss.match(nonword)) {
										if(message=="") {
												message = "Input letters";
										}
										else {
												message += " and input letters";
										}
										}
								} */
						}
				}
				else {
						message = "Enter your First Name";
				}

				if(message!="") {
						message += " please!";
						$('input[type="submit"]').attr('disabled', 'disabled');
				}

				return message;
		}

		$('#firstnameMessage').text(checkValidity(inputVal));
		checkSubmitValidity();

});

$('input[name="lastname"]').keyup(function() {

		var inputVal = $(this).val();

		function checkValidity(ss) {
				var message = "";

				if(ss!="") {
						if(ss.substring(0,2).match(space)) {
								message = "No space on first and second characters";
						}
						else {
								if(ss.length < 2) {
										if(message=="") {
												message = "Atleast 2 characters";
										}
										else {
												message += " and atleast 2 characters";
										}
								}

								if(ss.length > 20) {
										if(message=="") {
												message = "Maximum of 20 characters only";
										}
										else {
												message += " and maximum of 20 characters only";
										}
								}
						}
				}
				else {
						message = "Enter your Last Name";
				}

				if(message!="") {
						message += " please!";
						$('input[type="submit"]').attr('disabled', 'disabled');
				}

				return message;
		}

		$('#lastnameMessage').text(checkValidity(inputVal));
		checkSubmitValidity();

});

$('input[name="emailadd"]').keyup(function() {

		var inputVal = $(this).val();

		function checkValidity(ss) {
				var message = "";

				if(ss!="") {
						if(ss.length < 4) {
								if(message=="") {
										message = "Atleast 4 characters";
								}
								else {
										message += " and atleast 4 characters";
								}
						}

				}
				else {
						message = "Enter your Email Address";
				}

				if(message!="") {
						message += " please!";
						$('input[type="submit"]').attr('disabled', 'disabled');
				}

				return message;
		}

		$('#emailaddMessage').text(checkValidity(inputVal));
		checkSubmitValidity();

});

$('input[name="mobile"]').keyup(function() {

		var inputVal = $(this).val();

		function checkValidity(ss) {
				var message = "";

				if(ss!="") {
						if(ss.length < 10) {
								if(message=="") {
										message = "Atleast 10 digits";
								}
								else {
										message += " and atleast 10 digits";
								}
						}

				}
				else {
						message = "Enter your Mobile Number";
				}

				if(message!="") {
						message += " please!";
						$('input[type="submit"]').attr('disabled', 'disabled');
				}

				return message;
		}

		$('#mobileMessage').text(checkValidity(inputVal));
		checkSubmitValidity();

});

$('input[name="usernamelogin"]').keyup(function() {

		 var inputVal = $(this).val();
		function checkValidity(ss) {
				var message = "";

				if(ss!="") {
				}
				else {
						message = "Enter your username";
				}

				if(message!="") {
						message += " please!";
				}

				return message;
		}
		$('#usernameloginMessage').text(checkValidity(inputVal));

});

$('input[name="passwordlogin"]').keyup(function() {

		var inputVal = $(this).val();
		function checkValidity(ss) {
				var message = "";

				if(ss!="") {

				}
				else {
						message = "Enter your password";
				}

				if(message!="") {
						message += " please!";
				}

				return message;
		}
		$('#passwordloginMessage').text(checkValidity(inputVal));

});

function checkRequestValidity() {

		if($('#requestnameMessage').text()!="" || $('#requestemailMessage').text()!="" || $('#requestMessage').text()!="" || $('input[name="requestname"]').val()=="" || $('input[name="requestemail"]').val()=="" || $('input[name="request"]').val()=="") {
				$('#submitRequest').attr('disabled', 'disabled');
		}
		else {
				$('#submitRequest').removeAttr('disabled');
		}

}

$('#submitRequest').ready(function() {
		checkRequestValidity();
});

$('input[name="requestname"]').keyup(function() {

		var inputVal = $(this).val();

		function checkValidity(ss) {

				var message = "";
				if(ss!="") {

				}
				else {
						message = "Enter your name";
				}

				if(message!="") {
						message += " please!";
				}

		}

});
