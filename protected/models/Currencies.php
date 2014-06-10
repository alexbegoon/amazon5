<?php

/**
 * This is the model class for table "{{currencies}}".
 *
 * The followings are the available columns in table '{{currencies}}':
 * @property integer $id
 * @property string $currency_name
 * @property string $currency_code_2
 * @property string $currency_code_3
 * @property integer $currency_numeric_code
 * @property string $currency_exchange_rate
 * @property string $currency_symbol
 * @property string $currency_decimal_place
 * @property string $currency_decimal_symbol
 * @property string $currency_thousands
 * @property string $currency_positive_style
 * @property string $currency_negative_style
 * @property integer $published
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property ItemsByProviders[] $itemsByProviders
 * @property OrderItems[] $orderItems
 * @property Orders[] $orders
 * @property PriceRules[] $priceRules
 * @property ProductPrices[] $productPrices
 * @property ShippingCosts[] $shippingCosts
 * @property Warehouse[] $warehouses
 * @property WebShops[] $webShops
 */
class Currencies extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{currencies}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('currency_numeric_code, currency_exchange_rate, currency_symbol, currency_name, currency_positive_style, currency_negative_style, currency_code_3','required'),
			array('currency_numeric_code, published, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('currency_name, currency_positive_style, currency_negative_style', 'length', 'max'=>64),
			array('currency_code_2', 'length', 'max'=>2),
			array('currency_code_3', 'length', 'max'=>3),
			array('currency_exchange_rate', 'length', 'max'=>10),
			array('currency_symbol, currency_decimal_place, currency_decimal_symbol, currency_thousands', 'length', 'max'=>4),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, currency_name, currency_code_2, currency_code_3, currency_numeric_code, currency_exchange_rate, currency_symbol, currency_decimal_place, currency_decimal_symbol, currency_thousands, currency_positive_style, currency_negative_style, published, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'itemsByProviders' => array(self::HAS_MANY, 'ItemsByProviders', 'currency_id'),
			'orderItems' => array(self::HAS_MANY, 'OrderItems', 'currency_id'),
			'orders' => array(self::HAS_MANY, 'Orders', 'currency_id'),
			'priceRules' => array(self::HAS_MANY, 'PriceRules', 'currency_id'),
			'productPrices' => array(self::HAS_MANY, 'ProductPrices', 'currency_id'),
			'shippingCosts' => array(self::HAS_MANY, 'ShippingCosts', 'currency_id'),
			'warehouses' => array(self::HAS_MANY, 'Warehouse', 'currency_id'),
			'webShops' => array(self::HAS_MANY, 'WebShops', 'currency_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'currency_name' => 'Currency Name',
			'currency_code_2' => 'Currency Code 2',
			'currency_code_3' => 'Currency Code 3',
			'currency_numeric_code' => 'Currency Numeric Code',
			'currency_exchange_rate' => 'Currency Exchange Rate',
			'currency_symbol' => 'Currency Symbol',
			'currency_decimal_place' => 'Currency Decimal Place',
			'currency_decimal_symbol' => 'Currency Decimal Symbol',
			'currency_thousands' => 'Currency Thousands',
			'currency_positive_style' => 'Currency Positive Style',
			'currency_negative_style' => 'Currency Negative Style',
			'published' => 'Published',
			'created_on' => 'Created On',
			'created_by' => 'Created By',
			'modified_on' => 'Modified On',
			'modified_by' => 'Modified By',
			'locked_on' => 'Locked On',
			'locked_by' => 'Locked By',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('currency_name',$this->currency_name,true);
		$criteria->compare('currency_code_2',$this->currency_code_2,true);
		$criteria->compare('currency_code_3',$this->currency_code_3,true);
		$criteria->compare('currency_numeric_code',$this->currency_numeric_code);
		$criteria->compare('currency_exchange_rate',$this->currency_exchange_rate,true);
		$criteria->compare('currency_symbol',$this->currency_symbol,true);
		$criteria->compare('currency_decimal_place',$this->currency_decimal_place,true);
		$criteria->compare('currency_decimal_symbol',$this->currency_decimal_symbol,true);
		$criteria->compare('currency_thousands',$this->currency_thousands,true);
		$criteria->compare('currency_positive_style',$this->currency_positive_style,true);
		$criteria->compare('currency_negative_style',$this->currency_negative_style,true);
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
	 * @return Currencies the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        protected function beforeSave() 
        {
            if ($this->isNewRecord)
            {
                $this->created_on = new CDbExpression('NOW()');
                $this->created_by = Yii::app()->user->getId();
            }
            
            $this->modified_on = new CDbExpression('NOW()');
            $this->modified_by = Yii::app()->user->getId();    
            
            $this->locked_by = 0;
            $this->locked_on = null;

            return parent::beforeSave();
        }
        
        protected function beforeValidate()
        {
            if(!parent::beforeValidate())
            {
                return FALSE;
            }
            
            if((int)Yii::app()->user->getId() === (int)$this->locked_by)
            {                
                return true;
            }
            
            if((int)$this->locked_by === 0 || $this->locked_on < date('Y-m-d H:i:s', time() - 3 * 60 * 60))
            {                
                return true;
            }
            
            $username = Yii::app()->getModule('user')->user($this->locked_by)->profile->getAttribute('firstname') ." ". Yii::app()->getModule('user')->user($this->locked_by)->profile->getAttribute('lastname');
            $this->addError('locked_by_user','You can not edit this. Record locked by '.$username.'.');
            return FALSE;
        }
        
        protected function beforeDelete() 
        {
            if((int)$this->locked_by === (int)Yii::app()->user->getId())
            {
                return true;
            }    
            
            if ((int)$this->locked_by !== 0)
            {
                $username = Yii::app()->getModule('user')->user($this->locked_by)->profile->getAttribute('firstname') ." ". Yii::app()->getModule('user')->user($this->locked_by)->profile->getAttribute('lastname');
                $this->addError('locked_by_user','You can not delete this. Record locked by '.$username.'.');
                return FALSE;
            }

            return parent::beforeDelete();
        }
}
