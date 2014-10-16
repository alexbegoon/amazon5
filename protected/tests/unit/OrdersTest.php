<?php
/**
 * UnitTests for Orders model
 *
 */
class OrdersTest extends CDbTestCase
{
    public $fixtures=array(
        'orders'=>'Orders',
    );
    
    public function testValidateStatus()
    {
        $order=new Orders;
        $order->attributes=$this->orders['order1'];
    }
}
