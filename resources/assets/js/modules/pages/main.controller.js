export default { name: 'PagesMainController', controller };

function controller(){
    $('div.gridster').gridster({
        widget_margins: [10, 10],
        widget_base_dimensions: [140, 140],
        widget_selector: 'div',
        resize: {
            enabled: true
        }
    });
}