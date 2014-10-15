<?php
/**
 * Helpers for Amazoni5
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 */

/**
 * Return array of ENUM field
 * @param type $model
 * @param type $attribute
 * @return type
 */
function enumItem($model,$attribute)
{
        preg_match('/\((.*)\)/',$model->tableSchema->columns[$attribute]->dbType,$matches);
        foreach(explode(',', $matches[1]) as $value)
        {
                $value=str_replace("'",null,$value);
                $values[$value]=Yii::t('common', ucfirst($value));
        }
        asort($values);
        return $values;
}

function add_product()
{
    return CHtml::link(
        Yii::t('common', 'Add'),
        '#',
        array(
            'onclick'=>'$("#add_product_form").show("slow").css("overflow","");return false;',
        )
    );
}

function dialog($model,$attribute)
{
    static $i=0;
    if(!$model->hasAttribute($attribute))
        return null;
    
    if(empty($model->{$attribute}))
        return null;
    
    $id=CHtml::activeId($model, $attribute).'_'.$i++;
    Yii::app()->session['GridCell'.$id]=$model->{$attribute};
    
    return CHtml::ajaxLink(
    Yii::t('zii', 'View'), 
    Yii::app()->createUrl('ajax/gridCell'), 
    array (
        'type'=>'POST',
        'beforeSend'=>'function(html){ $("#mainDialog").dialog("open");$("#mainDialogContent").addClass("fa fa-spin fa-spinner fa-lg"); }',
        'success'=>'function(html){ $("#mainDialogContent").html(html).removeClass("fa fa-spin fa-spinner fa-lg"); }',
        'error'=>'function(jqXHR, textStatus, errorThrown){ $("#mainDialogContent").html(textStatus+": "+errorThrown).removeClass("fa fa-spin fa-spinner fa-lg"); }',
        'data'=>array('var'=>$id,Yii::app()->request->csrfTokenName=>Yii::app()->request->csrfToken),
        )
    );
}

/**
 * Create ajax switcher for a bool fields of the model $model
 * @param mixed $model
 * @param string $attribute
 * @param array $titles
 * @return string
 * @throws CHttpException
 */
function toggle($model, $attribute='published', $titles=null)
{
    $str = '';
    $space='&nbsp;&nbsp;&nbsp;&nbsp;';
    $tokenName  =  Yii::app()->request->csrfTokenName;
    $token      =  Yii::app()->request->csrfToken;
    
    if($model===null)
        return '';
    
    if(!$model->hasAttribute($attribute))
        throw new CHttpException(500,  
                Yii::t('common', 'Unknown attribute {attribute}', 
                        array('{attribute}'=>$attribute)));

    if($titles===null)
    {
        $titles=array("Unpublish","Publish");
    }
    
    $modelClass = get_class($model);
    
    if($model->{$attribute} == 1)
    {
        $name = Yii::t("yii", "Yes");
        $class = "fa fa-ban red";
        $attrVal=0;
    }
    else
    {
        $name = Yii::t("yii", "No");
        $class = "fa fa-check green";
        $attrVal=1;
    }
    
    $str = '<span id="toggle_attribute_'.$attribute.'">';
    $str .= $name;
    $str .= $space;
    $str .= CHtml::ajaxLink('<i id="toggle_i_'.$attribute.'" class="'.$class.'"></i>', 
            Yii::app()->controller->createUrl("toggle",
                    array("id"=>$model->primaryKey)),
            array(
                'type'=>'POST',
                'data'=>array($tokenName=>$token,$modelClass=>array($attribute=>$attrVal)),
                'success'=>'function(html){location.reload();}',
                'beforeSend' => 'function() {    
                    $("#toggle_i_'.$attribute.'").removeClass();
                    $("#toggle_i_'.$attribute.'").addClass("fa fa-spin fa-spinner");
                }',
            ),
            array('title'=>Yii::t("common", $titles[$attrVal])));
    $str .= '</span>';
    
    return $str;
}

function customerProfile($profileData)
{
    $profile = new Profile;
    
    $profile->attributes = unserialize($profileData)['profile'];
    
    $attributes = $profile->attributeNames();
    
    foreach ($attributes as $attr)
    {
        if(!in_array($attr, array('delivery_country_code','delivery_state_id')))
        $finalAttributes[] = $attr;
    }
    
    $finalAttributes[] = array(
        'name'=>'delivery_country_code',
        'value'=>Countries::listData($profile->delivery_country_code),
    );
    $finalAttributes[] = array(
        'name'=>'delivery_state_id',
        'value'=>States::listData($profile->delivery_state_id),
    );
    
    return Yii::app()->controller->widget('zii.widgets.CDetailView', array(
	'data'=>$profile,'attributes'=>$finalAttributes),true);
}

/**
 * Return "Yes"/"No" for bool field of rhe model $model.
 * Translation included.
 * Default attribute "Published"
 * @param object $model
 * @param string $attribute
 * @return string
 * @throws CHttpException
 */
function boolean($model, $attribute='published')
{
    if($model===null)
        return '';
    
    if(!$model->hasAttribute($attribute))
        throw new CHttpException(500,  
                Yii::t('common', 'Unknown attribute {attribute}', 
                        array('{attribute}'=>$attribute)));
    
    return $model->{$attribute}==1?Yii::t("yii", "Yes"):Yii::t("yii", "No");
}

function created_by($model)
{
    if($model===null)
        return '';
    
    if(!$model->hasAttribute('created_by'))
        throw new CHttpException(500,  
                Yii::t('common', 'Unknown attribute {attribute}', 
                        array('{attribute}'=>'created_by')));
    
    return Yii::app()->getModule("user")->user($model->created_by)->getFullName();
}

function customer($userId)
{
    return Yii::app()->getModule("user")->user($userId)->getFullName() . 
            ' - <'.Yii::app()->getModule("user")->user($userId)->email.'>';
}

function modified_by($model)
{
    if($model===null)
        return '';
    
    if(!$model->hasAttribute('modified_by'))
        throw new CHttpException(500,  
                Yii::t('common', 'Unknown attribute {attribute}', 
                        array('{attribute}'=>'modified_by')));
    
    return Yii::app()->getModule("user")->user($model->modified_by)->getFullName();
}

