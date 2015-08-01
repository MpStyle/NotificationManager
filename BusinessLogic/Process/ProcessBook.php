<?php

namespace BusinessLogic\Process;

final class ProcessBook
{
    public static function getNewProcessId()
    {
        return uniqid( "nm_", true );
    }
}
