<?php
if( !defined( 'WP_UNINSTALL_PLUGIN' ) ){
    die;
}

delete_option( 'customframes-border-options' );
delete_option( 'customframes-shadow-options' );
delete_option( 'customframes-caption-options' );