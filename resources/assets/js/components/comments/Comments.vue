<template>
    <div class="container">
        <commentForm :comment=comment :edit=edit :answer=answer :comments=that></commentForm>
        <h4>Comments</h4>
        <ul class="list-group media-list">
            <comment v-for="(comment, index) in comments" :comment=comment :comments=that :key=index
                     :index=index></comment>
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
                parentCommentsNode: []
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
                        if (this.answer) {
                            this.parentCommentsNode.push(response.data)
                        } else {
                            this.comments.push(response.data)
                        }
                        this.reset();
//                        this.readComments();

                    });
            },

            readComments: function () {
                this.$http.get("comments")
                    .then(function (response) {
                        this.comments = response.data;
                    });
            },

            updateComment: function () {
                this.$http.put("comments/" + this.comment.id, this.comment)
                    .then(function (response) {
                        this.$set(this.comments, this.comment.index, response.data);
                        this.reset();
//                        this.readComments();
                    });
            },

            deleteComment: function (comment, index) {

                this.$http.delete("comments/" + comment.id)
                    .then(function (response) {
                        this.reset();
                        this.$delete(this.comments, index);
//                        this.readComments();
                    });
            },

            editComment: function (comment, index) {
                this.set(comment);
                this.comment.index = index;
                this.edit = true;
            },

            answerComment: function (comment) {
                this.answer = true;
                this.set(comment, "parent_id", "id");
                this.parentCommentsNode = comment.answers;
            },

            reset: function () {
                this.comment = {
                    id: '',
                    parent_id: '',
                    body: '',
                    answers: []
                };
                this.edit = false;
                this.answer = false;
            },
            set: function (comment, prop, val) {
                if (prop) {
                    this.$set(this.comment, prop, comment[val]);
                } else {
                    this.$set(this.comment, 'id', comment.id);
                    this.$set(this.comment, 'parent_id', comment.parent_id);
                    this.$set(this.comment, 'body', comment.body);
                    this.$set(this.comment, 'answers', comment.answers);
                }
            }
        }
    }
</script>