<template>
    <li class="comment-item media list-group-item" :data-id=comment.id>
        <p class="id">#{{comment.id}}</p>
        <p class="comment_body">{{comment.body}}</p>
        <button class="btn btn-default" @click="comments.editComment(comment, index)">Edit</button>
        <button class="btn btn-danger" @click="comments.deleteComment(comment, index)">Delete</button>
        <button class="btn btn-default" @click="comments.answerComment(comment)">Answer</button>
        <answers :answers=comment.answers :comments=comments></answers>
    </li>
</template>
<script>
    export default{
        props: ['comments', 'comment', 'index'],
    }
</script>