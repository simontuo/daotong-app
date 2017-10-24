<template>
    <div class="">
        <Card>
            <p slot="title">
                <Icon type="chatboxes"></Icon>
                与 John 的对话
            </p>
            <a href="#" slot="extra">
                <Icon type="ios-loop-strong"></Icon>
                刷新
            </a>
            <div class="row mdui-m-x-2 mdui-m-b-2">
                <div class="mdui-valign">
                    <p class="mdui-center">This should be vertically aligned</p>
                </div>
                <div class="mdui-m-b-2" v-for="item in messages">
                    <Tooltip :content="item.bio" placement="right" :always="this.always">
                        <Avatar size="large" :src="item.from_user.avatar" />
                    </Tooltip>
                </div>

                <div class="pull-right mdui-m-b-2">
                    <Tooltip content="Right Center 文字提示" placement="left" :always="this.always">
                        <Avatar size="large" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
                    </Tooltip>
                </div>

            </div>
            <Form>
                <FormItem>
                    <Input v-model="textarea" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="请输入..."></Input>
                </FormItem>
                <FormItem>
                    <Button class="pull-right" type="primary">回复</Button>
                </FormItem>
            </Form>
        </Card>
    </div>
</template>

<script>
    export default {
        props: ['user', 'dialog'],
        data() {
            return {
                always: true,
                messages: [],
                textarea: '',
            }
        },
        mounted() {
            axios.get('/api/messages/' + this.user + '/' + this.dialog).then(response => {
                this.messages = response.data.messages;
            });
        }
    }
</script>

<style>

</style>
