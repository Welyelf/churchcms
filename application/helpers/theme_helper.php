<?php defined('BASEPATH') OR exit('No direct script access allowed');

function get_template($name)
{
    $CI = &get_instance();
    $exempt = FALSE;

    if (in_array($name, array('head', 'foot'))) {

        if (file_exists(THEME_PATH . DS . $name . '.php')) {
            $CI->load->view(THEME . DS . $name . '.php');
        } elseif (file_exists(DEFAULT_THEME_PATH . DS . $name . '.php')) {
            $CI->load->view(DEFAULT_THEME . DS . $name . '.php');
        }

        $exempt = TRUE;
    }

    // Checks if a METHOD wide override exists on the CURRENT THEME
    if (file_exists(THEME_PATH . CONTROLLER . DS . METHOD . DS . $name . '.php')) {
        $CI->load->view(THEME . DS . CONTROLLER . DS . METHOD . DS . $name . '.php');
    } // Checks if a CONTROLLER wide override exists on the CURRENT THEME
    elseif (file_exists(THEME_PATH . DS . CONTROLLER . DS . $name . '.php')) {
        $CI->load->view(THEME . DS . CONTROLLER . DS . $name . '.php');
    } // Checks if a GLOBAL files exists on the CURRENT THEME
    elseif (file_exists(THEME_PATH . DS . $name . '.php') && $exempt == FALSE) {
        $CI->load->view(THEME . DS . $name . '.php');
    } // Checks if a METHOD wide override exists on the DEFAULT THEME
    elseif (file_exists(DEFAULT_THEME_PATH . CONTROLLER . DS . METHOD . DS . $name . '.php')) {
        $CI->load->view(DEFAULT_THEME . DS . CONTROLLER . DS . METHOD . DS . $name . '.php');
    } // Checks if a CONTROLLER wide override exists on the DEFAULT THEME
    elseif (file_exists(DEFAULT_THEME_PATH . CONTROLLER . DS . $name . '.php')) {
        $CI->load->view(DEFAULT_THEME . DS . CONTROLLER . DS . $name . '.php');
    } // Checks if a GLOBAL wide override exists on the DEFAULT THEME
    elseif (file_exists(DEFAULT_THEME_PATH . DS . $name . '.php') && $exempt == FALSE) {
        $CI->load->view(DEFAULT_THEME . DS . $name . '.php');
    }
}

function get_content()
{
    $CI = &get_instance();

    if (file_exists(THEME_PATH . CONTROLLER . DS . METHOD . '.php')) {
        $CI->load->view(THEME . DS . CONTROLLER . DS . METHOD);
    } elseif (file_exists(DEFAULT_THEME_PATH . CONTROLLER . DS . METHOD . '.php')) {
        $CI->load->view(DEFAULT_THEME . CONTROLLER . DS . METHOD);
    } elseif (file_exists(THEME_PATH . CONTROLLER . DS . 'page_content.php')) {
        $CI->load->view(THEME . DS . CONTROLLER . DS . 'page_content.php');
    } elseif (file_exists(DEFAULT_THEME_PATH . CONTROLLER . DS . 'page_content.php')) {
        $CI->load->view(DEFAULT_THEME . CONTROLLER . DS . 'page_content.php');
    }
}