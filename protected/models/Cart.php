<?php
/**
 * This class represents the shopping cart.
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 */
class Cart extends CModel
{
    /**
     * Items in the shopping cart
     * @var array
     */
    public $order_items;
    /**
     * Total
     * @var double
     */
    public $total;
    /**
     * Subtotal
     * @var double
     */
    public $subtotal;
    /**
     * Tax amount
     * @var double
     */
    public $tax;
    /**
     * Currency
     * @var int
     */
    public $currency_id;
    
    public function __construct()
    {
        $this->init();
        $this->attachBehaviors($this->behaviors());
        $this->afterConstruct();
    }
    
    public function init()
    {
        // Defaults. Or how looks empty cart :)
        $this->order_items  =array();
        $this->total        =0;
        $this->subtotal     =0;
        $this->tax          =0;
        $this->currency_id  =Currencies::getCurrencyForDisplay();
        // Set Cart if customer has it.
        if( Yii::app()->user->hasState('cart') )
            $this->attributes=unserialize(Yii::app()->user->getState('cart'));
    }
    
    /**
     * Declares the validation rules.
     */
    public function rules()
    {
            return array(
                    array('currency_id,total,subtotal,tax', 'required'),                    
                    array('currency_id', 'numerical', 'integerOnly'=>true),
                    array('total,subtotal,tax', 'numerical','min'=>0),
                    array('total', 'validateTotal'),
                    array('order_items', 'validateItems'),
                    array('currency_id', 'in', 'range'=>Currencies::range()),
            );
    }
    
    public function validateItems($attribute,$params)
    {
        if( !is_array($this->{$attribute}) )
        {
            $this->addError($attribute, Yii::t('common', 
                    '{attribute} is wrong', 
                    array('{attribute}'=>$this->getAttributeLabel($attribute))));
            return false;
        }
    }
    
    public function validateTotal($attribute,$params)
    {
        if((float)$this->{$attribute} !== (float)$this->subtotal + (float)$this->tax)
        {
            $this->addError($attribute, Yii::t('common', 
                    '{attribute} is wrong', 
                    array('{attribute}'=>$this->getAttributeLabel($attribute))));
            return false;
        }
    }
    
    /**
     * Declares attribute labels.
     */
    public function attributeLabels() 
    {
       return array(
                'currency_id'=>Yii::t('common', 'Currency'),
                'total'=>Yii::t('common', 'Total'),
                'subtotal'=>Yii::t('common', 'Subtotal'),
                'tax'=>Yii::t('common', 'Tax'),
//                ''=>Yii::t('common', ''),
//                ''=>Yii::t('common', ''),
//                ''=>Yii::t('common', ''),
//                ''=>Yii::t('common', ''),
//                ''=>Yii::t('common', ''),
//                ''=>Yii::t('common', ''),
//                ''=>Yii::t('common', ''),
            ); 
    }
    
    public function attributeNames() 
    {
        $cart = Shop::getCart();
        return array_keys(get_object_vars($cart));
    }

    public function save($runValidation=true,$attributes=null)
    {
            if(!$runValidation || $this->validate($attributes))
                    return Yii::app()->user->setState('cart', serialize($this->attributes));
            else
                    return false;
    }
    
    public function addItem(OrderItems $item)
    {
        if(!$item->validate())
        {
            $this->addErrors($item->getErrors());
            return false;
        }
        
        $id=1;
        if(!empty($this->order_items))
        $id = max(array_keys($this->order_items)) + 1;
        $item->temp_id = $id;
        $this->order_items[$id] = $item;
        return $this->save();
    }
    
    public function removeItem($itemId)
    {
        if(isset($this->order_items[$itemId]))
            unset($this->order_items[$itemId]);
        return $this->save();
    }
    
    /**
     * Return order items.
     * @return \CArrayDataProvider object
     */
    public function getOrderItems()
    {
        return new CArrayDataProvider($this->order_items, array(
            'keyField'=>'temp_id',
            'sort'=>array(
                'attributes'=>array(
                     'id', 'product_quantity', 'product_final_price', 
                     'product_name', 'product_sku'
                ),
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
    }
    
    /**
     * Return order items.
     * Useful in the cases when you want to store cart to DB.
     * You can also simply call $cart->order_items, this is the same.
     * @return array Array of OrderItems models
     */
    public function getOrderItemsArr()
    {
        return $this->order_items;
    }
    
    private function calculateTotal()
    {
        return true;
    }
    
    private function calculateSubTotal()
    {
        return true;
    }
    
    private function calculateTax()
    {
        return true;
    }
    
    public function beforeValidate() 
    {
        $this->calculateTotal();
        $this->calculateSubTotal();
        $this->calculateTax();
        return parent::beforeValidate();
    }
    
    public function remove()
    {
        if( Yii::app()->user->hasState('cart') )
            Yii::app()->user->setState('cart',null);
    }
    
}//end class Cart