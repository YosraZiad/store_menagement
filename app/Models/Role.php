<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $guard = 'web';

    protected $fillable = ['team_id', 'name', 'display_name', 'brief', 'guard_name', 'created_at', 'updated_at', 'created_by', 'updated_by'];

    public function admin() {
        return $this->hasOne(User::class);  
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function hasUsers()
    {
        return $this->users()->exists();
    }
    /**
     * Check if the role is assigned to a specific user.
     */
    public function hasUser(User $user)
    {
        return $this->users()->contains($user);
    }

    /**
     * Get the permissions associated with the role.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Check if the role has a specific permission.
     */
    public function hasPermission(Permission $permission)
    {
        $permissions = $this->permissions();
    return $permissions->whereKey($permission->id)->exists();
        // $permissions = $this->permissions();
        // return $permissions->contains($permission);
    }

    /**
     * Check if the role has all of the given permissions.
     */
    public function hasAllPermissions(array $permissions)
    {
        return $this->permissions()->whereIn('id', $permissions)->count() === count($permissions);
    }

    /**
     * Check if the role has at least one of the given permissions.
     */
    public function hasAnyPermission(array $permissions)
    {
        return $this->permissions()->whereIn('id', $permissions)->exists();
    }

    /**
     * Assign a user to the role.
     */
    public function assignUser(User $user)
    {
        $this->users()->attach($user);
    }

    /**
     * Remove a user from the role.
     */
    public function removeUser(User $user)
    {
        $this->users()->detach($user);
    }

    /**
     * Sync the users assigned to the role.
     */
    public function syncUsers(array $userIds)
    {
        $this->users()->sync($userIds);
    }

    /**
     * Assign a permission to the role.
     */
    public function assignPermission(Permission $permission)
    {
        $this->permissions()->attach($permission);
    }

    /**
     * Remove a permission from the role.
     */
    public function removePermission(Permission $permission)
    {
        $this->permissions()->detach($permission);
    }

    /**
     * Sync the permissions assigned to the role.
     */
    public function syncPermissions(array $permissionIds)
    {
        $this->permissions()->sync($permissionIds);
    }

}
