<?php
namespace Ninja;
interface Routes
{
    public function getRoutes();
    public function getAuthentication() : \Ninja\Authentication;
    public function checkPermission($permission): bool;
}