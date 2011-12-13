function confirmdelete()
{
    var agree=confirm("Are you sure you want to delete this?")

    if (agree)
    {
	return true;
    }
    else
    {
	return false;
    }
}