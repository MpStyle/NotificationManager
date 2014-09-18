<?php
namespace MToolkit\Controller\Web;

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

require_once __DIR__ . '/../MAbstractWebController.php';
require_once __DIR__ . '/../MAbstractViewController.php';
require_once __DIR__ . '/../Model/MAbstractDataModel.php';

use MToolkit\Controller\MAbstractWebController;
use MToolkit\Controller\MAbstractViewController;
use MToolkit\Model\MAbstractDataModel;

class MAbstractListController extends MAbstractWebController
{
    /**
     * @var MAbstractDataModel
     */
    private $model=null;
    
    /**
     * @param string $tagName
     * @param \MToolkit\Controller\MAbstractViewController $parent
     */
    public function __construct( $tagName, MAbstractViewController $parent = null )
    {
        parent::__construct( $tagName, $parent );
    }
    
    /**
     * @return MAbstractDataModel
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param \MToolkit\Model\MAbstractDataModel $model
     * @return \MToolkit\Controller\Web\MAbstractListController
     */
    public function setModel( MAbstractDataModel $model )
    {
        $this->model = $model;
        return $this;
    }
}
