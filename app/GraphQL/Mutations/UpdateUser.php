<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;

final class UpdateUser
{
    /**
     * @param null $_
     * @param array{} $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth("sanctum")->user();
        $input = $args;

        $user->update($input);
        return ["user" => $user ?? []];
    }
}
