<?php

include_once $_SERVER['DOCUMENT_ROOT'] .
 '/phpsite/includes/magicquotes.inc.php';



if (isset($_GET['addproject']))

{

	$pagetitle = 'New Project';

	$action = 'addform';

	$text = '';

	$startdate= '';
	$enddate= '';
	$payment=' ';
	$clientid = '';
	
	$id = '';
	
	$button = 'Add project';

	

	include $_SERVER['DOCUMENT_ROOT'] . '/phpsite/includes/db.inc.php';

	

	// Build the list of clients

	$sql = "SELECT id, name FROM client";

	$result = mysqli_query($link, $sql);

	if (!$result)

	{

		$error = 'Error fetching list of clients.';

		include 'error.html.php';

		exit();

	}



	while ($row = mysqli_fetch_array($result))

	{

		$clients[] = array('id' => $row['id'], 'name' => $row['name']);
	
	}

	

	// Build the list of categories
	
	$sql = "SELECT id, name FROM category";
	
	$result = mysqli_query($link, $sql);

	if (!$result)

	{
		
$error = 'Error fetching list of categories.';

		include 'error.html.php';

		exit();

	}


	while ($row = mysqli_fetch_array($result))

	{

		$categories[] = array(

			'id' => $row['id'],
			
'name' => $row['name'],

			'selected' => FALSE);

	}



	include 'form.html.php';

	exit();

}






if (isset($_GET['addform']))

{

	include $_SERVER['DOCUMENT_ROOT'] . '/phpsite/includes/db.inc.php';


	$text = mysqli_real_escape_string($link, $_POST['text']);

	$startdate = mysqli_real_escape_string($link, $_POST['startdate']);

	$enddate = mysqli_real_escape_string($link, $_POST['enddate']);

	$payment = mysqli_real_escape_string($link, $_POST['payment']);

	$client = mysqli_real_escape_string($link, $_POST['client']);



	if ($client == '')
	
	{

		$error = 'You must choose an client for this project.
 Click &lsquo;back&rsquo; and try again.';

		include 'error.html.php';

		exit();

	}



	$sql = "INSERT INTO project SET

		projecttext='$text',

		startdate='$startdate',
		enddate='$enddate',
		payment='$payment',
		clientid='$client'";


	if (!mysqli_query($link, $sql))

	{

		$error = 'Error adding submitted project.';

		include 'error.html.php';

		exit();

	}



	$projectid = mysqli_insert_id($link);




	if (isset($_POST['categories']))

	{

		foreach ($_POST['categories'] as $category)

		{

			$categoryid = mysqli_real_escape_string($link, $category);

			$sql = "INSERT INTO projectcategory SET

				projectid='$projectid',

				categoryid='$categoryid'";

			if (!mysqli_query($link, $sql))
	
			{

			$error = 'Error inserting project into selected category.';

			include 'error.html.php';

			exit();

			}


		}

	}



	header('Location: .');

	exit();

}





if (isset($_POST['action']) and $_POST['action'] == 'Edit')

{

	include $_SERVER['DOCUMENT_ROOT'] . '/phpsite/includes/db.inc.php';


	$id = mysqli_real_escape_string($link, $_POST['id']);

	$sql = "SELECT id, projecttext, startdate, enddate, payment, clientid FROM project WHERE id='$id'";

	$result = mysqli_query($link, $sql);

	if (!$result)

	{

		$error = 'Error fetching project details.';

		include 'error.html.php';

		exit();

	}


	$row = mysqli_fetch_array($result);


	
	$pagetitle = 'Edit project';

	$action = 'editform';

	$text = $row['projecttext'];

	$startdate = $row['startdate'];

	$enddate = $row['enddate'];

	$payment = $row['payment'];

	$clientid = $row['clientid'];

	$id = $row['id'];

	$button = 'Update project';

	

	// Build the list of clients

	$sql = "SELECT id, name FROM client";

	$result = mysqli_query($link, $sql);

	if (!$result)

	{

		$error = 'Error fetching list of clients.';

		include 'error.html.php';

		exit();

	}



	while ($row = mysqli_fetch_array($result))

	{

		$clients[] = array('id' => $row['id'], 'name' => $row['name']);

	}



	// Get list of categories containing this project
	$sql = "SELECT categoryid FROM projectcategory WHERE projectid='$id'";

	$result = mysqli_query($link, $sql);

	if (!$result)

	{

		$error = 'Error fetching list of selected categories.';
	
		include 'error.html.php';

		exit();

	}



	while ($row = mysqli_fetch_array($result))

	{

		$selectedCategories[] = $row ['categoryid'];

	}

	

	// Build the list of all categories

	$sql = "SELECT id, name FROM category";
	
	$result = mysqli_query($link, $sql);

	if (!$result)

	{
				$error = 'Error fetching list of categories.';

		include 'error.html.php';

		exit();

	}



	while ($row = mysqli_fetch_array($result))

	{

		$categories[] = array(

			'id' => $row['id'],

			'name' => $row['name'],

			'selected' => in_array($row['id'], $selectedCategories));

	}



	include 'form.html.php';

	exit();

}




