<?php

class ManufacturersController extends Controller
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
                        'dataProvider'=>new CActiveDataProvider('ManufacturerTranslations',array(
                                'criteria'=>array(
                                    'condition'=>'manufacturer_id=:id',
                                    'params'=>array(':id'=>$id),
                                ),
                            )),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Manufacturers;
                
                $modelTranslation=new ManufacturerTranslations;
                
                $this->performAjaxValidation(array($model, $modelTranslation));
		 
		if(isset($_POST['Manufacturers'],$_POST['ManufacturerTranslations']))
		{
                        // Start the transaction
                        $transaction = Yii::app()->db->beginTransaction();
                        
			$model->attributes=$_POST['Manufacturers'];
			$modelTranslation->attributes=$_POST['ManufacturerTranslations'];
                        
                        if($model->save())
                        {
                            $modelTranslation->setPrimaryKey(array(
                                'manufacturer_id'=>$model->primaryKey,
                                'language_code'=> $_POST['ManufacturerTranslations']['language_code'],                                
                                    ));
                            
                            if($modelTranslation->save())
                            {
                                $transaction->commit();
                                $this->redirect(array('view','id'=>$model->id));
                            }
                            else
                            {
                                $transaction->rollback();
                            }
                        }
                        else 
                        {
                            $transaction->rollback();
                        }                        
		}

		$this->render('create',array(
			'model'=>$model,
                        'modelTranslation'=>$modelTranslation
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
                
                $this->performAjaxValidation(array($model));	 

		if(isset($_POST['Manufacturers']))
		{
                    $model->attributes=$_POST['Manufacturers'];

                    if($model->save())
                        $this->redirect(array('view','id'=>$model->id));
                }
                                
		$this->render('update',array(
			'model'=>$model
                        ));
	}
        
        public function actionCreateTranslation()
        {            
            $model= new ManufacturerTranslations;
            
            $model->setAttribute('manufacturer_id', Yii::app()->request->getParam('manufacturer_id'));
                
            // enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='manufacturer-translations-_translations-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            if(isset($_POST['ManufacturerTranslations']))
            {
                $model->attributes=$_POST['ManufacturerTranslations'];
                if($model->validate())
                {
                    $model->save();
                    $this->redirect(array('view','id'=>$model->manufacturer_id));
                }
            }
            $this->render('create_translations',array('model'=>$model));
        }
        
        public function actionUpdateTranslation()
	{
            $model=ManufacturerTranslations::model()->findByPk($this->getActionParams());
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
                
            // enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='manufacturer-translations-_translations-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if(isset($_POST['ManufacturerTranslations']))
            {
                $model->attributes=$_POST['ManufacturerTranslations'];
                if($model->validate())
                {
                    $model->save();
                    $this->redirect(array('view','id'=>$model->manufacturer_id));
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
		$dataProvider=new CActiveDataProvider('Manufacturers');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Manufacturers('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Manufacturers']))
			$model->attributes=$_GET['Manufacturers'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionToggle($id)
        {
            $model=Manufacturers::model()->findByPk($id);
            
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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Manufacturers the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Manufacturers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Manufacturers $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='manufacturers-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
