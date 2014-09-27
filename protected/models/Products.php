<?php

/**
 * This is the model class for table "{{products}}".
 *
 * The followings are the available columns in table '{{products}}':
 * @property string $id
 * @property string $product_parent_id
 * @property string $product_sku
 * @property integer $notification_sent
 * @property integer $newly_created
 * @property integer $published
 * @property integer $blocked
 * @property integer $manufacturer_id
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property OrderItems[] $orderItems
 * @property OrderItemsHistories[] $orderItemsHistories
 * @property Categories[] $productCategories
 * @property ProductImages[] $productImages
 * @property Manufacturers $manufacturer
 * @property ProductPrices[] $productPrices
 * @property ProductReviews[] $productReviews
 * @property Languages[] $productLanguages
 * @property ProviderOrderItems[] $providerOrderItems
 * @property Providers[] $productProviders
 * @property ProviderProductsHistories[] $providerProductsHistories
 * @property Warehouse[] $warehouses
 */
class Products extends CActiveRecord
{
    
        public $product_name;
        public $parent_category_id;
        
        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{products}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_sku', 'required'),
			array('product_sku', 'unique', 'message'=>Yii::t('common', 'This SKU already exists')),
			array('product_parent_id, notification_sent, published, newly_created, blocked, manufacturer_id, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('product_parent_id', 'length', 'max'=>11),
			array('product_sku', 'length', 'max'=>32),
			array('product_sku', 'length', 'min'=>6),
			array('published, blocked, notification_sent, newly_created', 'boolean'),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_name, product_parent_id, product_sku, published, blocked, notification_sent, newly_created, manufacturer_id, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'orderItems' => array(self::HAS_MANY, 'OrderItems', 'product_id'),
			'orderItemsHistories' => array(self::HAS_MANY, 'OrderItemsHistories', 'product_id'),
			'productCategories' => array(self::MANY_MANY, 'Categories', '{{product_categories}}(product_id, category_id)'),
			'productImages' => array(self::HAS_MANY, 'ProductImages', 'product_id'),
			'productTranslations' => array(self::HAS_MANY, 'ProductTranslations', 'product_id'),
			'productTranslation' => array(self::BELONGS_TO, 'ProductTranslations', 'id'),
			'manufacturer' => array(self::BELONGS_TO, 'Manufacturers', 'manufacturer_id'),
			'productPrices' => array(self::HAS_MANY, 'ProductPrices', 'product_id'),
			'productReviews' => array(self::HAS_MANY, 'ProductReviews', 'product_id'),
			'productLanguages' => array(self::MANY_MANY, 'Languages', '{{product_translations}}(product_id, language_code)'),
			'providerOrderItems' => array(self::HAS_MANY, 'ProviderOrderItems', 'product_id'),
			'productProviders' => array(self::MANY_MANY, 'Providers', '{{provider_products}}(product_id, provider_id)'),
			'providerProductsHistories' => array(self::HAS_MANY, 'ProviderProductsHistories', 'product_id'),
			'warehouses' => array(self::HAS_MANY, 'Warehouse', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'ID'),
			'product_parent_id' => Yii::t('common', 'Parent Product'),
			'product_sku' => Yii::t('common', 'Product SKU'),
			'product_name' => Yii::t('common', 'Product Name'),
			'manufacturer_id' => Yii::t('common', 'Manufacturer'),
			'published' => Yii::t('common', 'Published'),
                        'notification_sent' => Yii::t('common', 'Notification sent'),
                        'newly_created' => Yii::t('common', 'Newly Created'),
			'blocked' => Yii::t('common', 'Blocked'),
                        'manufacturer_id' => Yii::t('common', 'Manufacturer'),
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

		$criteria->compare('t.id',$this->id,true);
		$criteria->compare('t.product_parent_id',$this->product_parent_id,true);
		$criteria->compare('t.product_sku',$this->product_sku,true);
		$criteria->compare('t.published',$this->published);
		$criteria->compare('t.blocked',$this->blocked);
                $criteria->compare('t.notification_sent',$this->notification_sent);
		$criteria->compare('t.newly_created',$this->newly_created);
                $criteria->compare('t.manufacturer_id', $this->manufacturer_id);
		$criteria->compare('t.created_on',$this->created_on,true);
		$criteria->compare('t.created_by',$this->created_by);
		$criteria->compare('t.modified_on',$this->modified_on,true);
		$criteria->compare('t.modified_by',$this->modified_by);
		$criteria->compare('t.locked_on',$this->locked_on,true);
		$criteria->compare('t.locked_by',$this->locked_by);
                
                $criteria->with = array( 'productCategories','productTranslation' );
                $criteria->group = 't.id';
                $criteria->together = true;
                
                if(!empty($this->parent_category_id))
                {
                    $criteria->compare( 'productCategories_productCategories.category_id', $this->parent_category_id);
                }
                
                $criteria->compare( 'productTranslation.product_name', $this->product_name, true );
                
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'attributes'=>array(
                                'product_name'=>array(
                                    'asc'=>'productTranslation.product_name',
                                    'desc'=>'productTranslation.product_name DESC',
                                ),
                                '*',
                            ),
                        ),
                        'pagination'=>array(
                            'pageSize'=>'20'
                        )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Products the static model class
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
        
        /**
         * Return Product SKU by product ID
         * @param int $product_id
         * @return string
         */
        public static function getSKUbyPk($product_id)
        {
            return self::model()->findByPk($product_id)->product_sku;
        }
        
        public static function findBySKU($product_sku)
        {
            return self::model()->find('product_sku=:product_sku',array(':product_sku'=>$product_sku));
        }
        
        public function getName()
        {
            $model=null;
            if(Yii::app()->user->hasState('applicationLanguage'))
            {
                $currentLang = Yii::app()->user->getState('applicationLanguage');
                $model = ProductTranslations::model()->findByPk(array('product_id'=>$this->id,'language_code'=>$currentLang));
            }
            
            if($model===null)
            {
                $criteria = new CDbCriteria;
                $criteria->condition='product_id=:product_id';
                $criteria->params=array(':product_id'=>$this->id);
                $model = ProductTranslations::model()->find($criteria);
            }
            
            if($model===null)
            {
                return Yii::t('common', '*no name*');
            }
            
            return $model->product_name;
        }
        
        public static function itemAlias($type,$code=NULL) {
		$_items = array(
			'Published' => array(
				'0' => Yii::t('yii','No'),
				'1' => Yii::t('yii','Yes'),
			),
			'Blocked' => array(
				'0' => Yii::t('yii','No'),
				'1' => Yii::t('yii','Yes'),
			),
			'Newly Created' => array(
				'0' => Yii::t('yii','No'),
				'1' => Yii::t('yii','Yes'),
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
        
        public static function sync()
        {
            $result = Yii::t('common', 'Products synchronization');
            return  $result.' - <span class="green">OK</span>';
        }
        
        /**
         * Make SKU as 13 numbers EAN code
         * @param type $sku
         * @return string
         */
        public static function fixProductSKU($sku)
        {
            if(preg_match("/^\d{6,13}$|^#\d{6,13}$/", $sku) === 1)
            {
                $sku = str_replace('#', '', $sku);
                return str_pad($sku, 13, '0', STR_PAD_LEFT);
            }
            return $sku;
        }
        
        public function beforeValidate()
        {
            if($this->published == 1)
            {
                $this->newly_created = 0;
            }
            
            return parent::beforeValidate();
        }
}
