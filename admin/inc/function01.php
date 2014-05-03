<?php
	//------------------------------------------------------------------------------------------------------------//
	// รีเซ็คข้อมูลรหัสเรียงลำดับ
	//------------------------------------------------------------------------------------------------------------//
	function RenewID($tablename)
	{
		global $conn;

		$cfg_var["sql"]="SELECT ".$tablename."_id as id FROM ".$tablename." ORDER BY ".$tablename."_id";
		$cfg_var["query"]=mssql_query($cfg_var["sql"],$conn);
		$cfg_var["loop"]=1;
		while($cfg_var["row"]=mssql_fetch_array($cfg_var["query"]))
		{
			unset($cfg_var["sql"]);
			$cfg_var["sql"]="UPDATE ".$tablename." SET ".$tablename."_no=".$cfg_var["loop"]." WHERE ".$tablename."_id=".$cfg_var["row"]["id"];
			mssql_query($cfg_var["sql"],$conn);
			$cfg_var["loop"]++;
		}
		mssql_free_result($cfg_var["query"]);
	}

	//------------------------------------------------------------------------------------------------------------//
	// รีเซ็คข้อมูลรหัสเรียงลำดับ
	//------------------------------------------------------------------------------------------------------------//
	function RenewID2($tablename,$HOTELID)
	{
		global $conn;

		$cfg_var["sql"]="SELECT ".$tablename."_id as id FROM ".$tablename." WHERE fk_hotel=".$HOTELID." ORDER BY ".$tablename."_id";
		$cfg_var["query"]=mssql_query($cfg_var["sql"],$conn);
		$cfg_var["loop"]=1;
		while($cfg_var["row"]=mssql_fetch_array($cfg_var["query"]))
		{
			unset($cfg_var["sql"]);
			$cfg_var["sql"]="UPDATE ".$tablename." SET ".$tablename."_no=".$cfg_var["loop"]." WHERE ".$tablename."_id=".$cfg_var["row"]["id"];
			mssql_query($cfg_var["sql"],$conn);
			$cfg_var["loop"]++;
		}
		mssql_free_result($cfg_var["query"]);
	}

	//------------------------------------------------------------------------------------------------------------//
	// รีเซ็คข้อมูลรหัสเรียงลำดับสำหรับส่วนโรงแรม
	//------------------------------------------------------------------------------------------------------------//
	function RenewID3($tablename,$GROUPHOTELID)
	{
		global $conn;

		$cfg_var["sql"]="SELECT ".$tablename."_id as id FROM ".$tablename." WHERE fk_hotelgroup=".$GROUPHOTELID." ORDER BY ".$tablename."_id";
		$cfg_var["query"]=mssql_query($cfg_var["sql"],$conn);
		$cfg_var["loop"]=1;
		while($cfg_var["row"]=mssql_fetch_array($cfg_var["query"]))
		{
			unset($cfg_var["sql"]);
			$cfg_var["sql"]="UPDATE ".$tablename." SET ".$tablename."_no=".$cfg_var["loop"]." WHERE ".$tablename."_id=".$cfg_var["row"]["id"];
			mssql_query($cfg_var["sql"],$conn);
			$cfg_var["loop"]++;
		}
		mssql_free_result($cfg_var["query"]);
	}

function dircopy($srcdir, $dstdir, $verbose = false) {
  $num = 0;
  if(!is_dir($dstdir)) mkdir($dstdir);
  if($curdir = @opendir($srcdir)) {
    while($file = readdir($curdir)) {
      if($file != '.' && $file != '..') {
        $srcfile = $srcdir . '\\' . $file;
        $dstfile = $dstdir . '\\' . $file;
        if(is_file($srcfile)) {
          if(is_file($dstfile)) $ow = filemtime($srcfile) - filemtime($dstfile); else $ow = 1;
          if($ow > 0) {
            if($verbose) echo "Copying '$srcfile' to '$dstfile'...";
            if(copy($srcfile, $dstfile)) {
              touch($dstfile, filemtime($srcfile)); $num++;
              if($verbose) echo "OK\n";
            }
            else echo "Error: File '$srcfile' could not be copied!\n";
          }                  
        }
        else if(is_dir($srcfile)) {
          $num += dircopy($srcfile, $dstfile, $verbose);
        }
      }
    }
    closedir($curdir);
  }
  return $num;
}

