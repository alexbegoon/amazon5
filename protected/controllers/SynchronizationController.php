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
            ini_set('max_execution_time', 3600);
            $items=array();
            
            //Clean logs
            $this->cleanLogs();
            
            // Launch sync hooks.
            $items[] = Products::sync();
            $items[] = Categories::sync();
            $items[] = Manufacturers::sync();
            $items[] = Providers::sync();
            $items[] = WebShops::sync();
            
            
            $this->render('index',array('items'=>$items));
	}
        
        private function cleanLogs()
        {
            // Clean providers logs
            $criteria = new CDbCriteria;
            $criteria->condition='created_on < :date';
            $criteria->params=array(':date'=>date('Y-m-d H:i:s',time()-3600*24*Yii::app()->params['logsLifetime']));
            ProviderSyncLogs::model()->deleteAll($criteria);
        }
        
        /**
         * @deprecated since version 0
         * @throws CHttpException
         */
        public function actionImportTranslations()
        {
            ini_set ('memory_limit', "1024M");
            ini_set('max_execution_time', 1000);
            $translationsCSV = Yii::app()->params['uploadsPath'].'translations.csv';
            
            $data = file_get_contents($translationsCSV);
            
            $rows = explode("\n", $data);
            
            try
            {
                $currentTransaction = Yii::app()->db->getCurrentTransaction();
                if ($currentTransaction !== null) 
                {
                    // Transaction already started outside
                    $currentTransaction = null;
                }
                $transaction = Yii::app()->db->beginTransaction();
                
                
                $i = 0;
                foreach ($rows as $row)
                {
                    $row_data = str_getcsv($row);   
                    
                    if(!isset($row_data[1]))
                        continue;
                    
                    $product = Products::findBySKU($row_data[1]);
                    
                    if($product===null)
                        continue;
                    
//                    var_dump($row_data);die;
                    
                    $productTranslation = new ProductTranslations;
                    
                    $productTranslation->setAttribute('product_id', $product->id);
                    if(isset($row_data[2]) && $row_data[2] != 'NULL' && $row_data[2] != 'null')
                    $productTranslation->setAttribute('language_code',isset($row_data[2])?$row_data[2]:NULL);
                    if(isset($row_data[3]) && $row_data[3] != 'NULL' && $row_data[3] != 'null')
                    $productTranslation->setAttribute('product_name',isset($row_data[3])?$row_data[3]:NULL);
                    if(isset($row_data[4]) && $row_data[4] != 'NULL' && $row_data[4] != 'null')
                    $productTranslation->setAttribute('product_desc',isset($row_data[4])?$row_data[4]:NULL);
                    if(isset($row_data[5]) && $row_data[5] != 'NULL' && $row_data[5] != 'null')
                    $productTranslation->setAttribute('product_s_desc',isset($row_data[5])?$row_data[5]:NULL);
                    if(isset($row_data[6]) && $row_data[6] != 'NULL' && $row_data[6] != 'null')
                    $productTranslation->setAttribute('meta_desc',isset($row_data[6])?$row_data[6]:NULL);
                    if(isset($row_data[7]) && $row_data[7] != 'NULL' && $row_data[7] != 'null')
                    $productTranslation->setAttribute('meta_keywords',isset($row_data[7])?$row_data[7]:NULL);
                    if(isset($row_data[8]) && $row_data[8] != 'NULL' && $row_data[8] != 'null')
                    $productTranslation->setAttribute('custom_title',isset($row_data[8])?$row_data[8]:NULL);
                    
                    if(!$productTranslation->save())
                    {
//                        throw new Exception(get_validation_errors($productTranslation));
                    }
                    
                    if($i>100)
                    {
                        $transaction->commit();
                        $transaction = Yii::app()->db->beginTransaction();
                        $i=0;
                    }
                    
                    $i++;
                }
                
                $transaction->commit();
            } catch (Exception $ex) {
                $transaction->rollback();
                throw new CHttpException(500,$ex->getMessage());
            }
            
            
        }
}