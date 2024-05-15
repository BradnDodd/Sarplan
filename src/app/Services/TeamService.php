<?php

namespace App\Services;

use App\Models\Team;

class TeamService
{
    public function index()
    {
        return Team::all();
    }
}
