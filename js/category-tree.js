$(function () {
    $('.tree li.tree-li:has(ul.tree-ul)').addClass('parent_li').find(' > span').attr('title', Yii.t('common','Collapse this branch'));
    $('.tree li.tree-li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul.tree-ul > li.tree-li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', Yii.t('common','Expand this branch')).find(' > i').addClass('glyphicon-folder-close').removeClass('glyphicon-folder-open');
        } else {
            children.show('fast');
            setTimeout(function(){children.removeAttr('style')},150);
            $(this).attr('title', Yii.t('common','Collapse this branch')).find(' > i').addClass('glyphicon-folder-open').removeClass('glyphicon-folder-close');
        }
        e.stopPropagation();
    });
    $('.tree li.tree-li.parent_li').find('> span').hover(
            function() {
              $( this ).addClass( "tree-hover" );
              $( this ).parent().find('> ul.tree-ul span').addClass( "tree-hover" );
            }, function() {
              $( this ).removeClass( "tree-hover" );
              $( this ).parent().find('> ul.tree-ul span').removeClass( "tree-hover" );
            }
          );
});