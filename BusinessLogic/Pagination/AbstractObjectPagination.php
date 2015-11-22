<?php

namespace BusinessLogic\Pagination;

abstract class AbstractObjectPagination
{
    private $list;
    private $pageCount;
    private $count;
    
    public function getPageCount()
    {
        return $this->pageCount;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function setPageCount( $pageCount )
    {
        $this->pageCount = $pageCount;
        return $this;
    }

    public function setCount( $count )
    {
        $this->count = $count;
        return $this;
    }

    public function getList()
    {
        return $this->list;
    }

    public function setList( $list )
    {
        $this->list = $list;
        return $this;
    }

}
