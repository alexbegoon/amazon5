<?php

/**
 * This is the model class for table "{{provider_products}}".
 *
 * The followings are the available columns in table '{{provider_products}}':
 * @property integer $provider_id
 * @property string $product_id
 * @property string $provider_product_name
 * @property string $provider_price
 * @property integer $quantity_in_stock
 * @property integer $currency_id
 * @property string $provider_brand
 * @property string $provider_category
 * @property string $provider_sex
 * @property string $provider_image_url
 * @property string $provider_thumb_image_url
 * @property string $inner_id
 * @property string $inner_sku
 * @property integer $blocked
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 */
class ProviderProducts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{provider_products}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('provider_id, product_id, currency_id', 'required'),
			array('provider_id, quantity_in_stock, currency_id, blocked, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('product_id', 'length', 'max'=>11),
			array('provider_product_name, provider_brand, provider_category, provider_sex, provider_image_url, provider_thumb_image_url', 'length', 'max'=>255),
			array('provider_price', 'length', 'max'=>15),
                        array('provider_price','compare','compareValue'=>'0.00001',
                                                                                'operator'=>'>',
                                                                                'allowEmpty'=>true , 
                                                                                'message'=>Yii::t('common', '{attribute} must be greater than zero')),
			array('inner_id, inner_sku', 'length', 'max'=>64),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('provider_id, product_id, provider_product_name, provider_price, quantity_in_stock, currency_id, provider_brand, provider_category, provider_sex, provider_image_url, provider_thumb_image_url, inner_id, inner_sku, blocked, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'provider_id' => Yii::t('common', 'Provider ID'),
			'product_id' => Yii::t('common', 'Product ID'),
			'provider_product_name' => Yii::t('common', 'Provider Product Name'),
			'provider_price' => Yii::t('common', 'Provider Price'),
			'quantity_in_stock' => Yii::t('common', 'Quantity In Stock'),
			'currency_id' => Yii::t('common', 'Currency'),
			'provider_brand' => Yii::t('common', 'Provider Brand'),
			'provider_category' => Yii::t('common', 'Provider Category'),
			'provider_sex' => Yii::t('common', 'Provider Sex'),
			'provider_image_url' => Yii::t('common', 'Provider Image URL'),
			'provider_thumb_image_url' => Yii::t('common', 'Provider Thumb Image URL'),
			'inner_id' => Yii::t('common', 'Inner ID'),
			'inner_sku' => Yii::t('common', 'Inner SKU'),
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

		$criteria->compare('provider_id',$this->provider_id);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('provider_product_name',$this->provider_product_name,true);
		$criteria->compare('provider_price',$this->provider_price,true);
		$criteria->compare('quantity_in_stock',$this->quantity_in_stock);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('provider_brand',$this->provider_brand,true);
		$criteria->compare('provider_category',$this->provider_category,true);
		$criteria->compare('provider_sex',$this->provider_sex,true);
		$criteria->compare('provider_image_url',$this->provider_image_url,true);
		$criteria->compare('provider_thumb_image_url',$this->provider_thumb_image_url,true);
		$criteria->compare('inner_id',$this->inner_id,true);
		$criteria->compare('inner_sku',$this->inner_sku,true);
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
	 * @return ProviderProducts the static model class
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
