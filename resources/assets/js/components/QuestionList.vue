<template>
    <ul class="list-group">
        <a class="list-group-item">
            <span class="mdui-typo-headline-opacity">问题列表</span>
        </a>
        <a class="list-group-item">
            <h4 class="mdui-m-b-1"><small> 副标题 Secondary text</small> - <small>副标题 Secondary text</small></h4>
            <h4 class="mdui-m-b-2">h4 标题 heading</h4>
            <ButtonGroup >
                <Button type="ghost" size="small" class="question-list-button">
                    <Icon type="heart"></Icon>
                    22
                </Button>
                <Button class="question-list-button" type="ghost" size="small">
                    <Icon type="ios-chatboxes"></Icon>
                    10
                </Button>
            </ButtonGroup>
        </a>
        <a class="list-group-item mdui-valign"><h4 class="mdui-center mdui-m-b-1"><small>没有人提问哦</small></h4></a>
    </ul>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style media="screen">
    .list-group-item {
        border: 1px solid #eef5f9;
    }
    .question-list-button {
        color: #b2bac2;
    }
</style>
