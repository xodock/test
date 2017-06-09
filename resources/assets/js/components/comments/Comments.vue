<template>
    <div class="container">
        <commentForm :comment=comment :edit=edit :answer=answer :comments=that></commentForm>
        <h4>Comments</h4>
        <ul class="list-group media-list">
            <li class="media list-group-item" v-for="comment in comments">
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
                answer: false,
                comments: [],
                comment: {
                    parent_id: '',
                    body: '',
                    id: '',
                },
            }
        },

        created: function () {
            this.readComments();
        },
        ready: function () {
            this.readComments();
        },

        methods: {
            createComment: function () {
                this.$http.post("comments", this.comment)
                    .then(function (response) {
                        this.reset();
                        this.readComments();
                    });
            },

            readComments: function (comment_id) {

                this.$http.get("comments" + (comment_id || ""))
                    .then(function (response) {
                        this.comments = response.data;
                    });
            },

            updateComment: function (comment_id) {
                this.$http.put("comments/" + comment_id, this.comment)
                    .then(function (response) {
                        this.reset();
                        this.readComments();
                    });
            },

            deleteComment: function (comment_id) {
                this.$http.delete("comments/" + comment_id)
                    .then(function (response) {
                        this.reset();
                        this.readComments();
                    });
            },

            editComment: function (comment) {
                this.comment.body = comment.body;
                this.comment.id = comment.id;
                this.comment.parent_id = comment.parent_id;
                this.edit = true;
            },

            answerComment: function (comment_id) {
                this.answer = true;
                this.comment.parent_id = comment_id;
            },

            reset: function () {
                this.comment.body = '';
                this.comment.id = '';
                this.comment.parent_id = '';
                this.edit = false;
                this.answer = false;
            }
        }
    }
</script>