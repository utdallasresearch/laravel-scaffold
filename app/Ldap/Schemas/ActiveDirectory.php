<?php

namespace App\Ldap\Schemas;

use \Adldap\Schemas\ActiveDirectory as AdldapActiveDirectory;

/**
 * Class ActiveDirectory.
 *
 * The active directory attribute schema for easy auto completion retrieval.
 */
class ActiveDirectory extends AdldapActiveDirectory
{
    /**
     * Get the name of an LDAP attribute for a local User attribute
     *
     * @param string $attribute
     * @param string $default
     * @return string
     */
    public function configNameFor($attribute, $default = null)
    {
        return config('adldap_sync.attributes')[$attribute] ?? $default ?? $attribute;
    }

    /**
     * Get the name of the LDAP attribute used for login
     *
     * @return string
     */
    public function loginName()
    {
        return config('adldap_auth.usernames.ldap', 'samaccountname');
    }

    /**
     * {@inheritdoc}
     */
    public function accountName()
    {
        return $this->configNameFor('name', 'sammacountname');
    }

    /**
     * {@inheritdoc}
     */
    public function department()
    {
        return $this->configNameFor('department');
    }

    /**
     * {@inheritdoc}
     */
    public function displayName()
    {
        return $this->configNameFor('display_name', 'displaynameprintable');
    }

    /**
     * {@inheritdoc}
     */
    public function firstName()
    {
        return $this->configNameFor('firstname', 'givenname');
    }

    /**
     * {@inheritdoc}
     */
    public function lastName()
    {
        return $this->configNameFor('lastname', 'sn');
    }

    /**
     * {@inheritdoc}
     */
    public function email()
    {
        return $this->configNameFor('email', 'mail');
    }

    /**
     * {@inheritdoc}
     */
    public function emailNickname()
    {
        return $this->configNameFor('pea', 'mailnickname');
    }

    /**
     * {@inheritdoc}
     */
    public function title()
    {
        return $this->configNameFor('title');
    }

    /**
     * {@inheritdoc}
     */
    public function college()
    {
        return $this->configNameFor('college', 'school');
    }

    /**
     * {@inheritdoc}
     */
    public function employeeNumber()
    {
        return 'name';
    }
}
