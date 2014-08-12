<?php

class SynchronizationController extends CController
{
	public function actionIndex()
	{
            $items=array();
            
            $items[] = Products::sync();
            $items[] = Categories::sync();
            $items[] = Manufacturers::sync();
            $items[] = Providers::sync();
            $items[] = WebShops::sync();
            
            
            $this->render('index',array('items'=>$items));
	}
}