<html lang="th-TH">
<head>
	<title>โปรแกรมสร้างตารางเรียน (ม.อ.)</title>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="app.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="style.css">
	
	<!-- Download Image Library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>
	
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

	<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-40643498-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-40643498-3');
</script>
	
</head>
<?php
function start_end($stime) {
	$ret = 1;
	switch($stime) {
		case 7:
			$ret = 1;
			break;
		case 8:
			$ret = 3;
			break;
		case 9:
			$ret = 5;
			break;
		case 10:
			$ret = 7;
			break;
		case 11:
			$ret = 9;
			break;
		case 12:
			$ret = 11;
			break;
		case 13:
			$ret = 13;
			break;
		case 14:
			$ret = 15;
			break;
		case 15:
			$ret = 17;
			break;
		case 16:
			$ret = 19;
			break;
		case 17:
			$ret = 21;
			break;
		case 18:
			$ret = 23;
			break;
		case 19:
			$ret = 25;
			break;
		case 20:
			$ret = 27;
			break;
		default:
			$ret = 1;
	}
	return $ret;
}

function is_image($path) {
    $a = getimagesize($path);
    $image_type = $a[2];
     
    if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
    {
        return true;
    }
    return false;
}

function lineInday($day, $line) {
	foreach($day as $item){
	  if(strpos($line, $item)!== false){
		return true;
	  }
	}
	return false;
}

