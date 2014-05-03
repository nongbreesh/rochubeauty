<?
/*********************
Code by : Supachok Thotong
Email : Sthotong@gmail.com
*********************/
function moneyconvert($number){ 
$txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
$txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
$number = str_replace(",","",$number); 
$number = str_replace(" ","",$number); 
$number = str_replace("บาท","",$number); 
$number = explode(".",$number); 
if(sizeof($number)>2){ 
return 'ทศนิยมหลายตัวนะจ๊ะ'; 
exit; 
} 
$strlen = strlen($number[0]); 
$convert = ''; 
for($i=0;$i<$strlen;$i++){ 
	$n = substr($number[0], $i,1); 
	if($n!=0){ 
		if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; } 
		elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; } 
		elseif($i==($strlen-2) AND $n==1){ $convert .= ''; } 
		else{ $convert .= $txtnum1[$n]; } 
		$convert .= $txtnum2[$strlen-$i-1]; 
	} 
} 

$convert .= 'บาท'; 
if($number[1]=='0' OR $number[1]=='00' OR 
$number[1]==''){ 
$convert .= 'ถ้วน'; 
}else{ 
$strlen = strlen($number[1]); 
for($i=0;$i<$strlen;$i++){ 
$n = substr($number[1], $i,1); 
	if($n!=0){ 
	if($i==($strlen-1) AND $n==1){$convert 
	.= 'เอ็ด';} 
	elseif($i==($strlen-2) AND 
	$n==2){$convert .= 'ยี่';} 
	elseif($i==($strlen-2) AND 
	$n==1){$convert .= '';} 
	else{ $convert .= $txtnum1[$n];} 
	$convert .= $txtnum2[$strlen-$i-1]; 
	} 
} 
$convert .= 'สตางค์'; 
} 
return $convert; 
} 

function my_date($dDate, $dType=1, $dFormat='YMD', $Lang='th') {
	global $lang;
    if ($lang == 'th') {
	    $MonthFull = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    	$MonthAbbrl = array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    }
    else {
    	$MonthFull = array("January","February","March","April","May","June","July","August","September","October","November","December");
        $MonthAbbrl = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
    }
    $str_date = $dDate;
	if (strlen(trim($dDate)) > 0) {
        $dFormat = strtoupper($dFormat);
		if (substr($dFormat,0,1) == "D") $my_day = intval(substr($dDate,0,2));
		elseif (substr($dFormat,1,1) == "D")
			$my_day = (substr($dFormat,0,1) == "M") ? intval(substr($dDate,3,2)) : intval(substr($dDate,5,2));
		else $my_day = intval(substr($dDate,8,2));
		if (substr($dFormat,0,1) == "M") $my_month = intval(substr($dDate,0,2));
		elseif (substr($dFormat,1,1) == "M")
			$my_month = (substr($dFormat,0,1) == "D") ? intval(substr($dDate,3,2)) : intval(substr($dDate,5,2),10);
		else $my_month = intval(substr($dDate,8,2));
		if (substr($dFormat,0,1) == "Y") $my_year = intval(substr($dDate,0,4));
		elseif (substr($dFormat,1,1) == "Y") $my_year = intval(substr($dDate,3,4));
		else $my_year = intval(substr($dDate,6,4));
        if ($lang == 'th' && $my_year < 2500) $my_year = $my_year + 543;
		if ($dType == 0)  // 20/1/2007
			$str_date = $my_day . "/" . $my_month . "/" . $my_year;
		else if ($dType == 1)  // 20 Jan 07
			$str_date = $my_day . " " . $MonthAbbrl[$my_month-1] . " " . substr(strval($my_year), -2);
		else if ($dType == 2)  // 20 January 2007
			$str_date = $my_day . " " . $MonthFull[$my_month-1] . " " . $my_year;
		else $str_date = substr("0".$my_day,-2) . "/" . substr("0".$my_month,-2) . "/" . $my_year;
		if (strlen($dDate) > 10) {
			$str_time = trim(substr($dDate, 10));
			if (strlen($str_time) >= 5) {
				if (strcmp($str_time, '00:00:00') != 0) {
					$str_date .= " ".substr($str_time, 0, 5);
				}
			}
		}
	}
	return $str_date;
}

