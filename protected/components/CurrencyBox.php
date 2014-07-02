<?php
/**
 * Description of CurrencyBox
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 */
class CurrencyBox extends CWidget
{
    public function run()
    {
        $currencyId=Currencies::getDefaultCurrency();
        
        if(Yii::app()->user->hasState('applicationCurrency'))
        {
            $currencyId = Yii::app()->user->getState('applicationCurrency');
        }
        
        $this->render('currencybox', array('currencyId' => $currencyId));
    }
}
