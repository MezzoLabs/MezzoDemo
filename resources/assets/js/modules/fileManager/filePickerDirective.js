import FilePickerController from './FilePickerController';

/*@ngInject*/
export default function filePickerDirective() {
    return {
        restrict: 'E',
        templateUrl: '/mezzolabs/mezzo/cockpit/templates/filePickerDirective.html',
        scope: {
            fileType: '@',
            fieldName: '@',
            multiple: '@',
            name: '@'
        },
        controller: FilePickerController,
        controllerAs: 'vm',
        bindToController: true
    };
}