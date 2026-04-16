<?php
session_start();
session_destroy();

header('location:/COMP1841/cw/admin/login.php');