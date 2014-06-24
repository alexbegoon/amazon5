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
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Manufacturers;
                
                $manufacturerTranslations=new ManufacturerTranslations;
                
		 $this->performAjaxValidation($manufacturerTranslations);
		 $this->performAjaxValidation($model);

		if(isset($_POST['Manufacturers'],$_POST['ManufacturerTranslations']))
		{
                        // Start the transaction
                        $transaction = Yii::app()->db->beginTransaction();
                        
			$model->attributes=$_POST['Manufacturers'];
			$manufacturerTranslations->attributes=$_POST['ManufacturerTranslations'];
                        
                        if($model->save())
                        {
                            $manufacturerTranslations->setPrimaryKey(array(
                                'manufacturer_id'=>$model->primaryKey,
                                'language_code'=> $_POST['ManufacturerTranslations']['language_code'],                                
                                    ));
                            
                            if($manufacturerTranslations->save())
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
                        'manufacturerTranslations'=>$manufacturerTranslations
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
                $manufacturerTranslations=new ManufacturerTranslations;
                
                if((int)$model->locked_by===0 || (int)$model->locked_by===(int)Yii::app()->user->getId())
                $model->updateByPk($id,array(
                    'locked_by'=>Yii::app()->user->getId(),
                    'locked_on'=>date('Y-m-d H:i:s',time()),
                ));
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Manufacturers']))
		{
			$model->attributes=$_POST['Manufacturers'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
                        'manufacturerTranslations'=>$manufacturerTranslations,
		));
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
