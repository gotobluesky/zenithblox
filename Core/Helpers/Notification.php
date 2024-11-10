<?php

use Brian2694\Toastr\Facades\Toastr;


if (!function_exists('toastNotification')) {
    /**
     * Set toast message
     *
     * @param String $type
     * @param String $message
     * @param String $header
     * @return void
     */
    function toastNotification($type, $message, $header = null)
    {
        Toastr::$type(translate($message), $header);
    }
}
