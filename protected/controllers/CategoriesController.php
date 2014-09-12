<?php

class CategoriesController extends Controller
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
                $categoryTranslations = new CActiveDataProvider('CategoryTranslations', array(
                    'criteria'=>array(
                        'condition'=>'category_id=:category_id',
                        'params'=>array(':category_id'=>$id),
                    ),
                ));
                
                $categoryImages = new CActiveDataProvider('CategoryImages', array(
                    'criteria'=>array(
                        'condition'=>'category_id=:category_id',
                        'params'=>array(':category_id'=>$id),
                    ),
                ));
                
		$this->render('view',array(
			'model'=>$this->loadModel($id),
                        'categoryTranslations'=>$categoryTranslations,
                        'categoryImages'=>$categoryImages,
		));
	}
        
        public function actionCreateTranslation()
        {            
            $model= new CategoryTranslations;
            
            $model->setAttribute('category_id', Yii::app()->request->getParam('category_id'));
                
            // enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='category-translations-_translations-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            if(isset($_POST['CategoryTranslations']))
            {
                $model->attributes=$_POST['CategoryTranslations'];
                if($model->validate())
                {
                    $model->save();
                    $this->redirect(array('view','id'=>$model->category_id));
                }
            }
            $this->render('create_translations',array('model'=>$model));
        }
        
        public function actionUpdateTranslation()
        {            
            $model=CategoryTranslations::model()->findByPk($this->getActionParams());
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
                
            // enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='category-translations-_translations-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if(isset($_POST['CategoryTranslations']))
            {
                $model->attributes=$_POST['CategoryTranslations'];
                if($model->validate())
                {
                    $model->save();
                    $this->redirect(array('view','id'=>$model->category_id));
                }
            }
            $this->render('update_translations',array('model'=>$model));
        }
        
        public function actionCreateImage()
        {
            $model=new CategoryImages;
            
            $model->setAttribute('category_id', Yii::app()->request->getParam('category_id'));
            $category_name = Categories::model()->findByPk(Yii::app()->request->getParam('category_id'))->getName();
            
            //  enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='category-images-_images-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if(isset($_POST['CategoryImages']))
            {
                $model->attributes=$_POST['CategoryImages'];

                if(self::saveCategoryImage($model,$category_name))
                {
                    // form inputs are valid, do something here
                    $this->redirect(array('view','id'=>$model->category_id));
                }
            }
            $this->render('create_images',array('model'=>$model));
        }
        
        public function actionDeleteImage($id,$token)
        {
            if ($token !== Yii::app()->getRequest()->getCsrfToken())
                throw new CHttpException(400, Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
            $model=CategoryImages::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
                
            $model->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        
        public function actionMove($id)
        {
            $category=$this->loadModel($id);
            
            $categoryCategories=CategoryCategories::model()->findByPk(array('parent_id'=>Yii::app()->request->getParam('parent_id',0),
                                                                            'child_id'=>$category->id));
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='categories-move-form')
            {
                echo CActiveForm::validate($categoryCategories);
                Yii::app()->end();
            }
            
            if(isset($_POST['CategoryCategories']))
            {
                $categoryCategories->attributes = $_POST['CategoryCategories'];
                
                if($categoryCategories->save())
                {
                    $this->setSuccessMsg(Yii::t('common', 'Category "{category_name}" moved successfully',
                                                array('{category_name}'=>$category->getName())));
                    $this->redirect(array('index'));
                }
            }
            
            $this->render('move',array('categoryCategories'=>$categoryCategories,
                                       'model'=>$category));
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
        
        public function actionProducts($id)
        {
            $model=$this->loadModel($id);
            
            $products = new Products('search');
            $products->unsetAttributes();  // clear any default values
		if(isset($_GET['Products']))
			$products->attributes=$_GET['Products'];
                
            $products->parent_category_id = $model->id;
            
            $this->render('products',array(
                'model'=>$model,
                'products'=>$products,
            ));
        }
        
        public function actionAssignProduct($id)
        {
            $category=$this->loadModel($id);
            $productCategories=new ProductCategories;
            
            $productCategories->category_id=$id;
            
            if(isset($_POST['ProductCategories']))
            {
                if(preg_match('/-id::\d+$/', $_POST['ProductCategories']['product_id'], $matches)===1)
                {
                    $productCategories->product_id = (int)str_replace('-id::', '', $matches[0]);
                }
            }
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='assign_product-form')
            {
                CVarDumper::dump($productCategories,10,true);
                    echo CActiveForm::validate($productCategories);
                    Yii::app()->end();
            }
            
            if(isset($_POST['ProductCategories']))
            {
                if($productCategories->save())
                {
                    $this->setSuccessMsg(Yii::t('common','Product assigned successfully'));
                }
            }
            
            $this->render('assign_product',array(
                        'model'=>$category,
                        'productCategories'=>$productCategories,
            ));
        }
        
        public function actionRevokeProductFromCategory($id)
        {
            $category=$this->loadModel($id);
            
            $productCategories=ProductCategories::model()->findByPk(array('product_id'=>Yii::app()->request->getParam('product_id'),
                                                                          'category_id'=>$category->id ));
            
            if($productCategories!==null)
            {
                $productCategories->delete();
            }
            
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }

        public function actionRevokeAllProductsFromCategory($id,$token)
        {
            if ($token !== Yii::app()->getRequest()->getCsrfToken())
                throw new CHttpException(400, Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
            $category=$this->loadModel($id);
            
            $criteria = new CDbCriteria;
            $criteria->condition = 'category_id=:category_id';
            $criteria->params = array(':category_id'=>$category->id);
            
            $deletedRows = ProductCategories::model()->deleteAll($criteria);
            Yii::app()->setGlobalState('CategoryTreeVersion', date(DATE_W3C));
            $this->setSuccessMsg(Yii::t('common', 
                    '{n} entry successfully removed|{n} entries successfully removed',
                    array($deletedRows)));
                        
            $this->redirect(array('index'));
        }
        
        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Categories;
                $categoryImages = new CategoryImages;
                $categoryTranslations = new CategoryTranslations;
                $categoryCategories = new CategoryCategories;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation(array($model, $categoryImages, $categoryTranslations, $categoryCategories));

		if(isset($_POST['Categories'],
                         $_POST['CategoryImages'],
                         $_POST['CategoryTranslations'],
                         $_POST['CategoryCategories']
                        ))
		{
                    // Start the transaction
                    $transaction = Yii::app()->db->beginTransaction();
                    $valid = true;
                        
                    $model->attributes=$_POST['Categories'];
                    $categoryImages->attributes=$_POST['CategoryImages'];
                    $categoryTranslations->attributes=$_POST['CategoryTranslations'];
                    $categoryCategories->attributes=$_POST['CategoryCategories'];
                    
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
                        $categoryImages->setAttribute('category_id', $model->id);
                        $categoryTranslations->setAttribute('category_id', $model->id);
                        $categoryCategories->setAttribute('child_id', $model->id);
                    }
                    
                    if($categoryTranslations->validate() &&
                       $categoryCategories->validate() &&
                       self::saveCategoryImage($categoryImages, $categoryTranslations->category_name) && $valid 
                            )
                    {
                        $categoryTranslations->save();
                        $categoryCategories->save();
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
                        'categoryImages'=>$categoryImages,
                        'categoryTranslations'=>$categoryTranslations,
                        'categoryCategories'=>$categoryCategories
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

		if(isset($_POST['Categories']))
		{
			$model->attributes=$_POST['Categories'];
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
	public function actionDelete($id,$token)
	{
            if ($token !== Yii::app()->getRequest()->getCsrfToken())
                throw new CHttpException(400, Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
            $totalDeleted = 0;
            $this->loadModel($id);
            $childs = Categories::getChildsList($id);
            if(count($childs)>0)
            {
                foreach ($childs as $childCategory)
                {
                    if(Categories::model()->findByPk($childCategory['category_id'])->delete())
                    {
                        $totalDeleted++;
                    }
                }
            }
            
            if($this->loadModel($id)->delete())
            {
                $totalDeleted++;
                $this->setSuccessMsg (Yii::t ('common', 
                        '{n} entry successfully removed|{n} entries successfully removed',
                        array($totalDeleted)));
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
        
        public function actionRemoveAll($id,$token)
        {
            if ($token !== Yii::app()->getRequest()->getCsrfToken())
                throw new CHttpException(400, Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
            $webShop = WebShops::model()->findByPk($id);
            if($webShop===null)
                throw new CHttpException(404,'The requested page does not exist.');
            
            $criteria = new CDbCriteria;
            $criteria->condition = 'web_shop_id=:web_shop_id';
            $criteria->params = array(':web_shop_id'=>$webShop->id);
            
            $deletedRows=Categories::model()->deleteAll($criteria);
            
            Yii::app()->setGlobalState('CategoryTreeVersion', date(DATE_W3C));
            $this->setSuccessMsg(Yii::t('common', 
                    '{n} entry successfully removed|{n} entries successfully removed',
                    array($deletedRows)));
            
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Categories');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        
        public function actionCopyTree($id)
        {
            $webShop = WebShops::model()->findByPk($id);
            if($webShop===null)
                throw new CHttpException(404,'The requested page does not exist.');
            
            $this->render('copy_tree',array(
			'webShop'=>$webShop,
            ));
        }

        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Categories the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Categories::model()->findByPk($id);
		if($model===null)
                {
                    Yii::app()->setGlobalState('CategoryTreeVersion', date(DATE_W3C));
                    throw new CHttpException(404,'The requested page does not exist.');
                }
			
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Categories $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='categories-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        private static function saveCategoryImage($categoryImages, $categoryName)
        {
            // generate random string
            $rnd  = str_random(10);
            $rnd2 = str_random(10);  
            $categoryName = url_slug($categoryName,array('limit'=>20));
            $uploadedFile=CUploadedFile::getInstance($categoryImages,'image');

            if($uploadedFile)
            {
                $fileName = "{$categoryName}-{$rnd}.".$uploadedFile->getExtensionName();  // random number + file name
                $thumbFileName = "{$categoryName}-{$rnd2}-t.".$uploadedFile->getExtensionName();  // random number + file name
                $categoryImages->image = $fileName;
                $categoryImages->image_url = $fileName;
                $categoryImages->image_url_thumb = $thumbFileName;
                $imagePath=$categoryImages->imagespath.$fileName;
                $thumbImagePath=$categoryImages->imagespath.$thumbFileName;
            }

            if($categoryImages->validate())
            {
                $uploadedFile->saveAs($imagePath);
                $uploadedFile->saveAs($thumbImagePath);

                $image = Yii::app()->image->load($imagePath);
                $image->resize($categoryImages->thumb_width, $categoryImages->thumb_height)
                      ->quality($categoryImages->thumb_quality);
                $image->save($thumbImagePath);

                // check if file not exists
                if(!Yii::app()->file->set($imagePath)->isFile || 
                   !Yii::app()->file->set($thumbImagePath)->isFile )
                {
                    throw new CHttpException(500,'Can\'t store the product images');
                }
                
                if($categoryImages->save())
                return true;
            }
            
            return false;
        }
        
        public function actionCategoryTreeOptions()
        {
            if(isset($_POST['Categories']['web_shop_id']))
            echo Categories::model()->getCategoryTreeOptions(
                $_POST['Categories']['web_shop_id']
                    );
            Yii::app()->end();            
        }
}
