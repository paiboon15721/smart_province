<?php 
include("./chk_session.php");
include("./FUNCTION/function.php")
?>

<?php 
  //$fact = $_GET['fact'];
  if ($fact == "1") {
    $title = "เพื่มผู้ใช้งานระบบ";
  }elseif ($fact == "2") {
    $title = "แก้ไขผู้ใช้งานระบบ";
  }elseif ($fact == "3") {
    $title = "การบันทึกข้อมูลการปฏิบัติงานเข้า – ออกและรายงานเหตุการณ์";
  }elseif ($fact == "4") {
    $title = "ระบบรายงาน";
  }
?>

<?php 
if(isset($_GET['MENU']))
{
	$MENU = $_GET['MENU'];
}else{
	$MENU = "";
}

?>
<!-- -->
<div >
   	<table class="shadow-border" width="1000" border="0" height="156" align="center" background="./images/tab_bar.png" style="background-repeat:no-repeat" cellpadding="0" cellspacing="0">
    <form id="form1" name="form1" method="get" action="header_body.php">
    <input type=hidden name="MENU" id="MENU" value="<?php echo "$MENU" ?>"> 
   	  <tr>
   	    <td>
        <table width="995" height="156" border="0">
  <tr>
    <td width="156">&nbsp;</td>
    <td width="834" align="left" valign="center">
	  <table width="820" border="0">
    		  <tr height="80">
    		    <td height="48" valign="center"><div id="header" onmouseover="this.style.cursor='default'"><!--<?php echo"$title" ?>-->ระบบลงเวลาทำงานและรายงานเหตุการณ์ประจำวัน</div></td>


    		        <td   height="54" valign="center">
                  <table border="0" align="center" cellpadding="0" cellspacing="0">
     		            <tr  align="center">      

                          <td height="27" align="right" id="fontmenu" valign="bottom">--- จังหวัด นครนายก <?php $province ?>---</td>       
                    </tr>

        		    	</table>
        		    </td>
    		  </tr>
          <tr  align="center">  
                <td></td>    
                <td name="logout" id="logout"
                 height="20" width="150"
                <?php if($MENU != '4'){?> 
                onmouseover="this.style.cursor='hand';rollover('logout','#7cb1fd')"                                             
                onmouseout="rollover('logout','')"
                onClick="change_MENU('4')"
                onMouseDown="rollover('logout','')">  
                <a href="JavaScript:window.close()"><div id="fontmenu">
                <!--<img src="./images/sub_menu.png" name="logout" border="0" style="position:absolute;right:16.62%; top:108px">-->
                ออกจากระบบ</div></a>
                <?php }elseif($MENU == '4'){?>
                <div id="fontmenu">
                <!--<img src="./images/menuY.png" name="logout" border="0" style="position:absolute;right:16.62%; top:108px">-->
                ออกจากระบบ</div> 
                <?php } ?></td>
                
          </tr>
 	  </table>
    </td>
  </tr>
</table>
        </td>
      </tr>
   	  <tr>
      <td>
		<table width=100% border="0" cellpadding="0" cellspacing="0">
        <tr>      
      	<td>&nbsp;</td>
   	    <td align="left"><h4>ชื่อ - สกุล : <?php echo $_SESSION['EMPNAME']."  (".$_SESSION['EMPID'].")";?> </h4></td> <td align="right">
        
       <h4> หมู่บ้าน : 
	   <?php $provice =  get_name_ccaattmm($_SESSION['catm_menu']);
	    echo $provice;?></h4></td>
        <td>&nbsp;</td>
        </tr></form>
        </table>
</div>
        <!---->
