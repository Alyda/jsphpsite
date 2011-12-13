<?php include_once $_SERVER['DOCUMENT_ROOT'] .
	'/phpsite/includes/helpers.inc.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	
	<title>Client/Project Management System</title>

	<meta http-equiv="content-type"	content="text/html; charset=utf-8"/>

	<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>


<h1>Client/Project Management System</h1>


<h2>Add a new...</h2>
<ul>
<li><a href="categories/?addcategory">Project category</a></li>
<li><a href="clients/?addclient">Client</a></li>
<li><a href="?addproject">Project </a></li>
</ul>


<h2>View/edit existing...</h2>
<ul>
<li><a href="categories/">Project categories</a></li>
<li><a href="clients/">Clients</a></li>
<li>Projects meeting the following criteria:



<form action="" method="get">


<div>

	<label for="client">By client:</label>

	<select name="client" id="client">

		<option value="">Any client</option>

		<?php foreach ($clients as $client): ?>
	
			<option value="<?php htmlout($client['id']); ?>">
			<?php htmlout($client['name']); ?>
			</option>

		<?php endforeach; ?>

	</select>

</div>

<div>

	<label for="category">By category:</label>

	<select name="category" id="category">

		<option value="">Any category</option>

		<?php foreach ($categories as $category): ?>

			<option value="<?php htmlout($category['id']); ?>">
			<?php
 htmlout($category['name']); ?>
			</option>

		<?php endforeach; ?>

	</select>

</div>


<div>

	<label for="text">Containing text:</label>

	<input type="text" name="text" id="text"/>
</div>


<div>

	<input type="hidden" name="action" value="search"/>

	<input type="submit" value="Search"/>

</div>
</form>




</li>
</ul>


</body>

</html>
