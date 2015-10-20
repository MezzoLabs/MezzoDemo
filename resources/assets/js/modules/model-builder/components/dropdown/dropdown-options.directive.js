import ComponentOptions from '../ComponentOptions';

module.exports = new ComponentOptions('mezzoDropdownOptions', 'dropdown/dropdown-options.html', controller);

function controller(scope){
    scope.addItem = (label, value) => {
        var item = { label, value };

        scope.options.items.push(item);
    };

    scope.removeItem = index => {
        scope.options.items.splice(index, 1);
    };
}