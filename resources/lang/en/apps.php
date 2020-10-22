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
