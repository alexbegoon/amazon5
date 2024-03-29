<?php
/**
 * Collect and validate SagePay parameters
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 * 
 * 
 */
class SagePayParams extends CFormModel
{
    /**
     * SagePay payment email. 
     * Your business email address for SagePay payments. 
     * Also used as receiver_email.
     * @var string 
     */
    public $sagepay_email;    
    /**
     * SagePay Vendor Name::This is your unique Sage Pay System name. 
     * (Your My Sage Pay Account Name). It is used to identify yourself 
     * to the system. You will need to enter this into your 
     * shopping cart software / code and is also used when accessing your 
     * My Sage Pay Admin Reports pages. It replaces the 'testvendor' 
     * default settings. NB: Some shopping carts may refer to this as MerchantID
     * @var string 
     */
    public $sagepay_vendor_name;    
    /**
     * Live Encryption Password:::This password is used to encrypted 
     * the data your server sends to our Live servers 
     * via the Sage Pay Form system. 
     * You will need to update your shopping cart settings 
     * (or functions file) with this new password and your new Vendor Name.
     * @var string
     */
    public $live_encryption_password;    
    /**
     * Test Encryption Password:::This password is used to encrypted the data 
     * your server sends to our Test servers via the Sage Pay Form system. 
     * You will need to update your shopping cart settings (or functions file) 
     * with this new password and your new Vendor Name.
     * @var string
     */
    public $test_encryption_password;  
    /**
     * SSL enabled?::The Secure Sockets Layer (SSL) 
     * is a commonly-used protocol for managing the security 
     * of a message transmission on the Internet.
     * @var bool
     */
    public $ssl_enabled;
    /**
     * Profile type::This is used to indicate what type of payment pages 
     * should be displayed LOW returns simpler payment pages which have 
     * only one step and minimal formatting. 
     * Designed to run in i-Frames. 
     * NORMAL returns the normal card selection screen. (Default) 
     * @var type 
     */
    public $profile_type;    
    /**
     * SagePay SandBox email.
     * @var string 
     */
    public $sagepay_sandbox_email;
    /**
     * Sandbox mode
     * @var bool 
     */
    public $sandbox_mode;
    /**
     * Currency of the payment
     * @var int
     */
    public $payment_currency;
    /**
     * Countries::Please select the countries for which this payment method applies. 
     * If no country is selected, this payment method will be applied for all countries
     * @var array 
     */
    public $countries; 
    /**
     * Minimum Amount. 
     * Minimum Order Amount to offer this Payment
     * @var float
     */
    public $min_amount;
    /**
     * Maximum Amount. 
     * Maximum Order Amount to offer this Payment
     * @var float
     */
    public $max_amount;
    /**
     * Fees model
     * @var string 
     */
    public $fee_code;
    /**
     * Tax applied to order
     * @var float 
     */
    public $tax;
    /**
     * Order Status for Pending transactions. 
     * The order status to which orders are set, which have no completed 
     * Payment Transaction. The transaction was not cancelled in this case, 
     * but it is just pending and waiting for completion.
     * @var string
     */
    public $status_pending;
    /**
     * Order Status for Successful transactions. 
     * Select the order status to which the actual order is set, 
     * if the SagePay IPN was successful. If using download selling options: 
     * select the status which enables the download 
     * (then the customer is instantly notified about the download via e-mail).
     * @var string 
     */
    public $status_success;
    /**
     * Order Status for Failed transactions. 
     * Select an order status for Failed SagePay transactions.
     * @var string
     */
    public $status_canceled;
    /**
     * Debug?
     * @var bool 
     */
    public $debug;
    
    /**
     * Declares the validation rules.
     */
    public function rules()
    {
            return array(
                    array('sagepay_email,sagepay_vendor_name,test_encryption_password,live_encryption_password,profile_type,status_pending, status_success, status_canceled', 'required'),
                    array('sagepay_email, sagepay_sandbox_email', 'email'),
                    array('ssl_enabled, debug, sandbox_mode', 'boolean'),
                    array('payment_currency', 'numerical', 'integerOnly'=>true),
                    array('min_amount, max_amount, tax', 'numerical'),
                    array('min_amount, max_amount', 'validateAmount'),
                    array('min_amount', 'numerical', 'min'=>0.01),
                    array('profile_type', 'match', 'pattern'=>'/^LOW$|^NORMAL$/'),
                    array('status_pending, status_success, status_canceled','length','max'=>2),
                    array('status_pending, status_success, status_canceled','in','range'=>OrderStatuses::range()),
                    array('sagepay_vendor_name','length','max'=>15),
                    array('fee_code,test_encryption_password,live_encryption_password','length','max'=>64),
                    array('test_encryption_password,live_encryption_password','length','min'=>5),
                    array('fee_code','in','range'=>Fees::listData()),
                    array('countries','validateCountries'),
                    array('countries','safe'),
            );
    }
    
    public function validateCountries($attribute, $params)
    {
        if(empty($this->countries))
            return true;
        
        if(is_array($this->countries) && count($this->countries) > 0)
        {
            foreach ($this->countries as $countryCode)
            {
                if(!Countries::isAvailable($countryCode))
                    $this->addError ($attribute, 
                Yii::t ('common', 'Country with code {country_code} not available.', 
                    array('{country_code}'=>$countryCode)));
            }
        }
    }

    public function validateAmount($attribute, $params)
    {
        if(empty($this->min_amount)&&empty($this->max_amount))
            return false;
            
        if($this->min_amount>=$this->max_amount)
            $this->addError ($attribute, Yii::t('common','{attribute1} must be greater than {attribute2}',array(
                '{attribute1}'=>  $this->attributeLabels()['max_amount'],
                '{attribute2}'=>  $this->attributeLabels()['min_amount'],
            )));
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
            return array(
                'sagepay_email'=>Yii::t('common', 'SagePay payment email'),
                'sagepay_sandbox_email'=>Yii::t('common', 'SagePay Sandbox Email'),
                'sagepay_vendor_name'=>Yii::t('common', 'SagePay Vendor Name'),
                'test_encryption_password'=>Yii::t('common', 'Test Encryption Password'),
                'live_encryption_password'=>Yii::t('common', 'Live Encryption Password'),
                'profile_type'=>Yii::t('common', 'Profile Type'),
                'ssl_enabled'=>Yii::t('common', 'SSL Enabled'),
                'sandbox_mode'=>Yii::t('common', 'Sandbox'),
                'payment_currency'=>Yii::t('common', 'Currency'),
                'countries'=>Yii::t('common', 'Countries'),
                'min_amount'=>Yii::t('common', 'Minimum Amount'),
                'max_amount'=>Yii::t('common', 'Maximum Amount'),
                'fee_code'=>Yii::t('common', 'Fee'),
                'tax'=>Yii::t('common', 'Tax'),
                'status_pending'=>Yii::t('common', 'Order Status for Pending transactions'),
                'status_success'=>Yii::t('common', 'Order Status for Successful transactions'),
                'status_canceled'=>Yii::t('common', 'Order Status for Failed transactions'),
                'debug'=>Yii::t('common', 'Debug'),
            );
    }
    
    public static function itemAlias($type,$code=NULL) 
    {
        $_items = array(
            'profile_type'=>array(
                'LOW'=>Yii::t('common', 'Low'),
                'NORMAL'=>Yii::t('common', 'Normal'),
            )
        );
        if (isset($code))
                return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
                return isset($_items[$type]) ? $_items[$type] : false;
    }
}
