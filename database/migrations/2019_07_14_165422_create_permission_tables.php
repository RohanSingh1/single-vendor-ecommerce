<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedInteger('permission_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type',]);

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->primary(['permission_id', $columnNames['model_morph_key'], 'model_type'],
                'model_has_permissions_permission_model_type_primary');
        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedInteger('role_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type',]);

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['role_id', $columnNames['model_morph_key'], 'model_type'],
                'model_has_roles_role_model_type_primary');
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('role_id');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

        app('cache')->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
        ->forget(config('permission.cache.key'));
        $permission = [
            [
                'id' => 2,
                'name' => 'permission-list',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 16:42:59',
                'updated_at' => '2020-01-29 16:42:59'
            ],

            [
                'id' => 3,
                'name' => 'permission-create',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:22:53',
                'updated_at' => '2020-01-29 21:22:53'
            ],

            [
                'id' => 4,
                'name' => 'permission-edit',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:22:58',
                'updated_at' => '2020-01-29 21:22:58'
            ],

            [
                'id' => 5,
                'name' => 'permission-update',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:23:02',
                'updated_at' => '2020-01-29 21:23:02'
            ],

            [
                'id' => 6,
                'name' => 'permission-delete',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:23:06',
                'updated_at' => '2020-01-29 21:23:06'
            ],

            [
                'id' => 7,
                'name' => 'role-list',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:23:20',
                'updated_at' => '2020-01-29 21:23:20'
            ],

            [
                'id' => 8,
                'name' => 'role-create',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:23:25',
                'updated_at' => '2020-01-29 21:23:25'
            ],

            [
                'id' => 9,
                'name' => 'role-edit',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:23:28',
                'updated_at' => '2020-01-29 21:23:28'
            ],

            [
                'id' => 10,
                'name' => 'role-update',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:23:34',
                'updated_at' => '2020-01-29 21:23:34'
            ],

            [
                'id' => 11,
                'name' => 'role-delete',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:23:37',
                'updated_at' => '2020-01-29 21:23:37'
            ],

            [
                'id' => 12,
                'name' => 'user-list',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:23:49',
                'updated_at' => '2020-01-29 21:23:49'
            ],

            [
                'id' => 13,
                'name' => 'user-create',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:23:54',
                'updated_at' => '2020-01-29 21:23:54'
            ],

            [
                'id' => 14,
                'name' => 'user-edit',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:24:09',
                'updated_at' => '2020-01-29 21:24:09'
            ],

            [
                'id' => 15,
                'name' => 'user-update',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:24:15',
                'updated_at' => '2020-01-29 21:24:15'
            ],

            [
                'id' => 16,
                'name' => 'user-delete',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:24:23',
                'updated_at' => '2020-01-29 21:24:23'
            ],

            [
                'id' => 17,
                'name' => 'product-create',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:24:39',
                'updated_at' => '2020-01-29 21:24:39'
            ],

            [
                'id' => 18,
                'name' => 'product-delete',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:24:44',
                'updated_at' => '2020-01-29 21:24:44'
            ],

            [
                'id' => 19,
                'name' => 'product-edit',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:24:50',
                'updated_at' => '2020-01-29 21:24:50'
            ],

            [
                'id' => 21,
                'name' => 'product-update',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:25:08',
                'updated_at' => '2020-01-29 21:25:08'
            ],

            [
                'id' => 22,
                'name' => 'category-list',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:25:17',
                'updated_at' => '2020-01-29 21:25:17'
            ],

            [
                'id' => 23,
                'name' => 'category-create',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:25:21',
                'updated_at' => '2020-01-29 21:25:21'
            ],

            [
                'id' => 24,
                'name' => 'category-edit',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:25:24',
                'updated_at' => '2020-01-29 21:25:24'
            ],

            [
                'id' => 25,
                'name' => 'category-update',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:25:28',
                'updated_at' => '2020-01-29 21:25:28'
            ],

            [
                'id' => 26,
                'name' => 'category-delete',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:25:31',
                'updated_at' => '2020-01-29 21:25:31'
            ],

            [
                'id' => 27,
                'name' => 'sub-category-list',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:25:39',
                'updated_at' => '2020-01-29 21:25:39'
            ],

            [
                'id' => 28,
                'name' => 'sub-category-create',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:25:43',
                'updated_at' => '2020-01-29 21:25:43'
            ],

            [
                'id' => 29,
                'name' => 'sub-category-edit',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:25:46',
                'updated_at' => '2020-01-29 21:25:46'
            ],

            [
                'id' => 30,
                'name' => 'sub-category-update',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:25:50',
                'updated_at' => '2020-01-29 21:25:50'
            ],

            [
                'id' => 31,
                'name' => 'sub-category-delete',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:25:54',
                'updated_at' => '2020-01-29 21:25:54'
            ],

            [
                'id' => 32,
                'name' => 'brand-list',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:26:00',
                'updated_at' => '2020-01-29 21:26:00'
            ],

            [
                'id' => 33,
                'name' => 'brand-create',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:26:08',
                'updated_at' => '2020-01-29 21:26:08'
            ],

            [
                'id' => 34,
                'name' => 'brand-edit',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:26:11',
                'updated_at' => '2020-01-29 21:26:11'
            ],

            [
                'id' => 35,
                'name' => 'brand-update',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:26:15',
                'updated_at' => '2020-01-29 21:26:15'
            ],

            [
                'id' => 36,
                'name' => 'brand-delete',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:26:21',
                'updated_at' => '2020-01-29 21:26:21'
            ],

            [
                'id' => 37,
                'name' => 'supplier-list',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:26:36',
                'updated_at' => '2020-01-29 21:26:36'
            ],

            [
                'id' => 38,
                'name' => 'supplier-create',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:26:41',
                'updated_at' => '2020-01-29 21:26:41'
            ],

            [
                'id' => 39,
                'name' => 'supplier-edit',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:27:00',
                'updated_at' => '2020-01-29 21:27:00'
            ],

            [
                'id' => 40,
                'name' => 'supplier-update',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:27:07',
                'updated_at' => '2020-01-29 21:27:07'
            ],

            [
                'id' => 41,
                'name' => 'supplier-delete',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:27:12',
                'updated_at' => '2020-01-29 21:27:12'
            ],

            [
                'id' => 42,
                'name' => 'product-show-price',
                'guard_name' => 'admin',
                'created_at' => '2020-01-29 21:27:27',
                'updated_at' => '2020-01-29 21:27:27'
            ],

            [
                'id' => 43,
                'name' => 'product-list',
                'guard_name' => 'admin',
                'created_at' => '2020-02-07 00:57:59',
                'updated_at' => '2020-02-07 00:57:59'
            ]
        ];
        \Illuminate\Support\Facades\DB::table('permissions')->insert($permission);
        Role::create([
            'id' => 1,
            'name' => 'Super user',
            'guard_name' => 'admin',
            'created_at' => '2020-01-29 17:00:47',
            'updated_at' => '2020-01-29 22:00:49'
        ]);

        Role::create([
            'id' => 2,
            'name' => 'guest',
            'guard_name' => 'admin',
            'created_at' => '2020-01-29 21:56:35',
            'updated_at' => '2020-01-29 21:56:35'
        ]);

        Role::create([
            'id' => 3,
            'name' => 'admin',
            'guard_name' => 'admin',
            'created_at' => '2020-01-29 22:01:13',
            'updated_at' => '2020-01-29 22:01:13'
        ]);
        $roleHasPermission = [
            [
                'permission_id' => 2,
                'role_id' => 1
            ],

            [
                'permission_id' => 3,
                'role_id' => 1
            ],

            [
                'permission_id' => 4,
                'role_id' => 1
            ],

            [
                'permission_id' => 5,
                'role_id' => 1
            ],

            [
                'permission_id' => 6,
                'role_id' => 1
            ],

            [
                'permission_id' => 7,
                'role_id' => 1
            ],

            [
                'permission_id' => 8,
                'role_id' => 1
            ],

            [
                'permission_id' => 9,
                'role_id' => 1
            ],

            [
                'permission_id' => 10,
                'role_id' => 1
            ],

            [
                'permission_id' => 11,
                'role_id' => 1
            ],

            [
                'permission_id' => 12,
                'role_id' => 1
            ],

            [
                'permission_id' => 13,
                'role_id' => 1
            ],

            [
                'permission_id' => 14,
                'role_id' => 1
            ],

            [
                'permission_id' => 15,
                'role_id' => 1
            ],

            [
                'permission_id' => 16,
                'role_id' => 1
            ],

            [
                'permission_id' => 17,
                'role_id' => 1
            ],

            [
                'permission_id' => 17,
                'role_id' => 3
            ],

            [
                'permission_id' => 18,
                'role_id' => 1
            ],

            [
                'permission_id' => 18,
                'role_id' => 3
            ],

            [
                'permission_id' => 19,
                'role_id' => 1
            ],

            [
                'permission_id' => 19,
                'role_id' => 3
            ],

            [
                'permission_id' => 21,
                'role_id' => 1
            ],

            [
                'permission_id' => 21,
                'role_id' => 3
            ],

            [
                'permission_id' => 22,
                'role_id' => 1
            ],

            [
                'permission_id' => 22,
                'role_id' => 3
            ],

            [
                'permission_id' => 23,
                'role_id' => 1
            ],

            [
                'permission_id' => 23,
                'role_id' => 3
            ],

            [
                'permission_id' => 24,
                'role_id' => 1
            ],

            [
                'permission_id' => 24,
                'role_id' => 3
            ],

            [
                'permission_id' => 25,
                'role_id' => 1
            ],

            [
                'permission_id' => 25,
                'role_id' => 3
            ],

            [
                'permission_id' => 26,
                'role_id' => 1
            ],

            [
                'permission_id' => 26,
                'role_id' => 3
            ],

            [
                'permission_id' => 27,
                'role_id' => 1
            ],

            [
                'permission_id' => 27,
                'role_id' => 3
            ],

            [
                'permission_id' => 28,
                'role_id' => 1
            ],

            [
                'permission_id' => 28,
                'role_id' => 3
            ],

            [
                'permission_id' => 29,
                'role_id' => 1
            ],

            [
                'permission_id' => 29,
                'role_id' => 3
            ],

            [
                'permission_id' => 30,
                'role_id' => 1
            ],

            [
                'permission_id' => 30,
                'role_id' => 3
            ],

            [
                'permission_id' => 31,
                'role_id' => 1
            ],

            [
                'permission_id' => 31,
                'role_id' => 3
            ],

            [
                'permission_id' => 32,
                'role_id' => 1
            ],

            [
                'permission_id' => 32,
                'role_id' => 3
            ],

            [
                'permission_id' => 33,
                'role_id' => 1
            ],

            [
                'permission_id' => 33,
                'role_id' => 3
            ],

            [
                'permission_id' => 34,
                'role_id' => 1
            ],

            [
                'permission_id' => 34,
                'role_id' => 3
            ],

            [
                'permission_id' => 35,
                'role_id' => 1
            ],

            [
                'permission_id' => 35,
                'role_id' => 3
            ],

            [
                'permission_id' => 36,
                'role_id' => 1
            ],

            [
                'permission_id' => 36,
                'role_id' => 3
            ],

            [
                'permission_id' => 37,
                'role_id' => 1
            ],

            [
                'permission_id' => 37,
                'role_id' => 3
            ],

            [
                'permission_id' => 38,
                'role_id' => 1
            ],

            [
                'permission_id' => 38,
                'role_id' => 3
            ],

            [
                'permission_id' => 39,
                'role_id' => 1
            ],

            [
                'permission_id' => 39,
                'role_id' => 3
            ],

            [
                'permission_id' => 40,
                'role_id' => 1
            ],

            [
                'permission_id' => 40,
                'role_id' => 3
            ],

            [
                'permission_id' => 41,
                'role_id' => 1
            ],

            [
                'permission_id' => 41,
                'role_id' => 3
            ],

            [
                'permission_id' => 42,
                'role_id' => 1
            ],

            [
                'permission_id' => 42,
                'role_id' => 3
            ],

            [
                'permission_id' => 43,
                'role_id' => 1
            ],

            [
                'permission_id' => 43,
                'role_id' => 3
            ]
        ];
        \Illuminate\Support\Facades\DB::table('role_has_permissions')->insert($roleHasPermission);
        $modelHasRole = [
            [
                'role_id' => 1,
                'model_type' => 'App\Model\Admin\Admin',
                'model_id' => 1
            ],
            [
                'role_id' => 3,
                'model_type' => 'App\Model\Admin\Admin',
                'model_id' => 3
            ]
        ];
        \Illuminate\Support\Facades\DB::table('model_has_roles')->insert($modelHasRole);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}
