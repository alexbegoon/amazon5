<?php
/**
 * Description of LangBox
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 */
class LangBox extends CWidget
{
    public function run()
    {
        $currentLang='';
        
        if(Yii::app()->user->hasState('applicationLanguage'))
        {
            $currentLang = Yii::app()->user->getState('applicationLanguage');
        }
        
        $this->render('langBox', array('currentLang' => $currentLang));
    }
}