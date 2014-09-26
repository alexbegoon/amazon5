<?php
/**
 * Collect and validate PayPal parameters
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 * 
 * 
 */
class PayPalParams extends CFormModel
{
    /**
     * PayPal payment email. 
     * Your business email address for PayPal payments. 
     * Also used as receiver_email.
     * @var string 
     */
    public $paypal_email;
    /**
     * Boolean. Accept only verified buyers?::Here you can choose if you only 
     * want to accept payments from buyers with a <strong>verified</strong> 
     * PayPal account (when an account is not verified, PayPal does transfer 
     * the funds, but they do not fully guarantee the validity of the sale).
     * @var bool
     */
    public $only_verified_buyers;
    /**
     * PayPal SandBox email.
     * @var string 
     */
    public $paypal_sandbox_email;
    /**
     * Sandbox mode
     * @var bool 
     */
    public $sandbox_mode;
    /**
     * Let buyers override their PayPal addresses?::The address specified with 
     * automatic fill-in variables overrides the PayPal member’s stored address.
     * Buyers see the addresses that you pass in, but they cannot edit them. 
     * PayPal does not show addresses if they are invalid or omitted.
     * @var bool 
     */
    public $address_override;    
    /**
     * Prompt buyers for a shipping address
     * "0"=>Prompt for an address, but do not require one
     * "1"=>Do not prompt for an address
     * "2"=>Prompt for an address, and require one
     * @var int 
     */
    public $no_shipping;
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
     * if the PayPal IPN was successful. If using download selling options: 
     * select the status which enables the download 
     * (then the customer is instantly notified about the download via e-mail).
     * @var string 
     */
    public $status_success;
    /**
     * Order Status for Failed transactions. 
     * Select an order status for Failed PayPal transactions.
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
                    array('paypal_email,status_pending, status_success, status_canceled, payment_currency', 'required'),
                    array('paypal_email, paypal_sandbox_email', 'email'),
                    array('only_verified_buyers, debug, address_override, sandbox_mode', 'boolean'),
                    array('no_shipping, payment_currency', 'numerical', 'integerOnly'=>true),
                    array('min_amount, max_amount, tax', 'numerical'),
                    array('min_amount, max_amount', 'validateAmount'),
                    array('min_amount', 'numerical', 'min'=>0.01),
                    array('status_pending, status_success, status_canceled','length','max'=>2),
                    array('status_pending, status_success, status_canceled','in','range'=>OrderStatuses::range()),
                    array('fee_code','length','max'=>64),
                    array('fee_code','in','range'=>  Fees::listData()),
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
                'paypal_email'=>Yii::t('common', 'PayPal payment email'),
                'only_verified_buyers'=>Yii::t('common', 'Accept only verified buyers?'),
                'paypal_sandbox_email'=>Yii::t('common', 'PayPal Sandbox Email'),
                'sandbox_mode'=>Yii::t('common', 'Sandbox'),
                'address_override'=>Yii::t('common', 'Let buyers override their PayPal addresses?'),
                'no_shipping'=>Yii::t('common', 'Prompt buyers for a shipping address'),
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
                'no_shipping' => array(
                        '0' => Yii::t('yii','Prompt for an address, but do not require one'),
                        '1' => Yii::t('yii','Do not prompt for an address'),
                        '2' => Yii::t('yii','Prompt for an address, and require one'),
                ),
        );
        if (isset($code))
                return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
                return isset($_items[$type]) ? $_items[$type] : false;
    }
}
