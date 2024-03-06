<?php

session_start();

session_destroy();

header("Location: market.php");
exit;