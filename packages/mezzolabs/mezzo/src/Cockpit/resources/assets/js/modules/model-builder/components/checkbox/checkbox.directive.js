import Component from '../Component';

module.exports = new Component('mezzoCheckbox', 'checkbox/checkbox.html', modifyOptions);

function modifyOptions(options){
    options.label = 'Label';
}