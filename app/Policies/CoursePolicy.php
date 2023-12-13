<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Mycourse;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(User $user): bool
    // {
    //     return true;
    // }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Course $course): bool
    {
        $cek=Mycourse::where('user_id', $user->id)->where('course_id',$course->id)->first();
        return $user->id == $course->teacher->id || $cek;
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Course $course): bool
    {
        return $user->id == $course->teacher->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Course $course): bool
    {
        return $user->id == $course->teacher->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Course $course): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Course $course): bool
    // {
    //     //
    // }
}
