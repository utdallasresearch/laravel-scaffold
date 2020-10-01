<?php

namespace App\Ldap\Handlers;

use Adldap\Models\User as LdapUser;
use App\Ldap\Schemas\ActiveDirectory as Schema;
use App\User;

class LdapAttributeHandler
{
    /** @var Schema the LDAP server schema */
    public $schema;

    /**
     * Sync things from an Ldap User to a local User.
     *
     * @param LdapUser  $ldapUser
     * @param User      $user
     */
    public function handle(LdapUser $ldap_user, User $user)
    {
        $this->schema = $ldap_user->getSchema();
        $this->syncUserAttributes($ldap_user, $user);
        $this->normalizeUserAttributes($ldap_user, $user);
        $user->save();
    }

    /**
     * Sync a sub-set of the user's ldap attributes to the User model.
     * 
     * @param  LdapUser $ldap_user
     * @param  User     $user
     */
    public function syncUserAttributes(LdapUser $ldap_user, User $user)
    {
        foreach ($this->getAttributeMap() as $user_attribute => $ldap_attribute) {
            if ($ldap_attribute_value = $ldap_user->getFirstAttribute($ldap_attribute)) {
                $user->$user_attribute = $ldap_attribute_value;
            }
        }
    }

    /**
     * Sets some important default attributes for ldap Users that don't have them set.
     * 
     * @param  LdapUser   $ldap_user
     * @param  User   $user
     * @return void
     */
    protected function normalizeUserAttributes(LdapUser $ldap_user, User $user)
    {
        // If they don't have a name, set it to their login name
        if (!$user->name) {
            $user->name = $ldap_user->getFirstAttribute($this->schema->loginName());
        }

        // If they don't have an email address, set it to name@domain.com
        if (!$user->email && $user->name) {
            $user->email = $user->name . $this->getEmailDomain();
        }

        // If they don't have a pea, set it to their name
        if (!$user->pea && $user->name) {
            $user->pea = $user->name;
        }

        // If they don't have a display_name, set it to their name
        if (!$user->display_name && $user->name) {
            $user->display_name = $user->name;
        }
    }

    /**
     * Get the mapping of User attribute to Ldap attribute
     * 
     * @return array : ['user attribute' => 'ldap attribute']
     */
    protected function getAttributeMap()
    {
        return config('adldap_sync.attributes', []);
    }

    /**
     * Get the default email domain to use if the user doesn't have
     * an email address specified.
     *
     * @return string
     */
    protected function getEmailDomain()
    {
        return config('adldap_sync.email_domain', '@example.com');
    }
}
