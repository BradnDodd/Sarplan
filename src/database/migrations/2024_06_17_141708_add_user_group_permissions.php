<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::findOrCreate('user-group-view-any');
        Permission::findOrCreate('user-group-view-team');
        Permission::findOrCreate('user-group-create');
        Permission::findOrCreate('user-group-update');
        Permission::findOrCreate('user-group-delete');

        $teamMemberPermissions = ['user-group-view-team'];
        Role::findByName('team member')
            ->givePermissionTo($teamMemberPermissions);

        $teamLeaderPermissions = array_merge($teamMemberPermissions, ['user-group-view-any', 'user-group-update', 'user-group-create', 'user-group-delete']);
        Role::findByName('team leader')
            ->givePermissionTo($teamLeaderPermissions);

        Role::findByName('admin-super')
            ->givePermissionTo(Permission::all());

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
};
