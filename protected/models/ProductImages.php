<?php

/**
 * This is the model class for table "{{product_images}}".
 *
 * The followings are the available columns in table '{{product_images}}':
 * @property string $id
 * @property string $product_id
 * @property string $image_url
 * @property string $image_url_thumb
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
        
        // Thumb defaults
        public $thumb_width = 150;
        public $thumb_height = 150;
        public $thumb_quality = 100;
        
        public $noImageFilename = 'noimage.png';


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
			array('product_id, image_url, image', 'required'),
			array('created_by, modified_by, locked_by, thumb_width, thumb_height, thumb_quality', 'numerical', 'integerOnly'=>true),
                        array('image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true),
			array('product_id', 'length', 'max'=>11),
			array('image_url, image_url_thumb', 'length', 'max'=>255),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_id, image_url, image_url_thumb, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'image_url' => Yii::t('common', 'Image Url'),
			'image_url_thumb' => Yii::t('common', 'Image Url Thumb'),
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
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('image_url_thumb',$this->image_url_thumb,true);
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
            return '/imgs/shop/';
        }
        
        public function getImagesUrl()
        {
            return Yii::app()->request->baseUrl.$this->getImagesPath();
        }
        
        public function getImageUrl()
        {
            if(empty($this->image_url))
                return $this->NoImageUrl;
                
            return $this->imagesUrl.$this->image_url;
        }
        
        public function getThumbImageUrl()
        {
            if(empty($this->image_url_thumb))
                return $this->NoImageUrl;
            
            return $this->imagesUrl.$this->image_url_thumb;
        }
        
        public function getNoImageUrl()
        {
            return $this->imagesUrl.$this->noImageFilename;
        }
        
        public function getImageTag()
        {
            return CHtml::image($this->ImageUrl,'img for product id '.$this->product_id);
        }
        
        public function getThumbImageTag()
        {
            return CHtml::image($this->ThumbImageUrl,'thumb img for product id '.$this->product_id);
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
}
