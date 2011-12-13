<?php


include_once $_SERVER['DOCUMENT_ROOT'] .
'/phpsite/includes/magicquotes.inc.php';

if (isset($_GET['addclient']))

{
	$pagetitle = 'New Client';
	
	$action = 'addform';
	
	$name = '';
	
	$email = '';

	$address = '';

	$phone = '';

	$id = '';

	$button = 'Add client';

	include 'form.html.php';
	
	exit();

}




if (isset($_GET['addform']))

{

	include $_SERVER['DOCUMENT_ROOT'] . '/phpsite/includes/db.inc.php';


	$name = mysqli_real_escape_string($link, $_POST['name']);

	$email = mysqli_real_escape_string($link, $_POST['email']);

	$address = mysqli_real_escape_string($link, $_POST['address']);
	
	$phone = mysqli_real_escape_string($link, $_POST['phone']);

	$sql = "INSERT INTO client SET

		name='$name',

		email='$email',
		address='$address',
		phone='$phone'";

	
	if (!mysqli_query($link, $sql))
	
	{
		$error = 'Error adding submitted client.';
		
		include 'error.html.php';
		
		exit();
	
	}



	header('Location: .');
	
	exit();

}




if (isset($_POST['action']) and $_POST['action'] == 'Edit')

{
	
	include $_SERVER['DOCUMENT_ROOT'] . '/phpsite/includes/db.inc.php';

	
	$id = mysqli_real_escape_string($link, $_POST['id']);
	
	$sql = "SELECT id, name, email, address, phone FROM client WHERE id='$id'";
	
	$result = mysqli_query($link, $sql);
	
	if (!$result)

	{

		$error = 'Error fetching client details.';

		include 'error.html.php';

		exit();
	}
	

	$row = mysqli_fetch_array($result);

	
	$pagetitle = 'Edit Client';
	
	$action = 'editform';
	
	$name = $row['name'];
	
	$email = $row['email'];
	
	$address = $row ['address'];
	$phone = $row ['phone'];
	$id = $row['id'];
	
	$button = 'Update client';

	
	include 'form.html.php';
	
	exit();

}





if (isset($_GET['editform']))

{

	include $_SERVER['DOCUMENT_ROOT'] . '/phpsite/includes/db.inc.php';

	
	$id = mysqli_real_escape_string($link, $_POST['id']);

	$name = mysqli_real_escape_string($link, $_POST['name']);

	$email = mysqli_real_escape_string($link, $_POST['email']);
	$address = mysqli_real_escape_string($link, $_POST['address']);

	$phone = mysqli_real_escape_string($link, $_POST['phone']);



	$sql = "UPDATE client SET

		name='$name',
			
		email='$email'
,			
		address='$address'
,	
		phone='$phone'
	
		WHERE id='$id'";
	

	if (!mysqli_query($link, $sql))
	
	{
	
		$error = 'Error updating submitted client.';
		
		include 'error.html.php';
		
		exit();
	
	}

	

	header('Location: .');
	
	exit();

}





if (isset($_POST['action']) and $_POST['action'] == 'Delete')

{
	
	include $_SERVER['DOCUMENT_ROOT'] . '/phpsite/includes/db.inc.php';
	
	$id = mysqli_real_escape_string($link, $_POST['id']);

	

	// Get projects belonging to client	
	$sql = "SELECT id FROM project WHERE clientid='$id'";
	
	$result = mysqli_query($link, $sql);
	
	if (!$result)
	
	{
		
		$error = 'Error getting list of projects to delete.';
		
		include 'error.html.php';
		
		exit();
	
	}

	

	// For each project	
	while ($row = mysqli_fetch_array($result))
	
	{
		
		$projectId = $row[0];

		
		// Delete project category entries
		
		$sql = "DELETE FROM projectcategory WHERE projectid='$projectId'";
		
		if (!mysqli_query($link, $sql))
	
		{
			
			$error = 'Error deleting category entries for project.';
			
			include 'error.html.php';
			
			exit();
	
		}	

	}

	

	// Delete projects belonging to client
	
	$sql = "DELETE FROM project WHERE clientid='$id'";
	
	if (!mysqli_query($link, $sql))
	
	{
		
		$error = 'Error deleting projects for client.';
		
		include 'error.html.php';
		
		exit();
	
	}

	

	// Delete the client
	
	$sql = "DELETE FROM client WHERE id='$id'";
	
	if (!mysqli_query($link, $sql))
	
	{
		
		$error = 'Error deleting client.';
		
		include 'error.html.php';
		
		exit();
	
	}

	
	
	header('Location: .');
	exit();

}



// Display client list


include $_SERVER['DOCUMENT_ROOT'] . '/phpsite/includes/db.inc.php';

$result = mysqli_query($link, 'SELECT id, name, email, address, phone FROM client');

if (!$result)

{
	
	$error = 'Error fetching clients from database!';
	
	include 'error.html.php';
	
	exit();

}



while ($row = mysqli_fetch_array($result))

{
	
	$clients[] = array('id' => $row['id'], 'name' => $row['name'], 'email' => $row['email'], 'address' => $row['address'], 'phone' => $row['phone']);

}



include 'clients.html.php';

?>
