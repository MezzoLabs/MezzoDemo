export default run;

/*@ngInject*/ function run($state){
    /* Form stuff */
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.buttons =
        '<button type="submit" class="btn btn-primary btn-sm editable-submit">'+
        '<i class=ion-checkmark></i>'+
        '</button>'+
        '<button type="button" class="btn btn-default btn-sm editable-cancel">'+
        '<i class="ion-close"></i>'+
        '</button>';
}