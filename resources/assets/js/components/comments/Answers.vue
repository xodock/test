<template>
    <div class="media-body container">
        <ul class="media list-group media-list">
            <li class="media list-group-item" v-for="answer in answers">
                <comment :comment=answer :comments=comments></comment>
            </li>
        </ul>
    </div>
</template>
<script>
    export default{
        props: ['comments', 'answers'],
    }
</script>