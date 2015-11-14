<?php
/* @var $this Web\Views\Pagination */
?>
<ul class="pagination">
    <?php if( $this->showFirst() ): ?>
        <li class="first" title="First">
            <a href="?<?php echo $this->getQueryString() ?>page=0">
                First
            </a>
        </li>
    <?php endif; ?>

    <?php if( $this->showPrevious() ): ?>
        <li class="previous" title="Previous">
            <a href="?<?php echo $this->getQueryString() ?>page=<?php echo $this->getCurrentPage()-1 ?>">
                &laquo;
            </a>
        </li>
    <?php endif; ?>

    <?php for( $i = $this->getStartFrom(); $i<$this->getEndTo(); $i++ ): ?>
        <li class="<?php echo ($this->getCurrentPage()==$i ? "active" : "") ?>">
            <a href="?<?php echo $this->getQueryString() ?>page=<?php echo $i ?>">
                <?php echo $i+1 ?>
            </a>
        </li>
    <?php endfor; ?>

    <?php if( $this->showNext() ): ?>
        <li class="next" title="Next">
            <a href="?<?php echo $this->getQueryString() ?>page=<?php echo $this->getCurrentPage()+1 ?>">
                &raquo;
            </a>
        </li>
    <?php endif; ?>

    <?php if( $this->showLast() ): ?>
        <li class="last" title="Last">
            <a href="?<?php echo $this->getQueryString() ?>page=<?php echo $this->getPageCount()-1 ?>">
                Last
            </a>
        </li>
    <?php endif; ?>
</ul>