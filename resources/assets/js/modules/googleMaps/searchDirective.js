/*@ngInject*/
export default function searchDirective(mapService) {
    return {
        restrict: 'A',
        scope: {
            streetNumber: '@',
            street: '@',
            city: '@',
            state: '@',
            country: '@',
            postalCode: '@',
            latitude: '@',
            longitude: '@'
        },
        link
    };

    function link(scope, element, attributes) {
        const input = element[0];
        const autoCompleteOptions = {
            types: ['geocode']
        };
        const autoComplete = new google.maps.places.Autocomplete(input, autoCompleteOptions);

        autoComplete.addListener('place_changed', () => {
            const place = autoComplete.getPlace();
            const addressComponents = place.address_components;
            const componentForm = {
                street_number: {
                    key: 'short_name',
                    selector: scope.streetNumber
                },
                route: {
                    key: 'long_name',
                    selector: scope.street
                },
                locality: {
                    key: 'long_name',
                    selector: scope.city
                },
                administrative_area_level_1: {
                    key: 'long_name',
                    selector: scope.state
                },
                country: {
                    key: 'long_name',
                    selector: scope.country
                },
                postal_code: {
                    key: 'short_name',
                    selector: scope.postalCode
                }
            };

            addressComponents.forEach(component => {
                const componentType = component.types[0];
                const componentOptions = componentForm[componentType];

                if (componentOptions) {
                    const componentKey = componentOptions.key;
                    const componentSelector = componentOptions.selector;
                    const componentValue = component[componentKey];

                    $(`[name="${ componentSelector }"]`).val(componentValue);
                }
            });
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                const circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                const bounds = circle.getBounds();

                autoComplete.setBounds(bounds);
            });
        }
    }
}