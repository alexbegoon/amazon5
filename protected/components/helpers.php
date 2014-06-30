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