function deleted_by($model)
{
    if($model===null)
        return '';
    
    if(!$model->hasAttribute('deleted_by'))
        throw new CHttpException(500,  
                Yii::t('common', 'Unknown attribute {attribute}', 
                        array('{attribute}'=>'deleted_by')));
    
    if($model->deleted_by==0)
    {
        return '';
    }
    
    return Yii::app()->getModule("user")->user($model->deleted_by)->getFullName();
}

/**
 * Return string of all validation errors
 * @param type $model
 * @return string All errors
 */
function get_validation_errors($model)
{
    $result = '';
    $objTmp = (object) array('aFlat' => array());
    
    $callbackFcn=function(&$v, $k, &$t){
        $t->aFlat[] = $v;
    };
    $errors = $model->getErrors();
    array_walk_recursive($errors, $callbackFcn, $objTmp);                
    $errors = $objTmp->aFlat;
    
    foreach ($errors as $error)
    {
        $result.= $error."<br>\n";
    }
    
    return $result;
}

/**
 * Return random alphanumeric string with specified length bytes
 * @param int $length
 * @return string
 */
function str_random($length=6,$lowercaseOnly=true)
{
    $validCharacters = "0123456789abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ";
    
    if($lowercaseOnly)
        $validCharacters = "0123456789abcdefghijklmnopqrstuxyvwz";
    
    $validCharNumber = strlen($validCharacters);
 
    $result = "";
 
    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
 
    return $result;
}

/**
 * Returns only the file extension (without the period).
 * @param string $filename
 * @return string
 */
function file_ext($filename) {
	if( !preg_match('/\./', $filename) ) return '';
	return preg_replace('/^.*\./', '', $filename);
}

/**
 *  Returns the file name, less the extension.
 * @param string $filename
 * @return string
 */
function file_ext_strip($filename){
    return preg_replace('/\.[^.]*$/', '', $filename);
}

/**
 * Create a web friendly URL slug from a string.
 * 
 * Although supported, transliteration is discouraged because
 *     1) most web browsers support UTF-8 characters in URLs
 *     2) transliteration causes a loss of information
 *
 * @author Sean Murphy <sean@iamseanmurphy.com>
 * @copyright Copyright 2012 Sean Murphy. All rights reserved.
 * @license http://creativecommons.org/publicdomain/zero/1.0/
 *
 * @param string $str
 * @param array $options
 * @return string
 */
