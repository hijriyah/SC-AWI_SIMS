<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\staff;
use App\Models\guru;
use App\Models\siswa;
use App\Models\orangtua;


class Role extends Model
{
    use HasFactory;
    
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'guard_name'
    ];

    public function permissionsName($RoleName)
    {
        $role = $this->where('name', $RoleName)->first();

        if (!$role) {
            return []; 
        }
    
        $roleHasPermissions = DB::table('role_has_permissions')
            ->where('role_id', $role->id)
            ->pluck('permission_id'); 
    

        if ($roleHasPermissions->isEmpty()) {
            return []; 
        }
    
 
        $permissions = DB::table('permissions')
            ->whereIn('id', $roleHasPermissions)
            ->get();

        $names = $permissions->mapWithKeys(function ($permission) {
            return [$permission->name => $permission->name];
        });
        
        return $names->toArray();
    }

    public function permissionsId($id)
    {
        $roleHasPermissions = DB::table('role_has_permissions')->where('role_id', $id)->pluck('permission_id');

        $permissions = DB::table('permissions')
            ->whereIn('id', $roleHasPermissions)
            ->get();
                
            $names = $permissions->mapWithKeys(function ($permission) {
                return [$permission->name => $permission->name];
            });
            
        return $names->toArray();
    }


}