if (isset($_GET['editform']))

{

	include $_SERVER['DOCUMENT_ROOT'] . '/phpsite/includes/db.inc.php';


	
	$text = mysqli_real_escape_string($link, $_POST['text']);

	$startdate = mysqli_real_escape_string($link, $_POST['startdate']);

	$enddate = mysqli_real_escape_string($link, $_POST['enddate']);

	$payment = mysqli_real_escape_string($link, $_POST['payment']);

	$client = mysqli_real_escape_string($link, $_POST['client']);
	$id = mysqli_real_escape_string($link, $_POST['id']);

	

	if ($client == '')

	{

		$error = 'You must choose a client for this project. Click &lsquo;back&rsquo; and try again.';

		include 'error.html.php';

		exit();

	}



	$sql = "UPDATE project SET

			projecttext='$text',

			startdate='$startdate',
			enddate='$enddate',
			payment='$payment',
			clientid='$client'

			WHERE id='$id'";

	
	if (!mysqli_query($link, $sql))

	{

		$error = 'Error updating submitted project.';

		include 'error.html.php';

		exit();

	}



	$sql = "DELETE FROM projectcategory WHERE projectid='$id'";
	
	if (!mysqli_query($link, $sql))

	{
		
		$error = 'Error removing obsolete project category entries.';

		include 'error.html.php';

		exit();

	}



	if (isset($_POST['categories']))

	{

		foreach ($_POST['categories'] as $category)

		{

			$categoryid = mysqli_real_escape_string($link, $category);

			$sql = "INSERT INTO projectcategory SET

			projectid='$id',

			categoryid='$categoryid'";

			
			if (!mysqli_query($link, $sql))

			{
				$error = 'Error inserting project into selected category.';

				include 'error.html.php';

				exit();

			}

		}

	}


	

	header('Location: .');

	exit();

}




if (isset($_POST['action']) and $_POST['action'] == 'Delete')

{

	include $_SERVER['DOCUMENT_ROOT'] . '/phpsite/includes/db.inc.php';

	$id = mysqli_real_escape_string($link, $_POST['id']);

	


	// Delete category assignments for this project

	$sql = "DELETE FROM projectcategory WHERE projectid='$id'";

	if (!mysqli_query($link, $sql))

	{

		$error = 'Error removing project from categories.';

		include 'error.html.php';

		exit();

	}

	

	// Delete the project	
	$sql = "DELETE FROM project WHERE id='$id'";

	if (!mysqli_query($link, $sql))
	
	{

		$error = 'Error deleting project.';

		include 'error.html.php';

		exit();

	}

	

	header('Location: .');
	
	exit();

}






if (isset($_GET['action']) and $_GET['action'] == 'search')

{
	include $_SERVER['DOCUMENT_ROOT'] . '/phpsite/includes/db.inc.php';

	

	
//the basic select statement

	$select = 'SELECT project.id, projecttext, startdate, enddate, payment, name';

	$from   = ' FROM project';

	$where  = ' WHERE TRUE';



	$clientid =  mysqli_real_escape_string($link, $_GET['client']);
	
	if ($clientid != '') // A client is selected

	{
		$where .= " AND clientid='$clientid'";
	
	}


	$categoryid =  mysqli_real_escape_string($link,
	$_GET['category']);

	if ($categoryid != '') // A category is selected

	{
		$from  .= ' INNER JOIN projectcategory ON project.id = projectid';

		$where .= " AND categoryid='$categoryid'";

	}

	$text = mysqli_real_escape_string($link, $_GET['text']);

	if ($text != '') // Some search text was specified

	{

		$where .= " AND projecttext LIKE '%$text%'";

	}
	
	//set the variable to pull client name
	$from .= ' INNER JOIN client on clientid = client.id';



//retrieve and display projects

	
	$result = mysqli_query($link, $select . $from . $where);


	if (!$result)

	{

		$error = 'Error fetching projects.';

		include 'error.html.php';

		exit();
	
	}




	while ($row = mysqli_fetch_array($result))

	{

		$projects[] = array(
			'id' => $row['id'], 
			'text' => $row['projecttext'],
			'startdate' => $row['startdate'], 
			'enddate' => $row['enddate'], 
			'payment' => $row['payment'],
			'name' => $row['name']);
	
	}

	include 'projects.html.php';
	exit();	


}


// Display search form


include $_SERVER['DOCUMENT_ROOT'] . '/phpsite/includes/db.inc.php';

$result = mysqli_query ($link, 'SELECT id, name FROM client');

if (!$result)

{
	$error = 'Error fetching clients from database!';

	include 'error.html.php';

	exit();

}



while ($row = mysqli_fetch_array($result))

{

	$clients[] = array('id' => $row['id'], 'name' => $row['name']);

}






$result = mysqli_query($link, 'SELECT id, name FROM category');

if (!$result)
{

	$error = 'Error fetching categories from database!';

	include 'error.html.php';

	exit();

}

while ($row = mysqli_fetch_array($result))

{

	$categories[] = array('id' => $row['id'], 'name' => $row['name']);

}



include 'searchform.html.php';


?>