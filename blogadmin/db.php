<?php

// Force mysqli only (mysql extension is deprecated/removed in PHP 7+)
if (!defined('DATABASE')) {
    if (function_exists('mysqli_connect')) {
        define('DATABASE', 'mysqli');
    } else {
        die('Error: mysqli extension is required.');
    }
}

define('mysql_charset', 'utf8');

function db_link($link = null) {
    static $db_link = null;
    if ($link !== null && $link !== false) {
        $db_link = $link;
    }
    return $db_link;
}

function db_close($link = null) {
    if ($link === null) $link = db_link();
    if ($link instanceof mysqli) {
        return mysqli_close($link);
    }
    return false;
}

function db_select_db($dbname, $link = null) {
    if ($link === null) $link = db_link();
    if ($link instanceof mysqli) {
        return mysqli_select_db($link, $dbname);
    }
    return false;
}

function db_fetch_array($res) {
    if ($res instanceof mysqli_result) {
        return mysqli_fetch_array($res, MYSQLI_BOTH);
    }
    return false;
}

function db_fetch_assoc($res) {
    if ($res instanceof mysqli_result) {
        return mysqli_fetch_assoc($res);
    }
    return false;
}

function db_fetch_row($res) {
    if ($res instanceof mysqli_result) {
        return mysqli_fetch_row($res);
    }
    return false;
}

function db_num_fields($res) {
    if ($res instanceof mysqli_result) {
        return mysqli_num_fields($res);
    }
    return 0;
}

function db_num_rows($res) {
    if ($res instanceof mysqli_result) {
        return mysqli_num_rows($res);
    }
    return 0;
}

function db_affected_rows($link = null) {
    if ($link === null) $link = db_link();
    if ($link instanceof mysqli) {
        return mysqli_affected_rows($link);
    }
    return -1;
}

function db_query($query, $link = null) {
    if ($link === null) $link = db_link();
    if ($link instanceof mysqli) {
        return mysqli_query($link, $query);
    }
    return false;
}

function db_insert_id($link = null) {
    if ($link === null) $link = db_link();
    if ($link instanceof mysqli) {
        return mysqli_insert_id($link);
    }
    return 0;
}

function db_field_name($res, $field_offset) {
    if ($res instanceof mysqli_result) {
        $fo = mysqli_fetch_field_direct($res, $field_offset);
        if ($fo === false) return false;
        return $fo->name;
    }
    return false;
}

function db_field_type($res, $field_offset) {
    if ($res instanceof mysqli_result) {
        $fo = mysqli_fetch_field_direct($res, $field_offset);
        if ($fo === false) return false;
        return $fo->type;
    }
    return false;
}

function db_escape($str = null, $link = null) {
    if ($link === null) $link = db_link();
    if ($link instanceof mysqli && $str !== null) {
        return mysqli_real_escape_string($link, $str);
    }
    return '';
}

function db_connect() {
    // Hardcoded connection details to avoid accidental overrides
    $host = 'localhost';
    $username = 'resblog_user';
    $passwd = 'StrongPassword123!';
    $dbname = 'blog_admin_db';
    $port = 3306;
    $socket = null;

    if (DATABASE !== 'mysqli') {
        die("Unsupported database driver: " . DATABASE);
    }

    $link = mysqli_connect($host, $username, $passwd, $dbname, $port, $socket);

    if (!$link) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    db_link($link);
    mysqli_set_charset($link, mysql_charset);

    return $link;
}

function db_errno($link = null, $mysqli_connect = false) {
    if ($mysqli_connect) {
        return mysqli_connect_errno();
    }
    if ($link === null) $link = db_link();
    if ($link instanceof mysqli) {
        return mysqli_errno($link);
    }
    return 0;
}

function db_error($link = null, $mysqli_connect = false) {
    if ($mysqli_connect) {
        return mysqli_connect_error();
    }
    if ($link === null) $link = db_link();
    if ($link instanceof mysqli) {
        return mysqli_error($link);
    }
    return '';
}
