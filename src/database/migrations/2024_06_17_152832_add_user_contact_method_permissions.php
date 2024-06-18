<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::findOrCreate('user-contact-method-view-user');
        Permission::findOrCreate('user-contact-method-view-team');
        Permission::findOrCreate('user-contact-method-create-user');
        Permission::findOrCreate('user-contact-method-create-team');
        Permission::findOrCreate('user-contact-method-update-user');
        Permission::findOrCreate('user-contact-method-update-team');
        Permission::findOrCreate('user-contact-method-delete-user');
        Permission::findOrCreate('user-contact-method-delete-team');

        $teamMemberPermissions = ['user-contact-method-view-user', 'user-contact-method-update-user', 'user-contact-method-update-user', 'user-contact-method-create-user', 'user-contact-method-delete-user'];
        Role::findByName('team member')
            ->givePermissionTo($teamMemberPermissions);

        $teamLeaderPermissions = array_merge($teamMemberPermissions, ['user-contact-method-view-team', 'user-contact-method-update-team', 'user-contact-method-update-team', 'user-contact-method-create-team', 'user-contact-method-delete-team']);
        Role::findByName('team leader')
            ->givePermissionTo($teamLeaderPermissions);

        Role::findByName('admin-super')
            ->givePermissionTo(Permission::all());

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
};
