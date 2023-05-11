<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;


class UserRepository implements UserRepositoryInterface
{
    private $user;

    /**
     * constructor
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @inheritDoc
     */
    public function findFromEmail(string $email): User
    {
        return $this->user->where('email', $email)->firstOrFail();
    }

    /**
     * @inheritDoc
     */
    public function updateUserPassword(string $password, int $id): void
    {
        $this->user->where('id', $id)->update(['password' => Hash::make($password)]);
    }

    /**
     * @inheritDoc
     */
    public function getFromSchoolGradeClassRole(array $to_email_data): \Illuminate\Database\Eloquent\Collection 
    {
        return $this->user->query()
            ->where('schools_id', $to_email_data['school_id'])
            ->where('role', $to_email_data['role'])
            ->whereHas('users_detail', function($query) use ($to_email_data) {
                $query->where('grade', $to_email_data['grade'])
                    ->where('class', $to_email_data['class']);
            })
            ->get();

    }

    /**
     * @inheritDoc
     */
    public function getFromSchoolGradeRole(array $to_email_data): \Illuminate\Database\Eloquent\Collection
    {
        return $this->user->query()
            ->where('schools_id', $to_email_data['school_id'])
            ->where('role', $to_email_data['role'])
            ->whereHas('users_detail', function($query) use ($to_email_data) {
                $query->where('grade', $to_email_data['grade']);
            })
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function getFromSchoolRole(array $to_email_data): \Illuminate\Database\Eloquent\Collection
    {
        return $this->user->query()
            ->where('schools_id', $to_email_data['school_id'])
            ->where('role', $to_email_data['role'])
            ->get();
    }
}