import File from './File';

export default class FilePickerController {

    /*@ngInject*/
    constructor(api) {
        this.api = api;
        this.files = [];
        this.preview = null;
        this.searchText = '';

        this.loadFiles();
    }

    selectLabel() {
        const label = 'Select file';

        if(this.isMultiple()) {
            label + 's';
        }

        return label;
    }

    showModal($event) {
        const target = $event.target;

        $(target).prev().modal();
    }

    loadFiles(){
        this.api.files().then(apiFiles => {
            apiFiles.forEach(apiFile => {
                const file = new File(apiFile);

                if(this.fileType && file.type !== this.fileType){
                    return;
                }

                this.files.push(file);
            });
        });
    }

    filteredFiles(){
        if(this.searchText.length > 0){
            return this.files.filter(file => file.name.indexOf(this.searchText) !== -1);
        }

        return this.files;
    }

    setPreview(file){
        if(file.isImage()){
            this.preview = file;
        }
    }

    previewSource(){
        if(this.preview){
            return this.preview.url;
        }

        return '';
    }

    hidePreview(){
        this.preview = null;
    }

    leftColumnClass(){
        if(this.previewSource()){
            return 'col-xs-6';
        }

        return 'col-xs-12';
    }

    isMultiple(){
        return this.multiple !== undefined;
    }

    onSelect(selectedFile){
        if(!this.isMultiple()){
            this.files.forEach(file => file.selected = false);

            selectedFile.selected = true;
        }
    }

    selectedFiles(){
        return this.files.filter(file => file.selected);
    }

    disableSelectButton(){
        return this.selectedFiles().length === 0;
    }

    selectButtonLabel(){
        const selected = this.selectedFiles().length;

        if(selected === 0){
            return 'Please choose a file first';
        }

        return 'Select ' + selected + ' file' + (selected !== 1 ? 's' : '');
    }

    confirmSelected(){
        const selected = this.selectedFiles();
        const $field = $(`input[name="${ this.name }"]`);

        if(selected.length === 1){
            $field.val(selected[0].id);

            return;
        }

        const fileIds = [];

        selected.forEach(file => fileIds.push(file.id));
        $field.val(fileIds);
    }

}