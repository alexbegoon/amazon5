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
			'id' => Yii::t('common', 'ID'),
			'currency_name' => Yii::t('common', 'Currency Name'),
			'currency_code_2' => Yii::t('common', 'Currency Code 2'),
			'currency_code_3' => Yii::t('common', 'Currency Code 3'),
			'currency_numeric_code' => Yii::t('common', 'Currency Numeric Code'),
			'currency_exchange_rate' => Yii::t('common', 'Currency Exchange Rate'),
			'currency_symbol' => Yii::t('common', 'Currency Symbol'),
			'currency_decimal_place' => Yii::t('common', 'Currency Decimal Place'),
			'currency_decimal_symbol' => Yii::t('common', 'Currency Decimal Symbol'),
			'currency_thousands' => Yii::t('common', 'Currency Thousands'),
			'currency_positive_style' => Yii::t('common', 'Currency Positive Style'),
			'currency_negative_style' => Yii::t('common', 'Currency Negative Style'),
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
        
        public function behaviors()
        {
          return array( 'CBuyinArBehavior' => array(
                'class' => 'application.vendor.alexbassmusic.CBuyinArBehavior', 
              ));
        }
        
        /**
         * Return default system currency
         * @return mixed
         */
        public function getDefaultCurrency()
        {
            // default currency code
            $default='EUR';
            
            $defaultCurrency=Currencies::model()->find('currency_code_3=:code',array(':code'=>$default));
            if($defaultCurrency!==NULL)
            {
                return $defaultCurrency->id;
            }
            return NULL;
        }
        
        /**
         * Convert price from currency A to currency B
         * @param float $price
         * @param int $currencyA
         * @param int $currencyB
         * @return float
         * @throws CHttpException
         */
        public function convertCurrencyTo($price,$currencyA,$currencyB)
        {
            if(empty($price))
            {
                $msg='Price could not be empty';
                Yii::log($msg);
                throw new CHttpException(500, $msg);
            }
            
            $cA=Currencies::model()->findByPk($currencyA,array('condition'=>'published=1'));
            $cB=Currencies::model()->findByPk($currencyB,array('condition'=>'published=1'));
            
            if($cA===null)
            {
                $msg='Currency with ID: '.$currencyA.' not exists or not active';
                Yii::log($msg);
                throw new CHttpException(500, $msg);
            }
            
            if($cB===null)
            {
                $msg='Currency with ID: '.$currencyA.' not exists or not active';
                Yii::log($msg);
                throw new CHttpException(500, $msg);
            }
            
            $exchA=$cA->currency_exchange_rate;
            $exchB=$cB->currency_exchange_rate;
            
            if($currencyA==self::getDefaultCurrency())
            {
                $exchA=1.0;
            }
            
            if($currencyB==self::getDefaultCurrency())
            {
                $exchB=1.0;
            }
            
            if(empty($exchA) || $exchA <= 0)
            {
                $msg='Currency with ID: '.$currencyA.' have no exchange rate';
                Yii::log($msg);
                throw new CHttpException(500, $msg);
            }
            
            if(empty($exchB) || $exchB <= 0)
            {
                $msg='Currency with ID: '.$currencyB.' have no exchange rate';
                Yii::log($msg);
                throw new CHttpException(500, $msg);
            }
            
            return (float)$price * (float)$exchB / (float)$exchA;
        }
        
        /**
         * Display formatted and rounded price. Currency B is optional.
         * If currency B assigned, then price will be shown in currency B format, and of course converted to B
         * @param float $price
         * @param int $currencyA
         * @param int $currencyB
         * @return string
         */
        public function priceDisplay($price,$currencyA,$currencyB=0)
        {
            if(empty($currencyB))
            {
                $currencyIdForDisplay = self::getCurrencyForDisplay();
            }
            else 
            {
                $currencyIdForDisplay=$currencyB;
            }
            
            $price = self::convertCurrencyTo($price,$currencyA,$currencyIdForDisplay);
            return self::getFormattedCurrency($price,$currencyIdForDisplay);
        }
        
        /**
         * Format and Round price to selected currency
         * @param float $nb
         * @param int $currencyId
         * @return string
         */
        private function getFormattedCurrency($nb, $currencyId)
        {
            $c=  Currencies::model()->findByPk($currencyId);
            if($c===null)
            {
                Yii::log('Currency with ID: '.$currencyId.' not found.');
                return null;
            }
            
            $nbDecimal = $c->currency_decimal_place;
            if($nb>=0){
                    $format = $c->currency_positive_style;
                    $sign = '+';
            } else {
                    $format = $c->currency_negative_style;
                    $sign = '-';
                    $nb = abs($nb);
            }

            $res = number_format((float)$nb,$nbDecimal,$c->currency_decimal_symbol,$c->currency_thousands);
            $search = array('{sign}', '{number}', '{symbol}');
            $replace = array($sign, $res, $c->currency_symbol);
            $formattedRounded = str_replace ($search,$replace,$format);

            return $formattedRounded;
        }
        
        /**
         * Return currency for display in the views.
         * @return int
         */
        private function getCurrencyForDisplay()
        {
            if(Yii::app()->user->hasState('applicationCurrency'))
            {   
                $currencyId = Yii::app()->user->getState('applicationCurrency');
            }   
            if(empty($currencyId))
            {
                $currencyId = self::getDefaultCurrency();
            }

            return (int)$currencyId;
        }
}
