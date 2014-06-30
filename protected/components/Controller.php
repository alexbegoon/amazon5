<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
        public function filters()
        {
            return array(
                'rights', // perform access control for CRUD operations

            );
        }
        
        /**
         * Lock rows, which current user work with
         * @param mixed $models
         */
        protected function lockRows($models)
        {
            if(!is_array($models))
            {
                $models = array($models);
            }
            
            foreach ($models as $model)
            {
                if((int)$model->locked_by===0 || (int)$model->locked_by===(int)Yii::app()->user->getId())
                {
                    $pk = $model->tableSchema->primaryKey;
                    $compositePk=null;
                    if(!is_array($pk))
                    {
                        $compositePk = $model->primaryKey;
                    }
                    else
                    {
                        foreach($pk as $keyField)
                        {
                            $compositePk[$keyField]=$model->{$keyField};
                        }
                    }
                    
                    $model->updateByPk($compositePk,array(
                        'locked_by'=>Yii::app()->user->getId(),
                        'locked_on'=>date('Y-m-d H:i:s',time()),
                    ));
                }
            }
        }
}