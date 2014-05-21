<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<LINK rel="stylesheet" href="./css/style.css" type="text/css">

<script type="text/javascript">


function rollover(name,color)
{
	
	//alert(name);
//	document.bgColor = name;
	document.getElementById(name).bgColor = color;
	
//	var left = name+'_left';
//	var right = name+'_right';
//	var fullpath = './images/left_menu_bar';
	
//  document.images[user].src = fullpath;
 // document.images[user].src = './images/right_menu_bar';
  
 // document.getElementsByName(name).backgroundImage = fullpath;
 // document.bgColor = "#000000";
 // document.backgroundImage = fullpath;

}

function change_MENU(i)
{	
	if (i=="1")
	{
		//form1.MENU.value="1";
		var MENU = document.getElementById("MENU");
		MENU ="1";

	}	
	if (i=="2")
	{
		var MENU = document.getElementById("MENU");
		MENU.value="2";

	}
	if (i=="3")
	{
		var MENU = document.getElementById("MENU");
		MENU.value="3";
	
	}
	
}


</script>

