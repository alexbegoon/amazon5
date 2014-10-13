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
        
        public function actionFindProduct()
        {
            $phrase=Yii::app()->request->getParam('term');
            $criteria = new CDbCriteria();
            $criteria->compare('t.product_sku',$phrase,true,'OR');
            $criteria->compare('t.id',$phrase,false,'OR');
            $criteria->compare('productTranslation.product_name',$phrase,true,'OR');
            $criteria->with = array( 'productTranslation' );
            $criteria->group = 't.id';
            $criteria->together = true;
            $dataProvider = new CActiveDataProvider('Products', array(
            'criteria'=>$criteria,
        	'pagination'=>array(
                    'pageSize'=>'10',
                ),
            ));
            $data=array();
            foreach ($dataProvider->getData() as $product)
            {
                $data[] = array(
                    'label'=>$product->product_sku.' - '.$product->getName(),
                    'value'=>$product->id,
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
        
        public function actionGridCell()
        {
            if(!isset($_POST['var']))
                return;
            
            if(isset(Yii::app()->session['GridCell'.$_POST['var']]))
                $data=Yii::app()->session['GridCell'.$_POST['var']];
            
            $this->render('string',array('data'=>$data));
        }
        
        public function actionAddProductToCart()
        {
            $cart=Shop::getCart();

            if(isset($_POST['OrderItems'],$_POST['Orders']) && Yii::app()->request->isAjaxRequest)
            {
                $item=new OrderItems;
                $item->attributes=$_POST['OrderItems'];
                $item->currency_id=$_POST['Orders']['currency_id'];
                $item->order_id=0;
                
                if(!$item->validate())
                {
                    echo CActiveForm::validate($item);
                    Yii::app()->end();
                }
                
                $cart->addItem($item);
            }
        }
        
        public function actionRemoveItemFromCart()
        {
            $itemId=Yii::app()->request->getParam('itemId');
            if(Yii::app()->request->isAjaxRequest)
            {
                $cart=Shop::getCart();
                $cart->removeItem($itemId);
            }
        }
}