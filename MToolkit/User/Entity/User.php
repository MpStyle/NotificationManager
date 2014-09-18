<?php

namespace MToolkit\User\Entity;

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


class User
{
    /**
     * @var int
     */
    public $UserId = null;

    /**
     * @var string
     */
    public $Email = null;

    /**
     * @var string
     */
    public $Password = null;

    /**
     * @var string
     */
    public $CreateDate = null;

    /**
     * @var string
     */
    public $LastLoginDate = null;

    /**
     * @var string
     */
    public $LastPasswordChangeDate = null;

    /**
     * @var string
     */
    public $Comment = null;

    /**
     * @var boolean
     */
    public $IsLockedOut = null;

    /**
     * @var boolean
     */
    public $IsEnabled = null;

    /**
     * @var int
     */
    public $FailedPasswordAttemptCount = null;

    /**
     * @var string
     */
    public $Username = null;

    /**
     * @var string
     */
    public $LowerUsername = null;

}
