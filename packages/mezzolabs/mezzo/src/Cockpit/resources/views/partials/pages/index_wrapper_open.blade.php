<div class="wrapper"
     ng-init="vm.init('{{ $model_reflection->slug() }}', {!! str_replace('"', "'", $model_reflection->defaultIncludes()->toJson()) !!}, {!! str_replace('"', "'", $module_page->frontendOptions()->toJson()) !!})">
