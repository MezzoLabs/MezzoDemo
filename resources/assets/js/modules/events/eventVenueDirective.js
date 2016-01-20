/*@ngInject*/
export default function eventVenueDirective(api) {
    return {
        restrict: 'A',
        link
    };

    function link(scope, element, attributes) {
        var modelApi = api.model('EventVenue');
        var $form = $(element).parents('form');

        $(element).on('change', function(e, parameters){
            var filledFromApi = parameters && parameters.filledFromApi;

            if(!$(this).val() || $(this).val() == "" || filledFromApi) return true;

            modelApi.content($(this).val(), {include : 'address'}).then(function(result){
                fillAddress(result.address.data);
            });

        });

        function fillAddress(data){
            for(var attributeName in data){
                var selector = '[name="address.'+ attributeName +'"]';
                var $input = $form.find(selector);

                if($input.length == 0){
                    continue;
                }

                $input.val(data[attributeName]);
                $input.trigger('input');
            }
        }

    }




}