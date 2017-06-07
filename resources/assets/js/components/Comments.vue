<template>
    <div class="container">
        <commentForm :comment=comment :edit=edit :comments=that></commentForm>
        <h4>Comments</h4>
        <ul class="list-group">
            <li class="list-group-item" v-for="comment in comments">
                <comment :comment=comment :comments=that></comment>
            </li>
        </ul>
    </div>
</template>
<script>
    export default{
        data: function () {
            return {
                that: this,
                edit: false,
                comments: [],
                comment: {
                    body: '',
                    id: '',
                },
            }
        },

        created: function () {
            this.fetchComments();
        },
        ready: function () {
            this.fetchComments();
        },

        methods: {
            fetchComments: function () {
                this.$http.get("comments")
                    .then(function (response) {
                        this.comments = response.data;
                    });
            },

            createComment: function () {
                this.$http.post("comments", this.comment)
                    .then(function (response) {
                        this.comment.body = '';
                        this.comment.id = '';
                        this.fetchComments();
                    });
            },

            editComment: function (comment_id) {
                this.$http.put("comments/" + comment_id, this.comment)
                    .then(function (response) {
                        this.comment.body = '';
                        this.comment.id = '';
                        this.fetchComments();
                        this.edit = false;
                    });
            },

            deleteComment: function (comment_id) {
                this.$http.delete("comments/" + comment_id)
                    .then(function (response) {
                        this.comment.body = '';
                        this.comment.id = '';
                        this.fetchComments();
                    });
            },

            showComment: function (comment_id) {
                for (var i = 0; i < this.comments.length; i++) {
                    if (this.comments[i].id == comment_id) {
                        this.comment.body = this.comments[i].body;
                        this.comment.id = this.comments[i].id;
                        this.edit = true;
                    }
                }
            }
        }
    }
</script>