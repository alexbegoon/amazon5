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
        $attr=$attribute;
//        self::resolveName($model,$attr);
        preg_match('/\((.*)\)/',$model->tableSchema->columns[$attr]->dbType,$matches);
        foreach(explode(',', $matches[1]) as $value)
        {
                $value=str_replace("'",null,$value);
                $values[$value]=Yii::t('common', ucfirst(strtolower($value)));
        }

        return $values;
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