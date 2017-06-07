<template>
    <div class="container">
        <h4>Add Comment</h4>
        <form action="" @submit.prevent="edit ? comments.editComment(comment.id) : comments.createComment()">
            <div class="input-group">
                <textarea name="comment_body" v-model="comment.body" ref="textarea" class="form-control"></textarea>
            </div>
            <div class="input-group">
                <button type="submit" class="btn btn-primary" v-show="!edit">Add Comment</button>
                <button type="submit" class="btn btn-primary" v-show="edit">Edit Comment</button>
            </div>
        </form>
    </div>
</template>
<script>
    export default{
        props: ['comments', 'comment', 'edit'],
    }
</script>