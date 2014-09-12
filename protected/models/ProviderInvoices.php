<?php

/**
 * This is the model class for table "{{provider_invoices}}".
 *
 * The followings are the available columns in table '{{provider_invoices}}':
 * @property string $id
 * @property string $invoice_number
 * @property integer $provider_id
 * @property string $net_cost
 * @property integer $currency_id
 * @property integer $paid
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property Currencies $currency
 * @property Providers $provider
 */
class ProviderInvoices extends CActiveRecord
{
        public $total_cost;
        public $subtotal_cost;
        public $total_cost_currency;
        public $provider_type;
        public $vat_type;
        public $disablePaging = false;
        
        public function init()
        {
            $this->total_cost_currency = Currencies::getCurrencyForDisplay();
            $this->disablePaging = Yii::app()->request->getParam('disablePaging',false);
        }
        
        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{provider_invoices}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('provider_id, currency, net_cost', 'required'),
			array('provider_id, currency_id, paid, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('net_cost', 'length', 'max'=>15),
			array('net_cost', 'numerical', 'min'=>0.01),
                        array('invoice_number', 'length', 'max'=>64),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, invoice_number, provider_type, vat_type, provider_id, net_cost, currency_id, paid, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'currency' => array(self::BELONGS_TO, 'Currencies', 'currency_id'),
			'provider' => array(self::BELONGS_TO, 'Providers', 'provider_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'ID'),
                        'invoice_number' => Yii::t('common', 'Invoice Number'),
			'provider_id' => Yii::t('common', 'Provider'),
			'net_cost' => Yii::t('common', 'Net Cost'),
			'currency_id' => Yii::t('common', 'Currency'),
			'paid' => Yii::t('common', 'Paid'),
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
                
                $criteria->with = array('provider');
                $criteria->together = true;
                
		$criteria->compare('id',$this->id,true);
                $criteria->compare('invoice_number',$this->invoice_number,true);
		$criteria->compare('provider_id',$this->provider_id);
		$criteria->compare('net_cost',$this->net_cost,true);
		$criteria->compare('t.currency_id',$this->currency_id);
		$criteria->compare('paid',$this->paid);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified_on',$this->modified_on,true);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('locked_on',$this->locked_on,true);
		$criteria->compare('locked_by',$this->locked_by);
                
		$criteria->compare('provider.provider_type',$this->provider_type);
		$criteria->compare('provider.vat_type',$this->vat_type);
                
                $totalData = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>false
		));
                
                foreach ($totalData->getData() as $r)
                {
                    $this->total_cost += Currencies::convertCurrencyTo($r->net_cost, $r->currency_id,null,$r->provider->vat);
                }
                
                $data = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>$this->disablePaging?false:null,
		));
                
                foreach ($data->getData() as $r)
                {
                    $this->subtotal_cost += Currencies::convertCurrencyTo($r->net_cost, $r->currency_id,null,$r->provider->vat);
                }
                                
		return $data;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProviderInvoices the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function behaviors()
        {
            return array( 
                'CBuyinArBehavior' => array(
                    'class' => 'application.vendor.alexbassmusic.CBuyinArBehavior', 
                ),
//                'EDateRangeSearchBehavior' => array(
//                    'class' => 'application.components.EDateRangeSearchBehavior', 
//                ),
            );
        }
        
        public static function itemAlias($type,$code=NULL) 
        {
            $_items = array(
                    'Paid' => array(
                            '0' => Yii::t('yii','No'),
                            '1' => Yii::t('yii','Yes'),
                    ),
            );
            if (isset($code))
                    return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
            else
                    return isset($_items[$type]) ? $_items[$type] : false;
	}
}
