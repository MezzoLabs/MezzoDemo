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
        var label = 'Select file';

        if (this.isMultiple()) {
            label += 's';
        }

        label += " ( " + this.selectedFiles().length + " )";

        return label;
    }

    showModal($event) {
        const target = $event.target;

        $(target).parent().find('.modal').modal();
    }

    loadFiles() {
        this.api.files().then(apiFiles => {
            apiFiles.forEach(apiFile => {
                const file = new File(apiFile);

                if (this.fileType && file.type !== this.fileType) {
                    return;
                }

                this.files.push(file);

            });

            this.filesLoaded();
        });
    }

    filesLoaded() {
        this.selectOldValue();


    }

    selectOldValue() {
        if (!this.value) {
            return false;
        }

        if (this.value.indexOf(',') == -1) {
            this.selectId(this.value);
            this.confirmSelected();
            return true;
        }

        var ids = this.value.split(',');
        for (var i in ids) {
            this.selectId(ids[i]);
        }

        this.confirmSelected();

        return true;


    }

    filteredFiles() {
        if (this.searchText.length > 0) {
            return this.files.filter(file => file.name.indexOf(this.searchText) !== -1);
        }

        return this.files;
    }

    setPreview(file) {
        if (file.isImage()) {
            this.preview = file;
        }
    }

    previewSource() {
        if (this.preview) {
            return this.preview.url;
        }

        return '';
    }

    hidePreview() {
        this.preview = null;
    }

    leftColumnClass() {
        if (this.previewSource()) {
            return 'col-xs-6';
        }

        return 'col-xs-12';
    }

    isMultiple() {
        return this.multiple !== undefined;
    }

    selectId(id) {
        var file = _.find(this.files, {id: parseInt(id)});

        file.selected = true;
    }

    onSelect(selectedFile) {
        if (this.isMultiple() || !selectedFile.selected) {
            return;
        }

        this.files.forEach(file => file.selected = false);

        selectedFile.selected = true;
    }

    selectedFiles() {
        return this.files.filter(file => file.selected);
    }

    disableSelectButton() {
        return this.selectedFiles().length === 0;
    }

    selectButtonLabel() {
        const selected = this.selectedFiles().length;

        if (selected === 0) {
            return 'Please choose a file first';
        }

        return 'Select ' + selected + ' file' + (selected !== 1 ? 's' : '');
    }

    confirmSelected() {
        const selected = this.selectedFiles();
        const $field = this.inputField();

        if (selected.length === 1) {
            $field.val(selected[0].id);

            return;
        }

        const fileIds = [];

        selected.forEach(file => fileIds.push(file.id));
        $field.val(fileIds);
    }

    countSelected() {
        return this.selectedFiles().length;
    }

    acquireInputValue(value) {
        let values = [value];

        if (value.indexOf(',') !== -1) {
            values = value.split(',');
        }

        for (let i = 0; i < values.length; i++) {
            values[i] = parseInt(values[i], 10);
        }

        this.files.forEach(file => {
            if (_.contains(values, file.id)) {
                file.selected = true;
            }
        });
    }

    inputField() {
        return $(`input[name="${ this.name }"]`);
    }

}