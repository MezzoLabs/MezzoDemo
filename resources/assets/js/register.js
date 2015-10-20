module.exports = app => {
	register(require('./common/compile.directive.js'));
	register(require('./common/enter.directive.js'));
	register(require('./common/uid.service.js'));
	register(require('./layout/content/content.directive.js'));
	register(require('./layout/quickview/quickview.directive.js'));
	register(require('./layout/quickview/trigger.directive.js'));
	register(require('./layout/quickview/quickview.service.js'));
	register(require('./layout/sidebar/sidebar.directive.js'));
	register(require('./layout/topbar/topbar.directive.js'));
	register(require('./modules/files/aside.controller.js'));
	register(require('./modules/files/main.controller.js'));
	register(require('./modules/files/draggable.directive.js'));
	register(require('./modules/files/droppable.directive.js'));
	register(require('./modules/files/file-manager.service.js'));
	register(require('./modules/model-builder/model-builder.controller.js'));
	register(require('./modules/model-builder/model-builder.service.js'));
	register(require('./modules/pages/aside.controller.js'));
	register(require('./modules/pages/main.controller.js'));
	register(require('./modules/model-builder/components/component.service.js'));
	register(require('./modules/model-builder/components/checkbox/checkbox-options.directive.js'));
	register(require('./modules/model-builder/components/checkbox/checkbox.directive.js'));
	register(require('./modules/model-builder/components/dropdown/dropdown-options.directive.js'));
	register(require('./modules/model-builder/components/dropdown/dropdown.directive.js'));
	register(require('./modules/model-builder/components/owner/owner-options.directive.js'));
	register(require('./modules/model-builder/components/owner/owner.directive.js'));
	register(require('./modules/model-builder/components/relation/relation-options.directive.js'));
	register(require('./modules/model-builder/components/relation/relation.directive.js'));
	register(require('./modules/model-builder/components/text-multi/text-multi-options.directive.js'));
	register(require('./modules/model-builder/components/text-multi/text-multi.directive.js'));
	register(require('./modules/model-builder/components/text-single/text-single-options.directive.js'));
	register(require('./modules/model-builder/components/text-single/text-single.directive.js'));

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