<?php

class AccountingOverviewController extends Controller
{
	public function actionIndex()
	{
                $model=ProviderInvoices::model();
                $providersModel=Providers::model();
                $selected=null;
                
                
                $model->unsetAttributes();  // clear any default values
                if(isset($_GET['ProviderInvoices']))
                        $model->attributes=$_GET['ProviderInvoices'];
                
                if(isset($_GET['Providers']['provider_type']))
                {
                    $model->setAttribute ('provider_type', $_GET['Providers']['provider_type']);
                    $selected = $_GET['Providers']['provider_type'];
                }
                        
                
		$this->render('index',array(
                    'model'=>$model,
                    'providersModel'=>$providersModel,
                    'selected'=>$selected,
                ));
	}
}