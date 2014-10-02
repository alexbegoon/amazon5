<?php

/**
 * This is the model class for table "{{product_images}}".
 *
 * The followings are the available columns in table '{{product_images}}':
 * @property string $id
 * @property string $product_id
 * @property string $image_name
 * @property string $image_url Alternative way to upload an Image
 * @property string $image_name_thumb
 * @property integer $width
 * @property integer $height
 * @property integer $thumb_width
 * @property integer $thumb_height
 * @property integer $size
 * @property integer $thumb_size
 * @property string $extension
 * @property string $thumb_extension
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 * 
 * @property int $thumb_width Default thumb image width
 * @property int $thumb_height Default thumb image height
 * @property int $thumb_quality Default thumb image quality
 *
 * The followings are the available model relations:
 * @property Products $product
 */
class ProductImages extends CActiveRecord
{               
        public $image;
        public $image_archive;
        public $image_url;
        
        private $_image_path;
        private $_thumb_image_path;


        public $thumb_width;
        public $thumb_height;
        public $thumb_quality;
        
        public function init()
        {
            $this->thumb_width = Yii::app()->params['defaultThumbWidth'];
            $this->thumb_height = Yii::app()->params['defaultThumbHeight'];
            $this->thumb_quality = Yii::app()->params['defaultThumbQuality'];
        }

        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{product_images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, image_name, image_name_thumb, image, width, height, thumb_width, thumb_height, size, thumb_size', 'required'),
			array('created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('width, height, thumb_width, thumb_height, size, thumb_size, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),			
                        array('thumb_width, thumb_height, thumb_quality','numerical','min'=>5),
                        array('image', 'file','types'=>'jpg, gif, png'),
                        array('image_archive', 'file','types'=>'zip', 'allowEmpty'=>true),
			array('product_id', 'length', 'max'=>11),
			array('image_name, image_name_thumb', 'length', 'max'=>255),
			array('image_url', 'url'),
			array('image_url', 'length', 'max'=>255),
                        array('extension, thumb_extension', 'length', 'max'=>12),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_id, image_name, width, height, thumb_width, thumb_height, size, thumb_size, extension, thumb_extension, image_name_thumb, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'product' => array(self::BELONGS_TO, 'Products', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'ID'),
			'product_id' => Yii::t('common', 'Product'),
			'image' => Yii::t('common', 'Product Image'),
			'image_url' => Yii::t('common', 'Image URL'),
			'image_archive' => Yii::t('common', 'Image archive (.zip)'),
			'image_name' => Yii::t('common', 'Image Name'),
                        'width' => Yii::t('common', 'Width'),
			'height' => Yii::t('common', 'Height'),
			'size' => Yii::t('common', 'Image Size'),
			'thumb_size' => Yii::t('common', 'Thumb Image Size'),
                        'extension' => Yii::t('common', 'File Extension'),                        
			'thumb_extension' => Yii::t('common', 'Thumb Extension'),
			'thumb_width' => Yii::t('common', 'Thumb Width'),
			'thumb_height' => Yii::t('common', 'Thumb Height'),
			'thumb_quality' => Yii::t('common', 'Thumb Quality'),
			'image_name_thumb' => Yii::t('common', 'Thumb Image Name'),
			'created_on' => Yii::t('common', 'Created On'),
			'created_by' => Yii::t('common', 'Created By'),
			'modified_on' => Yii::t('common', 'Modified On'),
			'modified_by' => Yii::t('common', 'Modified By'),
			'locked_on' => Yii::t('common', 'Locked On'),
			'locked_by' => Yii::t('common', 'Locked By'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('image_name',$this->image_name,true);
		$criteria->compare('image_name_thumb',$this->image_name_thumb,true);
                $criteria->compare('width',$this->width);
		$criteria->compare('height',$this->height);
		$criteria->compare('thumb_width',$this->thumb_width);
		$criteria->compare('thumb_height',$this->thumb_height);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified_on',$this->modified_on,true);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('locked_on',$this->locked_on,true);
		$criteria->compare('locked_by',$this->locked_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductImages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function behaviors()
        {
          return array( 'CBuyinArBehavior' => array(
                'class' => 'application.vendor.alexbassmusic.CBuyinArBehavior', 
              ));
        }
        
        public function getImagesPath()
        {
            return Yii::app()->params['shopImagesPath'];
        }

        public function getNoImageFilename()
        {
            return Yii::app()->params['noImageFilename'];
        }

        public function getImagesURLPrefix()
        {
            return Yii::app()->params['shopImagesURL'];
        }
        
        public function getImagesURL()
        {
            return Yii::app()->request->baseURL.$this->getImagesURLPrefix();
        }
        
        public function getImageURL()
        {
            if(empty($this->image_name))
                return $this->NoImageURL;
                
            return $this->imagesURL.$this->image_name;
        }
        
        public function getThumbImageURL()
        {
            if(empty($this->image_name_thumb))
                return $this->NoImageURL;
            
            return $this->imagesURL.$this->image_name_thumb;
        }
        
        public function getNoImageURL()
        {
            return $this->imagesURL.$this->noImageFilename;
        }
        
        public function getImageTag()
        {
            return CHtml::image($this->ImageURL,'image for product id '.$this->product_id);
        }
        
        public function getImagePath()
        {
            return $this->imagesPath.$this->image_name;
        }
        
        public function getImageThumbPath()
        {
            return $this->imagesPath.$this->image_name_thumb;
        }

        public function getThumbImageTag()
        {
            return CHtml::image($this->ThumbImageURL,'thumb image for product id '.$this->product_id);
        }
        
        public static function listQualities()
        {
            return array(
                100=>'100 %',
                98=>'98 %',
                95=>'95 %',
                90=>'90 %',
                85=>'85 %',
                80=>'80 %',
                75=>'75 %',
                70=>'70 %',
                65=>'65 %',
                60=>'60 %',
                50=>'50 %',
                40=>'40 %',
                30=>'30 %',
                20=>'20 %',
                10=>'10 %',
           );
        }
        
        /**
         * Try to update product images from old virtuemart.
         * @deprecated since version 0 This is not joke. We can use it only once.
         * @return boolean
         */
        public static function updateImagesFromVirtuemart()
        {
            $imgsPath='http://www.cosmetiquesonline.net/components/com_virtuemart/shop_image/product/';
            $dsn='mysql:host=87.106.216.120:3306;dbname=cosmetiques';
            $username='cosmetiques';
            $password='base1985';
            $tablePrefix='jos_';
            $skuPrefix='#';
            
            // Connect to remote DB
            $connection=new CDbConnection($dsn,$username,$password);
            $connection->tablePrefix=$tablePrefix;
            // establish connection. You may try...catch possible exceptions
            $connection->active=true;
            
            $sql='SELECT product_sku, product_full_image FROM {{vm_product}}';
            $command=$connection->createCommand($sql);
            $data=array();
            foreach($command->queryAll() as $row)
            {
                $data[$row['product_sku']]=$row['product_full_image'];
            }
            
            // Get products without images
            $criteria=new CDbCriteria;
            $criteria->condition='productImages.id IS NULL';
            $criteria->group='t.id';
            $criteria->together=true;
            $models=Products::model()->with('productImages')->findAll($criteria);
            foreach ($models as $model)
            {
                if(!isset($data[$skuPrefix.$model->product_sku]))
                    continue;
                
                $imageUrl=$imgsPath.$data[$skuPrefix.$model->product_sku];
                
                $productImage=new ProductImages;
                $productImage->product_id=$model->id;
                $productImage->image_url=$imageUrl;
                
                CVarDumper::dump($productImage,10,true);die;
                $productImage->save();
            }
            
            $connection->active=false;  // close connection
            Yii::app()->end();
            return true;
        }
        
        /**
         * This method try to put image from provider's DB.
         * If product have no images, than system will try to get image from Provider DB.
         * @return boolean
         */
        public static function updateImagesFromProviders()
        {
            $criteria=new CDbCriteria;
            $criteria->condition='productImages.id IS NULL AND (providerProducts.provider_image_url<>\'\')';
            $criteria->group='t.id';
            $criteria->together=true;
            $models=Products::model()->with('providerProducts','productImages')->findAll($criteria);
            foreach ($models as $model)
            {
                $productImage = new ProductImages;
                $productImage->product_id=$model->id;
                $productImage->image_url=$model->providerProducts[0]->provider_image_url;
                if(!$productImage->save())
                {
                    $providerProduct=ProviderProducts::model()->findByPk($model->providerProducts[0]->getPrimaryKey());
                    $providerProduct->provider_image_url=null;
                    $providerProduct->save();
                }
            }
            
            return true;
        }

        public function getPopUpImage()
        {        
            return  CHtml::link($this->thumbImageTag, $this->imageURL, array('class' => 'fancybox-image'));
        }
                
        public function beforeValidate() 
        {   
            // generate random string
            $rnd  = str_random(10);
            $rnd2 = str_random(10); 
            $prefix = url_slug(Products::getSKUbyPk($this->product_id),array('limit'=>20)) or $this->product_id;
            
            if(empty($prefix))
                return false;
            
            if(!empty($this->image_url))
            {
                if(is_url_exists($this->image_url))
                {
                    $_FILES[__CLASS__]['name']['image'] = basename($this->image_url);
                    $_FILES[__CLASS__]['type']['image'] = getMimeType($_FILES[__CLASS__]['name']['image']);
                    $filename = tempnam(sys_get_temp_dir(),__CLASS__);
                    $handle = fopen($filename,'w');
                    $_FILES[__CLASS__]['size']['image'] = fwrite($handle, file_get_contents($this->image_url));
                    $_FILES[__CLASS__]['tmp_name']['image'] = $filename;
                    $_FILES[__CLASS__]['error']['image'] = 0;
                }
                else 
                {
                    if(isset($handle))
                        fclose($handle);                    
                    $this->addError('image_url', Yii::t('common', 
                            'Check <a href="{url}" target="_blank">this URL</a> please.', 
                            array('{url}'=>$this->image_url)));
                    return false;
                }
            }
            // Saves the name, size, type and data of the uploaded file
            if($file=CUploadedFile::getInstance($this,'image'))
            {
                $this->image_name = "{$prefix}-{$rnd}.".$file->extensionName;  // random number + file name
                $this->image_name_thumb = "{$prefix}-{$rnd2}-t.".$file->extensionName;  // random number + file name
                $this->extension = $file->extensionName;
                $this->thumb_extension = $file->extensionName;
                $this->size = $file->size;
                if(Yii::app()->file->set($file->tempName)->isFile)
                    $this->image=file_get_contents($file->tempName);
                else
                    $this->image=file_get_contents($this->image_name);
                
                $this->_image_path       =$this->imagespath.$this->image_name;
                $this->_thumb_image_path =$this->imagespath.$this->image_name_thumb;                
                if(!$file->saveAs($this->_image_path,false))
                    copy($file->tempName,$this->_image_path); 
                if(!$file->saveAs($this->_thumb_image_path,false))
                    copy($file->tempName,$this->_thumb_image_path);
                // check if file not exists
                if(!Yii::app()->file->set($this->_image_path)->isFile || 
                   !Yii::app()->file->set($this->_thumb_image_path)->isFile )
                {
                    $this->addError('image', Yii::t('common', 'Can\'t store the product images'));
                    $this->removeFiles();
                    return false;
                }
                if(!getimagesize($this->_image_path))
                {
                    $this->addError('image', Yii::t('common', 'File `{filename}` is not an image',array('{filename}'=>$file->name)));
                    $this->removeFiles();
                    return false;
                }
                list($this->width, $this->height) = getimagesize($this->_image_path);
                $image = Yii::app()->image->load($this->_image_path);
                $image->resize($this->thumb_width, $this->thumb_height)
                      ->quality($this->thumb_quality);
                $image->save($this->_thumb_image_path);
                list($this->thumb_width, $this->thumb_height) = getimagesize($this->_thumb_image_path);
                $this->thumb_size=filesize($this->_thumb_image_path);
                $file->reset();
            }
            else 
            {
                $this->addError('image', Yii::t('yii','{attribute} cannot be blank.',
                        array('{attribute}'=>$this->attributeLabels()['image'])));
                return false;
            }
            
            if(isset($handle))
                fclose($handle);
            
            return parent::beforeValidate();
        }
        
        public function beforeDelete() 
        {
            if(Yii::app()->file->set($this->imagePath)->isFile)
                unlink ($this->imagePath);
            if(Yii::app()->file->set($this->imageThumbPath)->isFile)
                unlink ($this->imageThumbPath);
            
            return parent::beforeDelete();
        }

        /**
         * If something went wrong, you can remove files of images saved.
         * May be it is not images, or not files :)
         */
        private function removeFiles()
        {
            if(Yii::app()->file->set($this->_image_path)->isFile)
                unlink ($this->_image_path);
            if(Yii::app()->file->set($this->_thumb_image_path)->isFile)
                unlink ($this->_thumb_image_path);
        }
}
