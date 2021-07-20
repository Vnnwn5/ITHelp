<?php

namespace App\Policies;


use App\Models\User;
use App\Models\Device;
use Illuminate\Auth\Access\HandlesAuthorization;

class DevicePolicy
{
    use HandlesAuthorization;
    /**
     * Determine if the given device can be updated by the user (tec).
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return bool
     */
    public function update(User $user, Device $device)
    {
        return $user->id === $device->user_id;
    }

}