function Zero($source, $digit) {
	if (is_string($source)) $source = trim($source);
	if (strlen(strval($source)) > $digit) $digit = strlen(strval($source));
	return substr(str_repeat("0", $digit - 1) . $source, -($digit));
}

function build_json($rs, $chk_array=0) {
    $i = 0;
    $json = "[ ";
    foreach ($rs as $row) {
        $json .= ($chk_array)?"[ ":"{ ";
        $j = 0;
        foreach ($row as $key=>$val) {
            $json .= ($chk_array)?"\"".$val."\"":"\"".$key."\": \"".$val."\"";
            $j++;
            if ($j < count($row)) $json .= ", ";
        }
        $json .= ($chk_array)?" ]":" }";
        $i++;
        if ($i < count($rs)) $json .= ",\n";
    }
    $json .= " ]";
    return $json;
}

function ChkInt($value) {
	if (!empty($value)) {
		if (is_string($value)) $value = str_replace(",", "", $value);
		if (is_numeric($value)) return $value;
		else return "0";
	}
	else return "0";
}

function implode_str($glue) {
	$tmp = array();
    for($i=1; $i<func_num_args(); $i++) {
		$value = func_get_arg($i);
		if (!empty($value) && $value != "-") array_push($tmp, $value);
    }
    return implode($glue, $tmp);
}

function MyDropDate($prefix='', $chk_start=false, $langx='th', $selected=array(), $yearrange=array()) {
	global $lang;
    if (strcmp($lang, "th") == 0) {
	    $MonthFull = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    	$MonthAbbrl = array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    }
    else {
    	$MonthFull = array("January","February","March","April","May","June","July","August","September","October","November","December");
        $MonthAbbrl = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
    }
	echo "<select name=\"",$prefix,"day\" id=\"",$prefix,"day\">";
	if ($chk_start) echo "<option value=\"\">วัน</option>";
	for ($i=1; $i<=31; $i++) {
		echo "<option value=\"",$i,"\"";
		if (!empty($selected['day'])) { if ($selected['day']==$i) echo " selected"; }
		else if (strcmp($_REQUEST[$prefix.'day'],strval($i))==0) echo " selected";
		echo ">",$i,"</option>\n";
	}
	echo "</select><select name=\"",$prefix,"month\" id=\"",$prefix,"month\">";
	if ($chk_start) echo "<option value=\"\">เดือน</option>";
	for ($i=1; $i<=12; $i++) {
		echo "<option value=\"",$i,"\"";
		if (!empty($selected['month'])) { if ($selected['month']==$i) echo " selected"; }
		else if (strcmp($_REQUEST[$prefix.'month'],strval($i))==0) echo " selected";
		echo ">",$MonthFull[$i-1],"</option>\n";
	}
	echo "</select>";
	echo "</select><select name=\"",$prefix,"year\" id=\"",$prefix,"year\">";
	if ($chk_start) echo "<option value=\"\">ปี</option>";
	if (count($yearrange) > 0) {
		foreach ($yearrange as $year) {
			echo "<option value=\"",$year,"\"";
			if (!empty($selected['year'])) { if ($selected['year']==$year) echo " selected"; }
			else if (strcmp($_REQUEST[$prefix.'year'],strval($year))==0) echo " selected";
			echo ">",((strcmp($lang, "th") == 0)?$year+543:$year),"</option>\n";
		}
	}
	else {
		$year = intval($_REQUEST[$prefix.'year']);
		if (empty($year)) $year = intval(date("Y")+1);
		for ($i=intval(date("Y")+1); $i>=$year-40; $i--) {
			echo "<option value=\"",$i,"\"";
			if (!empty($selected['year'])) { if ($selected['year']==$i) echo " selected"; }
			else if (strcmp($_REQUEST[$prefix.'year'],strval($i))==0) echo " selected";
			echo ">",((strcmp($lang, "th") == 0)?$i+543:$i),"</option>\n";
		}
	}
	echo "</select>";
}

