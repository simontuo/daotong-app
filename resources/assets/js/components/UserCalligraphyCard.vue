<template>
    <div class="mdui-m-b-3">
        <Card dis-hover>
            <p slot="title">书法专栏: {{ calligraphys.length}}</p>
            <div class="media" v-for="item in calligraphys">
                <div class="media-body" style="border-bottom: 1px solid #f2f2f2;">
                    <div class="media-heading mdui-typo-subheading ">
                        <span class="mdui-typo">
                            <a class="mdui-text-color-teal">{{ item.title }}</a>
                        </span>
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
                                <DropdownItem><span @click="showEdit(item.id)">编辑</span></DropdownItem>
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
                calligraphys: [],
            }
        },
        mounted () {
            axios.get('/api/calligraphys/' + this.user).then(response => {
                this.calligraphys = response.data.calligraphys;
            });
        },
        methods: {
            showEdit(id) {
                window.location.href = "/calligraphys/" + id + '/edit';
            },
        }
    }
</script>
