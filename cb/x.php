<?php
/*
 * Cople x.js+x.php of working example of CORS code. Leon Rom, 2017
*/
    $f = fopen( './logX.txt', "w" );
    fwrite( $f, "started X: HTTP_ORIGIN=" . $_SERVER['HTTP_ORIGIN'] ."\n" );

    $http_origin = $_SERVER['HTTP_ORIGIN'];
    $urlp = parse_url($http_origin);
    $host = $urlp[host];
    fwrite( $f, "host==$host" . "\n" );

    $allowed_hosts = [              // from which  hosts  acces wil be allowed
        'romleon.rf.gd',
        'rombase.h1n.ru',
//      'rombase.kl.com.ua',        // PHP on this host is DISALLOWED for testing purpose
        'rombase.ihostfull.com',
        'rombase.byethost7.com',    
        'crossbrowser-leonrom.c9users.io',  
    ];

    fwrite( $f, "set headers"  . "\n");
    header("Access-Control-Allow-Origin: {$http_origin}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400'); // cache for 1 day
        
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: 
            {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    if ((in_array($host, $allowed_hosts)) || ($host == ""))  // Decide if allow access
    {         
        $nam = "parms";
        $prm = "?";
        if (isset($_REQUEST[$nam])) 
            $prm = $_REQUEST[$nam];    
        fwrite( $f, "finish: prm=$prm" . "\n" );                
        
        echo ("CORS <b>$prm</b> !");
    }else{
        fwrite( $f, "your domain is NOT allowed" . "\n" );                
        echo ("Ваш домен не допущен");
    }
    fclose( $f);
?>
