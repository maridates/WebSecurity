<title>Hash Generator</title>
<?
if (!isset($_POST[sub]))
{
	?>
	<form action='enc.php' method='post'>
		<input type='text' name='hash'>
		<input type='submit' name='sub' value='Generate'>
	</form>
	<?
}
else
{
	$hash=$_POST[hash];
	print hash ("sha256", $hash);
	print "<br /><a href='enc.php'>Reset</a>";
}
?>