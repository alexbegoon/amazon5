<?php

class OrdersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
        /*
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
        */
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
        /* 
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        */
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        public function actionUpdateFields()
        {
            $order=array();
            $data=array();
            if(isset($_POST['Orders']))
            {
                $order=$_POST['Orders'];
            }
            
            if(empty($order))
                return;
            
            $pmId=null;
            if(isset($order['payment_method_id']))
                $pmId=$order['payment_method_id'];
                
            $data['Orders']['payment_method_id']=PaymentMethods::listOptions($order['web_shop_id'],$pmId);
            
            echo CJavaScript::jsonEncode($data);
            Yii::app()->end();
        }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Orders;
                $user=new User;
                $profile=new Profile;
                $orderItem=new OrderItems;
                $cart=Shop::getCart();
                $orderItems=$cart->getOrderItems();

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation(array($model,$user,$profile,$orderItem));
                 
		if(isset($_POST['Orders']))
		{
                    // Start the transaction
                    $transaction = Yii::app()->db->beginTransaction();
                    $valid = true;
                    $model->attributes=$_POST['Orders'];
                    // Register User if need
                    if(isset($_POST['User']) && $model->register_new_customer=='1')
                    {
                            $user->attributes=$_POST['User'];
                            $user->password=Yii::app()->getModule("user")->encrypting(microtime().$user->email);
                            $user->superuser=0;
                            $user->status=$user::STATUS_ACTIVE;
                            $user->activkey=Yii::app()->getModule("user")->encrypting(microtime().$user->password);
                            $profile->attributes=$_POST['Profile'];
                            $profile->user_id=0;
                            if($user->validate()&&$profile->validate()) {
                                    $user->password=Yii::app()->getModule("user")->encrypting(microtime().$user->email);
                                    if($user->save()) {
                                            $profile->user_id=$user->id;
                                            $profile->save();
                                    }
                                    $model->user_id=$user->id;
                                    $model->register_new_customer=0;
                            } else $profile->validate();
                    }
                    
                    $valid = $model->save();
                    if($valid)
                        $valid = $cart->unloadToOrder($model->id);
                    if($valid)
                        $valid = $cart->remove();
                    
                    // Order Successfully created 
                    if($valid)
                    {
                        $transaction->commit();
                        $this->redirect(array('view','id'=>$model->id));
                    }
                    else
                    {
                        $transaction->rollback();
                    }
		}

		$this->render('create',array(
			'model'=>$model,
			'user'=>$user,
			'profile'=>$profile,
                        'orderItems'=>$orderItems,
                        'orderItem'=>$orderItem,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                $user=User::model()->notsafe()->findbyPk($model->user_id);
                $profile=$user->profile;
                $orderItem=new OrderItems;
                $cart=Shop::getCart();
                $cart->restore($id);
                $orderItems=$cart->getOrderItems();
                
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation(array($model,$user,$profile));

		if(isset($_POST['Orders']))
		{
                    // Start the transaction
                    $transaction = Yii::app()->db->beginTransaction();
                    $valid = true;
                    $model->attributes=$_POST['Orders'];

                    // Register User if need
                    if(isset($_POST['User']) && $model->register_new_customer=='1')
                    {
                        $user=new User;
                        $profile=new Profile;
                        $user->attributes=$_POST['User'];
                        $user->password=Yii::app()->getModule("user")->encrypting(microtime().$user->email);
                        $user->superuser=0;
                        $user->status=$user::STATUS_ACTIVE;
                        $user->activkey=Yii::app()->getModule("user")->encrypting(microtime().$user->password);
                        $profile->attributes=$_POST['Profile'];
                        $profile->user_id=0;
                        if($user->validate()&&$profile->validate()) {
                                $user->password=Yii::app()->getModule("user")->encrypting(microtime().$user->email);
                                if($user->save()) {
                                        $profile->user_id=$user->id;
                                        $profile->save();
                                }
                                $model->user_id=$user->id;
                                $model->register_new_customer=0;
                        } else $profile->validate();
                    }

                    $valid = $model->save();
                    if($valid)
                        $valid = $cart->unloadToOrder($model->id);
                    if($valid)
                        $valid = $cart->remove();
                    
                    // Order Successfully created 
                    if($valid)
                    {
                        $transaction->commit();
                        $this->redirect(array('view','id'=>$model->id));
                    }
                    else
                    {
                        $transaction->rollback();
                    }
		}

		$this->render('update',array(
			'model'=>$model,
                        'user'=>$user,
			'profile'=>$profile,
                        'orderItem'=>$orderItem,
                        'orderItems'=>$orderItems,
		));
	}
        
        public function actionToggle($id)
        {
            $model=$this->loadModel($id);
            
            if($model!==null)
            {
                $modelName=get_class($model);                 
                if(isset($_POST[$modelName]))                 
                    $model->attributes = $_POST[$modelName];
                if($model->save())
                {
                    $this->setSuccessMsg(Yii::t('common', 'The request is successfully processed'));
                }
                else
                {
                    $this->setErrorMsg(Yii::t('common', 'The request was processed with errors'));
                    $this->setErrorMsg($model->getErrors());
                }
            }
        }

	/**
	 * Deletes Permanently a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionPermanentlyDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	/**
	 * Mark model as deleted. Not remove from DB.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=$this->loadModel($id);
                $model->deleted=1;
                $model->deleted_by=Yii::app()->user->getId();
                $model->deleted_on=date('Y-m-d H:i:s');
                
                if(!$model->validate(array('deleted','deleted_by','deleted_on')))
                {
                    $this->setWarningMsg($model->getErrors());
                }
                else
                {
                    if($model->saveAttributes(array('deleted','deleted_by','deleted_on')))
                    {
                        $this->setSuccessMsg(Yii::t('common', 
                                'Order with ID: {id}, successfully deleted.', 
                                array('{id}'=>$id)));
                    }
                    else
                    {
                        $this->setWarningMsg($model->getErrors());
                    }
                }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Orders',array(
                        'criteria'=>array(
                            'condition'=>'deleted=0',
                        ),
                        'pagination'=>array(
                            'pageSize'=>20,
                        ),
                ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Orders('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Orders']))
			$model->attributes=$_GET['Orders'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Orders the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Orders::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Orders $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='orders-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
