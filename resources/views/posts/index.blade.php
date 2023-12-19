<template x-route="/" x-handler="getToken">
    <template x-if="posts" x-init="getPosts">
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">

                    <!-- Nested row for non-featured blog posts-->
                    <div class="row">
                        <template x-for="post in posts">
                            <div class="col-lg-6">
                                <!-- Blog post-->

                                <div class="card mb-4">
                                    <a href="#"><img class="card-img-top"
                                                     src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg"/></a>
                                    <div class="card-body">

                                        <h2 class="card-title h4" x-text="post.title"></h2>
                                        <p class="card-text"></p>
                                        <a class="btn btn-primary" :href="/single/+post.id">Read more →</a>
                                    </div>
                                </div>


                            </div>
                        </template>
                    </div>
                    <!-- Pagination-->

                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Enter search term..."
                                       aria-label="Enter search term..." aria-describedby="button-search"/>
                                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                            </div>
                        </div>
                    </div>
                    <!-- Categories widget-->


                </div>
            </div>
        </div>
    </template>

</template>
