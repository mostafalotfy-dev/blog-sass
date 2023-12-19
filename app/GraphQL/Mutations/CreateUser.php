<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Tenant;
use App\Models\User;
use Nuwave\Lighthouse\Execution\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class CreateUser
{
    /**
     * Return a value for the field.
     *
     * @param  null  $root Always null, since this field has no parent.
     * @param  array{}  $args The field arguments passed by the client.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Shared between all fields.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Metadata for advanced query resolution.
     * @return mixed The result of resolving the field, matching what was promised in the schema
     */
    public function __invoke(mixed $root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): mixed
    {

        Tenant::create([
           "tenancy_db_name"=>$args["user"]["user_name"]
        ])->createDomain([
            "domain"=>$args["user"]["user_name"]
        ]);
        $input = $args["user"];
        $input["password"] = bcrypt($input["password"]);
        $user = User::create($args["user"]);

        return ["plainTextToken"=>$user->createToken("sassProject")->plainTextToken];

    }
}
