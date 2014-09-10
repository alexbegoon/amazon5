<?php

/**
 * This is the model class for table "{{services_providers_invoices}}".
 *
 * The followings are the available columns in table '{{services_providers_invoices}}':
 * @property integer $id
 * @property string $invoice_number
 * @property integer $provider_id
 * @property integer $paid
 * @property string $net_cost
 * @property integer $currency_id
 * @property string $invoice_date
 * @property string $due_date
 * @property string $file
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property Currencies $currency
 * @property ServicesProviders $provider
 */
class ServicesProvidersInvoices extends CActiveRecord
{
        public $total_cost;
        public $subtotal_cost;
        public $total_cost_currency;
        public $provider_type;

        public function init()
        {
            $this->total_cost_currency = Currencies::getCurrencyForDisplay();
        }
        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{services_providers_invoices}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('provider_id, currency_id, net_cost', 'required'),
			array('provider_id, paid, currency_id, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('invoice_number', 'length', 'max'=>64),
			array('net_cost', 'length', 'max'=>15),
			array('net_cost', 'numerical'),
			array('invoice_date, due_date, file, created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, provider_type, invoice_number, provider_id, paid, net_cost, currency_id, invoice_date, due_date, file, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'provider' => array(self::BELONGS_TO, 'ServicesProviders', 'provider_id'),
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
			'paid' => Yii::t('common', 'Paid'),
			'net_cost' => Yii::t('common', 'Net Cost'),
			'currency_id' => Yii::t('common', 'Currency'),
			'invoice_date' => Yii::t('common', 'Invoice Date'),
			'due_date' => Yii::t('common', 'Due Date'),
			'file' => Yii::t('common', 'File'),
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

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.invoice_number',$this->invoice_number,true);
		$criteria->compare('t.provider_id',$this->provider_id);
		$criteria->compare('t.paid',$this->paid);
		$criteria->compare('t.net_cost',$this->net_cost,true);
		$criteria->compare('t.currency_id',$this->currency_id);
		$criteria->compare('t.invoice_date',$this->invoice_date,true);
		$criteria->compare('t.due_date',$this->due_date,true);
		$criteria->compare('t.file',$this->file,true);
		$criteria->compare('t.created_on',$this->created_on,true);
		$criteria->compare('t.created_by',$this->created_by);
		$criteria->compare('t.modified_on',$this->modified_on,true);
		$criteria->compare('t.modified_by',$this->modified_by);
		$criteria->compare('t.locked_on',$this->locked_on,true);
		$criteria->compare('t.locked_by',$this->locked_by);
                
                $criteria->with = array( 'provider' );
                $criteria->together = true;
                
                $criteria->compare( 'provider.provider_type', $this->provider_type);
                
                $totalData = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>false
		));
                
                foreach ($totalData->getData() as $r)
                {
                    $this->total_cost += Currencies::convertCurrencyTo($r->net_cost, $r->currency_id);
                }
                
                $data = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
                
                foreach ($data->getData() as $r)
                {
                    $this->subtotal_cost += Currencies::convertCurrencyTo($r->net_cost, $r->currency_id);
                }
                                
		return $data;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServicesProvidersInvoices the static model class
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
