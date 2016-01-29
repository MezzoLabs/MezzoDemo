import File from './File';

export default class FilePickerController {

    /*@ngInject*/
    constructor(api, $scope, eventDispatcher) {
        this.api = api;
        this.files = [];
        this.preview = null;
        this.searchText = '';
        this.eventDispatcher = eventDispatcher;
        this.uniqueKey = _.random(10000, 90000);

        this.$parent = $scope.$parent;


        this.pagination = {
            size: 10,
            current: 1,
            perPage: 5
        };


        this.registerListeners();

        this.loadFiles();

    }

    registerListeners() {
        //Form was already received -> we dont have to wait for the selected value
        if (this.eventDispatcher.isInHistory('form.received')){
            return this.eventDispatcher.on('filepicker.files_loaded.' + this.uniqueKey, (event, payload) => {
                this.selectOldValue();
            });
        }

        // Wait for the form content and the possible files before selecting the old value
        return this.eventDispatcher.on(['form.received', 'filepicker.files_loaded.' + this.uniqueKey], (events, payloads) => {
            this.selectOldValue();
        });

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

        $(target).parents('mezzo-file-picker').find('.modal').modal();

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

    selectAddonIds() {
        return this.fileType == 'image' || this.fileType == 'video';
    }

    filesLoaded() {
        this.eventDispatcher.makeAndFire('filepicker.files_loaded.' + this.uniqueKey, {'files': this.files});
    }

    selectOldValue() {
        var value = this.$parent.vm.inputs[this.name];


        if (!value || value == "")
            return false;

        value = String(value);

        if (value.indexOf(',') == -1) {
            this.selectId(value);
            this.confirmSelected();
            return true;
        }

        var ids = value.split(',');
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

    pagedFiles() {
        var files = this.filteredFiles();

        var start = (this.pagination.current - 1) * this.pagination.perPage;
        var end = (this.pagination.current) * this.pagination.perPage - 1;

        return files.slice(start, end);
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
        if (!id || id == "") return false;


        var file = _.find(this.files, file => {
            return this.id(file) == id;
        });

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

    deselect(file) {
        file.selected = false;

        this.confirmSelected();
    }

    confirmSelected() {
        this.$parent.vm.inputs[this.name] = this.selectedIdsString();

    }

    selectedIdsString() {
        const selected = this.selectedFiles();

        if (selected.length === 1) {
            return this.id(selected[0]);
        }

        const fileIds = [];

        selected.forEach(file => fileIds.push(this.id(file)));

        return fileIds.join(',');
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
            if (_.contains(values, this.id(file))) {
                file.selected = true;
            }
        });
    }

    id(file) {
        return (this.selectAddonIds()) ? file.addon.id : file.id;
    }

    inputField() {
        return $('input[name="' + this.name + '"]');
    }

}