function printPageNav($numfound, $itemperpg) {
	global $_lang;
	$pagecount = ceil($numfound/$itemperpg);
	$range = 10;
	parse_str($_SERVER['QUERY_STRING'], $output);
	$page = 1;
	if (!empty($output['p'])) $page = intval($output['p']);
	if ($numfound > $itemperpg) {
		if ($page > 1) {
			$output['p'] = $page - 1;
			echo "<a href=\"?",build_query($output),"\">&lt; ",$_lang['Previous'],"</a> ";
		}
		$start_range = 1;
		$end_range = $pagecount;
		if ($page - $range > 2) {
			$output['p'] = 1;
			echo " <a href=\"?",build_query($output),"\">1</a> ... ";
			$start_range = $page - $range;
		}
		if ($page + $range < $pagecount - 1) {
			$end_range = $page + $range;
		}
		for ($i=$start_range; $i<=$end_range; $i++) {
			$output['p'] = $i;
			if ($i == $page) echo " <b>",$i,"</b> ";
			else echo " <a href=\"?",build_query($output),"\">",$i,"</a> ";
		}
		if ($end_range != $pagecount) {
			$output['p'] = $pagecount;
			echo " ... <a href=\"?",build_query($output),"\">",$pagecount,"</a> ";
		}
		if ($page < $pagecount) {
			$output['p'] = $page + 1;
			echo " <a href=\"?",build_query($output),"\">",$_lang['Next']," &gt;</a>";
		}
	}
}

function printPageNavHref($numfound, $itemperpg, $page, $href, $range=10) {
	$pagecount = ceil($numfound/$itemperpg);
	if ($numfound > $itemperpg) {
		if ($page > 1) echo "<a href=\"",str_replace("-P-", $page-1, $href),"\">&laquo;</a> ";

		$start_range = 1;
		$end_range = $pagecount;
		if ($page - $range > 2) {
			$start_range = $page - $range;
		}
		if ($page + $range < $pagecount - 1) {
			$end_range = $page + $range;
		}

		if ($start_range > 2) {
			echo " <a href=\"",str_replace("-P-", 1, $href),"\">1</a> ... ";
		}
		for ($i=$start_range; $i<=$end_range; $i++) {
			if ($i == $page) echo " <b>",$i,"</b> ";
			else echo " <a href=\"",str_replace("-P-", $i, $href),"\">",$i,"</a> ";
		}
		if ($end_range < $pagecount - 1) {
			echo " ... <a href=\"",str_replace("-P-", $pagecount, $href),"\">",$pagecount,"</a> ";
		}
		if ($page < $pagecount) {
			echo " <a href=\"",str_replace("-P-", $page+1, $href),"\">&raquo;</a>";
		}
	}
}

function GroupData($data, $fieldgroup=0, $fielddata=1) {
	$group = array();
	for ($i=0; $i<count($data); $i++) {
		$index = array_search($data[$i][$fieldgroup], $group);
		if ($index === false) {
			$index = count($group);
			$groupdata[$index] = array();
			array_push($group, $data[$i][$fieldgroup]);
		}
		array_push($groupdata[$index], $data[$i][$fielddata]);
	}
	foreach ($group as $key=>$value) {
		echo "<b>",$value,"</b>:<br>",implode(", ", $groupdata[$key]);
		echo "<br>";
	}
}

function build_query($parameters) {
	$query = "";
	if (version_compare(phpversion(), "5.0.0") >= 0) {
		$query = http_build_query($parameters);
	}
	else {
		$i = 0;
		foreach ($parameters as $key=>$value) {
			$query .= $key."=".$value;
			$i++;
			if($i < count($parameters)) $query .= "&";
		}
	}
	return $query;
}

function BlankValue($val) {
	if (empty($val)) {
		return "<div align=\"center\">-</div>";
	}
	else {
		return $val;
	}
}

