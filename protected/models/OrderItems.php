<?php

/**
 * This is the model class for table "{{order_items}}".
 *
 * The followings are the available columns in table '{{order_items}}':
 * @property string $id
 * @property string $order_id
 * @property string $product_id
 * @property integer $product_quantity
 * @property string $product_item_price
 * @property string $product_tax
 * @property string $product_base_price_with_tax
 * @property string $product_final_price
 * @property string $product_subtotal_discount
 * @property string $product_subtotal_with_tax
 * @property integer $currency_id
 * @property string $product_attribute
 * @property integer $returned
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property ItemsByProviders[] $itemsByProviders
 * @property ItemsFromWarehouse[] $itemsFromWarehouses
 * @property Currencies $currency
 * @property Products $product
 * @property Orders $order
 */
class OrderItems extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{order_items}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, product_id, currency_id', 'required'),
			array('product_quantity, currency_id, returned, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('order_id, product_id', 'length', 'max'=>11),
			array('product_item_price, product_tax, product_base_price_with_tax, product_final_price, product_subtotal_discount, product_subtotal_with_tax', 'length', 'max'=>15),
			array('product_attribute, created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, order_id, product_id, product_quantity, product_item_price, product_tax, product_base_price_with_tax, product_final_price, product_subtotal_discount, product_subtotal_with_tax, currency_id, product_attribute, returned, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'itemsByProviders' => array(self::HAS_MANY, 'ItemsByProviders', 'item_id'),
			'itemsFromWarehouses' => array(self::HAS_MANY, 'ItemsFromWarehouse', 'item_id'),
			'currency' => array(self::BELONGS_TO, 'Currencies', 'currency_id'),
			'product' => array(self::BELONGS_TO, 'Products', 'product_id'),
			'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'ID'),
			'order_id' => Yii::t('common', 'Order'),
			'product_id' => Yii::t('common', 'Product'),
			'product_quantity' => Yii::t('common', 'Product Quantity'),
			'product_item_price' => Yii::t('common', 'Product Item Price'),
			'product_tax' => Yii::t('common', 'Product Tax'),
			'product_base_price_with_tax' => Yii::t('common', 'Product Base Price With Tax'),
			'product_final_price' => Yii::t('common', 'Product Final Price'),
			'product_subtotal_discount' => Yii::t('common', 'Product Subtotal Discount'),
			'product_subtotal_with_tax' => Yii::t('common', 'Product Subtotal With Tax'),
			'currency_id' => Yii::t('common', 'Currency'),
			'product_attribute' => Yii::t('common', 'Product Attribute'),
			'returned' => Yii::t('common', 'Returned'),
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
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('product_quantity',$this->product_quantity);
		$criteria->compare('product_item_price',$this->product_item_price,true);
		$criteria->compare('product_tax',$this->product_tax,true);
		$criteria->compare('product_base_price_with_tax',$this->product_base_price_with_tax,true);
		$criteria->compare('product_final_price',$this->product_final_price,true);
		$criteria->compare('product_subtotal_discount',$this->product_subtotal_discount,true);
		$criteria->compare('product_subtotal_with_tax',$this->product_subtotal_with_tax,true);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('product_attribute',$this->product_attribute,true);
		$criteria->compare('returned',$this->returned);
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
	 * @return OrderItems the static model class
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
