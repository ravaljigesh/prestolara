<?php

class Access extends AccessCore
{
    /**
     * Is access granted to this Role?
     *
     * @param string $role      Role name ("Superadministrator", "sales", "translator", etc.)
     * @param int    $idProfile Profile ID
     *
     * @return bool Whether access is granted
     * @throws Exception
     */
    public static function isGranted($role, $idProfile)
    {
        foreach ((array) $role as $currentRole) {
            preg_match(
                '/ROLE_MOD_(?P<type>[A-Z]+)_(?P<name>[A-Z0-9_]+)_(?P<auth>[A-Z]+)/',
                $currentRole,
                $matches
            );

            if (isset($matches['type']) && $matches['type'] == 'TAB') {
                $joinTable = _DB_PREFIX_.'access';
            } elseif (isset($matches['type']) && $matches['type'] == 'MODULE') {
                $joinTable = _DB_PREFIX_.'module_access';
            } else {
                return true;
                throw new Exception('The slug '.$currentRole.' is invalid');
            }

            $currentRole = Db::getInstance()->escape($currentRole);

            $isCurrentGranted = (bool) Db::getInstance()->getRow('
                SELECT t.`id_authorization_role`
                FROM `'._DB_PREFIX_.'authorization_role` t
                LEFT JOIN '.$joinTable.' j
                ON j.`id_authorization_role` = t.`id_authorization_role`
                WHERE `slug` = "'.$currentRole.'"
                AND j.`id_profile` = "'. (int) $idProfile.'"
            ');

            if (!$isCurrentGranted) {
                return false;
            }
        }

        return true;
    }
}