function OrderBy($caption, $id) {
	list($order_by, $order_way) = explode("-", $GLOBALS['global_order']);
	parse_str($_SERVER['QUERY_STRING'], $output);
	if (strcmp($order_by, $id) == 0) {
		if (strcmp($order_way,"asc") == 0) $output['order_by'] = $id."-desc";
		else $output['order_by'] = $id."-asc";
		echo "<span class=\"ordercolumn\"><a href=\"?",build_query($output),"\">",$caption,"</a>";
		echo " <img src=\"../../images/",$order_way,".gif\" align=\"absmiddle\"></span>";
	}
	else {
		if (strcmp($id, "date") == 0) $output['order_by'] = $id."-desc";
		else $output['order_by'] = $id."-asc";
		echo "<a href=\"?",build_query($output),"\">" , $caption , "</a>";
	}
}

function OrderByHref($caption, $id, $href, $default='asc') {
	list($order_by, $order_way) = explode("-", $GLOBALS['global_order']);
	parse_str($_SERVER['QUERY_STRING'], $output);
	$href = str_replace("[order]", $id, $href);
	if (strcmp($order_by, $id) == 0) {
		if (strcmp($order_way,"asc") == 0) $href = str_replace("[way]", "desc", $href);
		else $href = str_replace("[way]", "asc", $href);
		echo "<b><a href=\"",$href,"\">",$caption,"</a></b>";
		echo "<img src=\"i/",$order_way,".gif\" align=\"absmiddle\">";
	}
	else {
		$href = str_replace("[way]", $default, $href);
		echo "<a href=\"",$href,"\">" , $caption , "</a>";
	}
}

function MyOptions($options, $selected='', $attr='', $class='', $indent='') {
	foreach ($options as $key=>$value) echo "<option value=\"",$key,"\" ",((strcmp($selected,$key)==0)?" selected":""),$attr,((!empty($class))?" class=\"".$class."\"":""),">",$indent,$value,"</option>\n";
}

function MyRadioGroup($choices, $inputname, $checked='', $separator='', $moreattb='') {
	foreach ($choices as $key=>$value) echo "<input type=\"radio\" name=\"",$inputname,"\" value=\"",$key,"\" ",((strcmp($checked,$key)==0)?" checked":""),$moreattb,">",$value,$separator,"\n";
}

function MyCheckBoxes($choices, $inputname, $checked=array(), $separator='', $moreattb='') {
	foreach ($choices as $key=>$value) echo "<input type=\"checkbox\" name=\"",$inputname,"\" value=\"",$key,"\" ",((in_array($key,$checked))?" checked":""),">",$value,$separator,"\n";
}

function CheckP($paragraph) {
	if (strpos($paragraph, "<p>") !== false) {
		if (strpos($paragraph, "</p>") == strrpos($paragraph, "</p>")) {
			$paragraph = str_replace("<p>", "", $paragraph);
			$paragraph = str_replace("</p>", "", $paragraph);
		}
	}
	return $paragraph;
}

function ShowTimeDiff($time, $separator=':') {
	list($hh, $mm) = explode($separator, $time);
	if (intval($hh) >= 24) return floor(intval($hh)/24)." day";
	else {
		$str = "";
		if (intval($hh) >= 2) $str = intval($hh)." hrs ";
		else if (intval($hh) == 1) $str = intval($hh)." hrs ";
		if (intval($hh) < 2 && intval($mm) != 0) $str .= intval($mm)." min.";
		return $str;
	}
}

function validate_email($email) {
	// Create the syntactical validation regular expression
	$regexp = "^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$";

	// Presume that the email is invalid
	$valid = 0;

	// Validate the syntax
	if (eregi($regexp, $email)) {
		list($username, $domaintld) = split("@", $email);
		// Validate the domain
		if (getmxrr($domaintld,$mxrecords)) $valid = 1;
	} else {
		$valid = 0;
	}
	return $valid;
}

function listvalue() {
	$args = func_get_args();
	$tmp_value = array();
	for ($i=1; $i<count($args); $i++) {
		if (!empty($args[$i]) && in_array($args[$i], $tmp_value) == false) array_push($tmp_value, $args[$i]);
	}
	return implode($args[0], $tmp_value);
}

