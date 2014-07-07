<?php

/**
 * This is the model class for table "{{product_translations}}".
 *
 * The followings are the available columns in table '{{product_translations}}':
 * @property string $product_id
 * @property string $language_code
 * @property string $product_name
 * @property string $product_desc
 * @property string $product_s_desc
 * @property string $meta_desc
 * @property string $meta_keywords
 * @property string $custom_title
 * @property string $slug
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 */
class ProductTranslations extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{product_translations}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, language_code, product_name', 'required'),
                        array('language_code', 'unique', 'criteria'=>array(
                            'condition'=>'`product_id`=:product_id',
                            'params'=>array(
                                ':product_id'=>$this->product_id
                            )
                        )),
			array('created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('product_id', 'length', 'max'=>11),
			array('language_code', 'length', 'max'=>5),
			array('product_name, product_desc, product_s_desc', 'length', 'min'=>8),
			array('product_name, meta_desc, meta_keywords, custom_title, slug', 'length', 'max'=>255),
			array('product_desc, product_s_desc, created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('product_id, language_code, product_name, product_desc, product_s_desc, meta_desc, meta_keywords, custom_title, slug, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_id' => Yii::t('common', 'Product ID'),
			'language_code' => Yii::t('common', 'Language'),
			'product_name' => Yii::t('common', 'Product Name'),
			'product_desc' => Yii::t('common', 'Product Description'),
			'product_s_desc' => Yii::t('common', 'Product Short Description'),
			'meta_desc' => Yii::t('common', 'Meta Description'),
			'meta_keywords' => Yii::t('common', 'Meta Keywords'),
			'custom_title' => Yii::t('common', 'Custom Title'),
			'slug' => Yii::t('common', 'Slug'),
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

		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('language_code',$this->language_code,true);
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('product_desc',$this->product_desc,true);
		$criteria->compare('product_s_desc',$this->product_s_desc,true);
		$criteria->compare('meta_desc',$this->meta_desc,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('custom_title',$this->custom_title,true);
		$criteria->compare('slug',$this->slug,true);
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
	 * @return ProductTranslations the static model class
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
}
