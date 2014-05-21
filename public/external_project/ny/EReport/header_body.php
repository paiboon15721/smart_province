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
   	<table width="1000" border="0" height="156" align="center" background="./images/tab_bar.png" style="background-repeat:no-repeat" cellpadding="0" cellspacing="0">
    <form id="form1" name="form1" method="get" action="header_body.php">
    <input type=hidden name="MENU" id="MENU" value="<?php echo "$MENU" ?>"> 
   	  <tr>
   	    <td>
        <table width="995" border="0" >
  <tr>
    <td width="156">&nbsp;</td>
    <td width="834" align="left" valign="top">
	  <table width="800" border="0">
    		  <tr>
    		    <td height="48" align="center" valign="bottom"><div id="header" onmouseover="this.style.cursor='default'"><?php echo"$title" ?><!--ระบบลงเวลาทำงานและรายงานเหตุการณ์ประจำวัน--></div></td>
   		   	  </tr>
              <tr>
              	<td height="27" align="right" id="fontmenu" valign="bottom">
                --- จังหวัด นครนายก <?php $province ?>---
              	</td>
              </tr>
    		  <tr>
    		    <td   height="54" valign="center">
                		<table border="0" align="center" cellpadding="0" cellspacing="0">
     		     <tr  align="center">
<!--
     			      <td name="user" id="user"
                        height="20" width="200"
                      <?php if($MENU != '1'){?>	
                      onmouseover="this.style.cursor='hand';rollover('user','#7cb1fd')"                  				
                      onmouseout="rollover('user','')"
                      onClick="change_MENU('1')"
                      onMouseDown="rollover('user','')">				  
                      <a href="edit_emp.php" ><div id="fontmenu">
                  	  แก้ไขผู้ใช้งานระบบ</div></a>
                      <?php }elseif($MENU == '1'){?>
                      <div id="fontmenu">
                  	  แก้ไขผู้ใช้งานระบบ</div> 
					  <?php } ?></td>
                      
                     
                      <td width="7"><img src="./images/cut_menu_bar.png" height="20"></td>
                      
                      
      			      <td name="save"  id="save"
                       height="20"  width="190"
                      <?php if($MENU != '2'){?>	
                      onmouseover="this.style.cursor='hand';rollover('save','#7cb1fd')"	
                      onmouseout="rollover('save','')"
                      onClick="change_MENU('2')"
                      onMouseDown="rollover('save','')">	
                      
                      <a href="chronicle.php"><div id="fontmenu">
                      บันทึกข้อมูลการเข้างาน</div></a>
                      <?php }elseif($MENU == '2'){?>
                      <div id="fontmenu">
                  	  บันทึกข้อมูลการเข้างาน</div> 
					  <?php } ?></td>
                      
                      
                      <td width="7"><img src="./images/cut_menu_bar.png" height="20"></td>
                     
                      
    			      <td name="report" id="report"
                       height="20" width="130"
                      <?php if($MENU != '3'){?>	
                      onmouseover="this.style.cursor='hand';rollover('report','#7cb1fd')"                                      				
                      onmouseout="rollover('report','')"
                      onClick="change_MENU('3')"
                      onMouseDown="rollover('report','')">	
                      <a href="Rpt_EReport.php"><div id="fontmenu">
                      ระบบรายงาน</div></a>
                      <?php }elseif($MENU == '3'){?>
                      <div id="fontmenu">
                  	  ระบบรายงาน</div> 
                      <?php } ?></td>
                     
                      <td width="7"><img src="./images/cut_menu_bar.png" height="20"></td>
-->     
<td width="600"> </td>                
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
</table>
        </td>
      </tr>
   	  <tr>
      <td>
		<table width=100% border="0" cellpadding="0" cellspacing="0">
        <tr>      
      	<td>&nbsp;</td>
   	    <td align="left"><h4>ชื่อ - สกุล : 
		<?php 
		$pid_show = formatPID($EMPID);
		echo $EMPNAME."  (".$pid_show.")";
		?> </h4></td> <td align="right">
        
       <h4> หมู่บ้าน : 
	   <?php $provice =  get_name_ccaattmm($CATM_MOO);
	    echo $provice;?></h4></td>
        <td>&nbsp;</td>
        </tr></form>
        </table>
        <!---->