function str_array_replace($str, $array, $format="{^}") {
	list($begin,$end) = explode("^", $format);
	foreach ($array as $key=>$value) {
		$str = str_replace($begin.$key.$end, $value, $str);
	}
	return $str;
}

function StrFilename($str) {
	$newstr = "";
	$str_valid = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_";
	for ($i=0; $i<mb_strlen($str, 'utf-8'); $i++) {
		$char = mb_substr($str,$i,1);
		if (strpos($str_valid, $char) === false) {
			$newstr .= "_";
		}
		else {
			$newstr .= $char;
		}
	}
	return $newstr;
}

function NextWeekend($nextday=2) {
	$start = mktime(0,0,0,date("m"),date("d")+$nextday,date("Y"));
	$start_wday = date("w", $start);
	$countdown = 5 - $start_wday;
	if ($countdown == -1) {
		$countdown = 6;
	}
	return strtotime("+".$countdown." days", $start);
}

function getip(){
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
		$ip = getenv("HTTP_CLIENT_IP");
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
		$ip = getenv("REMOTE_ADDR");
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
		$ip = $_SERVER['REMOTE_ADDR'];
	else
		$ip = "unknown";
	return($ip);
}

function RelateLocation($loc, $step='../', $glue=',') {
	$str = "<a href=\"".$step.strtolower($loc['hctFileName'])."_attractions_guide.htm\">".$loc['hctname']."</a>";
	if (strcmp($loc['hctcode'], "TH") == 0 || $loc['hctid'] == 3 || strcmp($loc['hctname'], "ประเทศไทย") == 0) {
		if (!empty($loc['hlcname'])) {
			$strloc = "<a href=\"".$step.strtolower($loc['hlcFileName'])."_attractions_guide_".$loc['hlcid'].".htm\">".$loc['hlcname']."</a>";
			if (strcmp($glue, ",") == 0) {
				$str = $strloc.", ".$str;
			}
			else {
				$str .= " &gt; ".$strloc;
			}
		}
	}
	return $str;
}

function PageLocation($loc, $step='../') {
	$str = "<a href=\"".$step.strtolower($loc['hctFileName'])."_attractions_guide.htm\">".$loc['hctname']."</a>";
	if (!empty($loc['hlcname']) && (strcmp($loc['hctcode'], "TH") == 0 || $loc['hctid'] == 3)) {
		$str .= " <img src=\"".$step."i/arrow.gif\" align=\"absmiddle\" width=\"16\" height=\"16\"> <a href=\"".$step.strtolower($loc['hlcFileName'])."_attractions_guide_".$loc['hlcid'].".htm\">ข้อมูลแหล่งท่องเที่ยวและกิจกรรมใน จ.".$loc['hlcname']."</a>";
	}
	else if (!empty($loc['hlcname'])) {
		$str .= " <img src=\"".$step."i/arrow.gif\" align=\"absmiddle\" width=\"16\" height=\"16\"> <a href=\"".$step.strtolower($loc['hlcFileName'])."_attractions_guide_".$loc['hlcid'].".htm\">".$loc['hlcname']."</a>";
	}
	return $str;
}

