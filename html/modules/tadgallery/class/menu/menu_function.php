<?php
//­¶­±¤Á´«¦C
function toolbar($multi_menu=array()){
	if(empty($multi_menu))return;
	$td="";
	if(is_array($multi_menu)){
		foreach($multi_menu as $file_name=>$m_array){
			foreach($m_array as $link=>$m){
				if($link=='title'){
					$td.="<td>
	<a class=\"button\" href=\"javascript:void(0)\">{$m}</a>
	<div class=\"section\">";
				}elseif($link=='only_title'){
					$td.="<td>
	<a class=\"button\" href=\"javascript:window.location.href='{$file_name}'\">{$m}</a>";
				}else{
					$td.="<a class=\"item\" href=\"{$file_name}?op={$link}\">{$m}</a>";
				}
			}
		}
	}else{
		$td="<td></td>";
	}

	$toolbar=toolbar_head()."
	<table cellspacing=\"0\" cellpadding=\"0\" id=\"xm_menu\" class=\"NavMenu\" style='width:auto'>
	<tr>
	$td
	</div>
	</td>
	</tr>
	</table>
	</div>
	".toolbar_foot();
		return $toolbar;
}

function toolbar_head(){
	$main="<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"js/menu.css\" />
	<script type=\"text/javascript\" src=\"js/adminmenu.js\"></script>
	<script type=\"text/javascript\" src=\"js/ie5.js\"></script>
	<script type=\"text/javascript\">
	/* preload images */
	var arrow1 = new Image(4, 7);
	arrow1.src = \"js/menuarrow1.gif\";
	var arrow2 = new Image(4, 7);
	arrow2.src = \"js/menuarrow1.gif\";
	</script>";
	return $main;
}

function toolbar_foot(){
	$main="<script type=\"text/javascript\">
	var xm_menu = new AdMenu(\"xm_menu\");
	xm_menu.position.level1.top = 1;
	xm_menu.position.level1.left = 0;
	xm_menu.position.levelX.top = 0;
	xm_menu.position.levelX.left = 0;
	xm_menu.arrow1 = \"js/menuarrow1.gif\";
	xm_menu.arrow2 = \"js/menuarrow1.gif\";
	xm_menu.init();
	</script>";
	return $main;
}

?>