function deleteDirectory($dirname,$only_empty=false) {
    if (!is_dir($dirname))
        return false;
    $dscan = array(realpath($dirname));
    $darr = array();
    while (!empty($dscan)) {
        $dcur = array_pop($dscan);
        $darr[] = $dcur;
        if ($d=opendir($dcur)) {
            while ($f=readdir($d)) {
                if ($f=='.' || $f=='..')
                    continue;
                $f=$dcur.'/'.$f;
                if (is_dir($f))
                    $dscan[] = $f;
                else
                    @unlink($f);
            }
            closedir($d);
        }
    }
    $i_until = ($only_empty)? 1 : 0;
    for ($i=count($darr)-1; $i>=$i_until; $i--) {
        //echo "\nDeleting '".$darr[$i]."' ... ";
       // if (@rmdir($darr[$i]))
           // echo "ok";
        //else
           //echo "FAIL";
		   @rmdir($darr[$i]);
    }
    return (($only_empty)? (count(scandir)<=2) : (!is_dir($dirname)));
}

function deleteFileInDirectory($dirname,$only_empty=false) {
    if (!is_dir($dirname))
        return false;
    $dscan = array(realpath($dirname));
    $darr = array();
    while (!empty($dscan)) {
        $dcur = array_pop($dscan);
        $darr[] = $dcur;
        if ($d=opendir($dcur)) {
            while ($f=readdir($d)) {
                if ($f=='.' || $f=='..')
                    continue;
                $f=$dcur.'/'.$f;
                if (is_dir($f))
                    $dscan[] = $f;
                else
                    @unlink($f);
            }
            closedir($d);
        }
    }
    $i_until = ($only_empty)? 1 : 0;
    return (($only_empty)? (count(scandir)<=2) : (!is_dir($dirname)));
}
//======================================
// เข้ารหัสข้อมูลที่เป็นสัญลักษณ์พิเศษ
//======================================
function StringEnCode($String)
{
	$String=str_replace("\"","{_1_}",$String);
	$String=str_replace("'","{_2_}",$String);
	$String=str_replace("\n","<br>",$String);
	return trim($String);
}

//======================================
// ถอดรหัสข้อมูลที่เป็นสัญลักษณ์พิเศษ
//======================================
function StringDeCode($String)
{
	$String=str_replace("{_1_}","&quot;",$String);
	$String=str_replace("{_2_}","&acute;",$String);
	$String=str_replace("{_3_}","",$String);
	return trim($String);
}

//======================================
// ถอดรหัสข้อมูลที่เป็นสัญลักษณ์พิเศษ
//======================================
function StringDeCode2($String)
{
	$String=str_replace("{_1_}","&quot;",$String);
	$String=str_replace("{_2_}","&acute;",$String);
	$String=str_replace("{_3_}","",$String);
	return trim($String);
}

