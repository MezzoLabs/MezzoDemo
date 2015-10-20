export default { name: 'quickview', service };

function service(){
    return { setVisible, isVisible };
}

function setVisible(open){
    if(open){
        $('#quickview').addClass('opened');
        $('#view-overlay').addClass('opened');
    } else {
        $('#quickview').removeClass('opened');
        $('#view-overlay').removeClass('opened');
    }
}

function isVisible(){
    return  $('#quickview').hasClass('opened');
}