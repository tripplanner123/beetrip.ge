<?php 
error_reporting(E_ALL); 
	require '_plugins/vendor/autoload.php';

	$f = (isset($_GET["f"])) ? base64_decode($_GET["f"]) : "";
	$w = (isset($_GET["w"])) ? (int)$_GET["w"] : 0;
	$h = (isset($_GET["h"])) ? (int)$_GET["h"] : 0;
	$wt_width = (isset($_GET["wt_width"])) ? (int)$_GET["wt_width"] : 100;
	$wt_height = (isset($_GET["wt_height"])) ? (int)$_GET["wt_height"] : 30;
	$grey = (isset($_GET["grey"]) && $_GET["grey"]=="true") ? "true" : "false";

	$filename = explode("http://batumibroker.ge/", $f);
	if(isset($filename[1]) && file_exists($filename[1])){

		$fileSize = filesize($filename[1]);
		
		$resizeDir = "_cache/";
		$resizeFileName = $fileSize. "-" . $w . "-" . $h . "-". $grey . "-" . str_replace(array("/", " "), "-", $filename[1]);
		$resizePath = $resizeDir . $resizeFileName;

		$manager = new Intervention\Image\ImageManagerStatic;
		$manager::configure(array('driver' => 'imagick'));

		if(!file_exists($resizePath)){
			if($grey=="true"){
				$watermark = $manager->make("_website/img/logo.png")->fit($wt_width, $wt_height);
				$img = $manager->make($filename[1])->fit($w, $h)->greyscale();
			}else if($w!=0 && $h!=0){
				$watermark = $manager->make("_website/img/logo.png")->fit($wt_width, $wt_height);
				$img = $manager->make($filename[1])->fit($w, $h);
			}else{
				$watermark = $manager->make("_website/img/logo.png")->fit(200, 60);
				$img = $manager->make($filename[1]);
			}

			
			$img->insert($watermark, 'bottom-right', 20, 20);
			$img->save($resizePath); 
		}

	    $ntct = array(
	    	"1" => "image/gif",
	        "2" => "image/jpeg",
	        "3" => "image/png",
	        "6" => "image/bmp",
	        "17" => "image/ico"
	    );
	    // header('Content-type: ' . $ntct[exif_imagetype($resizePath)]);
	    header('Content-type: image/jpeg');
		readfile($resizePath);
	}

?>