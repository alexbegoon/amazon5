<?php

class OrderStatusesController extends Controller
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
                $orderStatusTranslations = new CActiveDataProvider('OrderStatusTranslations', array(
                    'criteria'=>array(
                        'condition'=>'status_code=:status_code',
                        'params'=>array(':status_code'=>$id)
                    ),
                ));
                
		$this->render('view',array(
			'model'=>$this->loadModel($id),
                        'orderStatusTranslations'=>$orderStatusTranslations,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new OrderStatuses;
                $orderStatusTranslations=new OrderStatusTranslations;

            // Uncomment the following line if AJAX validation is needed
             $this->performAjaxValidation(array($model,$orderStatusTranslations));

            if(isset($_POST['OrderStatuses'], 
                     $_POST['OrderStatusTranslations']
                    ))
            {
                // Start the transaction
                $transaction = Yii::app()->db->beginTransaction();
                $valid = true;

                $model->attributes=$_POST['OrderStatuses'];
                $orderStatusTranslations->attributes=$_POST['OrderStatusTranslations'];

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
                    $orderStatusTranslations->setAttribute('status_code', $model->status_code);
                }
                
                if($orderStatusTranslations->validate() 
                    && $valid )
                {
                    $orderStatusTranslations->save();
                }
                else
                {
                    $valid=FALSE;
                }

                // Product Successfully created 
                if($valid)
                {
                    $transaction->commit();
                    $this->redirect(array('view','id'=>$model->status_code));
                }
                else
                {
                    $transaction->rollback();
                }
            }

            $this->render('create',array(
                    'model'=>$model,
                    'orderStatusTranslations'=>$orderStatusTranslations,
            ));
	}
        
        public function actionCreateTranslation()
        {            
            $model= new OrderStatusTranslations;
            
            $model->setAttribute('status_code', Yii::app()->request->getParam('status_code'));
                
            // enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='status-code-translations-_translations-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            if(isset($_POST['OrderStatusTranslations']))
            {
                $model->attributes=$_POST['OrderStatusTranslations'];
                if($model->validate())
                {
                    $model->save();
                    $this->redirect(array('view','id'=>$model->status_code));
                }
            }
            $this->render('create_translations',array('model'=>$model));
        }
        
        public function actionUpdateTranslation()
        {            
            $model=OrderStatusTranslations::model()->findByPk($this->getActionParams());
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
                
            // enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='status-code-translations-_translations-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            

            if(isset($_POST['OrderStatusTranslations']))
            {
                $model->attributes=$_POST['OrderStatusTranslations'];
                if($model->validate())
                {
                    $model->save();
                    $this->redirect(array('view','id'=>$model->status_code));
                }
            }
            $this->render('update_translations',array('model'=>$model));
        }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                
                if((int)$model->locked_by===0 || (int)$model->locked_by===(int)Yii::app()->user->getId())
                $model->updateByPk($id,array(
                    'locked_by'=>Yii::app()->user->getId(),
                    'locked_on'=>date('Y-m-d H:i:s',time()),
                ));
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OrderStatuses']))
		{
			$model->attributes=$_POST['OrderStatuses'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->status_code));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        public function actionToggle($id)
        {
            $model=$this->loadModel($id);
            
            if($model!==null)
            {
                $model->attributes = $this->getActionParams();
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
            
            $this->redirect(array('view','id'=>$id));
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
		$dataProvider=new CActiveDataProvider('OrderStatuses');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new OrderStatuses('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OrderStatuses']))
			$model->attributes=$_GET['OrderStatuses'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OrderStatuses the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=OrderStatuses::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param OrderStatuses $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-statuses-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
