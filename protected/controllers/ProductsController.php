<?php

class ProductsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{       
                $productImages = new CActiveDataProvider('ProductImages', array(
                    'criteria'=>array(
                        'condition'=>'product_id='.$id
                    ),
                ));
                
                $productTranslations = new CActiveDataProvider('ProductTranslations', array(
                    'criteria'=>array(
                        'condition'=>'product_id='.$id
                    ),
                ));
                $productPrices = new CActiveDataProvider('ProductPrices', array(
                    'criteria'=>array(
                        'condition'=>'product_id='.$id
                    ),
                ));
                
		$this->render('view',array(
			'model'=>$this->loadModel($id),
                        'productImages'=>$productImages,
                        'productTranslations'=>$productTranslations,
                        'productPrices'=>$productPrices,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Products;
                $productTranslation=new ProductTranslations;
                $productManufaturers=new ProductManufacturers;
                $productPrices=new ProductPrices;
                $productImages=new ProductImages;
                
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation(array($model,$productTranslation,$productManufaturers,$productPrices,$productImages));

		if(isset($_POST['Products'], 
                         $_POST['ProductTranslations'], 
                         $_POST['ProductManufacturers'],
                         $_POST['ProductPrices'],
                         $_POST['ProductImages']
                        ))
		{
                    // Start the transaction
                    $transaction = Yii::app()->db->beginTransaction();
                    $valid = true;
                    
                    $model->attributes=$_POST['Products'];
                    $productTranslation->attributes=$_POST['ProductTranslations'];
                    $productManufaturers->attributes=$_POST['ProductManufacturers'];
                    $productPrices->attributes=$_POST['ProductPrices'];
                    $productImages->attributes=$_POST['ProductImages'];

                    if(!$model->save())
                    {
                        $transaction->rollback();
                        $valid=FALSE;
                    }
                    
                    if($valid)
                    {
                        $productTranslation->setAttribute('product_id', $model->id);
                        $productManufaturers->setAttribute('product_id', $model->id);
                        $productPrices->setAttribute('product_id', $model->id);
                        $productImages->setAttribute('product_id', $model->id);
                    }
                    
                    if(!$productTranslation->save())
                    {
                        $transaction->rollback();
                        $valid=FALSE;
                    }
                    
                    if(!$productManufaturers->save())
                    {
                        $transaction->rollback();
                        $valid=FALSE;
                    }
                    
                    if(!$productPrices->save())
                    {
                        $transaction->rollback();
                        $valid=FALSE;
                    }
                    
                    $rnd  = str_random(10);  // generate random string
                    $rnd2 = str_random(10);  // generate random string
                    $uploadedFile=CUploadedFile::getInstance($productImages,'image');
                    
                    if($uploadedFile)
                    {
                        $fileName = "{$model->product_sku}-{$rnd}.".$uploadedFile->getExtensionName();  // random number + file name
                        $thumbFileName = "{$model->product_sku}-{$rnd2}-t.".$uploadedFile->getExtensionName();  // random number + file name
                        $productImages->image = $fileName;
                        $productImages->image_url = $fileName;
                        $productImages->image_url_thumb = $thumbFileName;
                        $imagePath=Yii::app()->basePath."/../".$productImages->imagespath.$fileName;
                        $thumbImagePath=Yii::app()->basePath."/../".$productImages->imagespath.$thumbFileName;
                    }
                    
                    if($productImages->save())
                    {
                        $uploadedFile->saveAs($imagePath);
                        $uploadedFile->saveAs($thumbImagePath);
                        
                        $image = Yii::app()->image->load($imagePath);
                        $image->resize($productImages->thumb_width, $productImages->thumb_height)
                              ->quality($productImages->thumb_quality);
                        $image->save($thumbImagePath);
                                                
                        // check if file not exists
                        if(!Yii::app()->file->set($imagePath)->isFile || 
                           !Yii::app()->file->set($thumbImagePath)->isFile )
                        {
                            $transaction->rollback();
                            $valid=FALSE;
                            throw new CHttpException(500,'Can\'t store the product images');
                        }
                    }
                    else
                    {
                        $transaction->rollback();
                        $valid=FALSE;
                    }
                    
                    // Product Successfully created 
                    if($valid)
                    {
                        $transaction->commit();
                        $this->redirect(array('view','id'=>$model->id));
                    }
		}

		$this->render('create',array(
			'model'=>$model,
                        'productTranslation'=>$productTranslation,
                        'productManufaturers'=>$productManufaturers,
                        'productPrices'=>$productPrices,
                        'productImages'=>$productImages,
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
                
                if((int)$model->locked_by===0 || (int)$model->locked_by===(int)Yii::app()->user->getId())
                $model->updateByPk($id,array(
                    'locked_by'=>Yii::app()->user->getId(),
                    'locked_on'=>date('Y-m-d H:i:s',time()),
                ));
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Products']))
		{
			$model->attributes=$_POST['Products'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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
		$dataProvider=new CActiveDataProvider('Products');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Products('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Products']))
			$model->attributes=$_GET['Products'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Products the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Products::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Products $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='products-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionUpdateTranslation()
        {            
            $model=ProductTranslations::model()->findByPk($this->getActionParams());
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
                
            // enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='product-translations-_translations-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            

            if(isset($_POST['ProductTranslations']))
            {
                $model->attributes=$_POST['ProductTranslations'];
                if($model->validate())
                {
                    $model->save();
                    $this->redirect(array('view','id'=>$model->product_id));
                    return;
                }
            }
            $this->render('update_translations',array('model'=>$model));
        }
        
        public function actionCreateTranslation()
        {            
            $model= new ProductTranslations;
            
            $model->setAttribute('product_id', CHttpRequest::getParam('product_id'));
                
            // enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='product-translations-_translations-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            if(isset($_POST['ProductTranslations']))
            {
                $model->attributes=$_POST['ProductTranslations'];
                if($model->validate())
                {
                    $model->save();
                    $this->redirect(array('view','id'=>$model->product_id));
                    return;
                }
            }
            $this->render('create_translations',array('model'=>$model));
        }
}
