<?php 
/* @var $this CategoriesController */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/category-tree.js');

function print_category($category)
{
    if(count($category->childs)>0)
        $class = 'glyphicon glyphicon-folder-open';
    else
        $class = 'glyphicon glyphicon-leaf';
    
    $str = '<li class="tree-li">
                <span><i class="'.$class.'"></i> '.$category->name.'</span> ';
    
    $str .= Yii::t('common', 'has {n} product|has {n} products',
                    array(count($category->categoryProducts), '{category_name}' => $category->name));
    
    
    $str .= '<i class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
    Dropdown
    <i class="caret"></i>
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
    <li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
  </ul>
</i>';
    
    if(count($category->childs)>0)
    {
        $str .='<ul class="tree-ul">';
        foreach($category->childs as $child)
        {
            $str .= print_category($child);
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
            <span><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<?php echo $webShop->shop_name;?></span> <a href="">Goes somewhere</a>
            <ul class="tree-ul">
                <?php $tree = Categories::model()->getCategoryTree($webShop->id);
                      if($tree!==null):
                ?>
                <?php foreach ($tree as $category):?>
                    <?php echo print_category($category);?>
                <?php endforeach;?>
                <?php endif;?>
            </ul>
        </li>
        <?php endforeach;?>
    </ul>
</div>