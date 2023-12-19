<template x-route="/single/:id">
    <template x-if="post" x-init="getPost()">
        <div class="container">
            <div class="row">
                <h1>Content</h1>
                <h2 class="card-title h4" x-text="post.title"></h2>
                <p class="card-text" x-text="post.body"></p>

            </div>

            <div class="row">
                <h2>@lang("Comments")</h2>
                <template x-for="comment in comments">
                    <div class="bg-gradient  text-white">
                    <span class="bg-black">@lang("Author Name"):  </span> <span class="bg-black" x-text="comment.name"></span>
                    <p class="bg-info" x-text="comment.body"></p>
                    </div>
                </template>
            </div>

        </div>

    </template>
</template>
