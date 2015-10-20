export default { name: 'mezzoSidebar', directive };

function directive(){
    return {
        restrict: 'E',
        templateUrl: 'layout/sidebar/sidebar.html',
        link
    };
}

function link(){
    var $body = $('body');

    $('.sidebar-pin').click(function(){
        var sidebarIsPinned = $body.hasClass('sidebar-pinned');

        if(sidebarIsPinned) {
            $('body').addClass('sidebar-unpinned').removeClass('sidebar-pinned');
            $(this).addClass('fa-circle-o').removeClass('fa-dot-circle-o');
        } else {
            $('body').addClass('sidebar-pinned').removeClass('sidebar-unpinned');
            $(this).addClass('fa-dot-circle-o').removeClass('fa-circle-o');
        }
    });

    $('#sidebar')
        .mouseenter(function(){
            $body.addClass('sidebar-mousein').removeClass('sidebar-mouseout');
        })
        .mouseleave(function(){
            $body.addClass('sidebar-mouseout').removeClass('sidebar-mousein');

            if($body.hasClass('sidebar-unpinned'))
                $('.nav-main .opened').removeClass('opened');
        });

    $('.nav-main > li.has-pages > a .dropdown').click(function(){
        $(this).parents('li').toggleClass('opened');
        console.log(this);
    });
}