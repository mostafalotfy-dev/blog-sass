<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;



use App\Models\User;


use Stancl\Tenancy\Database\Models\Domain;

final class DeleteUser
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = auth("sanctum")->user();
        $user =  User::findOrFail($user->id);
        $domain = Domain::where("domain",$user->user_name)->first();

        $domain->tenant->database()->manager()->deleteDatabase($domain->tenant);
        $domain->delete();
        return ["isDeleted"=>$user->delete()];
    }
}