function HotelPageLocation($loc, $step='') {
	$str = "<a href=\"".$step.strtolower($loc['hctFileName'])."_hotelslocation_guide.htm\">โรงแรมใน".$loc['hctname']."</a>";
	if (strcmp($loc['hctcode'], "TH") == 0 || $loc['hctid'] == 3 || strcmp($loc['hctname'], "ประเทศไทย") == 0) {
		if (!empty($loc['hlcname'])) {
			$str .= " <img src=\"".$step."i/arrow.gif\" align=\"absmiddle\" width=\"16\" height=\"16\"> <a href=\"".$step.strtolower($loc['hlcFileName'])."_hotelslocation_guide_".$loc['hlcid'].".htm\">โรงแรมใน จ.".$loc['hlcname']."</a>";
			if (!empty($loc['hslname'])) {
				$str .= " <img src=\"".$step."i/arrow.gif\" align=\"absmiddle\" width=\"16\" height=\"16\"> <a href=\"".$step.strtolower($loc['hlcFileName'])."_hotels_guide_".$loc['hlcid']."-".$loc['hslid'].".htm\">โรงแรมใน ".$loc['hslname']."</a>";
			}
			else if (!empty($loc['area_name'])) {
				$str .= " <img src=\"".$step."i/arrow.gif\" align=\"absmiddle\" width=\"16\" height=\"16\"> <a href=\"".$step.strtolower($loc['hlcFileName'])."_hotelslocation_guide_".$loc['hlcid'].".htm,".$loc['area_id']."\">โรงแรมใน ".$loc['area_name']."</a>";
				if (!empty($loc['area_name2'])) {
					$str .= " <img src=\"".$step."i/arrow.gif\" align=\"absmiddle\" width=\"16\" height=\"16\"> <a href=\"".$step.strtolower($loc['hlcFileName'])."_hotelslocation_guide_".$loc['hlcid'].".htm,".$loc['area_id']."-".$loc['area_id2']."\">".$loc['area_name2']."</a>";
				}
			}
		}
	}
	else if (!empty($loc['hlcname'])) {
		$str .= " <img src=\"".$step."i/arrow.gif\" align=\"absmiddle\" width=\"16\" height=\"16\"> <a href=\"".$step.strtolower($loc['hlcFileName'])."_hotelscity_guide_".$loc['hlcid'].".htm\">".$loc['hlcname']."</a>";
		if (!empty($loc['area_name'])) {
			$str .= " <img src=\"".$step."i/arrow.gif\" align=\"absmiddle\" width=\"16\" height=\"16\"> <a href=\"".$step.strtolower($loc['hlcFileName'])."_hotelslocation_guide_".$loc['hlcid'].".htm,".$loc['area_id']."\">".$loc['area_name']."</a>";
		}
	}
	return $str;
}

function IPxxx($ip) {
	if (!empty($ip)) {
		$ip = explode(".", $ip);
		$ip[3] = str_repeat("X", strlen($ip[3]));
		$str = implode(".", $ip);
	}
	return $str;
}

function PreparePath($str) {
	$str = str_replace("&", "and", $str);
	$str = str_replace("(", "", $str);
	$str = str_replace(")", "", $str);
	$str = str_replace("\"", "", $str);
	$str = str_replace("'", " ", $str);
	$str = str_replace(",", " ", $str);
	$str = str_replace("/", " ", $str);
	$str = str_replace("  ", " ", $str);
	$str = str_replace("  ", " ", $str);
	$str = str_replace(" ", "_", $str);
	return $str;
}

function Thai2Stay($agoda_path, $agoda_url, $agoda_id='') {
	if (strpos($agoda_url,"thai2stay") === false) {
		$arr_path = explode("/", substr($agoda_url,10));
		$country_filename = $arr_path[2];
		$city_filename = $arr_path[3];
		//$country_filename = PreparePath($agoda_path['country']);
		//$city_filename = PreparePath($agoda_path['city']);
		//$filename = $agoda_url;
		//$filename = substr($filename,strrpos($filename,"/")+1);
		$filename = $arr_path[4];
		$filename = substr($filename,0,strrpos($filename,"."));
		$hotel_url = "http://www.thai2stay.com/".$country_filename."/".$city_filename."/".$filename."_".$agoda_id.".htm";
		return $hotel_url;
	}
	else {
		return $agoda_url;
	}
}

function my_date_hint($thedate) {
	$day_name = my_date(substr($thedate, 0, 10));
	if (strcmp(substr($thedate,0,10), date("Y-m-d")) == 0) {
		$day_name = "วันนี้";
	}
	else if (strcmp(substr($thedate,0,10), date("Y-m-d", strtotime("-1 day"))) == 0) {
		$day_name = "เมื่อวานนี้";
	}
	if (strlen($thedate) > 10) $day_name .= " เวลา ".substr($thedate, 11)." น.";
	return $day_name;
}

