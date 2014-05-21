<?php
include('include/connect_db.php');


$path = "uploads/tmp/";
$valid_formats = array("jpg", "png", "gif", "bmp");

clearstatcache();
header("Cache-Control: no-cache");


	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimg']['name'];
			$size = $_FILES['photoimg']['size'];
			$catm = $_POST['ccaattmm'];
	        $emp_id = $_POST['emp_id'];
			
			if(strlen($name))
				{
					$ext="";
					list($txt, $ext) = explode(".", $name);

					if(in_array($ext,$valid_formats))
					{
					if($size<(1024*1024))
						{
							$actual_image_name ="";
							$tmp = "";
							$actual_image_name = "tmp".$emp_id."_". date("YmdHis").".".$ext;
							$tmp = $_FILES['photoimg']['tmp_name'];

							
							if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
									echo "<img id='showImg' src='uploads/tmp/".$actual_image_name."'  class='preview'>";
							?> <script>

								</script>
							<?php
									$length = strlen($emp_id)+3;
									$objScan = scandir("uploads/tmp/");
									$file_counter=0;
									$max_file = 1; //maximum file that u want to keep tmp
									$old_file="";

									foreach ($objScan as $value) {
										if(substr($value,0,$length)=="tmp$emp_id"){
											//echo "<br>".substr($value,0,$length)."== tmp".$emp_id;
											$file_counter++;
											$old_file = $value;
											//echo "<br>".substr($value,0,$length)."== tmp$emp_id :: val $value";
										//	echo "<br>".$value."counter = ".$file_counter;
										}
									}
									
								//	echo "<br>".$old_file."<br>";
									
									if($file_counter>$max_file){
										foreach ($objScan as $buff) {
											if((substr($buff,0,$length)=="tmp".$emp_id)&&($buff!=$old_file)){
												unlink("uploads/tmp/$buff");
												//echo "<br>remove file $buff | oldfile:  $old_file<br>";	
												
											}
										}
									}
									
									
								?>
									<script> 	
										$('#tmp_pic').val('<?php echo $old_file ;?>');	
		
									</script>
								<?php
									
								}
							
							else
								echo "failed";
						}
						else
						echo "Image file size max 1 MB";					
						}
						else
						echo "Invalid file format..";	
				}
				
			else
				echo "Please select image..!";
				
		}
		
		
?>