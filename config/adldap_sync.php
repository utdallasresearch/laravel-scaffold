<?php

/**
 * App-specific LDAP Attribute and property syncing settings.
 *
 * Note: This is not part of the adldap2/adldap2-laravel package.
 * It is specific to this application.
 */

return [

    /**
     * Mapping of attributes to sync from LDAP to the User record.
     *
     * Format: ['user model attribute' => 'ldap attribute']
     */
    'attributes' => [
        'name'          => 'samaccountname',
        'display_name'  => 'displaynameprintable',
        'college'       => 'college',
        'department'    => 'department',
        'firstname'     => 'givenname',
        'lastname'      => 'sn',
        'email'         => 'mail',
        'title'         => 'title',
        'pea'           => 'mail',
    ],

    /**
     * Default email domain to use for accounts.
     *
     */
    'email_domain' => env('DEFAULT_EMAIL_DOMAIN', '@example.com'),

];
