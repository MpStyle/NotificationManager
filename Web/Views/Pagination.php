<?php

namespace Web\Views;

use MToolkit\Controller\MAbstractViewController;

class Pagination extends MAbstractViewController
{
    private $range = 5;
    private $pageCount;

    /**
     * The constructor requires the total page count.
     * 
     * @param int $pageCount
     * @param MAbstractViewController $parent
     */
    public function __construct( $pageCount, MAbstractViewController $parent = null )
    {
        parent::__construct( __DIR__ . '/Pagination.view.php', $parent );
        $this->pageCount = $pageCount;
    }

    public function getStartFrom()
    {
        $startFrom = $this->getCurrentPage()-$this->range;
        if( $startFrom<0 )
        {
            $startFrom = 0;
        }

        return $startFrom;
    }

    public function getEndTo()
    {
        $endTo = $this->getCurrentPage()+$this->range;
        if( $endTo>$this->pageCount )
        {
            $endTo = $this->pageCount;
        }

        return $endTo;
    }

    public function getQueryString()
    {
        //echo $_SERVER['QUERY_STRING'];
        $queryString = $_SERVER['QUERY_STRING'];
        if( \MToolkit\Core\MString::isNullOrEmpty( $queryString ) )
        {
            return "";
        }

        return ($queryString . "&");
    }

    public function getCurrentPage()
    {
        $currentPage = $this->getGet()->getValue( "page" )==null ? 0 : (int) $this->getGet()->getValue( "page" );
        return $currentPage;
    }

    public function showFirst()
    {
        if( $this->getStartFrom()==0 )
        {
            return false;
        }

        return true;
    }

    public function showPrevious()
    {
        if( $this->getCurrentPage()<=0 )
        {
            return false;
        }

        return true;
    }

    public function showNext()
    {
        if( $this->getCurrentPage()>=$this->pageCount-1 )
        {
            return false;
        }

        return true;
    }

    public function showLast()
    {
        if( $this->getEndTo()==$this->pageCount )
        {
            return false;
        }

        return true;
    }

    /**
     * Returne the total page count
     * 
     * @return int
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }

}
