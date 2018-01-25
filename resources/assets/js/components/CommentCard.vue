<template>
    <Card dis-hover>
        <div class="mdui-valign">
            <Spin class="mdui-center" size="large"></Spin>
        </div>
        <p slot="title">
            N 条评论
        </p>
        <a slot="extra" @click.prevent="">
            <Icon size="20" type="arrow-swap"></Icon>
        </a>
        <div class="mdui-m-b-1">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <Avatar shape="square" size="small" style="line-height: 23px;" src="https://pic4.zhimg.com/v2-4b333dcd6dbcb4a2a14704a4a8414706_is.jpg" />
                    </a>
                </div>
                <div class="media-body">
                    <div class="" style="max-width: 90%;">
                        <p class="media-heading mdui-text-capitalize" style="font-size:16px;">simontuo</p>
                    </div>

                </div>
            </div>
            <p class="media-heading" style="font-size:16px;">我们希望道童图书馆能够成为一个让大家记录一些有意思、有意义东西的地方。我们希望大家能够遵守道童的相关约定，在记录不属于自己原创的东西时，应尊重原创作者，不要恶意转载！</p>
            <ButtonGroup style="margin-left: -15px;">
                <Button type="text"  class="question-button-color" icon="chatbubble"><strong>25 条评论</strong></Button>
                <Button type="text"  class="question-button-color" icon="android-share-alt"><strong>分享</strong></Button>
                <Button type="text"  class="question-button-color" icon="star"><strong></Icon>邀请回答</strong></Button>
            </ButtonGroup>
            <div class="mdui-divider"></div>
        </div>
        <div class="mdui-m-b-1">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <Avatar shape="square" size="small" style="line-height: 23px;" src="https://pic4.zhimg.com/v2-4b333dcd6dbcb4a2a14704a4a8414706_is.jpg" />
                    </a>
                </div>
                <div class="media-body">
                    <div class="" style="max-width: 90%;">
                        <p class="media-heading mdui-text-capitalize" style="font-size:16px;">simontuo</p>
                    </div>

                </div>
            </div>
            <p class="media-heading" style="font-size:16px;">我们希望道童图书馆能够成为一个让大家记录一些有意思、有意义东西的地方。我们希望大家能够遵守道童的相关约定，在记录不属于自己原创的东西时，应尊重原创作者，不要恶意转载！</p>
            <ButtonGroup style="margin-left: -15px;">
                <Button type="text"  class="question-button-color" icon="chatbubble"><strong>25 条评论</strong></Button>
                <Button type="text"  class="question-button-color" icon="android-share-alt"><strong>分享</strong></Button>
                <Button type="text"  class="question-button-color" icon="star"><strong></Icon>邀请回答</strong></Button>
            </ButtonGroup>
            <div class="mdui-divider"></div>
        </div>

        <div class="">

            <Form ref="formInline" inline>
                <FormItem prop="user" style="margin-bottom: 0px;width: 90%;">
                    <Input v-model="comment" :autosize="true"  type="textarea" :rows="1" size="large" placeholder="写下你的评论"></Input>
                </FormItem>
                <FormItem style="margin-bottom: 0px;">
                    <Button type="primary" @click="handleSubmit('formInline')"  >评论</Button>
                </FormItem>
            </Form>
        </div>

    </Card>
</template>

<script>
    export default {
        data() {
            return {
                comment: '',
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
