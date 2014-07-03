<?php

/**
 * This is the model class for table "{{product_prices}}".
 *
 * The followings are the available columns in table '{{product_prices}}':
 * @property string $id
 * @property string $product_id
 * @property string $product_price
 * @property integer $override
 * @property string $product_override_price
 * @property integer $product_tax_id
 * @property string $product_discount_id
 * @property integer $currency_id
 * @property integer $price_quantity_start
 * @property integer $price_quantity_end
 * @property integer $web_shop_id
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property Products $product
 * @property WebShops $webShop
 * @property Currencies $currency
 */
class ProductPrices extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{product_prices}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, currency_id, web_shop_id, product_price', 'required'),
			array('product_price', 'type', 'type'=>'float'),
			array('override, product_tax_id, currency_id, price_quantity_start, price_quantity_end, web_shop_id, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('product_id, product_discount_id', 'length', 'max'=>11),
			array('product_price, product_override_price', 'length', 'max'=>15),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_id, product_price, override, product_override_price, product_tax_id, product_discount_id, currency_id, price_quantity_start, price_quantity_end, web_shop_id, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'webShop' => array(self::BELONGS_TO, 'WebShops', 'web_shop_id'),
			'currency' => array(self::BELONGS_TO, 'Currencies', 'currency_id'),
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
			'product_price' => Yii::t('common', 'Product Price'),
			'override' => Yii::t('common', 'Override'),
			'product_override_price' => Yii::t('common', 'Product Override Price'),
			'product_tax_id' => Yii::t('common', 'Product Tax'),
			'product_discount_id' => Yii::t('common', 'Product Discount'),
			'currency_id' => Yii::t('common', 'Currency'),
			'price_quantity_start' => Yii::t('common', 'Price Quantity Start'),
			'price_quantity_end' => Yii::t('common', 'Price Quantity End'),
			'web_shop_id' => Yii::t('common', 'Web Shop'),
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
		$criteria->compare('product_price',$this->product_price,true);
		$criteria->compare('override',$this->override);
		$criteria->compare('product_override_price',$this->product_override_price,true);
		$criteria->compare('product_tax_id',$this->product_tax_id);
		$criteria->compare('product_discount_id',$this->product_discount_id,true);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('price_quantity_start',$this->price_quantity_start);
		$criteria->compare('price_quantity_end',$this->price_quantity_end);
		$criteria->compare('web_shop_id',$this->web_shop_id);
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
	 * @return ProductPrices the static model class
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
