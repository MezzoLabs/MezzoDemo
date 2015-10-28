import moduleBuilderState from '../modules/model-builder/state';
import pageBuilderState from '../modules/page-builder/state.js';
import fileManagerState from '../modules/file-manager/state';
import resourceIndexState from '../modules/resource/index/state';
import resourceCreateState from '../modules/resource/create/state';
import usersState from '../modules/users';
import permissionsState from '../modules/permissions';

export default [
    moduleBuilderState,
    pageBuilderState,
    fileManagerState,
    resourceIndexState,
    resourceCreateState,
    usersState,
    permissionsState
];