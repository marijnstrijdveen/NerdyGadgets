<?php
session_start();
session_unset();
session_destroy();

header("location: ../nerdygadgets/index.php");
exit();