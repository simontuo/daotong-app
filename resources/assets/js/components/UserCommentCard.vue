<template>
    <div class="">
        <Card dis-hover>
            <p slot="title">最新评论: {{ comments.length }}</p>
            <div class="media" v-for="item in comments">
                <div class="media-body mdui-typo-subheading" style="border-bottom: 1px solid #f2f2f2;">
                    <div class="media-heading mdui-typo">
                        <a class="mdui-text-color-indigo">{{ item.commentable.title }}</a>
                    </div>
                    <small class="mdui-text-color-grey-500 mdui-typo">
                        <a href="#">{{ item.user.name }}</a>
                        <span>: {{ item.bio }}</span> ⋅
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
        </Card>
    </div>
</template>
<script>
    export default {
        props: ['user'],
        data () {
            return {
                comments: [],
            }
        },
        mounted () {
            axios.get('/api/comments/' + this.user).then(response => {
                this.comments = response.data.comments;
            });
        }
    }
</script>
