<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::findOrCreate('team-view-any');
        Permission::findOrCreate('team-view-team');
        Permission::findOrCreate('team-create');
        Permission::findOrCreate('team-update');
        Permission::findOrCreate('team-delete');

        $teamMemberPermissions = ['team-view-team'];
        Role::findByName('team member')
            ->givePermissionTo($teamMemberPermissions);

        $teamLeaderPermissions = array_merge($teamMemberPermissions, ['team-view-any', 'team-update']);
        Role::findByName('team leader')
            ->givePermissionTo($teamLeaderPermissions);

        Role::findByName('admin-super')
            ->givePermissionTo(Permission::all());

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
};
