module.exports = app => {
	register(require('./common/compile.directive.js'));
	register(require('./common/enter.directive.js'));
	register(require('./common/register-state.directive.js'));
	register(require('./common/uid.service.js'));
	register(require('./modules/model-builder/model-builder.controller.js'));
	register(require('./modules/model-builder/model-builder.service.js'));
	register(require('./modules/file-manager/aside.controller.js'));
	register(require('./modules/file-manager/main.controller.js'));
	register(require('./modules/file-manager/draggable.directive.js'));
	register(require('./modules/file-manager/droppable.directive.js'));
	register(require('./modules/file-manager/file-manager.service.js'));
	register(require('./modules/page-builder/aside.controller.js'));
	register(require('./modules/page-builder/main.controller.js'));
	register(require('./modules/user/user.service.js'));
	register(require('./modules/model-builder/components/component.service.js'));
	register(require('./modules/resource/index/resource-index.controller.js'));
	register(require('./modules/user/list/user-list.controller.js'));
	register(require('./modules/resource/create/resource-create.controller.js'));
	register(require('./modules/user/show/user-show.controller.js'));
	register(require('./modules/model-builder/components/checkbox/checkbox-options.directive.js'));
	register(require('./modules/model-builder/components/checkbox/checkbox.directive.js'));
	register(require('./modules/model-builder/components/dropdown/dropdown-options.directive.js'));
	register(require('./modules/model-builder/components/dropdown/dropdown.directive.js'));
	register(require('./modules/model-builder/components/relation/relation-options.directive.js'));
	register(require('./modules/model-builder/components/relation/relation.directive.js'));
	register(require('./modules/model-builder/components/owner/owner-options.directive.js'));
	register(require('./modules/model-builder/components/owner/owner.directive.js'));
	register(require('./modules/model-builder/components/text-single/text-single-options.directive.js'));
	register(require('./modules/model-builder/components/text-single/text-single.directive.js'));
	register(require('./modules/model-builder/components/text-multi/text-multi-options.directive.js'));
	register(require('./modules/model-builder/components/text-multi/text-multi.directive.js'));

    function register(module){
        if(module.controller){
            return app.controller(module.name, module.controller);
        }

        if(module.directive){
            return app.directive(module.name, module.directive);
        }

        if(module.service){
            return app.factory(module.name, module.service);
        }
    }
};