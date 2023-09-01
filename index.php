<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form method="post" action="integration.php" id="studentForm">
		<label>Name</label>
		<input type="text" name="name" id="name"><br>
		<label>Email</label>
		<input type="text" name="email" id="email"><br>
		<label>Roll</label>
		<input type="text" name="roll" id="roll"><br>

		<input type="button" name="submit" id="submit" value="Submit" onclick="addData();">

		<div id="res"></div>
	</form>
</body>
</html>

<script type="text/javascript">
	function addData(){
		var button = document.getElementById('submit');
		button.value='Please wait';
		button.setAttribute("disabled", "disabled");
		var form = document.getElementById("studentForm");
	    var form_data = new FormData(form);
	    for ([key,value] of form_data.entries()){
	        console.log(key + ': '+value);
	    }
	    var action = form.getAttribute("action");                   
	    var xhr = new XMLHttpRequest();
	    xhr.open('POST', action, true);
	    xhr.overrideMimeType('text/xml; charset=UTF-8');
	    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	    xhr.onreadystatechange = function (){
		    if (xhr.readyState == 4 && xhr.status == 200){
		        var result = xhr.responseText;
		        button.value='Submit';
				button.removeAttribute("disabled");
		        // console.log("Result:" + result);
		        document.getElementById("res").innerHTML = "Student Added Successfuly";
		        form.reset();
		    }
	    };
	    xhr.send(form_data);
	}
</script>