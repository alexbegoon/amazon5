<?php

class AjaxController extends Controller
{
	public function actionIndex()
	{
            // Simply dump AJAX request
		$this->render('index');
	}
        
        public function actionFindUser()
        {
            $phrase=Yii::app()->request->getParam('term');
            $criteria = new CDbCriteria();
            $criteria->compare('user.username',$phrase,true,'OR');
            $criteria->compare('user.email',$phrase,true,'OR');
            $criteria->compare('profile.lastname',$phrase,true,'OR');
            $criteria->compare('profile.firstname',$phrase,true,'OR');
            $criteria->with = array( 'profile' );
            $criteria->group = 'user.id';
            $criteria->together = true;
            $dataProvider = new CActiveDataProvider('User', array(
            'criteria'=>$criteria,
        	'pagination'=>array(
                    'pageSize'=>'10',
                ),
            ));
            $data=array();
            foreach ($dataProvider->getData() as $user)
            {
                $data[] = array(
                    'label'=>$user->getFullName() .' - <'.$user->email.'>',
                    'value'=>$user->id,
                );
            }
            
            $this->render('json',array('data'=>$data));
        }
        
        public function actionUpdateDeliveryStates()
        {
            $data='';
            $countryCode = isset($_POST['Profile']['delivery_country_code'])?
                           $_POST['Profile']['delivery_country_code']:null;
            
            $selected    = isset($_POST['Profile']['delivery_state_id'])?
                           $_POST['Profile']['delivery_state_id']:null;
            
            $data = States::listOptions($countryCode, $selected);
            
            $this->render('string',array('data'=>$data));
        }
}