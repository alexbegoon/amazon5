<?php

/**
 * This is the model class for table "{{categories}}".
 *
 * The followings are the available columns in table '{{categories}}':
 * @property string $id
 * @property integer $web_shop_id
 * @property integer $published
 * @property integer $hits
 * @property string $outer_category_id
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property WebShops $webShop
 * @property CategoryCategories[] $parentCategories
 * @property CategoryCategories[] $childCategories
 * @property CategoryImages[] $categoryImages
 * @property Languages[] $categoryTranslations
 * @property Products[] $categoryProducts
 */
class Categories extends CActiveRecord
{
        public $categoryTree;
        public $level;
        public $hasChilds;
        public $childs;
        public $parent;
        public $name;
        public $hasProducts;
                
        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{categories}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('web_shop_id', 'required'),
			array('web_shop_id, published, hits, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('outer_category_id', 'length', 'max'=>45),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, web_shop_id, published, hits, outer_category_id, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'webShop' => array(self::BELONGS_TO, 'WebShops', 'web_shop_id'),
			'childCategories' => array(self::HAS_MANY, 'CategoryCategories', 'parent_id'),
			'parentCategories' => array(self::HAS_MANY, 'CategoryCategories', 'child_id'),
			'categoryImages' => array(self::HAS_MANY, 'CategoryImages', 'category_id'),
			'categoryTranslations' => array(self::MANY_MANY, 'Languages', '{{category_translations}}(category_id, language_code)'),
			'categoryProducts' => array(self::MANY_MANY, 'Products', '{{product_categories}}(category_id, product_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'ID'),
			'web_shop_id' => Yii::t('common', 'Web Shop'),
			'published' => Yii::t('common', 'Published'),
			'hits' => Yii::t('common', 'Hits'),
			'outer_category_id' => Yii::t('common', 'Outer Category ID'),
			'created_on' => Yii::t('common', 'Created On'),
			'created_by' => Yii::t('common', 'Created By'),
			'modified_on' => Yii::t('common', 'Modified On'),
			'modified_by' => Yii::t('common', 'Modified By'),
			'locked_on' => Yii::t('common', 'Locked On'),
			'locked_by' => Yii::t('common', 'Locked By'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('web_shop_id',$this->web_shop_id);
		$criteria->compare('published',$this->published);
		$criteria->compare('hits',$this->hits);
		$criteria->compare('outer_category_id',$this->outer_category_id,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified_on',$this->modified_on,true);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('locked_on',$this->locked_on,true);
		$criteria->compare('locked_by',$this->locked_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Categories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function behaviors()
        {
          return array( 'CBuyinArBehavior' => array(
                'class' => 'application.vendor.alexbassmusic.CBuyinArBehavior', 
              ));
        }
        
        public function getName()
        {
            $model=null;
            if(Yii::app()->user->hasState('applicationLanguage'))
            {
                $currentLang = Yii::app()->user->getState('applicationLanguage');
                $model = CategoryTranslations::model()->findByPk(array('category_id'=>$this->id,'language_code'=>$currentLang));
            }
            
            if($model===null)
            {
                $criteria = new CDbCriteria;
                $criteria->condition='category_id=:category_id';
                $criteria->params=array(':category_id'=>$this->id);
                $model = CategoryTranslations::model()->find($criteria);
            }
            
            if($model===null)
            {
                throw new CHttpException(500,'Model hasn\'t any translations');
            }
            
            if($model->category_name)
                $this->name = $model->category_name;
            
            return $model->category_name;
        }


        private function getTree($webShopId=null,$categoryId=0,$limit=1000)
        {
            static $level = 0;
            $childs = array();
            if ($level==$limit || $webShopId===null) return null;
            if($categoryId==0)
            {
                $category = self::model()->findByPk($categoryId);
            }
            else
            {
                $category = self::model()->cache(60,null,3)
                                         ->with('childCategories')
                                         ->find(array(
                                             'condition'=>'id=:category_id AND web_shop_id=:web_shop_id',
                                             'params'=>array(':category_id'=>$categoryId,
                                                             ':web_shop_id'=>$webShopId),
                                             ));
            }
            
            if($category===null)
                return null;
                        
            if(count($category->childCategories)>0)
            {
                $level++;
                foreach ($category->childCategories as $child)
                {
                    $model = self::model()->cache(300,null,3)
                                          ->with('childCategories','categoryProducts')
                                          ->find('t.id=:category_id AND web_shop_id=:web_shop_id',
                                                                 array(':category_id'=>$child->child_id,
                                                                       ':web_shop_id'=>$webShopId));
                    
                    if($model!==null)
                    {
                        $model->level = $level;
                        $model->name = $model->getName();
                        $model->childs = self::getTree($webShopId,$child->child_id);
                        $model->hasChilds = count($model->childs)>0?true:false;
                        $model->hasProducts = count($model->categoryProducts)>0?true:false;
                        $childs[] = $model;
                    }
                }
                $level--;
                @usort($childs, function($a, $b)
                {
                    return strcmp($a->name, $b->name);
                });
                return $childs;
            }
            return null;
        }
        
        public function getCategoryTree($webShopId=null,$categoryId=0,$limit=1000)
        {
            if(isset($this->categoryTree[$webShopId]))
                return $this->categoryTree[$webShopId];
            
            $this->categoryTree[$webShopId] = $this->getTree($webShopId,$categoryId=0,$limit=1000);
            
            return $this->categoryTree[$webShopId];
        }
        
        public function getCategoryTreeOptions($webShopId)
        {
            $str = CHtml::tag('option',array('value'=>0),
                   CHtml::encode('- '.Yii::t('common', 'Root').' -'),true);
            $tree = $this->getCategoryTree($webShopId);
            
            if(empty($tree))
                return $str;
                                    
            foreach(self::iterateTree($tree) as $category)
            {
                $str .= CHtml::tag('option',array('value'=>$category['category_id']),$category['category_name'],true);
            }
            
            return $str;
        }
        
        private static function iterateTree($tree)
        {
            static $finalTree;
            
            foreach($tree as $model)
            {
                $label = $model->name;
                if($model->level>1)
                {
                    $label = str_repeat('|--', $model->level-1).$label;
                }
                $finalTree[] = array('category_id'=>$model->id, 
                                     'category_name'=>CHtml::encode($label)
                               );
                
                if($model->hasChilds)
                {
                    self::iterateTree($model->childs);
                }
            }
            
            return $finalTree;
        }
        
        /**
         * Return 1D category tree. Use only for flat list or dropdown
         * @param int $webShopId
         */
        public function getCategoryTreeArr($webShopId)
        {
            $categoryArray = array();
            
            $categoryArray[] = array('category_id'=>0,
                                     'category_name'=>CHtml::encode('- '.Yii::t('common', 'Root').' -')   
                               );
            
            $tree = $this->getCategoryTree($webShopId);
            
            if(empty($tree))
                return $categoryArray;
            
            return array_merge($categoryArray, self::iterateTree($tree));
        }
        
        
}
