<?php
											
//$mm_name=$_POST["mm_name"];
$catm_save=$_POST["catm_save"];
//$mm_name_file =  $mm_name;
//echo "mm_name=".$mm_name."<br>";
//echo "catm_save=".$catm_save."<br>";
//echo "mm_desc=".$mm_desc."<br>";


//$len_mm_name = strlen($mm_name);
//$mm_tmp = substr($mm_name,0,1);
//$mm_tmp1 = substr($mm_name,1,$len_mm_name);

//$mm_name=strtoupper($mm_tmp ).$mm_tmp1;

$mm_name="Catm".$catm_save;
$mm_name_file =  "catm".$catm_save;
//echo "mm_name111=".$mm_name."<br>";

$path_control = "/var/www/html/ci/application/smart_province/controllers/";
$path_models = "/var/www/html/ci/application/smart_province/models/";
$path_views = "/var/www/html/ci/application/smart_province/views/";
$path_assets ="/var/www/html/ci/application/assets/images/";

$file_name_mm = $path_control.$mm_name_file.".php";
$file_name_mm_model = $path_models.$mm_name_file."_model.php";
$name_dir_views = $path_views.$mm_name_file."_page";
$name_dir_assets = $path_assets.$mm_name_file."_images";
$dir_assets_images_fullscreen = $name_dir_assets."/fullscreen";
$dir_assets_images_thumbnails = $name_dir_assets."/thumbnails";
$path_catm_active = "/var/www/html/ci/application/smart_province/catm_active.txt";


/*
echo "file_name_mm=".$file_name_mm."<br>";
echo "file_name_mm_model=".$file_name_mm_model."<br>";
echo "name_dir_views=".$name_dir_views."<br>";
echo "name_dir_assets=".$name_dir_assets."<br>";
echo "dir_assets_images_fullscreen=".$dir_assets_images_fullscreen."<br>";
*/

$todaydate = date("Ymd");
$todaytime = date("His"); 
$emp_pid = "9999999999999";



$fp_catm = fopen($path_catm_active, "a");
$str = $catm_save."|".$mm_desc."|".$todaydate.$todaytime."|".$emp_pid;
fwrite($fp_catm, $str."\n");
fclose($fp_catm);

//echo "write file=".$str;

/****************Creat file controllers*********************/
/*
if (!file_exists($file_name_mm)) {
$fp = fopen($file_name_mm, "w");
$str1 = "<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');";
$str2 = "class ".$mm_name." extends MY_Controller {";
$str3 = "function __construct() {";
$str4 = "parent::__construct('".$mm_name_file."');";
$str5 = "}";
$str6 = "}";

fwrite($fp, $str1."\n");
fwrite($fp, $str2."\n");
fwrite($fp, $str3."\n");
fwrite($fp, $str4."\n");
fwrite($fp, $str5."\n");
fwrite($fp, $str6."\n");

fclose($fp);

//****************Creat file models*********************

$fp1 = fopen($file_name_mm_model, "w");
$str1 = "<?php";
$str2 = "class ".$mm_name."_model extends MY_Model {";
$str3 = "}";
fwrite($fp1, $str1."\n");
fwrite($fp1, $str2."\n\n");
fwrite($fp1, $str3."\n");

fclose($fp1);



//****************Creat directory views *********************
if (!mkdir($name_dir_views, 0777, true)) {
    die('Failed to create folders...');
}

$tmp_shell ="cp /var/www/html/ci/application/smart_province/views/wangtoom_village_page/village*.php   ".$name_dir_views;

//echo "tmp_shell=".$tmp_shell."<br>";
shell_exec( $tmp_shell);
$tmp_shell ="cp /var/www/html/ci/application/smart_province/views/wangtoom_village_page/main.php   ".$name_dir_views;
//echo "tmp_shell=".$tmp_shell."<br>";
shell_exec( $tmp_shell);

if (!mkdir($name_dir_assets, 0777, true)) {
    die('Failed to create folders...');
}

if (!mkdir($dir_assets_images_fullscreen, 0777, true)) {
    die('Failed to create folders...');
}

$tmp_shell ="cp /var/www/html/ci/application/assets/images/wangtoom_village_images/fullscreen/*.jpg   ".$dir_assets_images_fullscreen;
//echo "tmp_shell=".$tmp_shell."<br>";
shell_exec( $tmp_shell);

if (!mkdir($dir_assets_images_thumbnails, 0777, true)) {
    die('Failed to create folders...');
}
$tmp_shell ="cp /var/www/html/ci/application/assets/images/wangtoom_village_images/thumbnails/*.jpg   ".$dir_assets_images_thumbnails;
//echo "tmp_shell=".$tmp_shell."<br>";
shell_exec( $tmp_shell);

$fp_catm = fopen($path_catm_active, "a");
$str = $catm_save."|".$mm_desc;
fwrite($fp_catm, $str."\n");
fclose($fp_catm);

   

}else{
    echo "Can't create";
}
*/
?>