function RangeDate($rangedate) {
	$MonthAbbrl = array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$startdate = explode("-", $rangedate[0]);
	$enddate = explode("-", $rangedate[1]);
	if (strcmp($rangedate[0], $rangedate[1]) == 0) {
		$str = my_date($rangedate[0]);
	}
	else if ($startdate[1] == $enddate[1]) {
		$str = intval($startdate[2])."-".intval($enddate[2])." ".$MonthAbbrl[intval($enddate[1])-1]." ".substr(intval($startdate[0])+543, -2);
	}
	else {
		$str = my_date($rangedate[0])."-".my_date($rangedate[1]);
	}
	return $str;
}

function image_exists($url){
	$file_headers = @get_headers($url,1);
	if(!$file_headers) return false;
	if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
		return false;
	}
	else if (preg_match("|200|", $file_headers[0])) {
		if (strpos($file_headers['Content-Type'], "image") !== false) {
			return true;
		}
		else return false;
	}
	else return false;
}

function get_picture($url, $filename)  {
	$dst_img = @imagecreatefromjpeg($url);
	if ($dst_img) {
		imagejpeg($dst_img, $filename, 100);
		return true;
	}
	else return false;
}

function trimzero($number) {
	if (strpos($number,".") !== false) {
		$number = rtrim($number,'0');
		$number = rtrim($number,'.');
	}
	return $number;
}

function is_zero($number,$replace='-') {
	if (floatval($number) != 0) {
		echo round($number,2);
	}
	else {
		echo $replace;
	}
}


function cart(){
//Create 'cart' if it doesn't already exist
if (!isset($_SESSION['SHOPPING_CART'])){ $_SESSION['SHOPPING_CART'] = array(); }

//Add an item only if we have the threee required pices of information: name, price, qty
if (isset($CoinName) && isset($CoinName) && (isset($_GET['qty'])) or !empty($_POST['qty'])){
	//Adding an Item
	//Store it in a Array
	if(!empty($_POST['qty'])){
	$qty = $_POST['qty'];
	}
	else{
	$qty = $_GET['qty']	;
	}
	$ITEM = array(
		//Item name		
		'name' => $CoinName,
		//Product id		
		'product_id' =>$id,
		//Product code		
		'product_code' =>$CoinID,
		//Item Price
		'price' => $coins['Price'], 
		//Qty wanted of item
		'qty' =>$qty	
		);

	//Add this item to the shopping cart
	$flag = 0;
	 foreach ($_SESSION['SHOPPING_CART'] as $itemNumber => $item) {
		 if($item['product_id'] == $id){
		 $flag = 1;
		 }
	 }
	 if($flag != 1){
	$_SESSION['SHOPPING_CART'][] =  $ITEM;
	}
	//Clear the URL variables
	//header('Location: ' . $_SERVER['PHP_SELF']);
}
//Allowing the modification of individual items no longer keeps this a simple shopping cart.
//We only support emptying and removing
else if (isset($_GET['remove'])){
	//Remove the item from the cart
	unset($_SESSION['SHOPPING_CART'][$_GET['remove']]);
	//Re-organize the cart
	//array_unshift ($_SESSION['SHOPPING_CART'], array_shift ($_SESSION['SHOPPING_CART']));
	//Clear the URL variables
	//header('Location: ' . $_SERVER['PHP_SELF']);
}
else if (isset($_GET['empty'])){
	//Clear Cart by destroying all the data in the session
	session_destroy();
	//Clear the URL variables
	header('Location: ' . $_SERVER['PHP_SELF']);

}
else if (isset($_POST['update'])) {
	//Updates Qty for all items
	foreach ($_POST['items_qty'] as $itemID => $qty) {
		//If the Qty is "0" remove it from the cart
		if ($qty == 0) {
			//Remove it from the cart
			unset($_SESSION['SHOPPING_CART'][$itemID]);
		}
		else if($qty >= 1) {
			//Update to the new Qty
			$_SESSION['SHOPPING_CART'][$itemID]['qty'] = $qty;
		}
	}
	//Clear the POST variables
	//header('Location: ' . $_SERVER['PHP_SELF']);
} 
}
function truncate($content, $limit, $pad, $break=' '){
if(strlen(utf8_decode($content)) <= $limit) return $content;

$content = substr($content, 0, $limit);
if(false != ($breakpoint = strrpos($content, $break))) {
$content = substr($content, 0, $breakpoint);
}

return $content . $pad;
}

