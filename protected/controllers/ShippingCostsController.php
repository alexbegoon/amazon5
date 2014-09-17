<?php

class ShippingCostsController extends Controller
{
        public $layout='//layouts/column2';
        
	public function actionIndex()
	{
            $dataProvider=new CActiveDataProvider('ShippingCosts');
            $this->render('index',array('dataProvider'=>$dataProvider));
	}

        public function actionCreate()
        {
            $model=new ShippingCosts;

            // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);

            if(isset($_POST['ShippingCosts']))
            {
                    $model->attributes=$_POST['ShippingCosts'];
                    if($model->save())
                            $this->redirect(array('view',$model->getPrimaryKey()));
            }

            $this->render('create',array(
                    'model'=>$model,
            ));
        }
        
        public function actionView()
        {            
            $this->render('view',array(
                    'model'=>$this->loadModel()
            ));
        }
        
        public function actionUpdate()
        {
            $model=$this->loadModel();
                
            if((int)$model->locked_by===0 || (int)$model->locked_by===(int)Yii::app()->user->getId())
            $model->updateByPk($model->getPrimaryKey(),array(
                'locked_by'=>Yii::app()->user->getId(),
                'locked_on'=>date('Y-m-d H:i:s',time()),
            ));

            // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);

            if(isset($_POST['ShippingCosts']))
            {
                    $model->attributes=$_POST['ShippingCosts'];
                    if($model->save())
                            $this->redirect(array('view',$model->getPrimaryKey()));
            }

            $this->render('update',array(
                    'model'=>$model,
            ));
        }

        public function actionAdmin()
        {
            $model=new ShippingCosts('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['ShippingCosts']))
                    $model->attributes=$_GET['ShippingCosts'];

            $this->render('admin',array(
                    'model'=>$model,
            ));
        }
        
        public function actionDelete()
	{
		$this->loadModel()->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

        public function loadModel()
	{
            $actionParams = $this->getActionParams();
            unset($actionParams['ajax']); // For AJAX calls uset this
            $model=ShippingCosts::model()->findByPk($actionParams);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
	}

                /**
	 * Performs the AJAX validation.
	 * @param ShippingMethods $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='shipping-costs-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}