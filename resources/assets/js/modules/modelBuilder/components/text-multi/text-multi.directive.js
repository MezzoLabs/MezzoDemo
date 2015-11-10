import Component from '../Component';

module.exports = new Component('mezzoTextMulti', 'text-multi/text-multi.html', modifyOptions);

function modifyOptions(options){
    options.label = 'Label';
    options.placeholder = 'Placeholder';
}