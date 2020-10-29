<?php

return [
    
    'index' => [
        'title' => 'Stats',
    ],
    
    'create' => [
        'title' => 'New app',
        'section-title' => 'New application',
        'app-infos' => 'Application Informations',
        'loading' => 'Loading...',
        
        'app-name' => 'Application name:',
        'app-name-desc' => 'This the name of your application it will be shown to user. Make sure that you type it correctly.',
        
        'app-siteweb' => 'Website url:',
        'app-siteweb-desc' => 'This is your website url it will be provided to the user to check your identity.',
        
        'app-webhook' => 'Webhook url:',
        'app-webhook-desc' => 'This the webhook to witch we will send the result of your paiement requests.',

        'app-legal-infos' => 'Legal Documents',
        
        'app-organisation-name' => 'Organisation name:',
        'app-organisation-name-desc' => 'This is the organisation name',

        'app-organisation-nif' => 'Organisation NIF:',
        'app-organisation-nif-desc' => 'This is the NIF of your organisation. Make sure that you type it correctly.',

        'app-organisation-cfe-recto' => 'Photo CFE recto:',
        'app-organisation-cfe-verso' => 'Photo CFE verso:',
        'app-create-submit' => 'Create the application',
    ],

    'app' => [
        'list' => [
            'title' => "Liste des applications",
            'section' => "Liste des applications",
            'table-app-name' => "Nom application",
            'table-members' => "Membres",
            'table-date' => "Cree le",
            'table-state' => "Etat",
            'table-action' => "Action",
            'table-details' => "Details",
        ],

        'show' => [
            'title' => "Details de l'application",
            'section' => "Details de l'application",

            'tab-infos' => "Infos",
            'tab-members' => "Membres",
            'tab-payments' => "Paiements",

            'infos-field' => "Champ",
            'infos-details' => "Valeur",
            'infos-app-name' => "Nom de l'application",
            'infos-app-icon' => "Icone de l'application",
            'infos-website' => "Siteweb",
            'infos-webhook' => "Url callback",
            'infos-organization' => "Organisation",
            'infos-cfe' => "Document CFE",
            'infos-nif' => "N.I.F",
        ],
    ],

    'apps-users' => [
        'index' => [
            'title' => 'Members',
            'section-title' => 'Application members',
            'invite' => 'Invite member(s)',
            'search' => 'Search',

            'user-name' => 'Name',
            'user-role' => 'Role',
            'user-added' => 'Added at',
            'user-state' => 'User state',
            'user-app-state' => 'App state',
            'user-action' => 'Action',
            'user-details' => 'Details',
        ],
        
        'create' => [
            'title' => 'Invite Members',
            'section-title' => 'Invite Members',

            'section-desc-line-one' => 'Enter the email of all users you want to invite for this app',
            'section-desc-line-two' => 'For each mail you will provide the role you want to assign to the member',

            'email-placeholder' => "Member's email",
            'member-role' => "Pick a role",
            'role-admin' => "Admin",
            'role-operation' => "Operation",
            'role-developer' => "Developper",
            'role-support' => "Customer support",

            'add-member' => "Add another member",
            'submit-invite' => "Invite member(s)",

            'success' => 'Invitation were successfully sent'
        ],

        'show' => [
            'title' => 'Details membre',
            'section-title' => 'Details membre',
            'name' => 'Nom:',
            'email' => 'Email:',
            'invited_at' => 'Ajouter le:',
            'state' => 'Etat:',
            'role' => 'Profil:',

            'resend-invite' => "Renvoyer le mail d'invitation",

            'actions-title' => 'Actions',
            'access-title' => 'Changer les droits d\'acces',
            'access-description' => "Pour changer les droits d'acces de <b>:email</b>, veuillez selectionner le role et enregistrer la modification.",
            'access-btn' => 'Enregistrer',
            'change-role-success' => "Changement des droits d'acces reussi",
            'cannot-change-admin-role' => "Vous ne pouvez pas changer le profile d'un <b>admin</b>.",

            'deactivate-title' => "Desactiver l'utilisateur",
            'deactivate-description' => 'Vous etes sur le point de desactiver <b>:email</b>, veuillez proceder avec attention.',
            'deactivate-btn' => 'Desactiver',

            'activate-title' => "Activer l'utilisateur",
            'activate-description' => 'Vous etes sur le point de reactiver <b>:email</b>',
            'activate-btn' => 'Activer',
        ],
    ],

    'apps-api' => [
        'index' => [
            'title' => "Keys and documentation",

            'app-keys-title' => 'Application keys',
            'development-keys-title' => 'Development api keys',
            'public-keys-label' => 'Public key',
            'secret-keys-label' => 'Secret key',
            'production-keys-title' => 'Production api keys',

            'doc-create-payment-title' => 'Create a payment request',
            'doc-create-payment-description' => "To make a payment request to your user, you should request a payment link from us using your secret key. Do this from your backend to make sure that your secret key is kept secret and doesn't get accesed by your users or any malicious individual.",
            'doc-create-payment-demo-title' => 'Here is a demo of how you can request the payment link:',
            
            'doc-create-payment-params' => 'Parameters',
            'doc-create-payment-params-required' => 'required',
            'doc-create-payment-params-secret-description' => "Your app's secret key",
            'doc-create-payment-params-amount-description' => "The amount you want your users to pay",
            'doc-create-payment-params-currency-description' => "The currency you wish your users to pay in",
            
            'doc-create-payment-responses' => 'Responses',

            'doc-create-payment-code' => 'Code samples',
        ],
    ],

];
