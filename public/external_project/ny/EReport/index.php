<?php
	//echo "<META HTTP-EQUIV=Refresh CONTENT=0 target=_blank;URL=\"Signin.application\">";
	//header('Location: Signin.application');
	
?>
<script>
	//window.open("http://172.16.246.235/EReport/Signin.application", "_parent")
	//window.open("http://157.179.24.101/MA1/EReport/Signin.application", "_parent")
	window.open("", "_parent")
	//window.close();
	setTimeout(function(){window.close();}, 5000);
	
function max() 
{ 
var obj = new ActiveXObject("Wscript.shell"); 
obj.SendKeys("{F11}"); 
} 

function ToggleRowDisplay(objTarget) 
{
	//alert(objTarget);
	try 
	{
		
		var objTableBody = document.getElementById(objTarget);
		//alert(objTableBody.style.display);
		if (objTableBody.style.display == "block")
		{ 
			//alert("none");
			objTableBody.style.display = "none";
		}else{
			///alert("block");
			objTableBody.style.display = "block";
		}
	}catch( expError ){
		alert( expError.number + " " + expError.description );
	}
}
</script>
<a href="./Signin.application?ACT_FLAG=-private 157.179.24.101/MA1/EReport/write_session.php" onmouseover="this.style.cursor='pointer';this.style.color='#ea5106';" class="H1"  onmouseout="this.style.color='#0408a1'">Login</a>
<a href="link.php?app=Signin&ACT_FLAG=1" onmouseover="this.style.cursor='pointer';this.style.color='#ea5106';" class="H1"  onmouseout="this.style.color='#0408a1'">Login2</a>
