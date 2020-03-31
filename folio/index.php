<?
	include("includes/mod_rewrite.php");
	if ($modRewrite) {
		header("Location: about-me/" );	
	} else {
		header("Location: about_me.php" );
	}
?>