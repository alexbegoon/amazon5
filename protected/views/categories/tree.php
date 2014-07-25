<?php 
/* @var $this CategoriesController */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/category-tree.js');

function print_category($category)
{
    if(count($category->childs)>0)
        $class = 'glyphicon glyphicon-folder-open';
    else
        $class = 'glyphicon glyphicon-leaf';
    
    $str = '<li>
                <span><i class="'.$class.'"></i> '.$category->name.'</span> <a href="">Goes somewhere</a>';
    if(count($category->childs)>0)
    {
        $str .='<ul>';
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
    <ul>
        <?php foreach (WebShops::listWebShops() as $webShop):?>
        <li>
            <span><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<?php echo $webShop->shop_name;?></span> <a href="">Goes somewhere</a>
            <ul>
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