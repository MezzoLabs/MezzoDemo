/*@ngInject*/
export default function mapDirective(mapService) {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        const actualElement = element[0];
        const map = new google.maps.Map(actualElement, {
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoom: 13,
            center: {lat: -33.8688, lng: 151.2195},
        });
        mapService.map = map;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const currentLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

                map.setCenter(currentLatLng);
            });
        }
    }
}