<?php

/**
 * This is the model class for table "{{products}}".
 *
 * The followings are the available columns in table '{{products}}':
 * @property string $id
 * @property string $product_parent_id
 * @property string $product_sku
 * @property integer $published
 * @property integer $blocked
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
 * @property Categories[] $amzni5Categories
 * @property ProductImages[] $productImages
 * @property Manufacturers[] $amzni5Manufacturers
 * @property ProductPrices[] $productPrices
 * @property ProductReviews[] $productReviews
 * @property Languages[] $amzni5Languages
 * @property ProviderOrderItems[] $providerOrderItems
 * @property Providers[] $amzni5Providers
 * @property ProviderProductsHistories[] $providerProductsHistories
 * @property Warehouse[] $warehouses
 */
class Products extends CActiveRecord
{
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
			array('published, blocked, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('product_parent_id', 'length', 'max'=>11),
			array('product_sku', 'length', 'max'=>32),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_parent_id, product_sku, published, blocked, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'amzni5Categories' => array(self::MANY_MANY, 'Categories', '{{product_categories}}(product_id, category_id)'),
			'productImages' => array(self::HAS_MANY, 'ProductImages', 'product_id'),
			'amzni5Manufacturers' => array(self::MANY_MANY, 'Manufacturers', '{{product_manufacturers}}(product_id, manufacturer_id)'),
			'productPrices' => array(self::HAS_MANY, 'ProductPrices', 'product_id'),
			'productReviews' => array(self::HAS_MANY, 'ProductReviews', 'product_id'),
			'amzni5Languages' => array(self::MANY_MANY, 'Languages', '{{product_translations}}(product_id, language_code)'),
			'providerOrderItems' => array(self::HAS_MANY, 'ProviderOrderItems', 'product_id'),
			'amzni5Providers' => array(self::MANY_MANY, 'Providers', '{{provider_products}}(product_id, provider_id)'),
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
			'product_parent_id' => Yii::t('common', 'Product Parent'),
			'product_sku' => Yii::t('common', 'Product Sku'),
			'published' => Yii::t('common', 'Published'),
			'blocked' => Yii::t('common', 'Blocked'),
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
		$criteria->compare('product_parent_id',$this->product_parent_id,true);
		$criteria->compare('product_sku',$this->product_sku,true);
		$criteria->compare('published',$this->published);
		$criteria->compare('blocked',$this->blocked);
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
}
