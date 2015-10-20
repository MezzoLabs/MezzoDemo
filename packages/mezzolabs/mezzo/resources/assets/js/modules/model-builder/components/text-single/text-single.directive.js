import Component from '../Component';

module.exports = new Component('mezzoTextSingle', 'text-single/text-single.html', modifyOptions);

function modifyOptions(options){
    options.label = 'Label';
    options.placeholder = 'Placeholder';
}