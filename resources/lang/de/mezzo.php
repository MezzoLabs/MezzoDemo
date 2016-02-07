<?php
return [
    'general' => [
        'add_new' => 'Erstellen',
        'edit' => 'Bearbeiten',
        'delete' => 'Löschen',
        'duplicate' => 'Duplizieren',
        'creating' => 'Erstelle',
        'editing' => 'Bearbeite',
        'edit_model' => ':name bearbeiten',
        'create_model' => ':name erstellen',
        'pagination' => [
            'first' => 'Erste',
            'last' => 'Letzte'
        ]
    ],
    'pages' => [
        'permission_index' => 'Zugriffsrechte',
        'role_index' => 'Alle Rollen',
        'user_index' => 'Alle Nutzer',
        'user_create' => 'Erstellen',
        'event_provider_create' => 'Lieferant erstellen',
        'event_provider_index' => 'Alle Lieferanten',
        'event_create' => 'Erstellen',
        'event_index' => 'Alle Veranstaltungen',
        'event_venue_index' => 'Alle Orte',
        'event_venue_create' => 'Ort erstellen',
        'post_create' => 'Erstellen',
        'post_index' => 'Alle Artikel',
        'advertisement_index' => 'Alle Werbungen',
        'advertisement_create' => 'Werbung erstellen',
        'page_index' => 'Alle Seiten',
        'page_create' => 'Seite hinzufügen',
        'product_create' => 'Produkt hinzufügen',
        'product_index' => 'Alle Produkte',
        'merchant_create' => 'Händler erstellen',
        'merchant_index' => 'Händler',
        'order_index' => 'Alle Bestellungen',
        'category_group' => 'Kategorien gruppieren',
        'category' => 'Kategorien'
    ],
    'modules' => [
        'groups' => [

        ],
        'posts' => [
            'title' => 'Artikel',
            'form' => [
                'publish' => 'Veröffentlichen',

            ]
        ],
        'filemanager' => 'Dateien',
        'events' => 'Veranstaltungen',
        'shop' => [
            'title' => 'Shop',
            'vouchers' => [
                'subscription_months' => 'Abo in Monaten',
                'money_coupon' => 'Wertgutschein in Euro',
                'for_user' => 'Nur für Nutzer'
            ]
        ],
        'general' => 'Allgemein',
        'user' => 'Nutzer',
        'categories' => 'Kategorien',
        'generator' => 'Generator',
        'developerdashboard' => 'Dashboard',
        'advertisements' => 'Werbungen',
        'contents' => [
            'title' => 'Inhalte',
            'blocks' => [
                'title' => 'Titel',
                'text_only' => 'Text',
                'image_and_text' => 'Text mit Bild',
                'images' => 'Bilder',
                'web_video' => 'Web Video'
            ]
        ],
        'pages' => 'Seiten'
    ],
    'models' => [
        'advertisement' => 'Werbung|Werbungen',
        'address' => 'Adresse|Adressen',
        'category' => 'Kategorie|Kategorien',
        'categorygroup' => 'Kategoriengruppe|Kategoriengruppen',
        'content' => 'Inhalt|Inhalte',
        'country' => 'Land|Länder',
        'event' => 'Verantaltung|Veranstaltungen',
        'eventday' => 'Veranstaltungs Tag|Veranstaltungs Tage',
        'eventprovider' => 'Verantaltungs Lieferant|Veranstaltungs Lieferanten',
        'eventvenue' => 'Verantaltungs Ort| Veranstaltungs Orte',
        'file' => 'Datei|Dateien',
        'imagefile' => 'Bild|Bilder',
        'merchant' => 'Händler',
        'option' => 'Option|Optionen',
        'order' => 'Bestellung',
        'page' => 'Seite|Seiten',
        'permission' => 'Zugriffsrecht|Zugriffsrechte',
        'post' => 'Artikel',
        'product' => 'Produkt|Produkte',
        'role' => 'Rolle|Rollen',
        'shoppingbasket' => 'Warenkorb|Warenkörbe',
        'tag' => 'Tag|Tags',
        'user' => 'Nutzer',
        'voucher' => 'Gutschein|Gutscheine'
    ],
    'selects' => [
        'gender' => [
            'm' => 'Herr',
            'f' => 'Frau',
            'n' => '-'
        ],
        'state' => [
            'published' => 'Veröffentlicht',
            'draft' => 'In Bearbeitung',
            'deleted' => 'Gelöscht'
        ],
        'voucher' => [
            'type' => [
                'default' => 'Normal',
                'subscription' => 'Abonement',
                'coupon' => 'Wertgutschein'
            ]
        ]
    ]
];
?>