<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Http;
use Nuwave\Lighthouse\Execution\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class Post
{
    /**
     * Return a value for the field.
     *
     * @param null $root Always null, since this field has no parent.
     * @param array{} $args The field arguments passed by the client.
     * @param GraphQLContext $context Shared between all fields.
     * @param ResolveInfo $resolveInfo Metadata for advanced
     * query resolution.
     * @return mixed The result of resolving the field, matching what was promised in the schema
     */
    public function __invoke(mixed $root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): mixed
    {

        $id = $args["id"];
        return [
            "post" => HTTP::get("https://jsonplaceholder.typicode.com/posts/{$id}")->json(),
            "comments" => HTTP::get("https://jsonplaceholder.typicode.com/posts/{$id}/comments")->json()
        ];
    }
}
