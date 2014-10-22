<?php

// get the file from the server and serve it up over SSL
// error_reporting( E_ALL );
// ini_set( 'display_errors', 1 );

$filename = ( isset( $_GET[ 'f' ] ) )
    ? $_GET[ 'f' ]
    : NULL;

if ( ! $filename
    || ! ( $contents = @file_get_contents( $filename ) ) )
{
    @header( "HTTP/1.0 404 Not Found" );
    exit;
}

// get the extension/MIME for this image
$ext = array_pop( explode( '.', $filename ) );

switch ( $ext )
{
    case 'jpg':
        $mime = 'image/jpeg';
        break;
    case 'gif':
        $mime = 'image/gif';
        break;
    default:
    case 'png':
        $mime = 'image/png';
        break;
}

@header( 'Content-type: '. $mime );
@header( 'Content-length: '. strlen( $contents ) );
echo $contents;
exit;