function url_slug($str, $options = array()) {
	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	
	$defaults = array(
		'delimiter' => '-',
		'limit' => null,
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => true,
	);
	
	// Merge options
	$options = array_merge($defaults, $options);
	
	$char_map = array(
		// Latin
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
		'ß' => 'ss', 
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
		'ÿ' => 'y',
 
		// Latin symbols
		'©' => '(c)',
 
		// Greek
		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
		'Ϋ' => 'Y',
		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
 
		// Turkish
		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 
 
		// Russian
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
		'Я' => 'Ya',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya',
 
		// Ukrainian
		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
 
		// Czech
		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
		'Ž' => 'Z', 
		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
		'ž' => 'z', 
 
		// Polish
		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
		'Ż' => 'Z', 
		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
		'ż' => 'z',
 
		// Latvian
		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
		'š' => 's', 'ū' => 'u', 'ž' => 'z'
	);
	
	// Make custom replacements
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	
	// Transliterate characters to ASCII
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}
	
	// Replace non-alphanumeric characters with our delimiter
	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	
	// Remove duplicate delimiters
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	
	// Truncate slug to max. characters
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	
	// Remove delimiter from ends
	$str = trim($str, $options['delimiter']);
	
	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function file_get_contents_curl($url) 
{
    if(strpos($url,Yii::app()->params['uploadsPath']) !== false)
    {
        return file_get_contents($url);
    }
    
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

/**
 * Check whether url exists.
 * @param string $url
 * @return boolean
 */
function is_url_exists($url) 
{
    $handle = @fopen($url,'r');
    if($handle !== false)
       return true;
    else
       return false;
}

function getMimeType($filename) {
    // MIME types array
    $mimeTypes = array(
        "323"       => "text/h323",
        "acx"       => "application/internet-property-stream",
        "ai"        => "application/postscript",
        "aif"       => "audio/x-aiff",
        "aifc"      => "audio/x-aiff",
        "aiff"      => "audio/x-aiff",
        "asf"       => "video/x-ms-asf",
        "asr"       => "video/x-ms-asf",
        "asx"       => "video/x-ms-asf",
        "au"        => "audio/basic",
        "avi"       => "video/x-msvideo",
        "axs"       => "application/olescript",
        "bas"       => "text/plain",
        "bcpio"     => "application/x-bcpio",
        "bin"       => "application/octet-stream",
        "bmp"       => "image/bmp",
        "c"         => "text/plain",
        "cat"       => "application/vnd.ms-pkiseccat",
        "cdf"       => "application/x-cdf",
        "cer"       => "application/x-x509-ca-cert",
        "class"     => "application/octet-stream",
        "clp"       => "application/x-msclip",
        "cmx"       => "image/x-cmx",
        "cod"       => "image/cis-cod",
        "cpio"      => "application/x-cpio",
        "crd"       => "application/x-mscardfile",
        "crl"       => "application/pkix-crl",
        "crt"       => "application/x-x509-ca-cert",
        "csh"       => "application/x-csh",
        "css"       => "text/css",
        "dcr"       => "application/x-director",
        "der"       => "application/x-x509-ca-cert",
        "dir"       => "application/x-director",
        "dll"       => "application/x-msdownload",
        "dms"       => "application/octet-stream",
        "doc"       => "application/msword",
        "dot"       => "application/msword",
        "dvi"       => "application/x-dvi",
        "dxr"       => "application/x-director",
        "eps"       => "application/postscript",
        "etx"       => "text/x-setext",
        "evy"       => "application/envoy",
        "exe"       => "application/octet-stream",
        "fif"       => "application/fractals",
        "flr"       => "x-world/x-vrml",
        "gif"       => "image/gif",
        "png"       => "image/png",
        "gtar"      => "application/x-gtar",
        "gz"        => "application/x-gzip",
        "h"         => "text/plain",
        "hdf"       => "application/x-hdf",
        "hlp"       => "application/winhlp",
        "hqx"       => "application/mac-binhex40",
        "hta"       => "application/hta",
        "htc"       => "text/x-component",
        "htm"       => "text/html",
        "html"      => "text/html",
        "htt"       => "text/webviewhtml",
        "ico"       => "image/x-icon",
        "ief"       => "image/ief",
        "iii"       => "application/x-iphone",
        "ins"       => "application/x-internet-signup",
        "isp"       => "application/x-internet-signup",
        "jfif"      => "image/pipeg",
        "jpe"       => "image/jpeg",
        "jpeg"      => "image/jpeg",
        "jpg"       => "image/jpeg",
        "js"        => "application/x-javascript",
        "latex"     => "application/x-latex",
        "lha"       => "application/octet-stream",
        "lsf"       => "video/x-la-asf",
        "lsx"       => "video/x-la-asf",
        "lzh"       => "application/octet-stream",
        "m13"       => "application/x-msmediaview",
        "m14"       => "application/x-msmediaview",
        "m3u"       => "audio/x-mpegurl",
        "man"       => "application/x-troff-man",
        "mdb"       => "application/x-msaccess",
        "me"        => "application/x-troff-me",
        "mht"       => "message/rfc822",
        "mhtml"     => "message/rfc822",
        "mid"       => "audio/mid",
        "mny"       => "application/x-msmoney",
        "mov"       => "video/quicktime",
        "movie"     => "video/x-sgi-movie",
        "mp2"       => "video/mpeg",
        "mp3"       => "audio/mpeg",
        "mpa"       => "video/mpeg",
        "mpe"       => "video/mpeg",
        "mpeg"      => "video/mpeg",
        "mpg"       => "video/mpeg",
        "mpp"       => "application/vnd.ms-project",
        "mpv2"      => "video/mpeg",
        "ms"        => "application/x-troff-ms",
        "mvb"       => "application/x-msmediaview",
        "nws"       => "message/rfc822",
        "oda"       => "application/oda",
        "p10"       => "application/pkcs10",
        "p12"       => "application/x-pkcs12",
        "p7b"       => "application/x-pkcs7-certificates",
        "p7c"       => "application/x-pkcs7-mime",
        "p7m"       => "application/x-pkcs7-mime",
        "p7r"       => "application/x-pkcs7-certreqresp",
        "p7s"       => "application/x-pkcs7-signature",
        "pbm"       => "image/x-portable-bitmap",
        "pdf"       => "application/pdf",
        "pfx"       => "application/x-pkcs12",
        "pgm"       => "image/x-portable-graymap",
        "pko"       => "application/ynd.ms-pkipko",
        "pma"       => "application/x-perfmon",
        "pmc"       => "application/x-perfmon",
        "pml"       => "application/x-perfmon",
        "pmr"       => "application/x-perfmon",
        "pmw"       => "application/x-perfmon",
        "pnm"       => "image/x-portable-anymap",
        "pot"       => "application/vnd.ms-powerpoint",
        "ppm"       => "image/x-portable-pixmap",
        "pps"       => "application/vnd.ms-powerpoint",
        "ppt"       => "application/vnd.ms-powerpoint",
        "prf"       => "application/pics-rules",
        "ps"        => "application/postscript",
        "pub"       => "application/x-mspublisher",
        "qt"        => "video/quicktime",
        "ra"        => "audio/x-pn-realaudio",
        "ram"       => "audio/x-pn-realaudio",
        "ras"       => "image/x-cmu-raster",
        "rgb"       => "image/x-rgb",
        "rmi"       => "audio/mid",
        "roff"      => "application/x-troff",
        "rtf"       => "application/rtf",
        "rtx"       => "text/richtext",
        "scd"       => "application/x-msschedule",
        "sct"       => "text/scriptlet",
        "setpay"    => "application/set-payment-initiation",
        "setreg"    => "application/set-registration-initiation",
        "sh"        => "application/x-sh",
        "shar"      => "application/x-shar",
        "sit"       => "application/x-stuffit",
        "snd"       => "audio/basic",
        "spc"       => "application/x-pkcs7-certificates",
        "spl"       => "application/futuresplash",
        "src"       => "application/x-wais-source",
        "sst"       => "application/vnd.ms-pkicertstore",
        "stl"       => "application/vnd.ms-pkistl",
        "stm"       => "text/html",
        "svg"       => "image/svg+xml",
        "sv4cpio"   => "application/x-sv4cpio",
        "sv4crc"    => "application/x-sv4crc",
        "t"         => "application/x-troff",
        "tar"       => "application/x-tar",
        "tcl"       => "application/x-tcl",
        "tex"       => "application/x-tex",
        "texi"      => "application/x-texinfo",
        "texinfo"   => "application/x-texinfo",
        "tgz"       => "application/x-compressed",
        "tif"       => "image/tiff",
        "tiff"      => "image/tiff",
        "tr"        => "application/x-troff",
        "trm"       => "application/x-msterminal",
        "tsv"       => "text/tab-separated-values",
        "txt"       => "text/plain",
        "uls"       => "text/iuls",
        "ustar"     => "application/x-ustar",
        "vcf"       => "text/x-vcard",
        "vrml"      => "x-world/x-vrml",
        "wav"       => "audio/x-wav",
        "wcm"       => "application/vnd.ms-works",
        "wdb"       => "application/vnd.ms-works",
        "wks"       => "application/vnd.ms-works",
        "wmf"       => "application/x-msmetafile",
        "wps"       => "application/vnd.ms-works",
        "wri"       => "application/x-mswrite",
        "wrl"       => "x-world/x-vrml",
        "wrz"       => "x-world/x-vrml",
        "xaf"       => "x-world/x-vrml",
        "xbm"       => "image/x-xbitmap",
        "xla"       => "application/vnd.ms-excel",
        "xlc"       => "application/vnd.ms-excel",
        "xlm"       => "application/vnd.ms-excel",
        "xls"       => "application/vnd.ms-excel",
        "xlsx"      => "vnd.ms-excel",
        "xlt"       => "application/vnd.ms-excel",
        "xlw"       => "application/vnd.ms-excel",
        "xof"       => "x-world/x-vrml",
        "xpm"       => "image/x-xpixmap",
        "xwd"       => "image/x-xwindowdump",
        "z"         => "application/x-compress",
        "zip"       => "application/zip",
        "3dm"	=> "x-world/x-3dmf",
        "3dmf"	=> "x-world/x-3dmf",
        "a"	=> "application/octet-stream",
        "aab"	=> "application/x-authorware-bin",
        "aam"	=> "application/x-authorware-map",
        "aas"	=> "application/x-authorware-seg",
        "abc"	=> "text/vnd.abc",
        "acgi"	=> "text/html",
        "afl"	=> "video/animaflex",
        "ai"	=> "application/postscript",
        "aif"	=> "audio/aiff",
        "aif"	=> "audio/x-aiff",
        "aifc"	=> "audio/aiff",
        "aifc"	=> "audio/x-aiff",
        "aiff"	=> "audio/aiff",
        "aiff"	=> "audio/x-aiff",
        "aim"	=> "application/x-aim",
        "aip"	=> "text/x-audiosoft-intra",
        "ani"	=> "application/x-navi-animation",
        "aos"	=> "application/x-nokia-9000-communicator-add-on-software",
        "aps"	=> "application/mime",
        "arc"	=> "application/octet-stream",
        "arj"	=> "application/arj",
        "arj"	=> "application/octet-stream",
        "art"	=> "image/x-jg",
        "asf"	=> "video/x-ms-asf",
        "asm"	=> "text/x-asm",
        "asp"	=> "text/asp",
        "asx"	=> "application/x-mplayer2",
        "asx"	=> "video/x-ms-asf",
        "asx"	=> "video/x-ms-asf-plugin",
        "au"	=> "audio/basic",
        "au"	=> "audio/x-au",
        "avi"	=> "application/x-troff-msvideo",
        "avi"	=> "video/avi",
        "avi"	=> "video/msvideo",
        "avi"	=> "video/x-msvideo",
        "avs"	=> "video/avs-video",
        "bcpio"	=> "application/x-bcpio",
        "bin"	=> "application/mac-binary",
        "bin"	=> "application/macbinary",
        "bin"	=> "application/octet-stream",
        "bin"	=> "application/x-binary",
        "bin"	=> "application/x-macbinary",
        "bm"	=> "image/bmp",
        "bmp"	=> "image/bmp",
        "bmp"	=> "image/x-windows-bmp",
        "boo"	=> "application/book",
        "book"	=> "application/book",
        "boz"	=> "application/x-bzip2",
        "bsh"	=> "application/x-bsh",
        "bz"	=> "application/x-bzip",
        "bz2"	=> "application/x-bzip2",
        "c"	=> "text/plain",
        "c"	=> "text/x-c",
        "c++"	=> "text/plain",
        "cat"	=> "application/vnd.ms-pki.seccat",
        "cc"	=> "text/plain",
        "cc"	=> "text/x-c",
        "ccad"	=> "application/clariscad",
        "cco"	=> "application/x-cocoa",
        "cdf"	=> "application/cdf",
        "cdf"	=> "application/x-cdf",
        "cdf"	=> "application/x-netcdf",
        "cer"	=> "application/pkix-cert",
        "cer"	=> "application/x-x509-ca-cert",
        "cha"	=> "application/x-chat",
        "chat"	=> "application/x-chat",
        "class"	=> "application/java",
        "class"	=> "application/java-byte-code",
        "class"	=> "application/x-java-class",
        "com"	=> "application/octet-stream",
        "com"	=> "text/plain",
        "conf"	=> "text/plain",
        "cpio"	=> "application/x-cpio",
        "cpp"	=> "text/x-c",
        "cpt"	=> "application/mac-compactpro",
        "cpt"	=> "application/x-compactpro",
        "cpt"	=> "application/x-cpt",
        "crl"	=> "application/pkcs-crl",
        "crl"	=> "application/pkix-crl",
        "crt"	=> "application/pkix-cert",
        "crt"	=> "application/x-x509-ca-cert",
        "crt"	=> "application/x-x509-user-cert",
        "csh"	=> "application/x-csh",
        "csh"	=> "text/x-script.csh",
        "css"	=> "application/x-pointplus",
        "css"	=> "text/css",
        "cxx"	=> "text/plain",
        "dcr"	=> "application/x-director",
        "deepv"	=> "application/x-deepv",
        "def"	=> "text/plain",
        "der"	=> "application/x-x509-ca-cert",
        "dif"	=> "video/x-dv",
        "dir"	=> "application/x-director",
        "dl"	=> "video/dl",
        "dl"	=> "video/x-dl",
        "doc"	=> "application/msword",
        "dot"	=> "application/msword",
        "dp"	=> "application/commonground",
        "drw"	=> "application/drafting",
        "dump"	=> "application/octet-stream",
        "dv"	=> "video/x-dv",
        "dvi"	=> "application/x-dvi",
        "dwf"	=> "drawing/x-dwf (old)",
        "dwf"	=> "model/vnd.dwf",
        "dwg"	=> "application/acad",
        "dwg"	=> "image/vnd.dwg",
        "dwg"	=> "image/x-dwg",
        "dxf"	=> "application/dxf",
        "dxf"	=> "image/vnd.dwg",
        "dxf"	=> "image/x-dwg",
        "dxr"	=> "application/x-director",
        "el"	=> "text/x-script.elisp",
        "elc"	=> "application/x-bytecode.elisp (compiled elisp)",
        "elc"	=> "application/x-elc",
        "env"	=> "application/x-envoy",
        "eps"	=> "application/postscript",
        "es"	=> "application/x-esrehber",
        "etx"	=> "text/x-setext",
        "evy"	=> "application/envoy",
        "evy"	=> "application/x-envoy",
        "exe"	=> "application/octet-stream",
        "f"	=> "text/plain",
        "f"	=> "text/x-fortran",
        "f77"	=> "text/x-fortran",
        "f90"	=> "text/plain",
        "f90"	=> "text/x-fortran",
        "fdf"	=> "application/vnd.fdf",
        "fif"	=> "application/fractals",
        "fif"	=> "image/fif",
        "fli"	=> "video/fli",
        "fli"	=> "video/x-fli",
        "flo"	=> "image/florian",
        "flx"	=> "text/vnd.fmi.flexstor",
        "fmf"	=> "video/x-atomic3d-feature",
        "for"	=> "text/plain",
        "for"	=> "text/x-fortran",
        "fpx"	=> "image/vnd.fpx",
        "fpx"	=> "image/vnd.net-fpx",
        "frl"	=> "application/freeloader",
        "funk"	=> "audio/make",
        "g"	=> "text/plain",
        "g3"	=> "image/g3fax",
        "gif"	=> "image/gif",
        "gl"	=> "video/gl",
        "gl"	=> "video/x-gl",
        "gsd"	=> "audio/x-gsm",
        "gsm"	=> "audio/x-gsm",
        "gsp"	=> "application/x-gsp",
        "gss"	=> "application/x-gss",
        "gtar"	=> "application/x-gtar",
        "gz"	=> "application/x-compressed",
        "gz"	=> "application/x-gzip",
        "gzip"	=> "application/x-gzip",
        "gzip"	=> "multipart/x-gzip",
        "h"	=> "text/plain",
        "h"	=> "text/x-h",
        "hdf"	=> "application/x-hdf",
        "help"	=> "application/x-helpfile",
        "hgl"	=> "application/vnd.hp-hpgl",
        "hh"	=> "text/plain",
        "hh"	=> "text/x-h",
        "hlb"	=> "text/x-script",
        "hlp"	=> "application/hlp",
        "hlp"	=> "application/x-helpfile",
        "hlp"	=> "application/x-winhelp",
        "hpg"	=> "application/vnd.hp-hpgl",
        "hpgl"	=> "application/vnd.hp-hpgl",
        "hqx"	=> "application/binhex",
        "hqx"	=> "application/binhex4",
        "hqx"	=> "application/mac-binhex",
        "hqx"	=> "application/mac-binhex40",
        "hqx"	=> "application/x-binhex40",
        "hqx"	=> "application/x-mac-binhex40",
        "hta"	=> "application/hta",
        "htc"	=> "text/x-component",
        "htm"	=> "text/html",
        "html"	=> "text/html",
        "htmls"	=> "text/html",
        "htt"	=> "text/webviewhtml",
        "htx"	=> "text/html",
        "ice"	=> "x-conference/x-cooltalk",
        "ico"	=> "image/x-icon",
        "idc"	=> "text/plain",
        "ief"	=> "image/ief",
        "iefs"	=> "image/ief",
        "iges"	=> "application/iges",
        "iges"	=> "model/iges",
        "igs"	=> "application/iges",
        "igs"	=> "model/iges",
        "ima"	=> "application/x-ima",
        "imap"	=> "application/x-httpd-imap",
        "inf"	=> "application/inf",
        "ins"	=> "application/x-internett-signup",
        "ip"	=> "application/x-ip2",
        "isu"	=> "video/x-isvideo",
        "it"	=> "audio/it",
        "iv"	=> "application/x-inventor",
        "ivr"	=> "i-world/i-vrml",
        "ivy"	=> "application/x-livescreen",
        "jam"	=> "audio/x-jam",
        "jav"	=> "text/plain",
        "jav"	=> "text/x-java-source",
        "java"	=> "text/plain",
        "java"	=> "text/x-java-source",
        "jcm"	=> "application/x-java-commerce",
        "jfif"	=> "image/jpeg",
        "jfif"	=> "image/pjpeg",
        "jfif-tbnl"	=> "image/jpeg",
        "jpe"	=> "image/jpeg",
        "jpeg"	=> "image/jpeg",
        "jpg"	=> "image/jpeg",
        "jps"	=> "image/x-jps",
        "js"	=> "application/x-javascript",
        "js"	=> "application/javascript",
        "js"	=> "application/ecmascript",
        "js"	=> "text/javascript",
        "js"	=> "text/ecmascript",
        "jut"	=> "image/jutvision",
        "kar"	=> "audio/midi",
        "kar"	=> "music/x-karaoke",
        "ksh"	=> "application/x-ksh",
        "ksh"	=> "text/x-script.ksh",
        "la"	=> "audio/nspaudio",
        "la"	=> "audio/x-nspaudio",
        "lam"	=> "audio/x-liveaudio",
        "latex"	=> "application/x-latex",
        "lha"	=> "application/lha",
        "lha"	=> "application/octet-stream",
        "lha"	=> "application/x-lha",
        "lhx"	=> "application/octet-stream",
        "list"	=> "text/plain",
        "lma"	=> "audio/nspaudio",
        "lma"	=> "audio/x-nspaudio",
        "log"	=> "text/plain",
        "lsp"	=> "application/x-lisp",
        "lsp"	=> "text/x-script.lisp",
        "lst"	=> "text/plain",
        "lsx"	=> "text/x-la-asf",
        "ltx"	=> "application/x-latex",
        "lzh"	=> "application/octet-stream",
        "lzh"	=> "application/x-lzh",
        "lzx"	=> "application/lzx",
        "lzx"	=> "application/octet-stream",
        "lzx"	=> "application/x-lzx",
        "m"	=> "text/plain",
        "m"	=> "text/x-m",
        "m1v"	=> "video/mpeg",
        "m2a"	=> "audio/mpeg",
        "m2v"	=> "video/mpeg",
        "m3u"	=> "audio/x-mpequrl",
        "man"	=> "application/x-troff-man",
        "map"	=> "application/x-navimap",
        "mar"	=> "text/plain",
        "mbd"	=> "application/mbedlet",
        "mc$"	=> "application/x-magic-cap-package-1.0",
        "mcd"	=> "application/mcad",
        "mcd"	=> "application/x-mathcad",
        "mcf"	=> "image/vasa",
        "mcf"	=> "text/mcf",
        "mcp"	=> "application/netmc",
        "me"	=> "application/x-troff-me",
        "mht"	=> "message/rfc822",
        "mhtml"	=> "message/rfc822",
        "mid"	=> "application/x-midi",
        "mid"	=> "audio/midi",
        "mid"	=> "audio/x-mid",
        "mid"	=> "audio/x-midi",
        "mid"	=> "music/crescendo",
        "mid"	=> "x-music/x-midi",
        "midi"	=> "application/x-midi",
        "midi"	=> "audio/midi",
        "midi"	=> "audio/x-mid",
        "midi"	=> "audio/x-midi",
        "midi"	=> "music/crescendo",
        "midi"	=> "x-music/x-midi",
        "mif"	=> "application/x-frame",
        "mif"	=> "application/x-mif",
        "mime"	=> "message/rfc822",
        "mime"	=> "www/mime",
        "mjf"	=> "audio/x-vnd.audioexplosion.mjuicemediafile",
        "mjpg"	=> "video/x-motion-jpeg",
        "mm"	=> "application/base64",
        "mm"	=> "application/x-meme",
        "mme"	=> "application/base64",
        "mod"	=> "audio/mod",
        "mod"	=> "audio/x-mod",
        "moov"	=> "video/quicktime",
        "mov"	=> "video/quicktime",
        "movie"	=> "video/x-sgi-movie",
        "mp2"	=> "audio/mpeg",
        "mp2"	=> "audio/x-mpeg",
        "mp2"	=> "video/mpeg",
        "mp2"	=> "video/x-mpeg",
        "mp2"	=> "video/x-mpeq2a",
        "mp3"	=> "audio/mpeg3",
        "mp3"	=> "audio/x-mpeg-3",
        "mp3"	=> "video/mpeg",
        "mp3"	=> "video/x-mpeg",
        "mpa"	=> "audio/mpeg",
        "mpa"	=> "video/mpeg",
        "mpc"	=> "application/x-project",
        "mpe"	=> "video/mpeg",
        "mpeg"	=> "video/mpeg",
        "mpg"	=> "audio/mpeg",
        "mpg"	=> "video/mpeg",
        "mpga"	=> "audio/mpeg",
        "mpp"	=> "application/vnd.ms-project",
        "mpt"	=> "application/x-project",
        "mpv"	=> "application/x-project",
        "mpx"	=> "application/x-project",
        "mrc"	=> "application/marc",
        "ms"	=> "application/x-troff-ms",
        "mv"	=> "video/x-sgi-movie",
        "my"	=> "audio/make",
        "mzz"	=> "application/x-vnd.audioexplosion.mzz",
        "nap"	=> "image/naplps",
        "naplps"	=> "image/naplps",
        "nc"	=> "application/x-netcdf",
        "ncm"	=> "application/vnd.nokia.configuration-message",
        "nif"	=> "image/x-niff",
        "niff"	=> "image/x-niff",
        "nix"	=> "application/x-mix-transfer",
        "nsc"	=> "application/x-conference",
        "nvd"	=> "application/x-navidoc",
        "o"	=> "application/octet-stream",
        "oda"	=> "application/oda",
        "omc"	=> "application/x-omc",
        "omcd"	=> "application/x-omcdatamaker",
        "omcr"	=> "application/x-omcregerator",
        "p"	=> "text/x-pascal",
        "p10"	=> "application/pkcs10",
        "p10"	=> "application/x-pkcs10",
        "p12"	=> "application/pkcs-12",
        "p12"	=> "application/x-pkcs12",
        "p7a"	=> "application/x-pkcs7-signature",
        "p7c"	=> "application/pkcs7-mime",
        "p7c"	=> "application/x-pkcs7-mime",
        "p7m"	=> "application/pkcs7-mime",
        "p7m"	=> "application/x-pkcs7-mime",
        "p7r"	=> "application/x-pkcs7-certreqresp",
        "p7s"	=> "application/pkcs7-signature",
        "part"	=> "application/pro_eng",
        "pas"	=> "text/pascal",
        "pbm"	=> "image/x-portable-bitmap",
        "pcl"	=> "application/vnd.hp-pcl",
        "pcl"	=> "application/x-pcl",
        "pct"	=> "image/x-pict",
        "pcx"	=> "image/x-pcx",
        "pdb"	=> "chemical/x-pdb",
        "pdf"	=> "application/pdf",
        "pfunk"	=> "audio/make",
        "pfunk"	=> "audio/make.my.funk",
        "pgm"	=> "image/x-portable-graymap",
        "pgm"	=> "image/x-portable-greymap",
        "pic"	=> "image/pict",
        "pict"	=> "image/pict",
        "pkg"	=> "application/x-newton-compatible-pkg",
        "pko"	=> "application/vnd.ms-pki.pko",
        "pl"	=> "text/plain",
        "pl"	=> "text/x-script.perl",
        "plx"	=> "application/x-pixclscript",
        "pm"	=> "image/x-xpixmap",
        "pm"	=> "text/x-script.perl-module",
        "pm4"	=> "application/x-pagemaker",
        "pm5"	=> "application/x-pagemaker",
        "png"	=> "image/png",
        "pnm"	=> "application/x-portable-anymap",
        "pnm"	=> "image/x-portable-anymap",
        "pot"	=> "application/mspowerpoint",
        "pot"	=> "application/vnd.ms-powerpoint",
        "pov"	=> "model/x-pov",
        "ppa"	=> "application/vnd.ms-powerpoint",
        "ppm"	=> "image/x-portable-pixmap",
        "pps"	=> "application/mspowerpoint",
        "pps"	=> "application/vnd.ms-powerpoint",
        "ppt"	=> "application/mspowerpoint",
        "ppt"	=> "application/powerpoint",
        "ppt"	=> "application/vnd.ms-powerpoint",
        "ppt"	=> "application/x-mspowerpoint",
        "ppz"	=> "application/mspowerpoint",
        "pre"	=> "application/x-freelance",
        "prt"	=> "application/pro_eng",
        "ps"	=> "application/postscript",
        "psd"	=> "application/octet-stream",
        "pvu"	=> "paleovu/x-pv",
        "pwz"	=> "application/vnd.ms-powerpoint",
        "py"	=> "text/x-script.phyton",
        "pyc"	=> "application/x-bytecode.python",
        "qcp"	=> "audio/vnd.qcelp",
        "qd3"	=> "x-world/x-3dmf",
        "qd3d"	=> "x-world/x-3dmf",
        "qif"	=> "image/x-quicktime",
        "qt"	=> "video/quicktime",
        "qtc"	=> "video/x-qtc",
        "qti"	=> "image/x-quicktime",
        "qtif"	=> "image/x-quicktime",
        "ra"	=> "audio/x-pn-realaudio",
        "ra"	=> "audio/x-pn-realaudio-plugin",
        "ra"	=> "audio/x-realaudio",
        "ram"	=> "audio/x-pn-realaudio",
        "ras"	=> "application/x-cmu-raster",
        "ras"	=> "image/cmu-raster",
        "ras"	=> "image/x-cmu-raster",
        "rast"	=> "image/cmu-raster",
        "rexx"	=> "text/x-script.rexx",
        "rf"	=> "image/vnd.rn-realflash",
        "rgb"	=> "image/x-rgb",
        "rm"	=> "application/vnd.rn-realmedia",
        "rm"	=> "audio/x-pn-realaudio",
        "rmi"	=> "audio/mid",
        "rmm"	=> "audio/x-pn-realaudio",
        "rmp"	=> "audio/x-pn-realaudio",
        "rmp"	=> "audio/x-pn-realaudio-plugin",
        "rng"	=> "application/ringing-tones",
        "rng"	=> "application/vnd.nokia.ringing-tone",
        "rnx"	=> "application/vnd.rn-realplayer",
        "roff"	=> "application/x-troff",
        "rp"	=> "image/vnd.rn-realpix",
        "rpm"	=> "audio/x-pn-realaudio-plugin",
        "rt"	=> "text/richtext",
        "rt"	=> "text/vnd.rn-realtext",
        "rtf"	=> "application/rtf",
        "rtf"	=> "application/x-rtf",
        "rtf"	=> "text/richtext",
        "rtx"	=> "application/rtf",
        "rtx"	=> "text/richtext",
        "rv"	=> "video/vnd.rn-realvideo",
        "s"	=> "text/x-asm",
        "s3m"	=> "audio/s3m",
        "saveme"	=> "application/octet-stream",
        "sbk"	=> "application/x-tbook",
        "scm"	=> "application/x-lotusscreencam",
        "scm"	=> "text/x-script.guile",
        "scm"	=> "text/x-script.scheme",
        "scm"	=> "video/x-scm",
        "sdml"	=> "text/plain",
        "sdp"	=> "application/sdp",
        "sdp"	=> "application/x-sdp",
        "sdr"	=> "application/sounder",
        "sea"	=> "application/sea",
        "sea"	=> "application/x-sea",
        "set"	=> "application/set",
        "sgm"	=> "text/sgml",
        "sgm"	=> "text/x-sgml",
        "sgml"	=> "text/sgml",
        "sgml"	=> "text/x-sgml",
        "sh"	=> "application/x-bsh",
        "sh"	=> "application/x-sh",
        "sh"	=> "application/x-shar",
        "sh"	=> "text/x-script.sh",
        "shar"	=> "application/x-bsh",
        "shar"	=> "application/x-shar",
        "shtml"	=> "text/html",
        "shtml"	=> "text/x-server-parsed-html",
        "sid"	=> "audio/x-psid",
        "sit"	=> "application/x-sit",
        "sit"	=> "application/x-stuffit",
        "skd"	=> "application/x-koan",
        "skm"	=> "application/x-koan",
        "skp"	=> "application/x-koan",
        "skt"	=> "application/x-koan",
        "sl"	=> "application/x-seelogo",
        "smi"	=> "application/smil",
        "smil"	=> "application/smil",
        "snd"	=> "audio/basic",
        "snd"	=> "audio/x-adpcm",
        "sol"	=> "application/solids",
        "spc"	=> "application/x-pkcs7-certificates",
        "spc"	=> "text/x-speech",
        "spl"	=> "application/futuresplash",
        "spr"	=> "application/x-sprite",
        "sprite"	=> "application/x-sprite",
        "src"	=> "application/x-wais-source",
        "ssi"	=> "text/x-server-parsed-html",
        "ssm"	=> "application/streamingmedia",
        "sst"	=> "application/vnd.ms-pki.certstore",
        "step"	=> "application/step",
        "stl"	=> "application/sla",
        "stl"	=> "application/vnd.ms-pki.stl",
        "stl"	=> "application/x-navistyle",
        "stp"	=> "application/step",
        "sv4cpio"	=> "application/x-sv4cpio",
        "sv4crc"	=> "application/x-sv4crc",
        "svf"	=> "image/vnd.dwg",
        "svf"	=> "image/x-dwg",
        "svr"	=> "application/x-world",
        "svr"	=> "x-world/x-svr",
        "swf"	=> "application/x-shockwave-flash",
        "t"	=> "application/x-troff",
        "talk"	=> "text/x-speech",
        "tar"	=> "application/x-tar",
        "tbk"	=> "application/toolbook",
        "tbk"	=> "application/x-tbook",
        "tcl"	=> "application/x-tcl",
        "tcl"	=> "text/x-script.tcl",
        "tcsh"	=> "text/x-script.tcsh",
        "tex"	=> "application/x-tex",
        "texi"	=> "application/x-texinfo",
        "texinfo"	=> "application/x-texinfo",
        "text"	=> "application/plain",
        "text"	=> "text/plain",
        "tgz"	=> "application/gnutar",
        "tgz"	=> "application/x-compressed",
        "tif"	=> "image/tiff",
        "tif"	=> "image/x-tiff",
        "tiff"	=> "image/tiff",
        "tiff"	=> "image/x-tiff",
        "tr"	=> "application/x-troff",
        "tsi"	=> "audio/tsp-audio",
        "tsp"	=> "application/dsptype",
        "tsp"	=> "audio/tsplayer",
        "tsv"	=> "text/tab-separated-values",
        "turbot"	=> "image/florian",
        "txt"	=> "text/plain",
        "uil"	=> "text/x-uil",
        "uni"	=> "text/uri-list",
        "unis"	=> "text/uri-list",
        "unv"	=> "application/i-deas",
        "uri"	=> "text/uri-list",
        "uris"	=> "text/uri-list",
        "ustar"	=> "application/x-ustar",
        "ustar"	=> "multipart/x-ustar",
        "uu"	=> "application/octet-stream",
        "uu"	=> "text/x-uuencode",
        "uue"	=> "text/x-uuencode",
        "vcd"	=> "application/x-cdlink",
        "vcs"	=> "text/x-vcalendar",
        "vda"	=> "application/vda",
        "vdo"	=> "video/vdo",
        "vew"	=> "application/groupwise",
        "viv"	=> "video/vivo",
        "viv"	=> "video/vnd.vivo",
        "vivo"	=> "video/vivo",
        "vivo"	=> "video/vnd.vivo",
        "vmd"	=> "application/vocaltec-media-desc",
        "vmf"	=> "application/vocaltec-media-file",
        "voc"	=> "audio/voc",
        "voc"	=> "audio/x-voc",
        "vos"	=> "video/vosaic",
        "vox"	=> "audio/voxware",
        "vqe"	=> "audio/x-twinvq-plugin",
        "vqf"	=> "audio/x-twinvq",
        "vql"	=> "audio/x-twinvq-plugin",
        "vrml"	=> "application/x-vrml",
        "vrml"	=> "model/vrml",
        "vrml"	=> "x-world/x-vrml",
        "vrt"	=> "x-world/x-vrt",
        "vsd"	=> "application/x-visio",
        "vst"	=> "application/x-visio",
        "vsw"	=> "application/x-visio",
        "w60"	=> "application/wordperfect6.0",
        "w61"	=> "application/wordperfect6.1",
        "w6w"	=> "application/msword",
        "wav"	=> "audio/wav",
        "wav"	=> "audio/x-wav",
        "wb1"	=> "application/x-qpro",
        "wbmp"	=> "image/vnd.wap.wbmp",
        "web"	=> "application/vnd.xara",
        "wiz"	=> "application/msword",
        "wk1"	=> "application/x-123",
        "wmf"	=> "windows/metafile",
        "wml"	=> "text/vnd.wap.wml",
        "wmlc"	=> "application/vnd.wap.wmlc",
        "wmls"	=> "text/vnd.wap.wmlscript",
        "wmlsc"	=> "application/vnd.wap.wmlscriptc",
        "word"	=> "application/msword",
        "wp"	=> "application/wordperfect",
        "wp5"	=> "application/wordperfect",
        "wp5"	=> "application/wordperfect6.0",
        "wp6"	=> "application/wordperfect",
        "wpd"	=> "application/wordperfect",
        "wpd"	=> "application/x-wpwin",
        "wq1"	=> "application/x-lotus",
        "wri"	=> "application/mswrite",
        "wri"	=> "application/x-wri",
        "wrl"	=> "application/x-world",
        "wrl"	=> "model/vrml",
        "wrl"	=> "x-world/x-vrml",
        "wrz"	=> "model/vrml",
        "wrz"	=> "x-world/x-vrml",
        "wsc"	=> "text/scriplet",
        "wsrc"	=> "application/x-wais-source",
        "wtk"	=> "application/x-wintalk",
        "xbm"	=> "image/x-xbitmap",
        "xbm"	=> "image/x-xbm",
        "xbm"	=> "image/xbm",
        "xdr"	=> "video/x-amt-demorun",
        "xgz"	=> "xgl/drawing",
        "xif"	=> "image/vnd.xiff",
        "xl"	=> "application/excel",
        "xla"	=> "application/excel",
        "xla"	=> "application/x-excel",
        "xla"	=> "application/x-msexcel",
        "xlb"	=> "application/excel",
        "xlb"	=> "application/vnd.ms-excel",
        "xlb"	=> "application/x-excel",
        "xlc"	=> "application/excel",
        "xlc"	=> "application/vnd.ms-excel",
        "xlc"	=> "application/x-excel",
        "xld"	=> "application/excel",
        "xld"	=> "application/x-excel",
        "xlk"	=> "application/excel",
        "xlk"	=> "application/x-excel",
        "xll"	=> "application/excel",
        "xll"	=> "application/vnd.ms-excel",
        "xll"	=> "application/x-excel",
        "xlm"	=> "application/excel",
        "xlm"	=> "application/vnd.ms-excel",
        "xlm"	=> "application/x-excel",
        "xls"	=> "application/excel",
        "xls"	=> "application/vnd.ms-excel",
        "xls"	=> "application/x-excel",
        "xls"	=> "application/x-msexcel",
        "xlt"	=> "application/excel",
        "xlt"	=> "application/x-excel",
        "xlv"	=> "application/excel",
        "xlv"	=> "application/x-excel",
        "xlw"	=> "application/excel",
        "xlw"	=> "application/vnd.ms-excel",
        "xlw"	=> "application/x-excel",
        "xlw"	=> "application/x-msexcel",
        "xm"	=> "audio/xm",
        "xml"	=> "application/xml",
        "xml"	=> "text/xml",
        "xmz"	=> "xgl/movie",
        "xpix"	=> "application/x-vnd.ls-xpix",
        "xpm"	=> "image/x-xpixmap",
        "xpm"	=> "image/xpm",
        "x-png"	=> "image/png",
        "xsr"	=> "video/x-amt-showrun",
        "xwd"	=> "image/x-xwd",
        "xwd"	=> "image/x-xwindowdump",
        "xyz"	=> "chemical/x-pdb",
        "z"	=> "application/x-compress",
        "z"	=> "application/x-compressed",
        "zip"	=> "application/x-compressed",
        "zip"	=> "application/x-zip-compressed",
        "zip"	=> "application/zip",
        "zip"	=> "multipart/x-zip",
        "zoo"	=> "application/octet-stream",
        "zsh"	=> "text/x-script.zsh",
    );
    
    $filenameArr = explode('.', $filename);
    $extension = end($filenameArr);
    if(isset($mimeTypes[$extension]))
    return $mimeTypes[$extension]; // return the array value
    
    return '';
}
?>