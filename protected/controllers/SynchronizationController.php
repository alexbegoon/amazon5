<?php

class SynchronizationController extends CController
{
//        public function filters()
//        {
//            return array(
//                'accessControl',
//            );
//        }
//        
//        public function accessRules() 
//        {
//            return array(
//                array('allow',
//                'actions' => array('index'),
//                'ips' => array('127.0.0.1','::1'),
//               ),
//                array('deny',
//                    'actions' => array('index','view', 'create', 'update', 'manage'),
//                    'ips' => array('*'),
//                ),
//            );
//        }
	public function actionIndex()
	{
            ini_set ('memory_limit', "1024M");
            ini_set('max_execution_time', 300);
            ini_set('base_dir', '/var/www/vhosts/amazonibuyin.com/:/tmp/');
            $items=array();
            
            $items[] = Products::sync();
            $items[] = Categories::sync();
            $items[] = Manufacturers::sync();
            $items[] = Providers::sync();
            $items[] = WebShops::sync();
            
            
            $this->render('index',array('items'=>$items));
	}
}