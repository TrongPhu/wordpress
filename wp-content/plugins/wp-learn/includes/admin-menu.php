<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function add_admin_menu(){
    add_menu_page(
            'Plugin Options',
            'Plugin Options',
            'manage_options',
            'plugin-options',
            'show_plugin_options',
            '',
            '2'
            );
}

function show_plugin_options(){
    echo '<h1 style="text-align:center;">Đây là trang Plugin Options</h1>';
}

add_action('admin_menu','add_admin_menu');


function add_admin_submenu(){
    add_submenu_page(
            'plugin-options',
            'General Settings',
            'General Settings',
            'manage_options',
            'plugin-options-general-settings',
            'show_general_setting_page'
            );
    
    add_submenu_page(
            'plugin-options',
            'Advanced Settings',
            'Advanced Settings',
            'manage_options',
            'plugin-options-advanced-settings',
            'show_advanced_setting_page'
            );
}

function show_general_setting_page(){

    if(!empty($_POST['save-general-info'])){
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];

        update_option('username', $username);
        update_option('first_name', $first_name);
        update_option('last_name', $last_name);
    }

    $username = get_option('username');
    $first_name = get_option('first_name');
    $last_name = get_option('last_name');

    require('template/general-setting.php');
}

function show_advanced_setting_page(){

    if(!isset($_POST['save-advanced-info'])){

        $national = $_POST['national'];
        $city = $_POST['city'];
        $district = $_POST['district'];
        $zip = $_POST['zip'];

        update_option('national', $national);
        update_option('city', $city);
        update_option('district', $district);
        update_option('zip', $zip);
    }

    $national = get_option('national');
    $city = get_option('city');
    $district = get_option('district');
    $zip = get_option('zip');

    require('template/advanced-setting.php');
}

add_action('admin_menu', 'add_admin_submenu');