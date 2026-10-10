<?php

require_once __DIR__ . '/core/Database.php';

// Compatibility entry point for legacy pages that expect a $conn variable.
$conn = Database::getConnection();
