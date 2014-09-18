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


require_once __DIR__ . '/MAbstractPDOMembership.php';
require_once __DIR__ . '/../Model/Sql/MPDOQuery.php';
require_once __DIR__ . '/../Core/MDataType.php';

use MToolkit\Model\Sql\MPDOQuery;
use MToolkit\Core\MDataType;

class MMySQLMembership extends MAbstractPDOMembership
{

    /**
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        parent::__construct($connection);
    }

    /**
     * Creates a new application and returns its ID.
     * 
     * @param string $name
     * @param string $description
     * @return null|int
     */
    public function addApplication($name, $description = null)
    {
        MDataType::mustBeString($name);
        MDataType::mustBeNullableString($description);

        $query = "CALL mtoolkit_AddApplication(?, ?)";


        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($name);
        $sql->bindValue($description);

        $sql->exec();

        $result = $sql->getResult();

        if ($result->rowCount() <= 0)
        {
            return null;
        }

        return $result->getData(0, 'ApplicationId');
    }

    /**
     * Creates a new user and returns the ID.
     * 
     * @param string $username
     * @param string $password
     * @param string|null $email
     * @param string|null $comment
     * @param int|null $applicationId
     * @return int|null
     */
    public function addUser($username, $password, $email = null, $comment = null, $applicationId = null)
    {
        MDataType::mustBeString($username);
        MDataType::mustBeString($password);
        MDataType::mustBeNullableString($email);
        MDataType::mustBeNullableString($comment);
        MDataType::mustBeNullableInt($applicationId);

        $query = "CALL mtoolkit_AddUser(?, ?, ?, ?, ?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($username);
        $sql->bindValue($password);
        $sql->bindValue($email);
        $sql->bindValue($comment);
        $sql->bindValue($applicationId);

        $sql->exec();

        $result = $sql->getResult();

        if ($result->rowCount() <= 0)
        {
            return null;
        }

        return $result->getData(0, 'UserId');
    }

    /**
     * Deletes the application and returns how many applications will be removed.
     * 
     * @param int $applicationId
     * @return int
     */
    public function deleteApplication($applicationId)
    {
        MDataType::mustBeInt($applicationId);

        $query = "CALL mtoolkit_DeleteApplication(?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($applicationId);

        $sql->exec();

        $result = $sql->getResult();

        return $result->rowCount();
    }

    /**
     * Deletes the role and returns how many roles will be removed.
     * 
     * @param type $roleId
     * @return type
     */
    public function deleteRole($roleId)
    {
        MDataType::mustBeInt($roleId);

        $query = "CALL mtoolkit_DeleteRole(?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($roleId);

        $sql->exec();

        $result = $sql->getResult();

        return $result->rowCount();
    }

    /**
     * Deletes the user and returns how many users will be removed.
     * 
     * @param int $userId
     * @return int
     */
    public function deleteUser($userId)
    {
        MDataType::mustBeInt($userId);

        $query = "CALL mtoolkit_DeleteUser(?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($userId);

        $sql->exec();

        $result = $sql->getResult();

        return $result->rowCount();
    }

    /**
     * Disables the user.
     * 
     * @param int $userId
     * @return boolean
     */
    public function disableUser($userId)
    {
        MDataType::mustBeInt($userId);

        $query = "CALL mtoolkit_DisableUser(?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($userId);

        $sql->exec();

        $result = $sql->getResult();

        return ( $result->rowCount() > 0 );
    }

    /**
     * Updates the application.
     * 
     * @param int $id
     * @param string $name
     * @param string|null $description
     * @return boolean
     */
    public function editApplication($id, $name, $description = null)
    {
        MDataType::mustBeInt($id);
        MDataType::mustBeString($name);
        MDataType::mustBeNullableString($description);

        $query = "CALL mtoolkit_EditApplication(?, ?, ?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($id);
        $sql->bindValue($name);
        $sql->bindValue($description);

        $sql->exec();

        $result = $sql->getResult();

        return ( $result->rowCount() > 0 );
    }

    /**
     * Updates the role.
     * 
     * @param int $id
     * @param string $name
     * @param string|null $description
     * @param int|null $applicationName
     * @return boolean
     */
    public function editRole($id, $name, $description = null, $applicationName = null)
    {
        MDataType::mustBeInt($id);
        MDataType::mustBeString($name);
        MDataType::mustBeNullableString($description);
        MDataType::mustBeNullableString($applicationName);

        $query = "CALL mtoolkit_EditRole(?, ?, ?, ?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($id);
        $sql->bindValue($name);
        $sql->bindValue($description);
        $sql->bindValue($applicationName);

        $sql->exec();

        $result = $sql->getResult();

        return ( $result->rowCount() > 0 );
    }

    /**
     * Updates the user.
     * 
     * @param int $id
     * @param string $username
     * @param string $password
     * @param string|null $email
     * @param string|null $comment
     * @param int|null $applicationId
     * @return boolean
     */
    public function editUser($id, $username, $password, $email = null, $comment = null, $applicationId = null)
    {
        MDataType::mustBeInt($id);
        MDataType::mustBeString($username);
        MDataType::mustBeString($password);
        MDataType::mustBeNullableString($email);
        MDataType::mustBeNullableString($comment);
        MDataType::mustBeNullableInt($applicationId);

        $query = "CALL mtoolkit_EditUser(?, ?, ?, ?, ?, ?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($id);
        $sql->bindValue($username);
        $sql->bindValue($password);
        $sql->bindValue($email);
        $sql->bindValue($comment);
        $sql->bindValue($applicationId);

        $sql->exec();

        $result = $sql->getResult();

        return ( $result->rowCount() > 0 );
    }

