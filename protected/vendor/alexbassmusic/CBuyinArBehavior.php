<?php

/**
 * Description of CBuyinArBehavior
 * 
 * There is BuyIn AR logic.
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 * @version 0.1
 */
class CBuyinArBehavior extends CActiveRecordBehavior
{        
        public function beforeSave() 
        {
            if($this->getOwner()->hasAttribute('created_on') && 
               $this->getOwner()->hasAttribute('created_by') &&
               $this->getOwner()->hasAttribute('modified_on') && 
               $this->getOwner()->hasAttribute('modified_by') &&
               $this->getOwner()->hasAttribute('locked_by') && 
               $this->getOwner()->hasAttribute('locked_on'))
            {
                if ($this->getOwner()->getIsNewRecord())
                {
                    $this->getOwner()->created_on = new CDbExpression('NOW()');
                    $this->getOwner()->created_by = Yii::app()->user->getId();
                }

                $this->getOwner()->modified_on = new CDbExpression('NOW()');
                $this->getOwner()->modified_by = Yii::app()->user->getId();    

                $this->getOwner()->locked_by = 0;
                $this->getOwner()->locked_on = null;
            }
        }
        
        public function beforeValidate()
        {            
            if($this->getOwner()->hasAttribute('created_on') && 
               $this->getOwner()->hasAttribute('created_by') &&
               $this->getOwner()->hasAttribute('modified_on') && 
               $this->getOwner()->hasAttribute('modified_by') &&
               $this->getOwner()->hasAttribute('locked_by') && 
               $this->getOwner()->hasAttribute('locked_on'))
            {
                if((int)Yii::app()->user->getId() === (int)$this->getOwner()->locked_by)
                {                
                    return true;
                }

                if((int)$this->getOwner()->locked_by === 0 || $this->getOwner()->locked_on < date('Y-m-d H:i:s', time() - 3 * 60 * 60))
                {                
                    return true;
                }

                $username = Yii::app()->getModule('user')
                                          ->user($this->getOwner()->locked_by)
                                          ->profile
                                          ->getAttribute('firstname') 
                                                    ." ". Yii::app()
                                          ->getModule('user')
                                          ->user($this->getOwner()->locked_by)
                                          ->profile
                                          ->getAttribute('lastname');
                $this->getOwner()->addError('locked_by_user','You can not edit this. Record locked by '.$username.'.');
                return FALSE;
            }
        }
        
        public function beforeDelete() 
        {
            if($this->getOwner()->hasAttribute('created_on') && 
               $this->getOwner()->hasAttribute('created_by') &&
               $this->getOwner()->hasAttribute('modified_on') && 
               $this->getOwner()->hasAttribute('modified_by') &&
               $this->getOwner()->hasAttribute('locked_by') && 
               $this->getOwner()->hasAttribute('locked_on'))
            {
                if((int)$this->getOwner()->locked_by === (int)Yii::app()->user->getId())
                {
                    return true;
                }    

                if ((int)$this->getOwner()->locked_by !== 0)
                {
                    $username = Yii::app()->getModule('user')
                                          ->user($this->getOwner()->locked_by)
                                          ->profile
                                          ->getAttribute('firstname') 
                                                    ." ". Yii::app()
                                          ->getModule('user')
                                          ->user($this->getOwner()->locked_by)
                                          ->profile
                                          ->getAttribute('lastname');
                    $this->getOwner()->addError('locked_by_user','You can not delete this. Record locked by '.$username.'.');
                    return FALSE;
                }
            }
        }
}
