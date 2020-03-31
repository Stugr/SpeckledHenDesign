<?
#	session_start();
	
	$section = '';
	$menuHtml = "";

	function openPage($sec, $sliderItems=0)
	{
		global $section;
		global $menuHtml;
	  $section=$sec;

		# build our menu
	
		$menu = array(
			"About Me" => "about_me.php",
			
			"Productandpackaging" => array(
				"Anatomicals" => "anatomicals2.php",
				"NPW" => "npw2.php",
				"Old Navy" => "oldnavy2.php",			
			),
			"Print" => array(
				"What's in it for me...?" => "whats_in_it_for_me.php",
				"Anatomicals" => "anatomicals.php",
				"Quiksilver" => "quiksilver.php",
				"Logos" => "logos.php",
			),
			"Illustrations" => array(
				"NPW" => "npw3.php",
				"Old Navy" => "oldnavy3.php",
			),
			"Fashion" => array(
				"Ghanda" => "ghanda.php",
			),
			"Personal" => array(
				"Lamborghini" => "lamborghini.php",
				"Cock and Sparrow" => "cock_and_sparrow.php",
				"Wedding" => "wedding.php",
			),
		);

		# build our menu html
		foreach ($menu as $menuitem => $values)
		{
			$valuesurl = $values;
			if(is_array($values))
			{
				$valuesurl = current($values);
			}
			$menuHtml.="<li>";
			$menuHtml.="<a class=\"menuitem\" href=\"$valuesurl\"><img src=\"images/menu/".Replacer($menuitem).".gif\" alt=\"$menuitem\" /></a>";
			if(is_array($values))
			{
				$menuHtml.="<ul>";
				foreach ($values as $key => $value)
				{
					$selected = "";
					if (str_replace(".php","",UnReplacer($value)) == strtolower($section))
					{
						$selected = " selected";
						$sec = $key;
					}
					$menuHtml.="<li><a class=\"submenuitem$selected\" href=\"$value\">$key</a></li>";
				}
				$menuHtml.="</ul>";
			}
			$menuHtml.="</li>";
		}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Speckled Hen Design - Steven Peck - <?=$sec;?></title>
	<link href="includes/default.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="includes/jquery.js"></script>
	<script type="text/javascript" src="includes/swfobject.js"></script>
<? 

	}

	function openBody()
	{
		global $section;
		global $menuHtml;
		global $slider;
		global $sliderCount;
		global $sliderArray;
?>
</head>
<body>
	<div id="container">
		<div id="menu">
		<a href="index.php" title="Speckled Hen Design"><img src="images/logo.jpg" alt="Steven Peck"></a>
			<ul><?=$menuHtml?></ul><br>
		</div>
		<div id="content">

<!--		<h1><?=Capitalise($section)?></h1>-->
<?
	}

	function closeBody()
	{
		global $section;
?>
		</div>
		<div id="footer">
	
		</div>
	</div>
</body>
</html>
<?
	}
?>

<?

	function ShowSiteInfo($url,$client,$role)
	{
		global $slider;
		global $sliderCount;
		$thumbs = 0;
		if ($sliderCount > 1) {
			$thumbs = $sliderCount;
		}
?>
	<div class="box" style="height: 35px; width: <? print 676 - ((57 + 16) * ($thumbs)) - 22 ?>px;"><? if (strlen($url) > 0) { ?><p><a target="_blank" href="<? print $url ?>" title="link to page">&nbsp;link to page&nbsp;</a></p><? } ?>
	<p><strong>Client</strong>&nbsp;&nbsp;<? print $client ?>&nbsp;&nbsp;&nbsp;<? if (strlen($role)) { ?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<strong>Role</strong>&nbsp;&nbsp;<? print $role ?><? } ?></p></div>
<?
	}
	
	function Replacer($str)
	{
		return strtolower(str_replace("'","",str_replace(" ","_",$str)));
	}

	function UnReplacer($str)
	{
		return strtolower(str_replace("_"," ",$str));
	}

	function Capitalise($tmpStr)
	{
		if (strlen($tmpStr)>0)
		{
			return strtoupper(substr($tmpStr,0,1)).substr($tmpStr,strlen($tmpStr)-(strlen($tmpStr)-1));
		}
			else
		{
			return "";
		}
	}
	
	function CutOffString($str,$pos)
	{
		$str=$str;
		if (strlen($str)>0)
		{
			if (strlen($str)>intval($pos))
			{
				return substr($str,0,$pos)."...";
			}
				else
			{
				return $str;
			} 
		}
			else
		{
			return "";
		} 
	} 
	
	function MakeHeading($part1)
	{
?>
		<h1><? print $part1; ?></h1>
<?
	}
	
	function InsertWork($workNo, $para1, $para2="")
	{
		global $section;
?>
		<img src="images/screenshots/<?=$section?>/0<?=$workNo?>.jpg">
		
		<div class="box"><p><?=$para1?></p><? if (strlen($para2) > 0) { ?><br /><p><?=$para2?></p><? } ?></div>
<?
	}
?>