<?php

/**
 * This is the model class for table "{{orders}}".
 *
 * The followings are the available columns in table '{{orders}}':
 * @property string $id
 * @property integer $user_id
 * @property string $order_number
 * @property string $order_pass
 * @property string $order_total
 * @property string $order_subtotal
 * @property string $order_tax
 * @property string $order_shipment
 * @property string $order_shipment_tax
 * @property string $order_payment
 * @property string $order_payment_tax
 * @property string $order_discount
 * @property string $order_coupon_code
 * @property string $order_coupon_id
 * @property string $order_coupon
 * @property integer $currency_id
 * @property integer $payment_method_id
 * @property integer $shipping_method_id
 * @property string $order_outer_status
 * @property string $order_inner_status
 * @property string $order_tracking_number
 * @property string $customer_note
 * @property string $manager_note
 * @property string $ip_address
 * @property integer $web_shop_id
 * @property string $user_profile_data
 * @property string $language_code
 * @property integer $magnet_msg_sent
 * @property string $w3c_order_date
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 * @property integer $deleted
 * @property string $deleted_on
 * @property integer $deleted_by
 *
 * The followings are the available model relations:
 * @property OrderHistories[] $orderHistories
 * @property OrderItems[] $orderItems
 * @property Languages $languageCode
 * @property Currencies $currency
 * @property PaymentMethods $paymentMethod
 * @property ShippingMethods $shippingMethod
 * @property OrderStatuses $orderOuterStatus
 * @property OrderStatuses $orderInnerStatus
 * @property Users $user
 * @property WebShops $webShop
 * @property Transactions[] $transactions
 */
class Orders extends CActiveRecord
{
        const USE_EXISTING_CUSTOMER = 0;
        const REGISTER_THE_NEW_CUSTOMER = 1;
    
