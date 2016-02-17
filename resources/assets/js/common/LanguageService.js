export default class LanguageService {
    constructor($translate) {
        this.$translate = $translate;

        this.cache = {};

        //TODO MOVE THIS TO CONFIG
        this.lang = {
            de: {
                general: {
                    create: 'Erstellen',
                    delete: 'Löschen',
                    update: 'Editieren'
                },
                messages: {
                    missing_permissions: 'Sie haben nicht genügend Rechte um diese Aktion auszuführen.',
                    shure_to_delete_models: {
                        title: 'Sind sie sich sicher?',
                        text: '{count} Ressource wird gelöscht.|{count} Ressourcen werden gelöscht.'
                    }
                },
                filemanager: {
                    library: 'Bibliothek',
                    item: 'Datei|Dateien',
                    order_by: 'Ordnen',
                    order_options: {
                        folders: 'Ordner',
                        title: 'Titel',
                        last_modified: 'Letzte Änderung'
                    },
                    messages: {
                        enter_folder_name: 'Neuen Ordnernamen eingeben'
                    },
                    categories: {
                        everything: 'Alles',
                        images: 'Bilder',
                        videos: 'Videos',
                        audio: 'Audio',
                        documents: 'Dokumente'
                    }
                },
                attributes: {
                    gender: {
                        m: 'Herr',
                        f: 'Frau'
                    },
                    backend: {
                        1: 'Cockpit',
                        0: 'Website'
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


    get(key, count = 1, vars = {}, language = 'de') {

        var cacheKey = this.uniqueCacheKey(key, language);

        if (!this.cache[cacheKey]) {
            this.cache[cacheKey] = this.findInTree(key, language);
        }

        var string = this.amountSubstring(this.cache[cacheKey], count);

        for (var i in vars) {
            string = string.replace("{" + i + "}", vars[i]);
        }

        return string;

    }

    amountSubstring(languageString, amount = 1) {
        if (languageString.indexOf('|') == -1) {
            return languageString;
        }

        const substrings = languageString.split('|');


        if (amount != 1 && substrings[1]) {
            return substrings[1];
        }


        return substrings[0];
    }

    findInTree(key, language) {
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

}