function make_tn_newpath($fileoriginal, $filewant, $minwidth, $minheight, $savelevel)
{
	$tn_filename = $filewant;  // path ??? ????????????????????????????

	if (file_exists($tn_filename)) // ???????????????????? ????????????? ??????????????
	{	unlink($tn_filename);  }

					set_time_limit(60);
					$photosize = getimagesize($fileoriginal);

					// ??????????????????????????
					$scale = min($minwidth/$photosize[0], $minheight/$photosize[1]);
							if ($scale < 1)
							{	$width = floor($scale*$photosize[0]);
								$height = floor($scale*$photosize[1]);   }
							else  // ????????????? ???????? ??????????? ???? ???????????  ???????????????????????????
							{	$width = $photosize[0];
								$height = $photosize[1];  }

				// ?????? jpeg
				if ($photosize[mime]=="image/jpeg")
				{
				$resizedimage = imagecreatetruecolor($width, $height);
				$thumbimage = imagecreatefromjpeg($fileoriginal);
				imagecopyresampled($resizedimage, $thumbimage, 0, 0, 0, 0, $width, $height, $photosize[0], $photosize[1]);
				imagejpeg($resizedimage,$tn_filename,$savelevel);
				imageDestroy($resizedimage);
				imageDestroy($thumbimage);
				}
				
				// ?????? gif
				if ($photosize[mime]=="image/gif")
				{
				$resizedimage = imagecreatetruecolor($width, $height);
				$thumbimage = imagecreatefromgif($fileoriginal);
				imagecopyresampled($resizedimage, $thumbimage, 0, 0, 0, 0, $width, $height, $photosize[0], $photosize[1]);
				imagejpeg($resizedimage,$tn_filename,$savelevel);
				imageDestroy($resizedimage);
				imageDestroy($thumbimage);
				}

				// ?????? bmp
				if ($photosize[mime]=="image/bmp")
				{
				$resizedimage = imagecreatetruecolor($width, $height);
				$thumbimage = imagecreatefromwbmp($fileoriginal);
				imagecopyresampled($resizedimage, $thumbimage, 0, 0, 0, 0, $width, $height, $photosize[0], $photosize[1]);
				imagejpeg($resizedimage,$tn_filename,$savelevel);
				imageDestroy($resizedimage);
				imageDestroy($thumbimage);
				}

				// ?????? png
				if ($photosize[mime]=="image/png")
				{
				$resizedimage = imagecreatetruecolor($width, $height);
				$thumbimage = imagecreatefrompng($fileoriginal);
				imagecopyresampled($resizedimage, $thumbimage, 0, 0, 0, 0, $width, $height, $photosize[0], $photosize[1]);
				imagejpeg($resizedimage,$tn_filename,$savelevel);
				imageDestroy($resizedimage);
				imageDestroy($thumbimage);
				}


} 
function ChangeDateTimeFormatThai($dateformat)
{
	$cfg_var["month"]["th"]=array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน","05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฏาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
	$cfg_var["month"]["en"]=array("01"=>"January","02"=>"February","03"=>"March","04"=>"April","05"=>"May","06"=>"June","07"=>"July","08"=>"August","09"=>"September","10"=>"October","11"=>"November","12"=>"December");
	$cfg_var["date"] = split(" ",$dateformat);
	$cfg_var["newdate"] = split("-",$cfg_var["date"][0]);
	$cfg_var["day"] = $cfg_var["newdate"][2];
	$cfg_var["mount"] = $cfg_var["newdate"][1];
	$cfg_var["year_th"] = $cfg_var["newdate"][0] + 543;
	$cfg_var["year_en"] = $cfg_var["newdate"][0];
	if($_SESSION[LANGUAGE]=="TH")
	{
		echo $cfg_var["day"]."  ".$cfg_var["month"]["th"][$cfg_var["mount"]]." ".$cfg_var["year_th"];
	}else{
		echo $cfg_var["day"]."  ".$cfg_var["month"]["en"][$cfg_var["mount"]]." ".$cfg_var["year_en"];
	}
}

function Strlenunderline($text,$numrow)
{
	return $text;
	$cfg_var["lentotal"] = strlen($text);
	$cfg_var["len"] = ceil($cfg_var["lentotal"]/$numrow);
	$cfg_var["lenstart"] = 0;
	$cfg_var["lensend"] = $numrow;
	if($cfg_var["len"]>3){$cfg_var["len"]=3;}
	for($cfg_var["loop"]=1;$cfg_var["loop"]<=$cfg_var["len"];$cfg_var["loop"]++)
	{
			$cfg_var["subject"] .= substr($text,$cfg_var["lenstart"],$cfg_var["lensend"])."<br>";
			$cfg_var["lenstart"] = $cfg_var["lenstart"] + $numrow;
			$cfg_var["lensend"] = $cfg_var["lensend"] + $numrow;
	}
	return $cfg_var["subject"];
	unset($cfg_var["subject"]);
}

function CheckFiletype($photo)
{
	$newphoto = split("\.",$photo);
	if($newphoto[1]=="pdf")
	{
		echo "<img src=\"images/EN/pdf.gif\" width=\"27\" height=\"11\" border=\"0\">";
	}else if($newphoto[1]=="doc")
	{
	 echo "<img src=\"images/EN/word.gif\" width=\"21\" height=\"16\" border=\"0\">";
	}else if($newphoto[1]=="ppt")
	{
	 echo "<img src=\"images/EN/ppt.gif\" width=\"21\" height=\"16\" border=\"0\">";
	} else if($newphoto[1]=="xls" || $newphoto[1]=="csv")
	{
		echo "<img src=\"images/EN/exel.gif\" width=\"21\" height=\"16\" border=\"0\">";
	}else{
		echo "<img src=\"images/EN/rar.gif\" width=\"21\" height=\"16\" border=\"0\">";
	}
}
?>