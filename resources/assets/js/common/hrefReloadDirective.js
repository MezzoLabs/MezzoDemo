/*@ngInject*/
export default function hrefReloadDirective() {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        const shouldReload = attributes.mezzoHrefReload === '1';

        if (!shouldReload) {
            return;
        }

        const $element = $(element);

        $element.click($event => {
            $event.stopPropagation();
            onHrefClick($element);
        });
    }

    function onHrefClick($element) {
        const href = $element.attr('href');

        if (!href) {
            return;
        }

        window.location.href = href;
    }
}