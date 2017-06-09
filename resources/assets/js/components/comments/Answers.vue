<template>
    <div class="answers media-body container">
        <ul class="media list-group media-list">
            <comment v-for="(answer, index) in answers" :comment=answer :comments=comments :key=index
                     :index=index></comment>
        </ul>
    </div>
</template>
<script>
    export default{
        props: ['comments', 'answers'],
    }
</script>