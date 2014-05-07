<?php

class LogoutController extends Controller
{
	public $defaultAction = 'logout';
	
	/**
	 * Logout the current user and redirect to returnLogoutUrl.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->controller->module->returnLogoutUrl);
	}
        
        /**
         * Kill redirect loop. Because Yii-Rights filter in global controller 
         * @return null
         */
        public function filters()
        {
            return null;
        }
}