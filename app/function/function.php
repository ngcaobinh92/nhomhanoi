<?php
use App\Models\CategoryModel;
use Illuminate\Support\Facades\Artisan;

function changeTitle($str,$strSymbol='-',$case=MB_CASE_LOWER){// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
	$str=trim($str);
	if ($str=="") return "";
	$str =str_replace('"','',$str);
	$str =str_replace("'",'',$str);
	$str = stripUnicode($str);
	$str = mb_convert_case($str,$case,'utf-8');
	$str = preg_replace('/[\W|_]+/',$strSymbol,$str);
	return $str;
}


function stripUnicode($str){
	if(!$str) return '';
	//$str = str_replace($a, $b, $str);
	$unicode = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|å|ä|æ|ā|ą|ǻ|ǎ',
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Å|Ä|Æ|Ā|Ą|Ǻ|Ǎ',
		'ae'=>'ǽ',
		'AE'=>'Ǽ',
		'c'=>'ć|ç|ĉ|ċ|č',
		'C'=>'Ć|Ĉ|Ĉ|Ċ|Č',
		'd'=>'đ|ď',
		'D'=>'Đ|Ď',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë|ē|ĕ|ę|ė',
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë|Ē|Ĕ|Ę|Ė',
		'f'=>'ƒ',
		'F'=>'',
		'g'=>'ĝ|ğ|ġ|ģ',
		'G'=>'Ĝ|Ğ|Ġ|Ģ',
		'h'=>'ĥ|ħ',
		'H'=>'Ĥ|Ħ',
		'i'=>'í|ì|ỉ|ĩ|ị|î|ï|ī|ĭ|ǐ|į|ı',	  
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï|Ī|Ĭ|Ǐ|Į|İ',
		'ij'=>'ĳ',	  
		'IJ'=>'Ĳ',
		'j'=>'ĵ',	  
		'J'=>'Ĵ',
		'k'=>'ķ',	  
		'K'=>'Ķ',
		'l'=>'ĺ|ļ|ľ|ŀ|ł',	  
		'L'=>'Ĺ|Ļ|Ľ|Ŀ|Ł',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ö|ø|ǿ|ǒ|ō|ŏ|ő',
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ö|Ø|Ǿ|Ǒ|Ō|Ŏ|Ő',
		'Oe'=>'œ',
		'OE'=>'Œ',
		'n'=>'ñ|ń|ņ|ň|ŉ',
		'N'=>'Ñ|Ń|Ņ|Ň',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|û|ū|ŭ|ü|ů|ű|ų|ǔ|ǖ|ǘ|ǚ|ǜ',
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Û|Ū|Ŭ|Ü|Ů|Ű|Ų|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ',
		's'=>'ŕ|ŗ|ř',
		'R'=>'Ŕ|Ŗ|Ř',
		's'=>'ß|ſ|ś|ŝ|ş|š',
		'S'=>'Ś|Ŝ|Ş|Š',
		't'=>'ţ|ť|ŧ',
		'T'=>'Ţ|Ť|Ŧ',
		'w'=>'ŵ',
		'W'=>'Ŵ',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ|ÿ|ŷ',
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ|Ÿ|Ŷ',
		'z'=>'ź|ż|ž',
		'Z'=>'Ź|Ż|Ž',
	);
	foreach($unicode as $khongdau=>$codau) {
		$arr=explode("|",$codau);
		$str = str_replace($arr,$khongdau,$str);
		$str = str_replace(' ','-',$str);
	}
	return $str;
}


function bindCategory($checked_cat = array(), $lang){

    $ckc = array();

    if($checked_cat){

        foreach($checked_cat as $cat){

            $ckc[] = $cat->cat_id;

        }

    }

    $rshtml = '';
    $categories = CategoryModel::where('lang', 'like', "%$lang%")->where('status', "public")->get();

    foreach($categories as $cat){

        if($cat->parent == 0){

            if(in_array($cat->id, $ckc)){

                if($cat->child > 0){

                    $element = '<div class="checkbox"><label><strong>'.$cat->name.'</strong> - '.$cat->des.'</label></div>';

                } else {

                    $element = '<div class="checkbox"><label><input checked="checked" type="checkbox" name="category[]" value="'.$cat->id.'"><strong>'.$cat->name.'</strong> - '.$cat->des.'</label></div>';
                }

            }else{

                if($cat->child > 0){

                    $element = '<div class="checkbox"><label><strong>'.$cat->name.'</strong> - '.$cat->cdes.'</label></div>';
                
                } else {

                    $element = '<div class="checkbox"><label><input type="checkbox" name="category[]" value="'.$cat->id.'"><strong>'.$cat->name.'</strong> - '.$cat->des.'</label></div>';

                }
            }

            $rshtml .= $element;

            $rshtml = dqCategory($categories,$cat,1,$rshtml, $ckc);

        }

    }

    return $rshtml;

}


