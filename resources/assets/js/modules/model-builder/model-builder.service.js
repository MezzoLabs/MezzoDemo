export default { name: 'modelBuilder', service };

/*@ngInject*/ function service(componentService, uid){
    return new ModelBuilder(componentService, uid);
}

class ModelBuilder {

    constructor(componentService, uid){
        this.componentService = componentService;
        this.uid = uid;
        this.fields = [];
        this.selectedField = null;
    }

    addField(name){
        var field = {
            id: this.uid(),
            name: name,
            options: {
                validationRules: []
            },
            mainDirective: 'mezzo-' + name,
            optionsDirective: 'mezzo-' + name + '-options'
        };

        this.componentService.setOptions(field.options);
        this.fields.push(field);
    }

    deleteField(deleted){
        $('a[href="#add-field-tab"]').tab('show');

        this.selectedField = null;

        for(var i = 0; i < this.fields.length; i++){
            var field = this.fields[i];

            if(field.id === deleted.id){
                this.fields.splice(i, 1);
                return;
            }
        }
    }

    selectField(field){
        $('a[href="#edit-field-tab"]').tab('show');

        this.selectedField = field;

        this.componentService.setOptions(field.options);
    }

    addValidationRule(){
        var rule = this.validationRule.toLowerCase();

        if(!rule || rule.length === 0 || this.hasValidationRule(rule)){
            return false;
        }

        this.validationRule = '';

        this.selectedField.options.validationRules.push(rule);
    }

    removeValidationRule(validationRule){
        var rules = this.selectedField.options.validationRules;

        for(var i = 0; i < rules.length; i++){
            if(rules[i] === validationRule){
                rules.splice(i, 1);
                return;
            }
        }
    }

    hasValidationRule(validationRule){
        var rules = this.selectedField.options.validationRules;

        for(var i = 0; i < rules.length; i++){
            if(rules[i] === validationRule){
                return true;
            }
        }

        return false;
    }

}