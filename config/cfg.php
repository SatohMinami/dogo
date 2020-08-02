<?php
/**
 * @author Keiyo.
 * @Date: 5/30/2017
 * @Time: 8:00 AM
 */
return [
    /*
      |--------------------------------------------------------------------------
      | Application Running Server;
      |--------------------------------------------------------------------------
      |
      | This value determines the "server" your application is currently
      | running in. This may determine how you prefer to configure various
      | services your application utilizes. Set this in your ".env" file.
      | Default : windows Server;
      | Value : windows, linux;
      |
     */
    'server' => env('SERVER', 'windows'),
    /*
     |--------------------------------------------------------------------------
     | Base path root acccess filename;
     |--------------------------------------------------------------------------
    */
    'root_path_file' => env('ROOT_PATH_FILE', 'http://karte.dev/'),

    /*
     |--------------------------------------------------------------------------
     | Domain_IP Access files;
     |--------------------------------------------------------------------------
    */
    'domain_ip' => env('APP_DOMAIN_IP', '127.0.0.1'),

    /*
     |--------------------------------------------------------------------------
     | CONFIG SERVICE ORCA
     |--------------------------------------------------------------------------
     | Default Service Orca
     | service : http://40.74.138.5:8000
     | username : ormaster
     | password : xxg9d3g!
     |--------------------------------------------------------------------------
    */
    'orca' => [
        'host' => env('ORCA_HOST', 'http://40.74.138.5'),
        'port' => env('ORCA_PORT', '8000'),
        'user' => env('ORCA_USER', 'ormaster'),
        'pass' => env('ORCA_PASS', 'xxg9d3g!'),
        'dir_log' => env('ORDER_RESPONSE_FOLDER'),
    ],

    /*
     |--------------------------------------------------------------------------
     | DIRECTORY IMAGE;
     |--------------------------------------------------------------------------
    */
    'directory'             => env('DIRECTORY', 'C:/scanviewerdat/画像'),
    'directory_tmp'         => env('DIRECTORY_TMP', 'C:/scanviewerdat/tmp画像'),
    'directory_kv'          => env('DIRECTORY_KV', 'C:/scanviewerdat/default'),
    'directory_cache'       => env('DIRECTORY_CACHE', 'C:/scanviewerdat/default'),
    'directory_stamp'       => env('DIRECTORY_STAMP', 'C:/scanviewerdat/default'),
    'directory_template'    => env('DIRECTORY_TEMPLATE', 'C:/scanviewerdat/default'),
    'directory_kensa'       => env('DIRECTORY_KENSA', 'C:/scanviewerdat/default'),
    'directory_evacuation'  => env('DIRECTORY_EVACUATION', 'C:/scanviewerdat/退避'),
    'kv_kubuntxt'           => env('KV_KUBUNTXT', 'C:/scanviewerdat/default'),
    'tensu_disp_flag'       => env('TENSU_DISP_FLAG', '0'),

    'taincode_import_csv_path'  => env('TANICD_MST_FILEPATH'),  // config('config.taincode_import_csv_path')
    'sry_kbn_import_csv_path'   => env('SRY_KBN_MST_FILEPATH') , // config('config.taincode_import_csv_path')
    'sry_shu_import_csv_path'   => env('SRY_SHUKBN_MST_FILEPATH'),  // config('config.taincode_import_csv_path')
    'BYOREKI_ASC' => env('BYOREKI_ASC'),
    'BYOREKI_SYUBYOMEI_TOP' => env('BYOREKI_SYUBYOMEI_TOP'),
    /*KEI_118*/
    'ORCA_KIND' => env('ORCA_KIND', 0),
    'CA_CERT' => env('CA_CERT'),
    'CERT' => env('CERT'),
    'CERT_KEY' => env('CERT_KEY'),
    'PASSPHRASE' => env('PASSPHRASE'),
    /*KEI_118*/

    /*KEI-265*/
    'SHINRYOKA_DISP_FLAG' =>env('SHINRYOKA_DISP_FLAG', 0),
    'ISHIMEI_DISP_FLAG' =>env('ISHIMEI_DISP_FLAG', 0),
     /*KEI-265*/
];
