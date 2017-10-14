<template>
    <div>
        <Card class="mdui-m-b-2" :padding='padding'>
            <div class="mdui-toolbar">
                <a :href="this.calligraphy_url" class="mdui-btn mdui-ripple">
                    <i class="mdui-icon mdui-icon-left material-icons">&#xe6dd;</i>书法
                </a>
                <a :href="this.article_url" class="mdui-btn mdui-ripple">
                    <i class="mdui-icon mdui-icon-left material-icons">&#xe865;</i>文章
                </a>
                <a :href="this.question_url" class="mdui-btn mdui-ripple">
                    <i class="mdui-icon mdui-icon-left material-icons">&#xe0c6;</i>问道
                </a>
            </div>
        </Card>
    </div>
</template>

<script>
    export default {
        props: ['calligraphy_url', 'article_url', 'question_url'],
        data() {
            return {
                padding: 0,
            }
        }
    }
</script>
