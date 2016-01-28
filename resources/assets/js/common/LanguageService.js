export default class LanguageService {
    constructor($translate) {
        this.$translate = $translate;

        this.cache = {};

        //TODO MOVE THIS TO CONFIG
        this.lang = {
            de: {
                attributes: {
                    gender: {
                        m: 'Herr',
                        f: 'Frau'
                    },
                    backend: {
                        1: 'Backend',
                        0: 'Frontend'
                    },
                    confirmed: {
                        1: 'Bestätigt',
                        0: 'Unbestätigt'
                    },
                    state: {
                        published: 'Veröffentlicht',
                        draft: 'Zur Vorlage',
                        deleted: 'Papierkorb'
                    }
                }
            }
        }
    }


    get(key, language = 'de') {
        var cacheKey = this.uniqueCacheKey(key, language);

        if(!this.cache[cacheKey]){
            this.cache[cacheKey] = this.findInTree(key, language);
        }

        return this.cache[cacheKey];

    }

    findInTree(key, language){
        var keyParts = key.split('.');

        var lang = _.clone(this.lang[language]);

        for (var i = 0; i != keyParts.length; i++) {
            var keyPart = keyParts[i];

            if (lang[keyPart]) {
                lang = lang[keyPart];
            } else {
                break;
            }
        }

        if (typeof lang != "string") {
            return key;
        }

        return lang;
    }

    uniqueCacheKey(key, language) {
        return key + '[' + language + ']';
    }


    has(key, language = 'de') {
        var translation = this.get(key, language);

        return translation != key;
    }

    bla() {
        this.$translate('ATTRIBUTES.GENDER').then(function (trans) {
            console.log(trans);
        });

    }
}