<template>
    <div class="mdui-m-b-3">
        <Card dis-hover>
            <p slot="title">文章专栏: {{ articles.length }}</p>
            <div class="media" v-for="item in articles">
                <div class="media-body mdui-typo-subheading" style="border-bottom: 1px solid #f2f2f2;">
                    <div class="media-heading">
                        <span class="mdui-typo"><a class="mdui-text-color-indigo">{{ item.title }}</a></span>
                        <small class="mdui-text-color-grey-500">
                            {{ item.likes.length }} 点赞
                            <span> ⋅ </span>
                            {{ item.comments_count }} 评论
                            <span> ⋅ </span>
                            <span>{{ item.created_time }}</span>
                        </small>
                        <Dropdown class="pull-right">
                            <Button type="text">
                                <Icon type="arrow-down-b"></Icon>
                            </Button>
                            <DropdownMenu slot="list">
                                <DropdownItem>编辑</DropdownItem>
                                <DropdownItem>公开/隐藏</DropdownItem>
                                <DropdownItem>关闭评论</DropdownItem>
                            </DropdownMenu>
                        </Dropdown>
                    </div>
                </div>
            </div>
        </Card>
    </div>
</template>
<script>
    export default {
        props: ['user'],
        data () {
            return {
                articles: [],
            }
        },
        mounted () {
            axios.get('/api/articles/' + this.user).then(response => {
                this.articles = response.data.articles;
            });
        }
    }
</script>
