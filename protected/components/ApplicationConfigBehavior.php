<?php
/**
 * 
 * ApplicationConfigBehavior is a behavior for the application.
 * It loads additional config parameters that cannot be statically 
 * written in config/main
 *
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 */
class ApplicationConfigBehavior extends CBehavior
{
    /**
     * Declares events and the event handler methods
     * See yii documentation on behavior
     */
    public function events()
    {
        return array_merge(parent::events(), array(
            'onBeginRequest'=>'beginRequest',
        ));
    }
 
    /**
     * Load configuration that cannot be put in config/main
     */
    public function beginRequest()
    {
        if (isset($_POST['lang']))
        {
            $this->owner->user->setState('applicationLanguage', $_POST['lang']);
        }
        if ($this->owner->user->hasState('applicationLanguage'))
        {
            $this->owner->language=strtolower(substr($this->owner->user->getState('applicationLanguage'),0,2));
        } 
        else 
        {
            $this->owner->language='en';
        }
        
        if (isset($_POST['currencyId']))
        {
            $this->owner->user->setState('applicationCurrency', $_POST['currencyId']);
        }
    }
}
