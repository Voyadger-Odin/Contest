<?php

function GetStatusName($statusCode)
{
    switch ($statusCode) {
        case -1:
            return 'In process';
        case 0:
            return 'OK';
        case 1:
            return 'Runtime error';
        case 2:
            return 'Timeout error';
        case 3:
            return 'Wrong answer';
    }
    return $statusCode;
}
