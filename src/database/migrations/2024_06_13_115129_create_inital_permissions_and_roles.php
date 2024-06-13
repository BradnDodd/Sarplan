<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Callouts
        Permission::create(['name' => 'callout-view-any']);
        Permission::create(['name' => 'callout-view-team']);
        Permission::create(['name' => 'callout-create']);
        Permission::create(['name' => 'callout-update']);
        Permission::create(['name' => 'callout-delete']);

        $teamMemberPermissions = ['callout-view-team', 'callout-create', 'callout-update', 'callout-delete'];
        Role::create(['name' => 'team member'])
            ->givePermissionTo($teamMemberPermissions);

        $teamLeaderPermissions = $teamMemberPermissions;
        $teamLeaderPermissions[] = 'callout-view-any';
        Role::create(['name' => 'team leader'])
            ->givePermissionTo($teamLeaderPermissions);

        Role::create(['name' => 'admin-super'])
            ->givePermissionTo(Permission::all());

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
