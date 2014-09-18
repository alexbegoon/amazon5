<?php

/**
 * This is the model class for table "{{shipping_costs}}".
 *
 * The followings are the available columns in table '{{shipping_costs}}':
 * @property integer $shipping_method_id
 * @property integer $web_shop_id
 * @property string $country_code
 * @property integer $postal_codes_range_id
 * @property string $shipping_company_price
 * @property string $seller_price
 * @property integer $currency_id
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property PostalCodesRanges $postalCodesRange
 * @property Countries $countryCode
 * @property Currencies $currency
 * @property ShippingMethods $shippingMethod
 * @property WebShops $webShop
 */
class ShippingCosts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{shipping_costs}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shipping_method_id, web_shop_id, country_code, postal_codes_range_id, currency_id, shipping_company_price, seller_price', 'required'),
			array('shipping_method_id, web_shop_id, postal_codes_range_id, currency_id, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('country_code', 'length', 'max'=>2),
			array('shipping_company_price, seller_price', 'numerical', 'min'=>0.01),
			array('shipping_company_price, seller_price', 'length', 'max'=>15),
                        array('shipping_method_id+web_shop_id+country_code+postal_codes_range_id', 'application.extensions.validators.uniqueMultiColumnValidator'),
			array('country_code, postal_codes_range_id', 'validateCountryRange'),
			array('postal_codes_range_id', 'validateRange'),
                        array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('shipping_method_id, web_shop_id, country_code, postal_codes_range_id, shipping_company_price, seller_price, currency_id, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
		);
	}
        
        public function validateCountryRange($attribute,$params)
        {
            if($this->postal_codes_range_id=='0')
            {
                return true;
            }
            
            $range = PostalCodesRanges::model()->findByPk($this->postal_codes_range_id);
            
            if($range!==null)
            {
                if($range->country_code!==$this->country_code)
                {
                    $this->addError($attribute, Yii::t('common', 
                    '{attribute} is inconsistent. The range of the postal codes should be consistent to selected country.', 
                    array('{attribute}'=>$this->attributeLabels()[$attribute])));

                    return FALSE;
                }
            }
        }
        public function validateRange($attribute,$params)
        {
            $range = PostalCodesRanges::model()->findByPk($this->postal_codes_range_id);
            
            if($range===null)
            {
                $this->addError($attribute, Yii::t('common', 
                '{attribute} malformed', 
                array('{attribute}'=>$this->attributeLabels()[$attribute])));
                
                return FALSE;
            }
        }

        /**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'postalCodesRange' => array(self::BELONGS_TO, 'PostalCodesRanges', 'postal_codes_range_id'),
			'countryCode' => array(self::BELONGS_TO, 'Countries', 'country_code'),
			'currency' => array(self::BELONGS_TO, 'Currencies', 'currency_id'),
			'shippingMethod' => array(self::BELONGS_TO, 'ShippingMethods', 'shipping_method_id'),
			'webShop' => array(self::BELONGS_TO, 'WebShops', 'web_shop_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'shipping_method_id' => Yii::t('common', 'Shipping Method'),
			'web_shop_id' => Yii::t('common', 'Web Shop'),
			'country_code' => Yii::t('common', 'Country'),
			'postal_codes_range_id' => Yii::t('common', 'Range of the Postal Codes'),
			'shipping_company_price' => Yii::t('common', 'Shipping Company Price'),
			'seller_price' => Yii::t('common', 'Seller\'s Price'),
			'currency_id' => Yii::t('common', 'Currency'),
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

		$criteria->compare('shipping_method_id',$this->shipping_method_id);
		$criteria->compare('web_shop_id',$this->web_shop_id);
		$criteria->compare('country_code',$this->country_code,true);
		$criteria->compare('postal_codes_range_id',$this->postal_codes_range_id);
		$criteria->compare('shipping_company_price',$this->shipping_company_price,true);
		$criteria->compare('seller_price',$this->seller_price,true);
		$criteria->compare('currency_id',$this->currency_id);
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
	 * @return ShippingCosts the static model class
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
