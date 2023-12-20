import './bootstrap';
import PineconeRouter from 'pinecone-router';

document.addEventListener('alpine:initialized', () => {
    window.PineconeRouter.settings.hash = false // use hash routing
    window.PineconeRouter.settings.basePath = '/' // set the base for the URL, doesn't work with hash routing

})
document.addEventListener('alpine:init', () => {
    Alpine.plugin(PineconeRouter)
    document.body.addEventListener("pinecone-start", () => {
        NProgress.start();
    })
    document.body.addEventListener('pinecone-end', () => NProgress.done());
    Alpine.data('app', () => ({
        posts: [],
        errors: {},
        post: {},
        token: "",
        disabled: false,
        successMessage: "",
        comments: {},
        getToken() {
            const searchParams = new URLSearchParams(location.search);
            if (searchParams.has("token")) {
                localStorage.setItem("token", searchParams.get("token"));
                this.token = searchParams.get("token")

                location.search = ""
            }


        },

        login(event) {
            const target = event.target;
            const form = new FormData(target);
            this.disabled = true;
            fetch(target.action, {
                method: target.method,
                body: form,
                headers: {
                    Accept: "application/json"
                }
            }).then(res => res.json())
                .then(json => {

                    this.errors = json;
                    this.token = json.token;
                    localStorage.setItem("token", this.token);

                    if (!this.errors.message) {

                        location.replace(json.redirectTo);
                    }

                }).catch((err) => {
                this.errors = err;

            }).finally(() => this.disabled = false)
        },
        readURL() {
            if (this.$refs.src.files && this.$refs.src.files) {
                var reader = new FileReader();
                const that = this;
                reader.onload = function (e) {
                    that.$refs.dist.src = e.target.result;
                    that.$refs.dist.width = "150";
                    that.$refs.dist.height = "150";
                    that.$refs.src.value = "";

                };

                reader.readAsDataURL(this.$refs.src.files[0]);
            }
        },
        isAuthorized() {
            return !!this.token;
        },
        getPosts() {

            this.token = localStorage.getItem("token")

            fetch("/graphql", {
                method: "POST",
                body: JSON.stringify({
                    query: `{
                  posts{
                  id
                  title,
                  body
                  }

                }`
                }),
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${this.token}`
                }
            }).then((res) => res.json())
                .then(data => {
                    this.posts = data.data.posts;
                }).catch(err=>{this.posts = {};this.token = ""});
        },
        profile(event) {
            const body = {};
            const target = event.target;
            const token = localStorage.getItem("token") || this.token
            const form = new FormData(target)

            fetch(target.action, {
                method: target.method,
                body: form,
                headers: {

                    Accept: "application/json",
                    Authorization: `Bearer ${token}`,

                }
            }).then((res) => res.json())
                .then((json) => {
                    this.successMessage = "Profile Updated Successfully";
                    this.$refs.cv.value = ""
                    this.$refs.password.value = ""
                });
        },
        getPost() {

            const name = window.PineconeRouter.context.params.id
            this.token = localStorage.getItem("token") || this.token

            fetch("/graphql", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${this.token}`
                },
                body: JSON.stringify({
                    query: `{
                    post(id:${name}){
                         post{
                             title,
                             body
                         },
                    comments{

                        name,
                        body
                         }
                        }

                     }`
                })
            }).then((res) => res.json())
                .then(data => {
                    this.post = data.data.post.post;
                    this.comments = data.data.post.comments
                });
        },

    }))
})