function smtpmail( $email , $subject , $body )
{
    $mail = new PHPMailer();

    $mail->IsSMTP();         
	$mail->IsHTML(true);
    $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้                        
    $mail->Host     = "mail.dressphuyhing.com"; //  mail server ของเรา
    $mail->SMTPAuth = true;     //  เลือกการใช้งานส่งเมล์ แบบ SMTP
	//$mail->Port = 25; // set the SMTP port for the GMAIL server
    $mail->Username = "noreply@dressphuyhing.com";   //  account e-mail ของเราที่ต้องการจะส่ง
    $mail->Password = "p@ssw0rd";  //  รหัสผ่าน e-mail ของเราที่ต้องการจะส่ง

    $mail->From     = "noreply@dressphuyhing.com";  //  account e-mail ของเราที่ต้องการจะส่ง
    $mail->FromName = "noreply@dressphuyhing.com"; //  ชื่อที่แสดง เมื่อผู้รับได้รับเมล์ของเรา
    $mail->AddAddress($email,"noreply@dressphuyhing.com");            // Email ปลายทางที่เราต้องการส่ง
    $mail->IsHTML(true);                  // ถ้า E-mail นี้ มีข้อความในการส่งเป็น tag html ต้องแก้ไข เป็น true
    $mail->Subject     =  $subject;        // หัวข้อที่จะส่ง
    $mail->Body     = $body;                   // ข้อความ ที่จะส่ง
	$result = $mail->send();       
	return $result;
}

function costshipping($weight){
	if($weight < 260){
		return 32;
	}
	elseif($weight < 500){
		return 52;
	}
	elseif($weight < 1000){
		return 67;
	}
	elseif($weight < 1500){
		return 82;
	}
	elseif($weight < 2000){
		return 98;
	}
	elseif($weight < 2500){
		return 112;
	}
	elseif($weight < 3000){
		return 137;
	}
	elseif($weight < 3500){
		return 142;
	}
	elseif($weight < 4000){
		return 162;
	}
	elseif($weight < 4500){
		return 182;
	}
	elseif($weight < 5000){
		return 202;
	}
	else{
		return 252;
	}
}


function costbox($weight){
	if($weight < 100){
		return 11;
	}
	elseif($weight < 500){
		return 12;
	}
	elseif($weight < 1000){
		return 16;
	}
	elseif($weight < 1500){
		return 24;
	}
	elseif($weight < 2000){
		return 35;
	}
	elseif($weight < 2500){
		return 50;
	}
	elseif($weight < 3000){
		return 50;
	}
	elseif($weight < 3500){
		return 65;
	}
	elseif($weight < 4000){
		return 65;
	}
	elseif($weight < 4500){
		return 80;
	}
	elseif($weight < 5000){
		return 80;
	}
	else{
		return 100;
	}
}


function checkword($title){
$title = preg_replace("/[\"\']/", "-", $title);
$title = stripslashes ($title);
$title = str_replace("-","",$title);
$title = str_replace(" ","-",$title);
$title = str_replace(".","-",$title);
$title = str_replace("(","",$title);
$title = str_replace(")","",$title);
$title = str_replace(",","",$title);
$title = str_replace("+","",$title);
$title = str_replace("*","",$title);
$title = str_replace("--","-",$title);
$title = str_replace('"',"-",$title);
$title = str_replace('/',"-",$title);
$title = str_replace('&',"And",$title);
$title = str_replace('[',"",$title);
$title = str_replace(']',"",$title);
$title = str_replace('?',"",$title);
return $title;
}
?>



