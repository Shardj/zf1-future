<?php

function firstOne()
{
    $substitute = "Testing";
    $varA = "{$substitute} 123!";
    $varB = "{$substitute} 123!";
    $varC = "$substitute 123!";
    $varD = "{$substitute}";
}

function secondOne()
{
}
