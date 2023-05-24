<?php

echo 'REQUEST_METHOD: ' . $_SERVER['REQUEST_METHOD'] . "\n\n";
readfile('php://input');
