/*@ngInject*/
export default function searchDirective() {
    return {
        restrict: 'A',
        link
    };
}

function link(scope, element, attributes) {
    const map = new google.maps.Map(element[0], {
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoom: 13,
        center: {lat: -33.8688, lng: 151.2195},
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            const currentLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

            map.setCenter(currentLatLng);
        });
    }
}