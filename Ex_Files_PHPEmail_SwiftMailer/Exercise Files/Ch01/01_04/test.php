<?php
require_once '../../includes/config.php';

if (class_exists('Swift')) {
    echo 'Good to go';
} else {
    echo 'We have a problem';
}