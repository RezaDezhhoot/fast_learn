<?php


namespace App\Repositories\Classes;

use App\Enums\CertificateEnum;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Alexusmai\LaravelFileManager\Services\ConfigService\ConfigRepository;
use Illuminate\Support\Facades\Auth;
use App\Enums\StorageEnum;
use App\Enums\EventEnum;
use App\Repositories\Interfaces\StorageRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Alexusmai\LaravelFileManager\Services\ACLService\ACLRepository;

class UserRepository implements UserRepositoryInterface, ConfigRepository , ACLRepository
{
    public function getDiskList(): array
    {
        $storages = [];
        $storages[] = Auth::user()->hasPermissionTo('public_driver') ? StorageEnum::PUBLIC_LABEL : null;
        $storages[] = Auth::user()->hasPermissionTo('private_driver') ? StorageEnum::PRIVATE_LABEL : null;
        $custom_storages = app(StorageRepositoryInterface::class)->getAll();

        try {
            foreach ($custom_storages as $value) {
                if (Auth::user()->hasPermissionTo($value->permission_name)) {
                    $storages[] = $value->name;
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }


        return array_filter($storages);
    }

    public function searchUsers($select, $where = [], $orWhere = [])
    {
        return User::latest('id')->select($select)->where($where)->orWhere($orWhere)->cursor();
    }

    public function walletTransactions(User $user)
    {
        // TODO: Implement walletTransactions() method.
        return $user->walletTransactions()->where('confirmed', 1)->get();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function syncRoles(User $user, $roles)
    {
        return $user->syncRoles($roles);
    }

    public function getUser($col, $value)
    {
        return User::where($col, $value)->firstOrFail();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function update(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }

    /**
     * @return mixed
     */
    public static function getNew()
    {
        return User::getNew();
    }

    public function getAll()
    {
        return User::all();
    }

    public function save(User $user)
    {
        $user->save();
        return $user;
    }

    public function getAllAdminList($status, $roles, $search, $pagination)
    {
        return User::latest('id')->when($status, function ($query) use ($status) {
            return $query->where('status', $status);
        })->when($roles, function ($query) use ($roles) {
            return $query->role($roles);
        })->search($search)->paginate($pagination);
    }

    public function newUserObject()
    {
        // TODO: Implement newUserObject() method.
        return new User();
    }

    public function hasRole($role)
    {
        return auth()->user()->hasRole($role);
    }

    public function submit_certificate(User $user, $certificate_id, $transcript_id)
    {
        return $user->certificates()->updateOrCreate(['certificate_id' => $certificate_id, 'transcript_id' => $transcript_id], []);
    }

    public function reclaiming_certificate(User $user, $certificate_id, $transcript_id)
    {
        $user->certificates()->where([['certificate_id', $certificate_id], ['transcript_id', $transcript_id]])->delete();
    }

    public function has_certificate(User $user, $certificate_id, $transcript_id)
    {
        return $user->certificates()->where([['certificate_id', $certificate_id], ['transcript_id', $transcript_id]])->first();
    }

    public function findCertificate(User $user, $id, $status)
    {
        return $status == CertificateEnum::DEMO ?
            $user->certificates()->findOrFail($id) :
            $user->certificates()->where('transcript_id', '!=', 0)->findOrFail($id);
    }

    public function findBy($where = [])
    {
        return User::where($where)->firstOrFail();
    }

    public function getDashboardData($from_date, $to_date)
    {
        return User::whereBetween('created_at', [$from_date . " 00:00:00", $to_date . " 23:59:59"])->count();
    }

    public function count()
    {
        return User::count();
    }

    public function getUsersForEvent(string $orderBy, int $count)
    {
        $priod = EventEnum::getPriods()[$count];

        if ($priod != EventEnum::ALL) {
            $counts = ceil(User::count() / $priod[0]);
            $skip = $counts * $priod[1];
            return User::select('email', 'phone')->skip($skip)->take($counts)
                ->orderBy('id', $orderBy)->cursor();
        } else {
            return User::select('email', 'phone')
                ->orderBy('id', $orderBy)->cursor();
        }
    }

    /**
     * LFM Route prefix
     * !!! WARNING - if you change it, you should compile frontend with new prefix(baseUrl) !!!
     *
     * @return string
     */
    final public function getRoutePrefix(): string
    {
        return config('file-manager.routePrefix');
    }

    /**
     * Get disk list
     *
     * ['public', 'local', 's3']
     *
     * @return array
     */

    /**
     * Default disk for left manager
     *
     * null - auto select the first disk in the disk list
     *
     * @return string|null
     */
    final public function getLeftDisk(): ?string
    {
        return config('file-manager.leftDisk');
    }

    /**
     * Default disk for right manager
     *
     * null - auto select the first disk in the disk list
     *
     * @return string|null
     */
    final public function getRightDisk(): ?string
    {
        return config('file-manager.rightDisk');
    }

    /**
     * Default path for left manager
     *
     * null - root directory
     *
     * @return string|null
     */
    final public function getLeftPath(): ?string
    {
        return config('file-manager.leftPath');
    }

    /**
     * Default path for right manager
     *
     * null - root directory
     *
     * @return string|null
     */
    final public function getRightPath(): ?string
    {
        return config('file-manager.rightPath');
    }

    /**
     * Image cache ( Intervention Image Cache )
     *
     * set null, 0 - if you don't need cache (default)
     * if you want use cache - set the number of minutes for which the value should be cached
     *
     * @return int|null
     */
    final public function getCache(): ?int
    {
        return config('file-manager.cache');
    }

    /**
     * File manager modules configuration
     *
     * 1 - only one file manager window
     * 2 - one file manager window with directories tree module
     * 3 - two file manager windows
     *
     * @return int
     */
    final public function getWindowsConfig(): int
    {
        return config('file-manager.windowsConfig');
    }

    /**
     * File upload - Max file size in KB
     *
     * null - no restrictions
     */
    final public function getMaxUploadFileSize(): ?int
    {
        return config('file-manager.maxUploadFileSize');
    }

    /**
     * File upload - Allow these file types
     *
     * [] - no restrictions
     */
    final public function getAllowFileTypes(): array
    {
        return config('file-manager.allowFileTypes');
    }

    /**
     * Show / Hide system files and folders
     *
     * @return bool
     */
    final public function getHiddenFiles(): bool
    {
        return config('file-manager.hiddenFiles');
    }

    /**
     * Middleware
     *
     * Add your middleware name to array -> ['web', 'auth', 'admin']
     * !!!! RESTRICT ACCESS FOR NON ADMIN USERS !!!!
     *
     * @return array
     */
    final public function getMiddleware(): array
    {
        return config('file-manager.middleware');
    }

    /**
     * ACL mechanism ON/OFF
     *
     * default - false(OFF)
     *
     * @return bool
     */
    final public function getAcl(): bool
    {
        return config('file-manager.acl');
    }

    /**
     * Hide files and folders from file-manager if user doesn't have access
     *
     * ACL access level = 0
     *
     * @return bool
     */
    final public function getAclHideFromFM(): bool
    {
        return config('file-manager.aclHideFromFM');
    }

    /**
     * ACL strategy
     *
     * blacklist - Allow everything(access - 2 - r/w) that is not forbidden by the ACL rules list
     *
     * whitelist - Deny anything(access - 0 - deny), that not allowed by the ACL rules list
     *
     * @return string
     */
    final public function getAclStrategy(): string
    {
        return config('file-manager.aclStrategy');
    }

    /**
     * ACL rules repository
     *
     * default - config file(ConfigACLRepository)
     *
     * @return string
     */
    final public function getAclRepository(): string
    {
        return config('file-manager.aclRepository');
    }

    /**
     * ACL Rules cache
     *
     * null or value in minutes
     *
     * @return int|null
     */
    final public function getAclRulesCache(): ?int
    {
        return config('file-manager.aclRulesCache');
    }

    /**
     * Whether to slugify filenames
     *
     * boolean
     *
     * @return bool|null
     */
    final public function getSlugifyNames(): ?bool
    {
        return config('file-manager.slugifyNames', false);
    }

    public function getModelNamespace(): string
    {
        return User::class;
    }

    public function getUserID()
    {
        return Auth::id();
    }

    public function getRules(): array
    {
        $acl = Auth::user()->acl;
        $free_storages = app(StorageRepositoryInterface::class)->getFreeStorages();
        $permissions = [];

        if (in_array(StorageEnum::PUBLIC_LABEL,$this->getDiskList())) {
            $permissions[] = [
                'disk' => StorageEnum::PUBLIC_LABEL,
                'path' => '*',
                'access' => 2
            ];
        }

        if (in_array(StorageEnum::PRIVATE_LABEL,$this->getDiskList())) {
            $permissions[] = [
                'disk' => StorageEnum::PRIVATE_LABEL,
                'path' => '*',
                'access' => 2
            ];
        }

        foreach ($free_storages as $item) {
            if (in_array($item->name,$this->getDiskList())) {
                $permissions[] = [
                    'disk' => $item->name,
                    'path' => '*',
                    'access' => 2
                ];
            }
        }

        if (!is_null($acl)) {
            foreach ($acl as $item) {
                foreach ($item->path as $path) {
                    $permissions[] = [
                        'disk' => $item->storage->name,
                        'path' => $path['path'],
                        'access' => $path['access']
                    ];
                }
            }
        }
        return $permissions;
    }
}
