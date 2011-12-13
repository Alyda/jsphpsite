<?php include_once $_SERVER['DOCUMENT_ROOT'] .
	'/phpsite/includes/helpers.inc.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>

	<title>Categories</title>

	<meta http-equiv="content-type"
	content="text/html; charset=utf-8"/>

	<link href="../style.css" rel="stylesheet" type="text/css" />
  	<script type="text/javascript" src="../core.js"></script>
    	<script type="text/javascript" src="../stripy_tables.js"></script>
    	<script type="text/javascript" src="../verifydelete.js"></script>

</head>
	

<body>

<h1>Categories</h1>
<p><a href="?addcategory">Add new category</a></p>




<table class="dataTable">
<thead>
	<tr>
	<th>Category</th>
	<th>Options</th>
	</tr>
</thead>
<tbody>
<?php foreach ($categories as $category): ?>
	

<tr>
	<td><?php htmlout($category['name']); ?>

</td>
	
	<td>
		<form action="" method="post" >


		<div>

		<input type="hidden" name="id" value="<?php
 echo $category['id']; ?>"/>
					<input type="submit" name="action" value="Edit"/>

		<input type="submit" name="action" onclick="return confirmdelete();" value="Delete"/>


		</div>
		</form>
	</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>





<p><a href="..">Return to Client/Project Management Sytstem home</a></p>


</body>

</html>
