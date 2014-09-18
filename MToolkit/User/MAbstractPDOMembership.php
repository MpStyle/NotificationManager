<?php

namespace User;

/*
 * This file is part of MToolkit.
 *
 * MToolkit is free software: you can redistribute it and/or modify
 * it under the terms of the LGNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * MToolkit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * LGNU Lesser General Public License for more details.
 *
 * You should have received a copy of the LGNU Lesser General Public License
 * along with MToolkit.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * @author  Michele Pagnin
 */


abstract class MAbstractPDOMembership
{
    /**
     * @var \PDO
     */
    private $connection = null;

    /**
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return \PDO
     */
    protected function getConnection()
    {
        return $this->connection;
    }

    // - Action
    /**
     * @param string $name
     * @param string $description
     * @param string|null $applicationName
     * @return int RoleId field
     */
    public abstract function addRole($name, $description = null, $applicationName = null);

    /**
     * @param int $id
     * @param string $name
     * @param string|null $description
     * @param string|null $applicationName
     * @return boolean
     */
    public abstract function EditRole($id, $name, $description = null, $applicationName = null);

    /**
     * @param int $id
     */
    public abstract function DeleteRole($id);

    /**
     * @param int $id
     * @param string $nameLike
     */
    public abstract function GetRoles($id = null, $nameLike = null);

    /**
     * @param string $name
     * @param string $description
     * @param string|null $applicationName
     * @return int ApplicationId field
     */
    public abstract function AddApplication($name, $description = null);

    /**
     * @param int $id
     * @param string $name
     * @param string|null $description
     * @return boolean
     */
    public abstract function EditApplication($id, $name, $description = null);

    /**
     * @param int $id
     */
    public abstract function DeleteApplication($id);

    /**
     * @param int $id
     * @param string $nameLike
     */
    public abstract function GetApplications($id = null, $nameLike = null);

    /**
     * @param string $username 
     * @param string $password 
     * @param int $failedPasswordAttemptCount 
     * @param string $comment 
     * @param string $applicationName
     * @return int
     */
    public abstract function AddUser($username, $password, $failedPasswordAttemptCount = -1, $comment = '', $applicationName = null);

    /**
     * @param int $id
     * @param string $username 
     * @param string $password 
     * @param int $failedPasswordAttemptCount 
     * @param string $comment 
     * @param string $applicationName
     */
    public abstract function EditUser($id, $username, $password, $failedPasswordAttemptCount = -1, $comment = '', $applicationName = null);

    /**
     * @param int $id
     */
    public abstract function DeleteUser($id);

    /**
     * @param int $id
     * @param string $usernameLike
     */
    public abstract function GetUsers($id = null, $usernameLike = null);

    /**
     * @param string $username
     * @param string $password
     */
    public abstract function Login($username, $password);

    /**
     * @param string $oldPassword
     * @param string $newPassword
     * @param string $confirmNewPassword
     */
    public abstract function ResetPassword($oldPassword, $newPassword, $confirmNewPassword);

    /**
     * @param int $id
     */
    public abstract function UnlockUser($id);

    /**
     * @param int $id
     */
    public abstract function LockUser($id);

    /**
     * @param int $id
     */
    public abstract function EnableUser($id);

    /**
     * @param int $id
     */
    public abstract function DisableUser($id);
}
