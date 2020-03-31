<?
#	session_start();
	
	$section = '';
	$slider = false;
	$sliderCount = 0;
	$sliderArray;
	$menuHtml = "";
	$piecesOfWork = 0;
	$piecesOfWorkWidth = 660-22;

	include("includes/mod_rewrite.php");

	define('BASE_URL', str_replace("//","/",dirname($_SERVER["SCRIPT_NAME"])."/"));

	function openPage($sec, $sliderItems=0, $sliderHeight=451)
	{
		global $section;
		global $slider;
		global $sliderCount;
		global $sliderArray;
		global $menuHtml;
		global $modRewrite;
	  $section=$sec;
		
		# build our menu
		$menu = array(
			"About Me" => "about_me.php",
			
			"Product and Packaging Design" => array(
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
			elseif ($modRewrite)
			{
				$valuesurl = "";
			}
			$menuHtml.="<li class=\"menuitem\">";
			$menuHtml.="<a href=\"".MenuModRewrite($menuitem,$valuesurl)."\"><img src=\"images/menu/".Replacer($menuitem).".gif\" alt=\"$menuitem\" /></a>";
			if(is_array($values))
			{
				$menuHtml.="<ul>";
				foreach ($values as $key => $value)
				{
					$selected = "";

					if (str_replace(".php","",$value) == strtolower($section))
					{
						$selected = " selected";
						$sec = $key;
					}

					$menuHtml.="<li class=\"submenuitem\"><a class=\"$selected\" href=\"".MenuModRewrite($menuitem,$value)."\">$key</a></li>";
				}
				$menuHtml.="</ul>";
			}
			else
			{
				if (str_replace(".php","",$values) == strtolower($section))
				{
					$sec = $menuitem;
				}
			}
			$menuHtml.="</li>";
		}
		
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Speckled Hen Design - Stephen Peck - <?=$sec;?></title>
	<link href="includes/default.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="includes/jquery_1.4.min.js"></script>
<? 

	}

	function openBody()
	{
		global $section;
		global $menuHtml;
		global $slider;
		global $sliderCount;
		global $sliderArray;
		global $modRewrite;
?>
</head>
<body>
	<div id="container">
		<div id="menu">
			<a href="<? if ($modRewrite) { echo BASE_URL."about-me/"; } else { echo BASE_URL."about_me.php"; } ?>" title="Speckled Hen Design"><img src="images/logo.jpg" alt="Stephen Peck"></a>
			<ul><?=$menuHtml?></ul><br>
		</div>
		<div id="content">

			

<?	

//		MakeHeading($section);
	}

	function closeBody()
	{
		global $piecesOfWork;
		global $piecesOfWorkWidth;
		global $section;
		if ($piecesOfWork > 1)
		{
?>
				<div class="backtotop" style="width: <?=$piecesOfWorkWidth?>px; "><div><a href="#">^ back to top</a></div></div>
<?
		}
?>
			</div>
			<div id="footer">

			</div>
		</div>

	</body>
	</html>
<?
	}

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
		if ($slider)
		{
?>
	</div>
<?
		}
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
	
	function MenuModRewrite($str1, $str2)
	{
		global $modRewrite;
		if ($modRewrite)
		{
			return BASE_URL.strtolower(str_replace(" ","-",$str1)."/".str_replace("_","-",str_replace(".php","",$str2)));
		}
		else {
			return BASE_URL.$str2;
		}
	}
	
	function MakeHeading($part1)
	{
?>
		<h1><? print $part1; ?></h1>
<?
	}
	
	function InsertWork($workNo, $workWidth, $para1="", $para2="", $para3="", $para4="")
	{
		global $section;
		global $piecesOfWork;
		global $piecesOfWorkWidth;
		$piecesOfWork += 1;
		if (is_null($workWidth))
		{
			$workWidth = 660;
		}
		$piecesOfWorkWidth = $workWidth+16;
?>
		<div class="pieceofwork">
		<img class="artwork" src="images/screenshots/<?=$section?>/0<?=$workNo?>.jpg" style="width: <?=$workWidth?>px">
		<? if (strlen($para1) > 0) { ?>
			<div class="box" style="width: <?=$workWidth-22?>px"><p><?=$para1?></p><? if (strlen($para2) > 0) { ?><br /><p><?=$para2?></p><? } ?><? if (strlen($para3) > 0) { ?><br /><p><?=$para3?></p><? } ?><? if (strlen($para4) > 0) { ?><br /><p><?=$para4?></p><? } ?></div>
		<? } ?>
		</div>
<?
	}
?>