<?php

namespace MezzoLabs\Mezzo\Modules\User\Commands;

use MezzoLabs\Mezzo\Console\Commands\MezzoCommand;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Modules\User\Domain\Repositories\PermissionRepository;
use MezzoLabs\Mezzo\Modules\User\Domain\Repositories\RoleRepository;
use MezzoLabs\Mezzo\Modules\User\Domain\Repositories\UserRepository;

class SeedPermissions extends MezzoCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mezzo:permissions:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with the default permissions for displaying and editing models.';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $defaultPermissions = $this->allPermissionArray();

        $permissionRepository = $this->permissionRepository();

        foreach ($defaultPermissions as $permissionsData) {
            $permission = $permissionRepository->updateOrInsert($permissionsData);

            if ($permission->wasRecentlyCreated) {
                $this->info('Created permission "' . $permission->key() . "'");
            }
        }

        $allPermissions = $permissionRepository->all();
        $admin = $this->roleRepository()->findOrCreateAdmin();

        $admin->givePermissions($allPermissions);

        $adminUserId = $this->ask('Enter the email of the user which will crowned as the eternal administrator:');

        if ($adminUserId) {
            $adminUser = $this->userRepository()->findByOrFail('email', $adminUserId);

            $adminUser->attachRole($admin);

            $this->info('Long live the king!');
        }

        $this->info('--> All default permissions are in the table.');

    }

    /**
     * @return PermissionRepository
     */
    protected function permissionRepository()
    {
        return app()->make(PermissionRepository::class);
    }

    /**
     * @return RoleRepository
     */
    protected function roleRepository()
    {
        return app()->make(RoleRepository::class);
    }

    /**
     * @return UserRepository
     */
    protected function userRepository()
    {
        return app()->make(UserRepository::class);
    }

    protected function allPermissionArray()
    {
        $allPermissions = [];

        $allModels = mezzo()->reflector()->modelReflections();

        $allModels->each(function (MezzoModelReflection $model) use (&$allPermissions) {
            $modelName = strtolower($model->name());
            $modelTitle = space_case(str_plural($model->name()));

            $allPermissions[] = [
                'model' => $modelName,
                'name' => 'create',
                'label' => 'Create ' . $modelTitle
            ];

            $allPermissions[] = [
                'model' => $modelName,
                'name' => 'show',
                'label' => 'Show ' . $modelTitle
            ];

            $allPermissions[] = [
                'model' => $modelName,
                'name' => 'show_own',
                'label' => 'Show created ' . $modelTitle
            ];

            $allPermissions[] = [
                'model' => $modelName,
                'name' => 'edit',
                'label' => 'Edit ' . $modelTitle
            ];

            $allPermissions[] = [
                'model' => $modelName,
                'name' => 'edit_own',
                'label' => 'Edit created ' . $modelTitle
            ];

            $allPermissions[] = [
                'model' => $modelName,
                'name' => 'delete',
                'label' => 'Delete ' . $modelTitle
            ];

            $allPermissions[] = [
                'model' => $modelName,
                'name' => 'delete_own',
                'label' => 'Delete created ' . $modelTitle
            ];

        });

        $allPermissions[] = [
            'model' => NULL,
            'name' => 'administrate',
            'label' => 'Administrate'
        ];

        $allPermissions[] = [
            'model' => NULL,
            'name' => 'cockpit',
            'label' => 'Can see the Cockpit'
        ];

        return $allPermissions;
    }


}