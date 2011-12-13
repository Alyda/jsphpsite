<?php include_once $_SERVER['DOCUMENT_ROOT'] .
 '/phpsite/includes/helpers.inc.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	
	<title>Manage Projects: Search Results</title>

	<meta http-equiv="content-type"
	content="text/html; charset=utf-8"/>

	<link href="style.css" rel="stylesheet" type="text/css" />
   	<script type="text/javascript" src="core.js"></script>
    	<script type="text/javascript" src="stripy_tables.js"></script>
    	<script type="text/javascript" src="verifydelete.js"></script>
</head>


<body>
	
<h1>Search Results</h1>


<?php if (isset($projects)): ?>



<table class="dataTable">

<thead>
	<tr>
	<th>Project Description</th>
	<th>Client</th>
	<th>Start Date</th>
	<th>End Date</th>
	<th>Payment</th>
	<th>Options</th>
	</tr>

</thead>

<tbody>
<?php foreach ($projects as $project): ?>

<tr>

	<td><?php htmlout($project['text']); ?></td>

	<td><?php htmlout($project['name']); ?></td>
	<td><?php htmlout($project['startdate']); ?></td>
	<td><?php htmlout($project['enddate']); ?></td>
	<td><?php htmlout($project['payment']); ?></td>
	
	<td>
		<form action="?" method="post" id="submitform">

		<div>

		<input type="hidden" name="id" value="<?php
 htmlout($project['id']); ?>"/>
				<input type="submit" name="action" value="Edit"/>

		<input type="submit" name="action" onclick="return confirmdelete();" value="Delete"/>

		</div>

		</form>
	
	</td>
</tr>

<?php endforeach; ?>

</tbody>
</table>

<?php endif; ?>

<p><a href="index.php">Return to Client/Project Management Sytstem home</a></p>


</body>
</html>
