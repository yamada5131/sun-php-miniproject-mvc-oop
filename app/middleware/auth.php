<?php

function checkAuth(): void
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: /index.php?mod=auth&&act=login-form");
        exit;
    }
}