    /**
     * Enables user.
     * 
     * @param int $userId
     * @return boolean
     */
    public function enableUser($userId)
    {
        MDataType::mustBeInt($userId);

        $query = "CALL mtoolkit_EnableUser(?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($userId);

        $sql->exec();

        $result = $sql->getResult();

        return ( $result->rowCount() > 0 );
    }

    /**
     * Returns the applications.
     * 
     * @param int|null $userId
     * @param string|null $nameLike
     * @return \MToolkit\Core\MList<\MToolkit\User\Entity\Application>
     */
    public function getApplications($userId = null, $nameLike = null)
    {
        MDataType::mustBeNullableInt($userId);
        MDataType::mustBeNullableString($nameLike);

        $query = "CALL mtoolkit_GetApplications(?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($userId);
        $sql->bindValue($nameLike);

        $sql->exec();

        $result = $sql->getResult();
        $result->setClassName("MToolkit\User\Entity\Application");

        return $result;
    }

    /**
     * Returns the roles.
     * 
     * @param int|null $id
     * @param string|null $nameLike
     * @param int|null $applicationId
     * @return \MToolkit\Core\MList<\MToolkit\User\Entity\Role>
     */
    public function getRoles($id = null, $nameLike = null, $applicationId = null)
    {
        MDataType::mustBeNullableInt($id);
        MDataType::mustBeNullableString($nameLike);
        MDataType::mustBeNullableInt($applicationId);

        $query = "CALL mtoolkit_GetRoles(?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($id);
        $sql->bindValue($nameLike);
        $sql->bindValue($applicationId);

        $sql->exec();

        $result = $sql->getResult();
        $result->setClassName("MToolkit\User\Entity\Role");

        return $result;
    }

    /**
     * Returns the users.
     * 
     * @param int|null $id
     * @param string|null $usernameLike
     * @param int|null $applicationId
     * @return \MToolkit\Core\MList<\MToolkit\User\Entity\User>
     */
    public function getUsers($id = null, $usernameLike = null, $applicationId = null)
    {
        MDataType::mustBeNullableInt($id);
        MDataType::mustBeNullableString($usernameLike);
        MDataType::mustBeNullableInt($applicationId);

        $query = "CALL mtoolkit_GetUsers(?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($id);
        $sql->bindValue($usernameLike);
        $sql->bindValue($applicationId);

        $sql->exec();

        $result = $sql->getResult();
        $result->setClassName("MToolkit\User\Entity\User");

        return $result;
    }

    public function lockUser($userId)
    {
        MDataType::mustBeInt($userId);

        $query = "CALL mtoolkit_LockUser(?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($userId);

        $sql->exec();

        $result = $sql->getResult();

        return ( $result->rowCount() > 0 );
    }

    /**
     * Tries a login.
     * 
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function login($username, $password)
    {
        MDataType::mustBeString($username);
        MDataType::mustBeString($password);

        $query = "CALL mtoolkit_Login(?, ?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($username);
        $sql->bindValue($password);

        $sql->exec();

        $result = $sql->getResult();

        return ($result->getData(0, 'Result') == 1);
    }

    /**
     * Resets the password.
     * 
     * @param string $oldPassword
     * @param string $newPassword
     * @param string $confirmNewPassword
     * @return boolean
     */
    public function resetPassword($oldPassword, $newPassword, $confirmNewPassword)
    {
        MDataType::mustBeString($oldPassword);
        MDataType::mustBeString($newPassword);
        MDataType::mustBeString($confirmNewPassword);

        $query = "CALL mtoolkit_ResetPassword(?, ?, ?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($oldPassword);
        $sql->bindValue($newPassword);
        $sql->bindValue($confirmNewPassword);

        $sql->exec();

        $result = $sql->getResult();

        return ($result->getData(0, 'Result') == 1);
    }

    public function unlockUser($userId)
    {
        MDataType::mustBeInt($userId);

        $query = "CALL mtoolkit_UnlockUser(?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($userId);

        $sql->exec();

        $result = $sql->getResult();

        return ( $result->rowCount() > 0 );
    }

    /**
     * Assigns a role to an user.
     * 
     * @param int $userId
     * @param int $roleId
     * @return int
     */
    public function addUserToRole($userId, $roleId)
    {
        MDataType::mustBeInt($userId);
        MDataType::mustBeInt($roleId);

        $query = "CALL mtoolkit_AddUserToRole(?, ?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($userId);
        $sql->bindValue($roleId);

        $sql->exec();

        $result = $sql->getResult();

        return $result->rowCount();
    }

    /**
     * Adds a new role and returns its ID
     * 
     * @param string $name
     * @param string|null $description
     * @param string|null $applicationId
     * @return null|int
     */
    public function addRole($name, $description = null, $applicationId = null)
    {
        MDataType::mustBeString($name);
        MDataType::mustBeNullableString($description);
        MDataType::mustBeNullableInt($applicationId);

        $query = "CALL mtoolkit_AddRole(?, ?, ?)";
        $sql = new MPDOQuery($query, $this->getConnection());

        $sql->bindValue($name);
        $sql->bindValue($description);
        $sql->bindValue($applicationId);

        $sql->exec();

        $result = $sql->getResult();

        if ($result->rowCount() <= 0)
        {
            return null;
        }

        return $result->getData(0, 'RoleId');
    }

}
