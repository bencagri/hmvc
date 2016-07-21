<?php
/**
 * Routing config
 *
 *  Sample Basic Routing
 *  1- If you use module's controller for routing;
 *
 *      '/foo/(:any)' => 'bar/baz/index'
 *
 *      This means; siteurl.com/foo/234 loads modules => bar, controller => baz, method => index
 *
 *  2- If you are using app/controllers
 *
 *      '/foo/baz' => 'bar/baz'
 *
 *      This means; siteurl.com/foo/baz loads app/controllers => bar, method => baz
 *
 */


$config['route'] = [
    '/user/(:any)/' =>  'routed@routed@test', //sample routed

    '/api/'         =>  'actions@actions@index',
    '/api/post/'    =>  'actions@actions@add',
    '/api/update/'  =>  'actions@actions@update',
    '/api/delete/'  =>  'actions@actions@delete',
];