<template>
    <div class="container">
        <p class="comment_body">{{comment.body}}</p>
        <a class="btn btn-default" @click="comments.showComment(comment.id)">Edit</a>
        <a class="btn btn-danger" @click="comments.deleteComment(comment.id)">Delete</a>
    </div>
</template>
<script>
    export default{
        props: ['comments', 'comment'],
    }
</script>