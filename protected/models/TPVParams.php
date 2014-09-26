<?php
/**
 * Collect and validate TPV parameters
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 * 
 * 
 */
class TPVParams extends CFormModel
{
    /**
     * TPV payment email. 
     * Your business email address for TPV payments. 
     * Also used as receiver_email.
     * @var string 
     */
    public $tpv_email;    
    /**
     * TPV Commerce key
     * @var string 
     */
    public $tpv_commerce_key;    
    /**
     *  TPV password
     * @var string
     */
    public $tpv_password;
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
     * if the TPV IPN was successful. If using download selling options: 
     * select the status which enables the download 
     * (then the customer is instantly notified about the download via e-mail).
     * @var string 
     */
    public $status_success;
    /**
     * Order Status for Failed transactions. 
     * Select an order status for Failed TPV transactions.
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
                    array('tpv_email,tpv_password,tpv_commerce_key,status_pending, status_success, status_canceled', 'required'),
                    array('tpv_email', 'email'),
                    array('debug, sandbox_mode', 'boolean'),
                    array('payment_currency', 'numerical', 'integerOnly'=>true),
                    array('min_amount, max_amount, tax', 'numerical'),
                    array('min_amount, max_amount', 'validateAmount'),
                    array('min_amount', 'numerical', 'min'=>0.01),
                    array('status_pending, status_success, status_canceled','length','max'=>2),
                    array('status_pending, status_success, status_canceled','in','range'=>OrderStatuses::range()),
                    array('fee_code,tpv_password,tpv_commerce_key','length','max'=>64),
                    array('tpv_password,tpv_commerce_key','length','min'=>5),
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
                'tpv_email'=>Yii::t('common', 'TPV payment email'),
                'tpv_password'=>Yii::t('common', 'TPV Password'),
                'tpv_commerce_key'=>Yii::t('common', 'TPV Commerce Key'),
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
            
        );
        if (isset($code))
                return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
                return isset($_items[$type]) ? $_items[$type] : false;
    }
}