?>
<div class="container">
		<div class="col-md-12">
		<div class="col-md-2"></div>
		
		<form method="POST">
		<div class="col-md-3">
			<div class="form-area">
				<h3 style="margin-bottom: 10px;">โปรแกรมสร้างตารางเรียน </h3>
				
				<div class="form-group">
					ชื่อตาราง
                    <input type="text" class="form-control" placeholder="ใส่ชื่อตาราง ถ้าไม่มีให้เว้นว่าง" name="str_title" id="str_title" value="<?php if(isset($_POST["str_title"])) { echo $_POST["str_title"]; } ?>">
				</div>
				
				<div class="form-group">
					รูปภาพพื้นหลัง (ใส่เป็น URL รูปแบบ http://......)
                    <input type="text" class="form-control" placeholder="ใส่ URL รูปภาพ ถ้าไม่มีให้เว้นว่าง "name="str_img" id="str_image_val" value="<?php if(isset($_POST["str_img"])) { echo $_POST["str_img"]; } ?>">
				</div>
				
				<div class="form-group">
					ตารางจาก SIS
                    <textarea class="form-control" type="textarea" id="message" placeholder="ใส่ตารางเรียนที่ก๊อปจาก Sis มาวาง" rows="5" name="str" id="str_val"><?php if(isset($_POST["str"])) { echo $_POST["str"]; } ?></textarea>				
                </div>

				
				
				
				<button id="create_class_table" class="btn btn-primary" style="margin-top: 10px; margin-bottom: 10px;">สร้างตารางเรียน</button>
				
				<div style="margin-top: 10px; background-color: #fff; padding: 10px;">

					<!--<span class="label label-success">อัพเดทครั้งที่ 1</span><br>
					<p class="bg-info" style="margin-top: 10px; padding-left: 10px;">
						- อัพเดทรายการสีบนตาราง<br>
						- เปลี่ยนสีปุ่มดาวน์โหลดภาพ
					</p>

					<span class="label label-success">อัพเดทครั้งที่ 2</span><br>
					<p class="bg-info" style="margin-top: 10px; padding-left: 10px;">
						- เพิ่มการตั้งค่าพื้นหลัง
					</p>
					
					
					<span class="label label-success">อัพเดทครั้งที่ 3</span><br>
					<p class="bg-info" style="margin-top: 10px; padding-left: 10px;">
						- รองรับตารางเรียนภาษาอังกฤษ (ม.อ. ภูเก็ต)
					</p>
					
					<span class="label label-success">อัพเดทครั้งที่ 4</span><br>
					<p class="bg-info" style="margin-top: 10px; padding-left: 10px;">
						- แก้ไข ตารางเรียนหาย / เวลาเรียนไม่ตรงในบางวิชา
					</p>
					-->
					
					<span class="label label-success">อัพเดทครั้งที่ 5</span><br>
					<p class="bg-info" style="margin-top: 10px; padding-left: 10px;">
						- ปรับปรุงให้รองรับ เวลาเรียนรูปแบบ 08.30 10.30
					</p>
					
					<span class="label label-success">อัพเดทครั้งที่ 6</span><br>
					<p class="bg-info" style="margin-top: 10px; padding-left: 10px;">
						- เพิ่มการตั้งค่าหัวตาราง
					</p>
					
					<span class="label label-success">อัพเดทครั้งที่ 7</span><br>
					<p class="bg-info" style="margin-top: 10px; padding-left: 10px;">
						- เปิดใช้งาน การตั้งค่าพื้นหลัง
					</p>
					
					<span class="label label-success">อัพเดทครั้งที่ 8</span><br>
					<p class="bg-info" style="margin-top: 10px; padding-left: 10px;">
						- ปรับปรุง บางรายวิชาที่ไม่ขึ้น
					</p>
					
					<span class="label label-success">อัพเดทครั้งที่ 9</span><br>
					<p class="bg-info" style="margin-top: 10px; padding-left: 10px;">
						- รองรับการใช้งานบนมือถือ และเพิ่มตารางเรียน เวลา 07.00 - 08.00
					</p>

					<!--<div class="alert alert-danger">
					  <strong>ประกาศ!</strong> สำหรับบางคน ที่เวลาเรียนอยู่ในแบบ 08.30 - 10.30 (มีหน่วยนาทีเป็น 30 นาที) ระบบยังมีปัญหาอยู่ แต่ถ้าวิชาคนที่ไม่มีหน่วย 30 นาที ใช้งานได้ตามปกติครับ เดี๋ยวรีบกลับมาแก้ ไปเดินงานเกษตรแปป
					</div>-->
					
					<p style="margin-top: 10px; padding-left: 10px; background-color: #f9d62e; padding: 5px;">
						พบปัญหาการใช้งาน แจ้งที่ <a href="https://www.facebook.com/arafarn" target="_BLANK"><font color="#ff4e50"><u>Arafan Hemho</u></font></a>
					</p>
					

					
				</div>
			</div>
		</div>
		</form>
	

		
		<div class="col-md-5" style="background-color: #ddd; padding: 10px;">
				<h3 style="margin-bottom: 10px;">วิธีใช้งาน!! </h3>
				1. เปิดตารางเรียนใน SIS แล้วก๊อปเฉพาะข้อความมาทั้งตาราง<br>
				<img src="01.png" width="100%">
				
				<br><br>
				2. นำข้อความมาวาง แล้วกดสร้างตารางเรียน<br>
				<img src="02.png" width="100%">
		</div>
		</div>
		
		<div class="col-md-12">


			


			
		<?php if(isset($_POST["str"] ,$_POST["str_img"] , $_POST["str_title"])) {
			$url = $_POST["str_img"];
			//$url = "";
			$img_err = "";
			
			if($url != "") {
				
				//Check url is valid
				if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
					$img_err = "URL รูปภาพไม่ถูกต้อง";
					$url = "";
				} else {
					
					//Step 1 check url is exists
					$file_headers = get_headers($url);
					if(strpos($file_headers[0], '404') !== false){
						$img_err = "ไม่พบที่อยู่ไฟล์";
						$url = "";
					} else {
						//Step 2 check url is image
						if(is_image($url) == false) {
							$img_err = "URL ไม่ใช่รูปภาพ (GIF, JPG, PNG, BMP) เท่านั้น";
							$url = "";
						} else {

							$context = stream_context_create(array(
								'http' => array(
									'timeout' => 1   // Timeout in seconds
								)
							));
							
							$image = file_get_contents($url, 0, $context);
							
							if (!empty($image)) {
								if ($image !== false){
									$base64img = 'data:image/jpg;base64,'.base64_encode($image);
								}
							} else {
								$img_err = "หมดเวลาโหลด";
								$url = "";
							}
							
						}

					}

				}
			}
			
			$title = $_POST["str_title"];
			if($title == "") {
				$title = "ตารางเรียน";
			}
			
			?>
			
			<?php
			if($img_err != "") {
				echo "<div class='alert alert-danger' role='alert'>
					  มีข้อผิดพลาด! : $img_err
					</div>";
			}
			
			?>
<div class="col-md-12" style="background-color: #ffffff; padding-top: 15px; padding: 20px; margin-top: 10px;" id="table_class">
		
		
<div id="html-content-holder" style="background-color: #ffffff";>

	<center>
		<canvas id="myCanvas" width="800" height="70">
			Browser ไม่รองรับ Javascript กรุณาใช้ Google Chrome
		</canvas>
	</center>

	<script>
	var canvas = document.getElementById("myCanvas");
	var ctx = canvas.getContext("2d");
	ctx.font = "30px Kanit";
	ctx.textAlign="center";
	ctx.fillText("<?php echo $title;?>",400,50);
	</script>
			<table class="table" style="font-size: 12px; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd;font-weight:bold; 
			<?php
				if($url == "") {
					echo "background-color: #e8ebf0;";
				} else {
					echo "background-image: url('".$base64img."');";
				}
			?>" width="100%">
				<tbody>
				  <tr style="background-color: #ffffff">
					<td width="1%" height="50" ></td>
					<td width="7.6%" colspan="2">07:00-08:00</td>
					<td width="7.6%" colspan="2">08:00-09:00</td>
					<td width="7.6%" colspan="2">09:00-10:00</td>
					<td width="7.6%" colspan="2">10:00-11:00</td>
					<td width="7.6%" colspan="2">11:00-12:00</td>
					<td width="7.6%" colspan="2">12:00-13:00</td>
					<td width="7.6%" colspan="2">13:00-14:00</td>
					<td width="7.6%" colspan="2">14:00-15:00</td>
					<td width="7.6%" colspan="2">15:00-16:00</td>
					<td width="7.6%" colspan="2">16:00-17:00</td>
					<td width="7.6%" colspan="2">17:00-18:00</td>
					<td width="7.6%" colspan="2">18:00-19:00</td>
					<td width="7.6%" colspan="2">19:00-20:00</td>
				  </tr>
				  <tr>
					<td height="50"  style="background-color: #ffffff;">Mon</td>
					<td id="mon1" width="3.8%"></td>
					<td id="mon2" width="3.8%"></td>
					<td id="mon3" width="3.8%"></td>
					<td id="mon4" width="3.8%"></td>
					<td id="mon5" width="3.8%"></td>
					<td id="mon6" width="3.8%"></td>
					<td id="mon7" width="3.8%"></td>
					<td id="mon8" width="3.8%"></td>
					<td id="mon9" width="3.8%"></td>
					<td id="mon10" width="3.8%"></td>
					<td id="mon11" width="3.8%"></td>
					<td id="mon12" width="3.8%"></td>
					<td id="mon13" width="3.8%"></td>
					<td id="mon14" width="3.8%"></td>
					<td id="mon15" width="3.8%"></td>
					<td id="mon16" width="3.8%"></td>
					<td id="mon17" width="3.8%"></td>
					<td id="mon18" width="3.8%"></td>
					<td id="mon19" width="3.8%"></td>
					<td id="mon20" width="3.8%"></td>
					<td id="mon21" width="3.8%"></td>
					<td id="mon22" width="3.8%"></td>
					<td id="mon23" width="3.8%"></td>
					<td id="mon24" width="3.8%"></td>
					<td id="mon25" width="3.8%"></td>
					<td id="mon26" width="3.8%"></td>
				  </tr>
				  <tr>
					<td height="50"  style="background-color: #ffffff">Tue</td>
					<td id="tue1" width="3.8%"></td>
					<td id="tue2" width="3.8%"></td>
					<td id="tue3" width="3.8%"></td>
					<td id="tue4" width="3.8%"></td>
					<td id="tue5" width="3.8%"></td>
					<td id="tue6" width="3.8%"></td>
					<td id="tue7" width="3.8%"></td>
					<td id="tue8" width="3.8%"></td>
					<td id="tue9" width="3.8%"></td>
					<td id="tue10" width="3.8%"></td>
					<td id="tue11" width="3.8%"></td>
					<td id="tue12" width="3.8%"></td>
					<td id="tue13" width="3.8%"></td>
					<td id="tue14" width="3.8%"></td>
					<td id="tue15" width="3.8%"></td>
					<td id="tue16" width="3.8%"></td>
					<td id="tue17" width="3.8%"></td>
					<td id="tue18" width="3.8%"></td>
					<td id="tue19" width="3.8%"></td>
					<td id="tue20" width="3.8%"></td>
					<td id="tue21" width="3.8%"></td>
					<td id="tue22" width="3.8%"></td>
					<td id="tue23" width="3.8%"></td>
					<td id="tue24" width="3.8%"></td>
					<td id="tue25" width="3.8%"></td>
					<td id="tue26" width="3.8%"></td>
				  </tr>
				  <tr>
					<td height="50"  style="background-color: #ffffff">Wed</td>
					<td id="wed1" width="3.8%"></td>
					<td id="wed2" width="3.8%"></td>
					<td id="wed3" width="3.8%"></td>
					<td id="wed4" width="3.8%"></td>
					<td id="wed5" width="3.8%"></td>
					<td id="wed6" width="3.8%"></td>
					<td id="wed7" width="3.8%"></td>
					<td id="wed8" width="3.8%"></td>
					<td id="wed9" width="3.8%"></td>
					<td id="wed10" width="3.8%"></td>
					<td id="wed11" width="3.8%"></td>
					<td id="wed12" width="3.8%"></td>
					<td id="wed13" width="3.8%"></td>
					<td id="wed14" width="3.8%"></td>
					<td id="wed15" width="3.8%"></td>
					<td id="wed16" width="3.8%"></td>
					<td id="wed17" width="3.8%"></td>
					<td id="wed18" width="3.8%"></td>
					<td id="wed19" width="3.8%"></td>
					<td id="wed20" width="3.8%"></td>
					<td id="wed21" width="3.8%"></td>
					<td id="wed22" width="3.8%"></td>
					<td id="wed23" width="3.8%"></td>
					<td id="wed24" width="3.8%"></td>
					<td id="wed25" width="3.8%"></td>
					<td id="wed26" width="3.8%"></td>
				  </tr>
				  <tr>
					<td height="50"  style="background-color: #ffffff">Thu</td>
					<td id="thu1" width="3.8%"></td>
					<td id="thu2" width="3.8%"></td>
					<td id="thu3" width="3.8%"></td>
					<td id="thu4" width="3.8%"></td>
					<td id="thu5" width="3.8%"></td>
					<td id="thu6" width="3.8%"></td>
					<td id="thu7" width="3.8%"></td>
					<td id="thu8" width="3.8%"></td>
					<td id="thu9" width="3.8%"></td>
					<td id="thu10" width="3.8%"></td>
					<td id="thu11" width="3.8%"></td>
					<td id="thu12" width="3.8%"></td>
					<td id="thu13" width="3.8%"></td>
					<td id="thu14" width="3.8%"></td>
					<td id="thu15" width="3.8%"></td>
					<td id="thu16" width="3.8%"></td>
					<td id="thu17" width="3.8%"></td>
					<td id="thu18" width="3.8%"></td>
					<td id="thu19" width="3.8%"></td>
					<td id="thu20" width="3.8%"></td>
					<td id="thu21" width="3.8%"></td>
					<td id="thu22" width="3.8%"></td>
					<td id="thu23" width="3.8%"></td>
					<td id="thu24" width="3.8%"></td>
					<td id="thu25" width="3.8%"></td>
					<td id="thu26" width="3.8%"></td>
				  </tr>
				  <tr>
					<td height="50"  style="background-color: #ffffff">Fri</td>
					<td id="fri1" width="3.8%"></td>
					<td id="fri2" width="3.8%"></td>
					<td id="fri3" width="3.8%"></td>
					<td id="fri4" width="3.8%"></td>
					<td id="fri5" width="3.8%"></td>
					<td id="fri6" width="3.8%"></td>
					<td id="fri7" width="3.8%"></td>
					<td id="fri8" width="3.8%"></td>
					<td id="fri9" width="3.8%"></td>
					<td id="fri10" width="3.8%"></td>
					<td id="fri11" width="3.8%"></td>
					<td id="fri12" width="3.8%"></td>
					<td id="fri13" width="3.8%"></td>
					<td id="fri14" width="3.8%"></td>
					<td id="fri15" width="3.8%"></td>
					<td id="fri16" width="3.8%"></td>
					<td id="fri17" width="3.8%"></td>
					<td id="fri18" width="3.8%"></td>
					<td id="fri19" width="3.8%"></td>
					<td id="fri20" width="3.8%"></td>
					<td id="fri21" width="3.8%"></td>
					<td id="fri22" width="3.8%"></td>
					<td id="fri23" width="3.8%"></td>
					<td id="fri24" width="3.8%"></td>
					<td id="fri25" width="3.8%"></td>
					<td id="fri26" width="3.8%"></td>
				  </tr>
				  <tr>
					<td height="50"  style="background-color: #ffffff">Sat</td>
					<td id="sat1" width="3.8%"></td>
					<td id="sat2" width="3.8%"></td>
					<td id="sat3" width="3.8%"></td>
					<td id="sat4" width="3.8%"></td>
					<td id="sat5" width="3.8%"></td>
					<td id="sat6" width="3.8%"></td>
					<td id="sat7" width="3.8%"></td>
					<td id="sat8" width="3.8%"></td>
					<td id="sat9" width="3.8%"></td>
					<td id="sat10" width="3.8%"></td>
					<td id="sat11" width="3.8%"></td>
					<td id="sat12" width="3.8%"></td>
					<td id="sat13" width="3.8%"></td>
					<td id="sat14" width="3.8%"></td>
					<td id="sat15" width="3.8%"></td>
					<td id="sat16" width="3.8%"></td>
					<td id="sat17" width="3.8%"></td>
					<td id="sat18" width="3.8%"></td>
					<td id="sat19" width="3.8%"></td>
					<td id="sat20" width="3.8%"></td>
					<td id="sat21" width="3.8%"></td>
					<td id="sat22" width="3.8%"></td>
					<td id="sat23" width="3.8%"></td>
					<td id="sat24" width="3.8%"></td>
					<td id="sat25" width="3.8%"></td>
					<td id="sat26" width="3.8%"></td>
				  </tr>
				  <tr>
					<td height="50"  style="background-color: #ffffff">Sun</td>
					<td id="sun1" width="3.8%"></td>
					<td id="sun2" width="3.8%"></td>
					<td id="sun3" width="3.8%"></td>
					<td id="sun4" width="3.8%"></td>
					<td id="sun5" width="3.8%"></td>
					<td id="sun6" width="3.8%"></td>
					<td id="sun7" width="3.8%"></td>
					<td id="sun8" width="3.8%"></td>
					<td id="sun9" width="3.8%"></td>
					<td id="sun10" width="3.8%"></td>
					<td id="sun11" width="3.8%"></td>
					<td id="sun12" width="3.8%"></td>
					<td id="sun13" width="3.8%"></td>
					<td id="sun14" width="3.8%"></td>
					<td id="sun15" width="3.8%"></td>
					<td id="sun16" width="3.8%"></td>
					<td id="sun17" width="3.8%"></td>
					<td id="sun18" width="3.8%"></td>
					<td id="sun19" width="3.8%"></td>
					<td id="sun20" width="3.8%"></td>
					<td id="sun21" width="3.8%"></td>
					<td id="sun22" width="3.8%"></td>
					<td id="sun23" width="3.8%"></td>
					<td id="sun24" width="3.8%"></td>
					<td id="sun25" width="3.8%"></td>
					<td id="sun26" width="3.8%"></td>
				  </tr>
				</tbody>
			</table>
</div>
			<center>	
			<button id="confirmDownload" class="btn btn-success" style="margin-top: 10px; margin-bottom: 10px;" id="btn-Preview-Image" disabled><a id="btn-Convert-Html2Image" href="#">ดาวน์โหลด</a></button>
			<br>(รองรับการทำงานบน Google Chrome)
			<br><br>
			<u>Develop by</u> <a href="https://www.facebook.com/itpsuhatyai/" target="_BLANK"><img src="it-logo-for-sign-in.png" width="80" height="32"></a>
			</center>


<script>
$(document).ready(function(){

	
var element = $("#html-content-holder"); // global variable
var getCanvas; // global variable
 
 
         html2canvas(element, {
         onrendered: function (canvas) {
                //$("#previewImage").append(canvas);
				//$("#html-content-holder").html(canvas);
                getCanvas = canvas;
				$("#confirmDownload").prop('disabled', false);
             }
         });
  

    $("#btn-Convert-Html2Image").on('click', function () {
    var imgageData = getCanvas.toDataURL("image/png");
    // Now browser starts downloading it instead of just showing it
    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
    $("#btn-Convert-Html2Image").attr("download", "<?php echo time();?>.png").attr("href", newData);
	});

});

</script>

	<div class="col-md-12" style="background-color: #ffffff; margin-top: 10px;" align="center">
		<table class="table table-bordered" style="text-align: center; font-size: 15px; table-layout:fixed;">
			<thead>
			  <tr>
				<th style="background-color: #e8e5e0;" width="5%">Section</th>
				<th style="background-color: #e8e5e0;" width="6%">รหัสวิชา</th>
				<th style="background-color: #e8e5e0;" width="20%">ชื่อวิชา</th>
				<th style="background-color: #e8e5e0;" width="6%">วันที่เรียน</th>
				<th style="background-color: #e8e5e0;" width="8%">เวลาเรียน</th>
				<th style="background-color: #e8e5e0;" width="8%">ห้องเรียน</th>
				<th style="background-color: #e8e5e0;">อาจารย์ผู้สอน</th>
				
			  </tr>
			</thead>
			<tbody>
			
			<?php
			$str = $_POST["str"];
			$colors = array("#ff4e50", "#fc913a", "#f9d62e", "#eae374", "#e2f4c7", "#aa8754", "#ffc5d9", "#c2f2d0", "#fdf5c9", "#ffcb85", "#dfdfde", "#a2798f", "#d7c6cf", "#8caba8", "#ebdada"); 
			$days = array("จันทร์","อังคาร","พุธ", "พฤหัส", "ศุกร์", "เสาร์", "อาทิตย์");
			$days_eng = array("Mon","Tue","Wed", "Thu", "Fri", "Sat", "Sun");
			
			
			$uniquesj = array();
			$randcolor = array();
			
			//Step 1 Get all subject code
			foreach(preg_split("/((\r?\n)|(\r\n?))/", $str) as $line){
				if(lineInday($days, $line) || lineInday($days_eng, $line)) {
					$rm = explode("	", $line);
					//if(count($rm) < 1) { die(); }
					array_push($uniquesj, $rm[3]);
				}
				
			}
			
			//Step 2 Remove Duplicate & get color
			$uniquesj = array_unique($uniquesj);
			$uniquesj = array_values($uniquesj);
			$randcolor = range(0, count($uniquesj));
			shuffle($randcolor);
			
			foreach(preg_split("/((\r?\n)|(\r\n?))/", $str) as $line){

				if(lineInday($days, $line) || lineInday($days_eng, $line)) {	
					
				$arr = explode("	", $line);
				//array_push($ab, $arr);
				$day = 0;
				$start = 0;
				$end = 0;
				$color = "";
				$data = json_encode($arr);
				$pos_color = 0;
				
				//Find day
				for($i=0;$i<7;$i++) {
					$position = strcmp($days[$i], $arr[0]);
					if($position == 0) {
						$day = $i;
					}
				}
				
				//print_r($arr);
				
				//Total 12 cols
				for($i=0;$i<7;$i++) {
					$position = strcmp($days[$i], $arr[0]);
					if($position == 0) {
						$day = $i;
						break;
					}
					
					$position = strcmp($days_eng[$i], $arr[0]);
					if($position == 0) {
						$day = $i;
						break;
					}
				}
				
				

				
				//Find Start & Stop 8.30
				$start = start_end(substr($arr[1], 0, 2));
				if((substr($arr[1], 3, 2)) == "30") {
					$start = $start + 1; // 8.30 : 8 - 6 = 2
				}
				
				$end = start_end(substr($arr[2], 0, 2));
				if((substr($arr[2], 3, 2)) == "00") {
					//$end += 1; // 8.30 : 8 - 6 = 2
					$end -= 1;
				} elseif((substr($arr[2], 3, 2)) == "50") {
					$end += 1;
				}

				//Position color
				for($i=0;$i<count($uniquesj);$i++) {
					$position = strcmp($uniquesj[$i], $arr[3]);
					if($position == 0) {
						$pos_color = $i;
						break;
					}
				}
								
				echo "<script>";
				echo "updateTable(".$day.",".$start.",".$end.",".$data.",'".$colors[$randcolor[$pos_color]]."');";
				echo "</script>";
				
				?>
				
				<tr>
					<td><?=$arr[6];?></td>
					<td style="background-color: <?=$colors[$randcolor[$pos_color]];?>"><?=$arr[3];?></td>
					<td><?=$arr[4];?></td>
					<td><?=$arr[0];?></td>
					<td><?=$arr[1];?> - <?=$arr[2];?></td>
					<td><?=$arr[8];?></td>
					<td><?=$arr[7];?></td>
				</tr>
				
				<?php
				
				}
				
				
				
			} 

			?>

		<?php } ?>
		
		
				  
				  </tbody>
			</table>
		</div>
		
		
		</div>
		</div>
</div>
</div>

</body>
</html>