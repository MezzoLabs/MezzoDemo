class ModelBuilderController {

    /*@ngInject*/ constructor(modelBuilder){
        this.modelBuilder = modelBuilder;
        this.buttons = [
            button('Single line text', 'ion-document', 'text-single'),
            button('Paragraph text', 'ion-document-text', 'text-multi'),
            button('Checkbox', 'ion-android-checkbox-outline', 'checkbox'),
            button('Dropdown', 'ion-android-arrow-dropdown-circle', 'dropdown'),
            button('Relation', 'ion-arrow-swap', 'relation'),
            button('Owner', 'ion-person', 'owner')
        ];
    }

}

export default { name: 'ModelBuilderController', controller: ModelBuilderController };

function button(label, icon, component){
    return { label, icon, component };
}