export default () => {
    $('.sidebar-pin').click(function(){
        var sidebarIsPinned = $('body').hasClass('sidebar-pinned');

        if(sidebarIsPinned) {
            $('body').addClass('sidebar-unpinned').removeClass('sidebar-pinned');
            $(this).addClass('fa-circle-o').removeClass('fa-dot-circle-o');
        }
        else {
            $('body').addClass('sidebar-pinned').removeClass('sidebar-unpinned');
            $(this).addClass('fa-dot-circle-o').removeClass('fa-circle-o');

        }

    });


    $('#sidebar').mouseenter(function(){
        $('body').addClass('sidebar-mousein').removeClass('sidebar-mouseout');
    });

    $('#sidebar').mouseleave(function(){
        $('body').addClass('sidebar-mouseout').removeClass('sidebar-mousein');

        if($('body').hasClass('sidebar-unpinned'))
            $('.nav-main .opened').removeClass('opened');
    });

    $('.nav-main > li.has-pages > a .dropdown').click(function(){
        $(this).parents('li').toggleClass('opened');
        console.log(this);
    });

    $('.trigger-quickview').click(function(){
        quickviewVisible(!quickviewIsVisible());
        return false;
    });

    $('#quickview .btn-close').click(function(){
        quickviewVisible(false);
    });

    $('#content-main, #view-overlay').click(function(){
        quickviewVisible(false);

    });

    function quickviewIsVisible(){
        return  $('#quickview').hasClass('opened');
    }

    function quickviewVisible(open){
        if(open){
            $('#quickview').addClass('opened');
            $('#view-overlay').addClass('opened');
        } else {
            $('#quickview').removeClass('opened')
            $('#view-overlay').removeClass('opened')
        }
    }

    /**
     * Form stuff
     */
    $.fn.editable.defaults.mode = 'inline';

    $.fn.editableform.buttons =
        '<button type="submit" class="btn btn-primary btn-sm editable-submit">'+
        '<i class=ion-checkmark></i>'+
        '</button>'+
        '<button type="button" class="btn btn-default btn-sm editable-cancel">'+
        '<i class="ion-close"></i>'+
        '</button>';

    $('.editable').editable();


    $('select').select2();
};