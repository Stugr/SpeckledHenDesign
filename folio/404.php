<?
	header("HTTP/1.0 404 Not Found");
	include("includes/template.php");
	openPage("404");
	openBody();
?>



<div class="pieceofwork">
	<div class="box" style="border: 8px solid; border-color: #ffffff;"><p style="font-size: 16px;"><strong>Error 404!</strong></p><br /><p>Damn. We can't find that file. Perhaps try another?</p></div>
</div>

<? 
	closeBody();
?>

