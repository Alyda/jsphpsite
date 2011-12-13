<?php include_once $_SERVER['DOCUMENT_ROOT'] .
	'/phpsite/includes/helpers.inc.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
		
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title><?php htmlout($pagetitle); ?></title>

	<meta http-equiv="content-type"
	content="text/html; charset=utf-8"/>

	<link href="style.css" rel="stylesheet" type="text/css" />
   	<script type="text/javascript" src="doublecheck.js"></script>
    	<script type="text/javascript" src="core.js"></script>

</head>
<body>

<h1>
<?php htmlout($pagetitle); ?>
</h1>


<form action="?<?php htmlout($action); ?>" method="post" onsubmit="return doublecheckproject();">


<div>

	<label for="client">Client:</label>

	<select name="client" id="client">

	<option value="">Select one</option>

	<?php foreach ($clients as $client): ?>
	
	<option value="<?php htmlout($client['id']); ?>"
		<?php
 if ($client['id'] == $clientid)
 echo ' selected="selected"';
?>>
		<?php htmlout($client['name']); ?>
	</option>
	<?php endforeach; ?>

	</select>

</div>


<div>
	<label for="text">Describe your project here: </label>

	<textarea id="text" name="text" rows="3" cols="40"><?php htmlout($text); ?></textarea>
</div>


<div>
	<label for="startdate">Start Date: <input type="text" name="startdate"

	id="startdate" value="<?php htmlout($startdate); ?>"/>
	</label>

</div>

<div>
	<label for="enddate">End Date: <input type="text" name="enddate"

	id="enddate" value="<?php htmlout($enddate); ?>"/>
	</label>

</div>

<div>
	<label for="payment">Payment: <input type="text" name="payment"

	id="payment" value="<?php htmlout($payment); ?>"/>
	</label>

</div>




<fieldset>

<legend>Categories:</legend>

<?php foreach ($categories as $category): ?>

<div>
	<label for="category<?php htmlout($category['id']);
?>">
	<input type="checkbox" name="categories[]"
 
		id="category<?php htmlout($category['id']); ?>"
	
		value="<?php htmlout($category['id']); ?>"
		<?php
	
		if ($category['selected'])

		{
			echo ' checked="checked"';

		}
		?>
	/>
	<?php htmlout($category['name']); ?>
	</label>
</div>

<?php endforeach; ?>

</fieldset>



<div>

	<input type="hidden" name="id" value="<?php htmlout($id); ?>"/>
	
	<input type="submit" value="<?php htmlout($button); ?>"/>
	<input type="button" name="Cancel" value="Cancel" onclick="window.location = 'index.php' " />
</div>

</form>


</body>

</html>
