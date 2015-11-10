import Component from '../Component';

module.exports = new Component('mezzoDropdown', 'dropdown/dropdown.html', modifyOptions);

function modifyOptions(options){
    options.label = 'Label';
    options.items = [];
    options.multiple = false;
}