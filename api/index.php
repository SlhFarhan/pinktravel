<?php

/**
 * Forward Vercel requests to normal Laravel routing
 */

// Override SCRIPT_NAME so Laravel doesn't mistake the /api folder as the base URL
$_SERVER['SCRIPT_NAME'] = '/index.php';

require __DIR__ . '/../public/index.php';
