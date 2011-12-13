
function doublecheck()
{
    var requiredField = document.getElementById("nametext").value;
    
    if (requiredField.length < 1)
    {
	alert("Please fill in a value for this required field.");
	return false;
    }
    else
    {
	return true;
    }
}


function doublecheckclient()
{
 var requiredemail = document.getElementById("email").value;
 var requiredname = document.getElementById("name").value; 
   
    if (requiredname.length < 1)
    {
	alert("Please enter a name.");
	return false;
    }

    if (requiredemail.length < 1)
    {
	alert("Please fill in a valid e-mail address.");
	return false;
    }
	
    else
    {
    	return true;
    }	
}


function doublecheckproject()
{
 var requireddescription = document.getElementById("text").value;
 var requiredclient = document.getElementById("client").value;
   
    if (requiredclient.length < 1)
    {
	alert("Please select a client.");
	return false;
    }

    if (requireddescription.length < 1)
    {
	alert("Please enter a description of this project.");
	return false;
    }

    else
    {	
   	return true;
   }
}

