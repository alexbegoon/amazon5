<?php

class PaymentMethodsController extends Controller
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
                $paymentMethodTranslations =new CActiveDataProvider('PaymentMethodTranslations', array(
                    'criteria'=>array(
                        'condition'=>'payment_method_id=:id',
                        'params'=>array(':id'=>$id)
                    ),
                ));
                
		$this->render('view',array(
			'model'=>$this->loadModel($id),
                        'paymentMethodTranslations'=>$paymentMethodTranslations,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            $model=new PaymentMethods;
            $paymentMethodTranslation=new PaymentMethodTranslations;
            $paypalParams=new PayPalParams;

            // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation(array($model,$paymentMethodTranslation,$paypalParams));

            if(isset($_POST['PaymentMethods'],
                     $_POST['PaymentMethodTranslations'],
                     $_POST['PayPalParams']))
            {
                // Start the transaction
                $transaction = Yii::app()->db->beginTransaction();
                $valid = true;

                $model->attributes=$_POST['PaymentMethods'];
                if(isset($_POST['PaymentMethods']['handler_component']))
                $model->parameters=serialize($_POST[$_POST['PaymentMethods']['handler_component'].'Params']);
                $paymentMethodTranslation->attributes=$_POST['PaymentMethodTranslations'];

                if($model->validate() && $valid)
                {
                    $model->save();
                }
                else
                {
                    $valid=FALSE;
                }

                if($valid)
                {
                    $paymentMethodTranslation->setAttribute('payment_method_id', $model->id);
                }

                if( $paymentMethodTranslation->validate() 
                    && $paypalParams->validate()
                    && $valid )
                {
                    $paymentMethodTranslation->save();
                }
                else
                {
                    $valid=FALSE;
                }
                // Method Successfully created 
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
                    'paymentMethodTranslation'=>$paymentMethodTranslation,
            ));
	}
        
        public function actionCreateTranslation()
        {            
            $model= new PaymentMethodTranslations;
            
            $model->setAttribute('payment_method_id', Yii::app()->request->getParam('payment_method_id'));
                
            // enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='payment-method-translations-_translations-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            if(isset($_POST['PaymentMethodTranslations']))
            {
                $model->attributes=$_POST['PaymentMethodTranslations'];
                if($model->validate())
                {
                    $model->save();
                    $this->redirect(array('view','id'=>$model->payment_method_id));
                }
            }
            $this->render('create_translations',array('model'=>$model));
        }
        
        public function actionUpdateTranslation()
        {            
            $model=PaymentMethodTranslations::model()->findByPk($this->getActionParams());
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
                
            // enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='payment-method-translations-_translations-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            

            if(isset($_POST['PaymentMethodTranslations']))
            {
                $model->attributes=$_POST['PaymentMethodTranslations'];
                if($model->validate())
                {
                    $model->save();
                    $this->redirect(array('view','id'=>$model->payment_method_id));
                }
            }
            $this->render('update_translations',array('model'=>$model));
        }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('PaymentMethods');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PaymentMethods('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PaymentMethods']))
			$model->attributes=$_GET['PaymentMethods'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PaymentMethods the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PaymentMethods::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PaymentMethods $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='payment-methods-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