function dqCategory($categories, $cat, $level = 1, $rshtml = '', $ckc){

    ++$level;

    foreach($categories as $catsub){

        if($catsub->parent == $cat->id){

            $space = '';

            for($i=0;$i<$level;++$i){

                $space .= '--';

            }

            if(in_array($catsub->id, $ckc)){

                $element = '<div class="checkbox"><label><input checked="checked" type="checkbox" name="category[]" value="'.$catsub->id.'">'.$space.' '.$catsub->name.'</label></div>';

            }else{

                $element = '<div class="checkbox"><label><input type="checkbox" name="category[]" value="'.$catsub->id.'">'.$space.' '.$catsub->name.'</label></div>';

            }

            $rshtml .= $element;

            $rshtml = dqCategory($categories, $catsub, $level, $rshtml, $ckc);

        }

    }

    return $rshtml;

}

function check_token($param) {
    $secret_key = 'kqxs';
    if (isset($param['token']) && $param['token'] != '') {
        $token_param = $param['token'];
        unset($param['token']);
        $token_check = hash_hmac('sha256', implode('', $param), $secret_key);
        if ($token_check === $token_param) {
            return true;
        } else {
            response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'Unauthorized - TokenInvalid',
                // 'token' => $token_check,
            ])->send();
            exit();
        }
    } else {
        response()->json([
            'status' => false,
            'code' => 401,
            'message' => 'Unauthorized - TokenRequired',
        ])->send();
        exit();
    }
}


function parse_signed_request($signed_request) {
    list($encoded_sig, $payload) = explode('.', $signed_request, 2);

    $secret = "appsecret"; // Use your app secret here

    // decode the data
    $sig = base64_url_decode($encoded_sig);
    $data = json_decode(base64_url_decode($payload), true);

    // confirm the signature
    $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
    if ($sig !== $expected_sig) {
        error_log('Bad Signed JSON signature!');
        return null;
    }

    return $data;
}

function base64_url_decode($input) {
    return base64_decode(strtr($input, '-_', '+/'));
}


function encrypt128($key = NULL, $data = '') {
    if($key != NULL && $data != ""){
        $method = "AES-128-ECB";
        $encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA);
        $result = base64_encode($encrypted);
        return $result;
    }else{
        return "Invalid key or data.";
    }
}


function decrypt128($key = NULL,$data="") {
    if($key != NULL && $data != ""){
        $method = "AES-128-ECB";
        $dataDecoded = base64_decode($data);
        $decrypted = openssl_decrypt($dataDecoded, $method, $key, OPENSSL_RAW_DATA);
        return $decrypted;
    }else{
        return "Invalid key or data.";
    }
}


function millitime() {
  	$microtime = microtime();
  	$comps = explode(' ', $microtime);

  	// Note: Using a string here to prevent loss of precision
  	// in case of "overflow" (PHP converts it to a double)
  	return sprintf('%d%03d', $comps[1], $comps[0] * 1000);
}

function encryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded  = openssl_encrypt($q, "AES-128-ECB", $cryptKey);
    return( $qEncoded );
}

function decryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded  = openssl_decrypt($q, "AES-128-ECB", $cryptKey);
    return( $qDecoded );
}

function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function getUserIP() {  
  // Get real visitor IP behind CloudFlare network
  if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
  }
  $client  = @$_SERVER['HTTP_CLIENT_IP'];
  $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
  $remote  = $_SERVER['REMOTE_ADDR'];

  if(filter_var($client, FILTER_VALIDATE_IP))
  {
      $ip = $client;
  }
  elseif(filter_var($forward, FILTER_VALIDATE_IP))
  {
      $ip = $forward;
  }
  else
  {
      $ip = $remote;
  }

  return $ip;
}  

