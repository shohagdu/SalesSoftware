<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Dhaka");
$time =  Date('Y-m-d h:i:s');

$active_group = 'default';
$query_builder = TRUE;


$db['default'] = array(
    'dsn'	=> '',
    'hostname' => 'localhost',
    'username' => 'root',
	'password' => 'zaq123',
	'database' => 'red_green_bazzar_db',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'development'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
