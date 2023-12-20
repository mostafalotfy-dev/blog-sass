<template x-route="/profile">
    <div class="container">
        <h2>@lang("Profile")</h2>
        <p  class="alert text-primary" x-text="successMessage"></p>
        <div class="row">
            @php($user =auth("web")->user())
            <div class="col-md-12">
                <form method="post" action="{{route("profile.update")}}" @submit.prevent="profile" enctype="multipart/form-data">


                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="name">@lang("Your Name")</label>
                            <div class="input-group">

                                <input type="text"  value="{{$user->name}}" name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="user_name">@lang("User Name")</label>
                            <div class="input-group">

                                <input type="text" id="user_name" name="user_name" disabled value="{{$user->user_name}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="phone_number">@lang("Phone Number")</label>
                            <div class="input-group">

                                <input type="text"  id="phone_number" disabled name="phone_number" value="{{$user->phone_number}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="email">@lang("Email")</label>

                            <div class="input-group">

                                <input type="email"  id="email" name="email" value="{{$user->email}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="password">@lang("Password")</label>

                            <div class="input-group">

                                <input type="password"  id="password" name="password"  x-ref="password" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="file">@lang("CV File")</label>
                                <div class="input-group">
                                    <input type="file"  name="file" accept=".pdf" id="file" x-ref="cv" class="btn form-control">
                                </div>

                            </div>


                            <div class="col-md-3">
                                <label for="file">@lang("Your Image")</label>
                                <div class="input-group">
                                    <input type="file" @change="readURL" x-ref="src" name="image" accept="image/*" id="image" class="btn form-control">
                                </div>
                                <img src="{{"/storage/uploads/$user->user_name/$user->image"}}" x-ref="dist" width="150" height="150" alt="@lang('portfolio')">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <input class="btn btn-primary" @click="successMessage = ''" :disabled="disabled" type="submit" value="@lang("Update Profile")">
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</template>
