<template>
    <Card>
        <p slot="title" class="mdui-typo-title-opacity">
            热门标签
        </p>
        <Tag checkable class="question-tag">标签一</Tag>
        <Tag checkable class="question-tag">标签一</Tag>
        <Tag checkable class="question-tag">标签一</Tag>
        <Tag checkable class="question-tag">标签一</Tag>
        <Tag checkable class="question-tag">标签一</Tag>
    </Card>
</template>

<script>
    export default {

    }
</script>

<style>
    .question-tag {
        border: 0px solid #fff;
        background: #eef4fa;
        font-size: 15px;
    }
    .question-tag, .question-tag a, .question-tag a:hover {
        color: #3e7ac2;
    }
</style>