        /**
         * 
         * @var bool
         */
        public $register_new_customer;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{orders}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, user_profile_data, order_pass, order_number, currency_id, payment_method_id, shipping_method_id, order_outer_status, order_inner_status, web_shop_id, language_code, order_total, ip_address, order_subtotal, order_tax, order_shipment, order_shipment_tax, order_payment, order_payment_tax, order_discount, order_coupon', 'required'),
			array('currency_id, payment_method_id, shipping_method_id, web_shop_id, magnet_msg_sent, created_by, modified_by, locked_by, deleted, deleted_by', 'numerical', 'integerOnly'=>true),
			array('order_number, order_tracking_number', 'length', 'max'=>64),
			array('order_number', 'unique'),
			array('deleted, magnet_msg_sent, register_new_customer', 'boolean'),
			array('order_pass', 'length', 'max'=>8),
			array('order_total, order_subtotal, order_tax, order_shipment, order_shipment_tax, order_payment, order_payment_tax, order_discount, order_coupon, ip_address', 'length', 'max'=>15),
			array('order_total, order_subtotal, order_tax, order_shipment, order_shipment_tax, order_payment, order_payment_tax, order_discount, order_coupon', 'numerical'),
			array('order_coupon_code', 'length', 'max'=>32),
			array('order_coupon_id', 'length', 'max'=>10),
			array('order_outer_status, order_inner_status', 'length', 'max'=>2),
			array('order_outer_status, order_inner_status', 'in', 'range'=>OrderStatuses::range()),
			array('currency_id', 'in', 'range'=>Currencies::range()),
			array('web_shop_id', 'in', 'range'=>WebShops::range()),
			array('language_code', 'in', 'range'=>Languages::range()),
			array('language_code', 'length', 'max'=>5),
			array('w3c_order_date', 'length', 'max'=>45),
                        // Additional checks
                        array('user_id','numerical', 'integerOnly'=>true, 'min'=>1),
                        array('user_id','validateUser'),
                        array('order_total','validateTotal'),
                        array('order_coupon_code','validateCoupon'),
                        array('payment_method_id','validatePaymentMethod'),
                        array('shipping_method_id','validateShippingMethod'),
                        array('order_outer_status','validateStatus'),
                        array('order_inner_status','validateStatus'),
                        array('order_tracking_number','validateTracking'),
                        array('user_profile_data','validateProfile'),                    
			array('created_on, modified_on, locked_on, deleted_on','date','format'=>array('yyyy-MM-dd HH:mm:ss','0000-00-00 00:00:00')),
			array('customer_note, manager_note, user_profile_data, created_on, modified_on, locked_on, deleted_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, order_number, order_pass, order_total, order_subtotal, order_tax, order_shipment, order_shipment_tax, order_payment, order_payment_tax, order_discount, order_coupon_code, order_coupon_id, order_coupon, currency_id, payment_method_id, shipping_method_id, order_outer_status, order_inner_status, order_tracking_number, customer_note, manager_note, ip_address, web_shop_id, user_profile_data, language_code, magnet_msg_sent, w3c_order_date, created_on, created_by, modified_on, modified_by, locked_on, locked_by, deleted, deleted_on, deleted_by', 'safe', 'on'=>'search'),
		);
	}
        
        public function getUserData()
        {
            $userData = array();
            
            if(!empty($this->user_profile_data))
                $userData=unserialize($this->user_profile_data);
            
            return $userData;
        }
        
        public function validateProfile($attribute,$params)
        {   
            if(!isset($this->userData['profile']))
            {
                $this->addError($attribute, Yii::t('yii','{attribute} is invalid.', 
                array('{attribute}'=>$this->getAttributeLabel($attribute))));
                return false;
            }
                
            $profile=new Profile;
            $profile->attributes=$this->userData['profile'];
            $profile->user_id=0;
            
            if(!$profile->validate())
            {
                $this->addError($attribute, Yii::t('yii','{attribute} is invalid.', 
                array('{attribute}'=>$this->getAttributeLabel($attribute))));
                
                $this->addErrors($profile->getErrors());
                
                return false;
            }
                
            return true;
        }
        
        public function validateTracking($attribute,$params)
        {
            // Validate tracking here
            if(!empty($this->{$attribute})&&!empty($this->shipping_method_id))
                if(!ShippingCompanies::validateTrackingNumber(
                        $this->{$attribute},$this->shipping_method_id))
                {
                    $this->addError($attribute, Yii::t('yii','{attribute} is invalid.', 
                    array('{attribute}'=>$this->getAttributeLabel($attribute))));
                    return false;
                }
        }
        
        public function validateStatus($attribute,$params)
        {
            $model=OrderStatuses::model()->findByPk(
                        $this->{$attribute}
                    );
            if($model===null)
            {
                $this->addError($attribute, Yii::t('common', '{attribute} not exists', 
                    array('{attribute}'=>$this->getAttributeLabel($attribute))));
                return false;
            }
            
            if( ($model->public=='1' && $attribute=='order_inner_status') || 
                ($model->public!='1' && $attribute=='order_outer_status') )
            {
                $this->addError($attribute, Yii::t('common', '{attribute} is wrong', 
                    array('{attribute}'=>$this->getAttributeLabel($attribute))));
                return false;
            }
            return true;
        }
        
        public function validatePaymentMethod($attribute,$params)
        {
            $model=PaymentMethods::model()->findByPk(
                        $this->{$attribute}
                    );
            if($model===null || $model->web_shop_id!=$this->web_shop_id)
            {
                $this->addError($attribute, Yii::t('common', '{attribute} not exists', 
                    array('{attribute}'=>$this->getAttributeLabel($attribute))));
                return false;
            }
            return true;
        }
        
        public function validateShippingMethod($attribute,$params)
        {
            $model=ShippingMethods::model()->findByPk(
                        $this->{$attribute}
                    );
            if($model===null)
            {
                $this->addError($attribute, Yii::t('common', '{attribute} not exists', 
                    array('{attribute}'=>$this->getAttributeLabel($attribute))));
                return false;
            }
            return true;
        }
        
        public function validateUser($attribute,$params)
        {
            $user=Yii::app()->getModule("user")->user($this->{$attribute});
            
            if(!$user || empty($this->{$attribute}) || $user->status!='1')
            {
                $this->addError($attribute, Yii::t('common', '{attribute} not exists', 
                    array('{attribute}'=>$this->getAttributeLabel($attribute))));
                return false;
            }
            return true;
        }
        
        public function validateTotal($attribute,$params)
        {
            $valid=(float)$this->{$attribute} === ((float)$this->order_subtotal
                                                 + (float)$this->order_tax
                                                 + (float)$this->order_payment
                                                 + (float)$this->order_shipment
                                                 - (float)$this->order_discount
                                                 - (float)$this->order_coupon) 
            && (float)$this->{$attribute}>0;
            if(!$valid)
            {
                $this->addError($attribute, Yii::t('yii','{attribute} is invalid.', 
                        array('{attribute}'=>$this->getAttributeLabel($attribute))));
                return false;
            }
            return true;
        }        
        
        public function validateCoupon($attribute,$params)
        {
            if(empty($this->order_coupon_code))
                return true;
            
            if(empty($this->order_coupon_id))
            {
                $this->addError($attribute, 
                        Yii::t('common', '{attribute} not exists',
                        array('{attribute}'=>$this->getAttributeLabel($attribute))));
                return false;
            }
            
            $coupon = Coupons::model()->findByPk($this->order_coupon_id);
            
            if($coupon===null)
            {
                $this->addError($attribute, 
                        Yii::t('common', '{attribute} not exists',
                        array('{attribute}'=>$this->getAttributeLabel($attribute))));
                return false;
            }
            
            if($coupon->published!='1')
            {
                $this->addError($attribute, 
                        Yii::t('common', '{attribute} not exists',
                        array('{attribute}'=>$this->getAttributeLabel($attribute))));
                return false;
            }
            
            if($coupon->isExpired())
            {
                $this->addError($attribute, 
                        Yii::t('common', 'This coupon code is invalid or has expired',
                        array('{attribute}'=>$this->getAttributeLabel($attribute))));
                return false;
            }
            if($coupon->hasBeenUsed())
            {
                $this->addError($attribute, 
                        Yii::t('common', 'This coupon code is invalid or has expired',
                        array('{attribute}'=>$this->getAttributeLabel($attribute))));
                return false;
            }
            
            return true;
        }        

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'orderHistories' => array(self::HAS_MANY, 'OrderHistories', 'order_id'),
			'orderItems' => array(self::HAS_MANY, 'OrderItems', 'order_id'),
			'languageCode' => array(self::BELONGS_TO, 'Languages', 'language_code'),
			'currency' => array(self::BELONGS_TO, 'Currencies', 'currency_id'),
			'paymentMethod' => array(self::BELONGS_TO, 'PaymentMethods', 'payment_method_id'),
			'shippingMethod' => array(self::BELONGS_TO, 'ShippingMethods', 'shipping_method_id'),
			'orderOuterStatus' => array(self::BELONGS_TO, 'OrderStatuses', 'order_outer_status'),
			'orderInnerStatus' => array(self::BELONGS_TO, 'OrderStatuses', 'order_inner_status'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'webShop' => array(self::BELONGS_TO, 'WebShops', 'web_shop_id'),
			'transactions' => array(self::HAS_MANY, 'Transactions', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'Order ID'),
			'user_id' => Yii::t('common', 'Customer'),
			'order_number' => Yii::t('common', 'Order Number'),
			'order_pass' => Yii::t('common', 'Order Password'),
			'order_total' => Yii::t('common', 'Order Total'),
			'order_subtotal' => Yii::t('common', 'Order Subtotal'),
			'order_tax' => Yii::t('common', 'Order Tax'),
			'order_shipment' => Yii::t('common', 'Order Shipment Cost'),
			'order_shipment_tax' => Yii::t('common', 'Order Shipment Tax'),
			'order_payment' => Yii::t('common', 'Order Payment Cost'),
			'order_payment_tax' => Yii::t('common', 'Order Payment Tax'),
			'order_discount' => Yii::t('common', 'Order Discount Amount'),
			'order_coupon_code' => Yii::t('common', 'Order Coupon Code'),
			'order_coupon_id' => Yii::t('common', 'Order Coupon ID'),
			'order_coupon' => Yii::t('common', 'Order Coupon Discount'),
			'currency_id' => Yii::t('common', 'Currency'),
			'payment_method_id' => Yii::t('common', 'Payment Method'),
			'shipping_method_id' => Yii::t('common', 'Shipping Method'),
			'order_outer_status' => Yii::t('common', 'Order Public Status'),
			'order_inner_status' => Yii::t('common', 'Order System Status'),
			'order_tracking_number' => Yii::t('common', 'Order Tracking Number'),
			'customer_note' => Yii::t('common', 'Customer Note'),
			'manager_note' => Yii::t('common', 'Manager Note (Customers not able to view this note)'),
			'ip_address' => Yii::t('common', 'IP Address'),
			'web_shop_id' => Yii::t('common', 'Web Shop'),
			'user_profile_data' => Yii::t('common', 'User Profile Data'),
			'language_code' => Yii::t('common', 'Language'),
			'magnet_msg_sent' => Yii::t('common', '`Magnet` Message Sent'),
			'w3c_order_date' => Yii::t('common', 'W3C Order Date'),
			'created_on' => Yii::t('common', 'Created On'),
			'created_by' => Yii::t('common', 'Created By'),
			'modified_on' => Yii::t('common', 'Modified On'),
			'modified_by' => Yii::t('common', 'Modified By'),
			'locked_on' => Yii::t('common', 'Locked On'),
			'locked_by' => Yii::t('common', 'Locked By'),
			'deleted' => Yii::t('common', 'Order Deleted'),
			'deleted_on' => Yii::t('common', 'Deleted On'),
			'deleted_by' => Yii::t('common', 'Deleted By'),
			'register_new_customer' => Yii::t('common', 'Register the New Customer'),
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('order_number',$this->order_number,true);
		$criteria->compare('order_pass',$this->order_pass);
		$criteria->compare('order_total',$this->order_total,true);
		$criteria->compare('order_subtotal',$this->order_subtotal,true);
		$criteria->compare('order_tax',$this->order_tax,true);
		$criteria->compare('order_shipment',$this->order_shipment,true);
		$criteria->compare('order_shipment_tax',$this->order_shipment_tax,true);
		$criteria->compare('order_payment',$this->order_payment,true);
		$criteria->compare('order_payment_tax',$this->order_payment_tax,true);
		$criteria->compare('order_discount',$this->order_discount,true);
		$criteria->compare('order_coupon_code',$this->order_coupon_code,true);
		$criteria->compare('order_coupon_id',$this->order_coupon_id,true);
		$criteria->compare('order_coupon',$this->order_coupon,true);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('payment_method_id',$this->payment_method_id);
		$criteria->compare('shipping_method_id',$this->shipping_method_id);
		$criteria->compare('order_outer_status',$this->order_outer_status,true);
		$criteria->compare('order_inner_status',$this->order_inner_status,true);
		$criteria->compare('order_tracking_number',$this->order_tracking_number,true);
		$criteria->compare('customer_note',$this->customer_note,true);
		$criteria->compare('manager_note',$this->manager_note,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('web_shop_id',$this->web_shop_id);
		$criteria->compare('user_profile_data',$this->user_profile_data,true);
		$criteria->compare('language_code',$this->language_code,true);
		$criteria->compare('magnet_msg_sent',$this->magnet_msg_sent);
		$criteria->compare('w3c_order_date',$this->w3c_order_date,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified_on',$this->modified_on,true);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('locked_on',$this->locked_on,true);
		$criteria->compare('locked_by',$this->locked_by);
		$criteria->compare('deleted',0);
		$criteria->compare('deleted_on',$this->deleted_on,true);
		$criteria->compare('deleted_by',$this->deleted_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
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
        
        private function storeUserProfile()
        {
            $user=Yii::app()->getModule("user")->user($this->user_id);
            
            if($user!==null)
            {
                $data=array();
                $data['user']=$user->attributes;
                $data['profile']=$user->profile->attributes;
                $this->user_profile_data = serialize($data);
            }
            return true;
        }
        private function storeCoupon()
        {
            if(!empty($this->order_coupon_code))
            {
                $coupon=Coupons::findByCode($this->order_coupon_code);
                if($coupon!==null)
                {
                    $this->order_coupon_id=$coupon->id;
                }
            }
            return true;
        }
        private function storeW3Cdate()
        {
            if(empty($this->w3c_order_date))
            {
                $this->w3c_order_date=date(DATE_W3C);
            }
            return true;
        }
        private function storeIPaddress()
        {
            if(empty($this->ip_address))
            {
                $this->ip_address=Yii::app()->request->userHostAddress;
            }
            return true;
        }
        private function generateOrderPassword()
        {
            if($this->isNewRecord)
                $this->order_pass=str_random(8);
            return true;
        }
        
        public function beforeValidate() 
        {
            $this->storeUserProfile();
            $this->storeCoupon();
            $this->storeIPaddress();           
            $this->generateOrderPassword();
            $this->storeW3Cdate();
            
            return parent::beforeValidate();
        }
}