function getInbetweenStrings($start, $end, $str){
    $matches = array();
    $regex = "/$start([a-zA-Z0-9_]*)$end/";
    preg_match_all($regex, $str, $matches);
    return $matches[1];
}

function updateEnv($data = array())
{
    if (!count($data)) {
        return;
    }

    $pattern = '/([^\=]*)\=[^\n]*/';

    $envFile = base_path() . '/.env';
    $lines = file($envFile);
    $newLines = [];
    foreach ($lines as $line) {
        preg_match($pattern, $line, $matches);

        if (!count($matches)) {
            $newLines[] = $line;
            continue;
        }

        if (!key_exists(trim($matches[1]), $data)) {
            $newLines[] = $line;
            continue;
        }

        $line = trim($matches[1]) . "={$data[trim($matches[1])]}\n";
        $newLines[] = $line;
    }

    $newContent = implode('', $newLines);
    file_put_contents($envFile, $newContent);
}


function setEnv($data)
{
    if (!count($data)) {
        return;
    }

    $path = base_path('.env');

    if (file_exists($path)) {

        // Get all the lines from that file
        $lines = explode("\n", file_get_contents($path));
        
        $settings = collect($lines)
            ->filter() // remove empty lines
            ->transform(function ($item) {
                return explode("=", $item, 2);
            }) // separate key and values
            ->pluck(1, 0); // keys to keys, values to values

        foreach ($data as $key => $value) {
            $settings[$key] = $value; // set the new value whether it exists or not
            $rebuilt = $settings->map(function ($value, $key) {
                return "$key=$value";
            })->implode("\n"); // rebuild the env file
        }

        file_put_contents($path, $rebuilt); // put the new contents

        Artisan::call("config:cache"); // cache the added/modified parameter
    }
}

function number_to_alphabet($number) {
    $number = intval($number);
    if ($number <= 0) {
       return '';
    }
    $alphabet = '';
    while($number != 0) {
       $p = ($number - 1) % 26;
       $number = intval(($number - $p) / 26);
       $alphabet = chr(65 + $p) . $alphabet;
    }
   return $alphabet;
}

function alphabet_to_number($string) {
    $string = strtoupper($string);
    $length = strlen($string);
    $number = 0;
    $level = 1;
    while ($length >= $level ) {
        $char = $string[$length - $level];
        $c = ord($char) - 64;        
        $number += $c * (26 ** ($level-1));
        $level++;
    }
    return $number;
}

function squashCharacters($str)
{
    static $normalizeChars = null;
    if ($normalizeChars === null) {
        $normalizeChars = array(
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'Ae',
            'Ç'=>'C',
            'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E',
            'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I',
            'Ð'=>'Dj',
            'Ñ'=>'N',
            'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O',
            'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U',
            'Ý'=>'Y',
            'Þ'=>'B',
            'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'ae',
            'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e',
            'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i',
            'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o',
            'ù'=>'u', 'ú'=>'u', 'û'=>'u',
            'ý'=>'y',
            'þ'=>'b',
            'ÿ'=>'y',
            'Š'=>'S', 'š'=>'s', 'ś' => 's',
            'Ž'=>'Z', 'ž'=>'z',
            'ƒ'=>'f'
        );
    }
    return strtr($str, $normalizeChars);
}

function convertFieldsToAscii(&$item, $template=null, $default='', array $ignore=null)
{
    foreach ($item as $field => &$value) {

        // Skip fields in the $ignore array.
        if ($ignore && in_array($field, $ignore)) {
            continue;
        }

        // Normalize non-ASCII characters with ASCII counterparts.
        $value = squashCharacters($value);

        // Replace fields that contain non-ASCII characters with a default.
        if (mb_convert_encoding($value, 'ascii') !== $value) {
            // If template is provided, use the template field, if set.
            if ($template) {
                if (is_object($template) && isset($template->{$field})) {
                    $value = $template->{$field};
                } elseif (is_array($template) && isset($template[$field])) {
                    $value = $template[$field];
                } else {
                    $value = $default;
                }
            } else {
                $value = $default;
            }
        }
    }
}

?>