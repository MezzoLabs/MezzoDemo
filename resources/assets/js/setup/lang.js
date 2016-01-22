/*@ngInject*/
export default function addTranslations($translateProvider, languageService) {

    $translateProvider.translations('de', {
        'ATTRIBUTES.GENDER' : {m: 'Herr', f: 'Frau'},
        'FOO': 'Dies ist ein Absatz'
    });

    $translateProvider.preferredLanguage('de');
}