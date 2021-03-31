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
        'app-name-desc' => 'This the name of your application it will be shown to your clients. Make sure that you type it correctly.',

        'app-siteweb' => 'Website url:',
        'app-siteweb-desc' => 'This is your website url it will be provided to your clients to check your identity.',

        'app-webhook' => 'Webhook url:',
        'app-webhook-desc' => 'This is the url to witch we will send the result of your paiement requests.',

        'app-legal-infos' => 'Legal Documents',

        'app-organisation-name' => 'Organisation name:',
        'app-organisation-name-desc' => 'This is the organisation name',

        'app-organisation-nif' => 'Organisation NIF:',
        'app-organisation-nif-desc' => 'This is the NIF of your organisation. Make sure that you type it correctly.',

        'app-organisation-cfe-recto' => 'Photo CFE recto:',
        'app-organisation-cfe-verso' => 'Photo CFE verso:',
        'app-create-submit' => 'Create the application',

        'app-carriers' => "Gsm mobile money",
        'app-carriers-description' => "Pick the mobile money carriers from which you'd like to accept payments from.",
    ],

    'app' => [
        'list' => [
            'title' => "Applications list",
            'section' => "Applications list",
            'table-app-name' => "App name",
            'table-members' => "Members",
            'table-date' => "Created at",
            'table-state' => "State",
            'table-action' => "Action",
            'table-details' => "Details",
        ],

        'show' => [
            'title' => "Application's details",
            'section' => "Application's details",

            'app-deactivated' => "The apllication is now deactivated",
            'app-activated' => "The apllication is now activated",
            'app-rejected' => "The apllication is now rejected",

            'tab-infos' => "Infos",
            'tab-members' => "Members",
            'tab-carriers' => "Carriers",
            'tab-payments' => "Payments",

            'infos-field' => "Field",
            'infos-details' => "Value",
            'infos-app-name' => "Applications's name",
            'infos-app-icon' => "App icon",
            'infos-website' => "Website",
            'infos-webhook' => "Webhook url",
            'infos-organization' => "Organization",
            'infos-cfe' => "Cfe Document",
            'infos-nif' => "N.I.F",

            'infos-activate-btn' => "Activate",
            'infos-deactivate-btn' => "Deactivate",
            'infos-reject-btn' => "Reject",

            'payments-credit-operation-title' => "Credit operations",
            'payments-debit-operation-title' => "Debit operations",
            'payments-operation-amount' => "Amount",
            'payments-operation-created-at' => "Created at",
            'payments-operation-state' => "State",
            'payments-operation-details' => "Details",

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
            'title' => 'Member details',
            'section-title' => 'Member details',
            'name' => 'Name:',
            'email' => 'Email:',
            'invited_at' => 'Added the:',
            'state' => 'State:',
            'role' => 'Role:',

            'resend-invite' => 'Resend invitation email',

            'actions-title' => 'Actions',
            'access-title' => "Change member's role",
            'access-description' => "To change the access rights of <b>:email</b>, select the role and save the modification.",
            'access-btn' => 'Save',
            'change-role-success' => "Change of access rights successful",
            'cannot-change-admin-role' => "You can not change another <b>admin</b> role.",

            'deactivate-title' => "Deactivate user",
            'deactivate-description' => 'You are about to deactivate <b>:email</b>, please proceed carefully.',
            'deactivate-btn' => 'Deactivate',

            'activate-title' => "Reactivate user",
            'activate-description' => 'You are about to reactivate <b>:email</b>',
            'activate-btn' => 'Activate',
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

            'app-webhook-title' => 'Application webhook',
            'app-webhook-description' => 'Set the webhook of your application, it must be',
            'app-webhook-https' => 'https',
            'app-webhook-update-button' => 'Update the webhook url',
            'update-webhook-success' => "Webhook updated",

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
