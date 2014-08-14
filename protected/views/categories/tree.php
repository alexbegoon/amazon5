<?php 
/* @var $this CategoriesController */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/category-tree.js');

function print_category($category, $webShopId)
{
    if($category->hasChilds)
        $class = 'glyphicon glyphicon-folder-open';
    else
        $class = 'glyphicon glyphicon-leaf';
    
    $str = '<li class="tree-li">
                <span><i class="'.$class.'"></i> '.$category->name.'</span> ';
    
    $str .= Yii::t('common', 'has {n} product|has {n} products',
                    array(count($category->categoryProducts), '{category_name}' => $category->name));
    
    $str .= '<i class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
    '.Yii::t('common', 'Action').'
    <i class="caret"></i>
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="'.Yii::app()->controller->createUrl('create', array('web_shop_id'=>$webShopId,'parent_id'=>$category->id)).'"><i class="glyphicon glyphicon-plus-sign"></i> '.Yii::t('common', 'Create category here').'</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="'.Yii::app()->controller->createUrl($category->id).'"><i class="glyphicon glyphicon-edit"></i> '.Yii::t('common', 'Manage this category').'</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="'.Yii::app()->controller->createUrl('products',array('id'=>$category->id)).'"><i class="glyphicon glyphicon-barcode"></i> '.Yii::t('common', 'Assign products').'</a></li>
    <li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="'.Yii::app()->controller->createUrl('move',array('id'=>$category->id,'web_shop_id'=>$webShopId,'parent_id'=>$category->parent_id)).'"><i class="glyphicon glyphicon-move"></i> '.Yii::t('common', 'Move this category').'</a></li>
    <li role="presentation" class="divider"></li>
    <li role="presentation">
    '.CHtml::link('<i class="fa fa-trash-o"></i> '.Yii::t('common', 'Revoke all products'), 
                    Yii::app()->controller->createUrl('RevokeAllProductsFromCategory',array('id'=>$category->id)),
                    array('confirm'=>Yii::t('common','Are you sure you want to delete these items?'),
                          'role'=>'menuitem',
                          'tabindex'=>'-1',
                          'class'=>'red')).'</li>
                              <li role="presentation" class="divider"></li>
    <li role="presentation">
    '.CHtml::link('<i class="fa fa-trash-o"></i> '.Yii::t('common', 'Remove this category'), 
                    Yii::app()->controller->createUrl('delete',array('id'=>$category->id)),
                    array('confirm'=>Yii::t('zii','Are you sure you want to delete this item?'),
                          'role'=>'menuitem',
                          'tabindex'=>'-1',
                          'class'=>'red')).'</li>
  </ul>
</i>';
    
    
    if($category->hasChilds)
    {
        $str .='<ul class="tree-ul">';
        foreach($category->childs as $child)
        {
            $str .= print_category($child,$webShopId);
        }
        $str .='</ul>';
    }
    $str .= '</li>';
    return $str;
}
?>
<div class="tree well">
    <ul class="tree-ul">
        <?php foreach (WebShops::listWebShops() as $webShop):?>
        <li class="tree-li">
            <span><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<?php echo $webShop->shop_name;?></span>
            <?php echo Yii::t('common', 'has {n} category|has {n} categories',
                array(count($webShop->categories)));?>
            <i class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                    <?php echo Yii::t('common', 'Action');?>
                    <i class="caret"></i>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('categories/create', array('web_shop_id'=>$webShop->id,'parent_id'=>0))?>"><i class="glyphicon glyphicon-plus-sign"></i> <?php echo Yii::t('common', 'Create category here')?></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl('webShops/'.$webShop->id)?>"><i class="glyphicon glyphicon-edit"></i> <?php echo Yii::t('common', 'Manage this Web Shop')?></a></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation">
                        <?php echo CHtml::link('<i class="fa fa-sitemap"></i> <i class="fa fa-arrow-right"></i> <i class="fa fa-sitemap"></i> '.Yii::t('common', 'Copy category tree'), 
                                    Yii::app()->controller->createUrl('copyTree',array('id'=>$webShop->id)),
                                    array('role'=>'menuitem',
                                          'tabindex'=>'-1'))?></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation">
                        <?php echo CHtml::link('<i class="fa fa-trash-o"></i> '.Yii::t('common', 'Remove all categories'), 
                                    Yii::app()->controller->createUrl('removeAll',array('id'=>$webShop->id)),
                                    array('confirm'=>Yii::t('common','Are you sure you want to delete this item?|Are you sure you want to delete these items?',array(count($webShop->categories))),
                                          'role'=>'menuitem',
                                          'tabindex'=>'-1',
                                          'class'=>'red'))?>
                    </li>
                </ul>
            </i>
            <ul class="tree-ul">
                <?php $tree = Categories::model()->getCategoryTree($webShop->id);
                      if($tree!==null):
                ?>
                <?php foreach ($tree as $category):?>
                    <?php echo print_category($category, $webShop->id);?>
                <?php endforeach;?>
                <?php endif;?>
            </ul>
        </li>
        <?php endforeach;?>
    </ul>
</div>