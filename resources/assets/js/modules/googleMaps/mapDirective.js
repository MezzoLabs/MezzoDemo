/*@ngInject*/
export default function mapDirective(mapService) {
    return {
        restrict: 'A',
        scope: {
            latitude: '@',
            longitude: '@'
        },
        link
    };

    function link(scope, element, attributes) {
        const actualElement = element[0];
        const map = new google.maps.Map(actualElement, {
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoom: 8,
            center: {lat: -33.8688, lng: 151.2195},
        });

        setupLatitudeLongitudeWatches();

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const currentLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

                map.setCenter(currentLatLng);
            });
        }

        $('a[data-toggle="tab"]').on('shown.bs.tab', () => {
            google.maps.event.trigger(map, 'resize');
        });

        mapService.receivePlace = receivePlace;

        function receivePlace(place) {
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            marker.setVisible(false);

            if (!place.geometry) {
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
            }
            marker.setIcon({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            });
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
        }

        function setupLatitudeLongitudeWatches() {
            const coordinates = {
                latitude: undefined,
                longitude: undefined
            };
            const latitudeName = scope.latitude;
            const longitudeName = scope.longitude;
            const $latitude = getElementByName(latitudeName);
            const $longitude = getElementByName(longitudeName);

            $latitude.on('input', onLatitudeChange);
            $longitude.on('input', onLongitudeChange);

            function onLatitudeChange(event, extraParams) {
                if (extraParams !== 'triggeredByFormDataService') {
                    return;
                }

                coordinates.latitude = $latitude.val();

                tryUpdatingMap();
            }

            function onLongitudeChange(event, extraParams) {
                if (extraParams !== 'triggeredByFormDataService') {
                    return;
                }

                coordinates.longitude = $longitude.val();

                tryUpdatingMap();
            }

            function tryUpdatingMap() {
                if (!coordinates.latitude || !coordinates.longitude) {
                    return; // Cannot update map without both coordinates
                }

                const geocoder = new google.maps.Geocoder;
                const location = {
                    location: {
                        lat: parseFloat(coordinates.latitude),
                        lng: parseFloat(coordinates.longitude)
                    }
                };

                geocoder.geocode(location, (results, status) => {
                    if (status !== google.maps.GeocoderStatus.OK || results.length === 0) {
                        return;
                    }

                    receivePlace(results[0]);
                });
            }
        }

        function getElementByName(name) {
            return $(`[name="${ name }"]`);
        }
    }
}