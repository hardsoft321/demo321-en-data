<?php
function post_install()
{
    require_once 'modules/DbGit/DbGit.php';
    $plan = require __DIR__.'/data.php';
    DbGit::executeFileToDbPlan($plan);
}
