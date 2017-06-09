<template>
    <div class="media-body container">
        <p class="id">#{{comment.id}}</p>
        <p class="comment_body">{{comment.body}}</p>
        <a class="btn btn-default" @click="comments.editComment(comment)">Edit</a>
        <a class="btn btn-danger" @click="comments.deleteComment(comment.id)">Delete</a>
        <a class="btn btn-default" @click="comments.answerComment(comment.id)">Answer</a>
        <answers :answers=comment.answers :comments=comments></answers>
    </div>
</template>
<script>
    export default{
        props: ['comments', 'comment'],
    }
</script>