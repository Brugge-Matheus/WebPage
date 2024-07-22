<?php

function setFlash($index, $message)
{

    if (!isset($_SESSION['flash'][$index])) {

        $_SESSION['flash'][$index] = $message;
    }
}

function getFlash($index, $style = 'danger')
{
    if (isset($_SESSION['flash'][$index])) {

        $flash = $_SESSION['flash'][$index];

        unset($_SESSION['flash'][$index]);

        // return "<span style='$style'>$flash</span>";

        return "<div class='alert alert-{$style}' role='alert'>$flash</div>";
    }
}