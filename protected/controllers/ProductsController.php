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
            $productTranslations=new ProductTranslations;
            $productManufaturers=new ProductManufacturers;
            $productPrices=new ProductPrices;
            $productImages=new ProductImages;

            // Uncomment the following line if AJAX validation is needed
             $this->performAjaxValidation(array($model,$productTranslations,$productManufaturers,$productPrices,$productImages));

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
                $productTranslations->attributes=$_POST['ProductTranslations'];
                $productManufaturers->attributes=$_POST['ProductManufacturers'];
                $productPrices->attributes=$_POST['ProductPrices'];
                $productImages->attributes=$_POST['ProductImages'];

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
                    $productTranslations->setAttribute('product_id', $model->id);
                    $productManufaturers->setAttribute('product_id', $model->id);
                    $productPrices->setAttribute('product_id', $model->id);
                    $productImages->setAttribute('product_id', $model->id);
                }
                
                if($productManufaturers->validate() &&
                   $productTranslations->validate() &&
                   $productPrices->validate() && 
                   self::saveProductImage($productImages,$model->product_sku) && 
                   $valid )
                {
                    $productManufaturers->save();
                    $productTranslations->save();
                    $productPrices->save();
                }
                else
                {
                    $valid=FALSE;
                }

                // Product Successfully created 
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
                    'productTranslations'=>$productTranslations,
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
                }
            }
            $this->render('update_translations',array('model'=>$model));
        }
        
        public function actionCreateTranslation()
        {            
            $model= new ProductTranslations;
            
            $model->setAttribute('product_id', Yii::app()->request->getParam('product_id'));
                
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
                }
            }
            $this->render('create_translations',array('model'=>$model));
        }
        
        public function actionCreateImage()
        {
            $model=new ProductImages;
            
            $model->setAttribute('product_id', Yii::app()->request->getParam('product_id'));
            $sku = Products::getSKUbyPk(Yii::app()->request->getParam('product_id'));
            
            //  enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='product-images-_images-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if(isset($_POST['ProductImages']))
            {
                $model->attributes=$_POST['ProductImages'];

                if(self::saveProductImage($model,$sku))
                {
                    // form inputs are valid, do something here
                    $this->redirect(array('view','id'=>$model->product_id));
                }
            }
            $this->render('create_images',array('model'=>$model));
        }
        
        public function actionDeleteImage($id)
        {
            $model=ProductImages::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
                
            $model->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        
        public function actionUpdatePrice()
        {
            $model=ProductPrices::model()->findByPk($this->getActionParams());
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

            // enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='product-prices-_prices-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            

            if(isset($_POST['ProductPrices']))
            {
                $model->attributes=$_POST['ProductPrices'];
                if($model->validate())
                {
                    $model->save();
                    $this->redirect(array('view','id'=>$model->product_id));
                }
            }
            $this->render('update_prices',array('model'=>$model));
        }
        
        public function actionCreatePrice()
        {
            $model=new ProductPrices;
            
            $model->product_id=Yii::app()->request->getParam('product_id');
            // enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='product-prices-_prices-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            

            if(isset($_POST['ProductPrices']))
            {
                $model->attributes=$_POST['ProductPrices'];
                if($model->validate())
                {
                    $model->save();
                    $this->redirect(array('view','id'=>$model->product_id));
                }
            }
            $this->render('update_prices',array('model'=>$model));
        }
        
        public function actionBatchUploadImages()
        {
            $model=new ProductImages;
            
            if(isset($_POST['ProductImages']))
            {
                $model->attributes=$_POST['ProductImages'];
                
                $uploadedFile=CUploadedFile::getInstance($model,'image_archive');
                
                if($uploadedFile)
                {
                    $filePath = Yii::app()->params['uploadsPath'].'batch_product_images.zip';
                    $uploadedFile->saveAs($filePath);
                    $zip=new ZipArchive();
                    
                    if ($zip->open($filePath) === TRUE) 
                    { 
                        $zip->extractTo(Yii::app()->params['uploadsPath'].'batch_product_images');
                        
                        $images = CFileHelper::findFiles(Yii::app()->params['uploadsPath'].'batch_product_images');
                        
                        foreach($images as $uploadedImagePath) 
                        {                              
                            $contents = file_get_contents($uploadedImagePath);
                            
                            if(preg_match('/^[^_].*\.(bmp|jpeg|gif|png|jpg)$/i', basename($uploadedImagePath))===1)
                            {
                                $sku = file_ext_strip(basename($uploadedImagePath));
                            }
                            else 
                            {
                                continue;
                            }

                            $product = Products::findBySKU($sku);

                            if($product===null)
                            {
                                $this->setWarningMsg(Yii::t('common', 'Product with SKU: {sku} not found',array('{sku}'=>$sku)));
                                continue;
                            } 

                            $image=new ProductImages;

                            // generate random string
                            $rnd  = str_random(10);
                            $rnd2 = str_random(10); 

                            // random number + file name
                            $fileName = "{$sku}-{$rnd}.".file_ext(basename($uploadedImagePath));  
                            $thumbFileName = "{$sku}-{$rnd2}-t.".file_ext(basename($uploadedImagePath));
                            $image->product_id = $product->id;
                            $image->image = $fileName;
                            $image->image_url = $fileName;
                            $image->image_url_thumb = $thumbFileName;
                            $image->thumb_width = $model->thumb_width;
                            $image->thumb_height = $model->thumb_height;
                            $image->thumb_quality = $model->thumb_quality;
                            $imagePath=$model->imagespath.$fileName;
                            $thumbImagePath=$model->imagespath.$thumbFileName;
                            
                            if(!$image->save())
                            {
                                foreach ($image->getErrors() as $attr)
                                {
                                    foreach ($attr as $err)
                                    {
                                        $this->setWarningMsg(Yii::t('common', $err));
                                    }
                                }
                                
                                continue;
                            }
                            else
                            {                                                            
                                $сimage = Yii::app()->image->load($uploadedImagePath);
                                $сimage->resize($model->thumb_width, $model->thumb_height)
                                       ->quality($model->thumb_quality);
                                $сimage->save($thumbImagePath);
                                $сimage = Yii::app()->image->load($uploadedImagePath);                                
                                $сimage->save($imagePath);
                                
                                // check if file not exists
                                if(!Yii::app()->file->set($imagePath)->isFile || 
                                   !Yii::app()->file->set($thumbImagePath)->isFile )
                                {
                                    throw new CHttpException(500,'Can\'t store the product images');
                                }
                                
                                $this->setSuccessMsg(Yii::t('common', 'Product image for the product SKU: {sku}, successfully saved.', array('{sku}'=>$sku)));                                
                            }
                        }
                    } 
                    else 
                    { 
                        throw new CHttpException(500,'Error reading zip-archive!');
                    } 
                }   

                $model->validate(array('image_archive','thumb_width','thumb_height','thumb_quality'));
            }
                       
            $this->render('batch_upload_images',array('model'=>$model));
        }

        private static function saveProductImage($model,$sku)
        {
            // generate random string
            $rnd  = str_random(10);
            $rnd2 = str_random(10);  
            
            $uploadedFile=CUploadedFile::getInstance($model,'image');

            if($uploadedFile)
            {
                $fileName = "{$sku}-{$rnd}.".$uploadedFile->getExtensionName();  // random number + file name
                $thumbFileName = "{$sku}-{$rnd2}-t.".$uploadedFile->getExtensionName();  // random number + file name
                $model->image = $fileName;
                $model->image_url = $fileName;
                $model->image_url_thumb = $thumbFileName;
                $imagePath=$model->imagespath.$fileName;
                $thumbImagePath=$model->imagespath.$thumbFileName;
            }

            if($model->validate())
            {
                $uploadedFile->saveAs($imagePath);
                $uploadedFile->saveAs($thumbImagePath);

                $image = Yii::app()->image->load($imagePath);
                $image->resize($model->thumb_width, $model->thumb_height)
                      ->quality($model->thumb_quality);
                $image->save($thumbImagePath);

                // check if file not exists
                if(!Yii::app()->file->set($imagePath)->isFile || 
                   !Yii::app()->file->set($thumbImagePath)->isFile )
                {
                    throw new CHttpException(500,'Can\'t store the product images');
                }
                
                if($model->save())
                return true;
            }
            
            return false;
        }
}
