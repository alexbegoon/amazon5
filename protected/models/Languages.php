<?php

/**
 * This is the model class for table "{{languages}}".
 *
 * The followings are the available columns in table '{{languages}}':
 * @property string $lang_code
 * @property string $title
 * @property string $title_native
 * @property string $sef
 * @property string $image_url
 * @property string $image_url_thumb
 * @property integer $published
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property Categories[] $amzni5Categories
 * @property Content[] $contents
 * @property ContentCategories[] $contentCategories
 * @property Manufacturers[] $amzni5Manufacturers
 * @property Menu[] $menus
 * @property PaymentMethods[] $amzni5PaymentMethods
 * @property Products[] $amzni5Products
 * @property ShippingMethods[] $amzni5ShippingMethods
 * @property WebShops[] $webShops
 */
class Languages extends CActiveRecord
{
        public $language_code = 'lang_code';
        public $default_language = 'lang_code';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{languages}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lang_code','match','pattern'=> '/^[a-zA-Z]{2}-[a-zA-Z]{2}$/','message'=> Yii::t('common','Language code must be in format \'xx-xx\', where \'x\' - letter.')),
                        array('lang_code, title, sef, image_url, image_url_thumb','required'),
			array('published, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('lang_code', 'length', 'max'=>7),
			array('title, title_native', 'length', 'max'=>64),
			array('sef', 'length', 'max'=>32),
			array('image_url, image_url_thumb', 'length', 'max'=>255),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('lang_code, title, title_native, sef, image_url, image_url_thumb, published, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'amzni5Categories' => array(self::MANY_MANY, 'Categories', '{{category_translations}}(language_code, category_id)'),
			'contents' => array(self::HAS_MANY, 'Content', 'language_code'),
			'contentCategories' => array(self::HAS_MANY, 'ContentCategories', 'language_code'),
			'amzni5Manufacturers' => array(self::MANY_MANY, 'Manufacturers', '{{manufacturer_translations}}(language_code, manufacturer_id)'),
			'menus' => array(self::HAS_MANY, 'Menu', 'language_code'),
			'amzni5PaymentMethods' => array(self::MANY_MANY, 'PaymentMethods', '{{payment_method_translations}}(language_code, payent_method_id)'),
			'productTranslations' => array(self::MANY_MANY, 'Products', '{{product_translations}}(language_code, product_id)'),
			'amzni5ShippingMethods' => array(self::MANY_MANY, 'ShippingMethods', '{{shipping_method_translations}}(language_code, shipping_method_id)'),
			'webShops' => array(self::HAS_MANY, 'WebShops', 'default_language'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'lang_code' => Yii::t('common', 'Language Code'),
			'title' => Yii::t('common', 'Title'),
			'title_native' => Yii::t('common', 'Title Native'),
			'sef' => Yii::t('common', 'Sef'),
			'image_url' => Yii::t('common', 'Image Url'),
			'image_url_thumb' => Yii::t('common', 'Image Url Thumb'),
			'published' => Yii::t('common', 'Published'),
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

		$criteria->compare('lang_code',$this->lang_code,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('title_native',$this->title_native,true);
		$criteria->compare('sef',$this->sef,true);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('image_url_thumb',$this->image_url_thumb,true);
		$criteria->compare('published',$this->published);
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
	 * @return Languages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
                
        public function behaviors()
        {
            return array(
                    'CBuyinArBehavior' => array(
                'class' => 'application.vendor.alexbassmusic.CBuyinArBehavior'
                        ),
            );
        }
        
        /**
         * Return available languages in the system
         * @return object
         */
        public static function listLanguages()
        {
            return self::model()->findAll(array('order'=>'title_native', 'condition'=>'published=1'));
        }
        
        /**
         * Return available languages in the system for dropdown list
         * @return mixed
         */
        public static function listData()
        {
            return CHtml::listData(self::listLanguages(), 'lang_code','title');
        }
        
        public static function getCurrent()
        {
            if(Yii::app()->user->hasState('applicationLanguage'))
                return Yii::app()->user->getState('applicationLanguage');
            
            return self::getDefault();
        }
        
        /**
         * Return default system language
         * @return string
         */
        public static function getDefault()
        {
            return 'en-GB';
        }
        
        public static function getNameByPk($language_code)
        {
            return self::model()->findByPk($language_code)->title_native;
        }
}
