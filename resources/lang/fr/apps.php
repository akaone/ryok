<?php

return [

    'index' => [
        'title' => 'Stats',
    ],

    'create' => [
        'title' => 'Nouvelle app',
        'section-title' => 'Nouvelle application',
        'app-infos' => "Informations de l'application",
        'loading' => 'Chargement...',

        'app-name' => "Nom de l'application:",
        'app-name-desc' => "Ceci est le nom de votre application qui serra affiche a vos clients. Assurez-vous de le saisir correctement.",

        'app-siteweb' => 'Lien site web:',
        'app-siteweb-desc' => "Il s'agit de l'URL de votre site Web, elle sera fournie à vos clients pour vérifier votre identité.",

        'app-webhook' => "L'url callback",
        'app-webhook-desc' => "C'est l'url au lequel nous vous enverrons le résultat de vos demandes de paiement.",

        'app-legal-infos' => 'Documents legaux',

        'app-organisation-name' => 'Le nom de votre organuisation:',
        'app-organisation-name-desc' => "Il s'agit du nom de votre organisation",

        'app-organisation-nif' => 'Le NIF de votre organisation:',
        'app-organisation-nif-desc' => "Il s'agit du numero NIF de votre organisation. Assurez-vous de le saisir correctement.",

        'app-organisation-cfe-recto' => 'Photo CFE recto:',
        'app-organisation-cfe-verso' => 'Photo CFE verso:',
        'app-create-submit' => "Creer l'application",

        'app-carriers' => "Operateurs mobile money",
        'app-carriers-description' => "Veuillez choisir la liste des operateurs mobile money d'on vous souhaiterais recevoir des paiements.",
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

            'app-deactivated' => "L'apllication a ete desactive",
            'app-activated' => "L'apllication a ete active",
            'app-rejected' => "L'apllication a ete rejete",

            'tab-infos' => "Infos",
            'tab-members' => "Membres",
            'tab-carriers' => "Operateurs",
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

            'infos-activate-btn' => "Activer",
            'infos-deactivate-btn' => "Deactiver",
            'infos-reject-btn' => "Rejeter",

            'payments-credit-operation-title' => "Operations de credit",
            'payments-debit-operation-title' => "Operations de debit",
            'payments-operation-amount' => "Montant",
            'payments-operation-created-at' => "Date creation",
            'payments-operation-state' => "Etat",
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

            'app-keys-title' => "Clefs d'authentification",
            'development-keys-title' => 'Clefs de développement',
            'public-keys-label' => 'Clef publique',
            'secret-keys-label' => 'Clef secrete',
            'production-keys-title' => 'Clefs de de production',

            'app-webhook-title' => "Url webhook de l'application",
            'app-webhook-description' => "Configurer l'url webhook de votre application, il doit être en",
            'app-webhook-https' => 'https',
            'app-webhook-update-button' => "Mettre à jour l'url webhook",
            'update-webhook-success' => "Webhook mise à jour",

            'doc-create-payment-title' => 'Créer une demande de paiement',
            'doc-create-payment-description' => "Pour générer une demande de paiement à vos clients, vous devez demander un lien de paiement en utilisant votre clef secrete. Faites cette demande depuis votre backend pour eviter que votre clef secrete soit exposer à des personnes malveillantes.",
            'doc-create-payment-demo-title' => 'Voici un example de comment générer un lien de paiement:',

            'doc-create-payment-params' => 'Paramètres',
            'doc-create-payment-params-required' => 'requis',
            'doc-create-payment-params-secret-description' => "La clef secrete de votre application",
            'doc-create-payment-params-amount-description' => "Le montant que vous souhaiter que le client paie (en centime)",
            'doc-create-payment-params-currency-description' => "La devise du paiement",

            'doc-create-payment-responses' => 'Réponses',
            'doc-create-payment-request-url' => 'Lien de la requête',

            'doc-create-payment-code' => 'Example de code',
            'doc-api-status' => 'statut :number',
            'doc-api-create-payment-success' => 'Paiement crée',
            'doc-api-payment-id' => 'identifiant du paiement',
            'doc-api-payment-url' => 'lien de paiement',
            'doc-api-payment-live' => 'boolean montrant si le paiement est en mode live ou démo',
            'doc-api-app-not-activated' => "L'application marchande n'est pas activé",

            'doc-app-show-description' => "Après la generation d'un lien de paiement vous pouvez à tout moment consulter l'état du paiement",
            'doc-app-show-subtitle' => "Voici un example de comment vérifier le statut d'un paiement:",
            'doc-app-show-generated-payment-id' => "L' id de paiement généré précédemment",
            'doc-app-show-payment-found' => "Paiement trouvé",
            'doc-app-show-payment-not-found' => "Le paiement n'existe pas",
        ],
    ],

    'apps-settings' => [
        'index' => [
            'title' => "Settings",
            'carriers-title' => "Opérateurs",
            'carriers-description' => "Ci-dessous se trouve la liste de tous les pays que nous supportons. Selectionnez les pays d'on vous souhaiter accepter des paiements",
            'carriers-update-button' => "Mettre à jour",
            'carriers-update-success' => "Opérateurs mis à jour",

            'delete-section-title' => "Supprimer cette application",
            'delete-section-description' => "En supprimant cette application vous ne pourrais plus accepter de nouveau paiement pour cette application",
            'delete-section-button' => "Supprimer quand meme",
            'delete-confirm' => "Voulez vous vraiment supprimer cette application ?",
            'delete-confirm-button' => "Supprimer",
        ],
    ],

];
