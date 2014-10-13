<?php
/**
 * This class introduce the Web Shop.
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 */
class Shop extends WebShops
{
    /**
     * Initiate and return Shopping cart.
     * @return \Cart object
     */
    public static function getCart()
    {
        return new Cart;
    }
    
    /**
     * Return Web Shop ID
     * @return int Web Shop ID
     * @throws CHttpException
     */
    public static function getId()
    {
        if(Yii::app()->user->hasState('WebShopID'))
        {
            return (int)Yii::app()->user->getState('WebShopID');
        }
        
        $shopCode = Yii::app()->params['WebShopCode'];
        
        $model = parent::findByCode($shopCode);
        
        if($model!==null)
        {
            Yii::app()->user->setState('WebShopID',(int)$model->id);
            return (int)$model->id;
        }
        
        throw new CHttpException(500,Yii::t('common', 'Please, check webshop code in the configuration.'));
    }
}
