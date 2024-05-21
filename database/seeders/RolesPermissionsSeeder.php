<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\BackedEnumValueResolver;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $warehouseManagerRole = Role::create(['name' => 'warehouse manager']);
        $assistantManagerRole = Role::create(['name' => 'assistant manager']);
        $distributionAgentRole = Role::create(['name' => 'distribution agent']);

        // Define permissions
        $permissions = [
            'category.index', 'category.store', 'category.show', 'category.update', 'category.destroy',
        ];
        foreach ($permissions as $permissionName) {
            Permission::findOrCreate($permissionName, 'web');
        }

        // Assign permissions to roles
        $adminRole->syncPermissions($permissions); // delete old permissions and keep those inside the $permissions
        $warehouseManagerRole->syncPermissions($permissions);
        $assistantManagerRole->syncPermissions($permissions);
        $distributionAgentRole->syncPermissions($permissions);

        //////////////////////////////////////////////////////////////

        // Create users and assign roles
        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $adminUser->assignRole($adminRole);

        // Assign permission associated with the role to the user
        $permissions = $adminRole->permissions()->pluck('name')->toArray();
        $adminUser->givePermissionTo($permissions);

        //////////////////////////////////////////////////////////////

//        // Create users and assign roles
//        $clientUser = User::factory()->create([
//            'name' => 'Client User',
//            'email' => 'client@example.com',
//            'password' => bcrypt('password'),
//        ]);
//        $clientUser->assignRole($clientRole);
//
//        // Assign permission associated with the role to the user
//        $permissions = $clientRole->permissions()->pluck('name')->toArray();
//        $clientUser->givePermissionTo($permissions);
    }
}
