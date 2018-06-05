<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('tcpdf'))
{
    function tcpdf()
    {
        require_once('tcpdf/tcpdf.php');
    }
}