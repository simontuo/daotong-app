<template>
    <Card>
        <div style="text-align:center">
            <!-- 打赏/点赞 -->
            <p slot="title" class="mdui-m-b-2">
                <ButtonGroup>
                    <Button type="success" size="large">
                        <Icon type="android-favorite"></Icon>
                        点赞
                    </Button>
                    <Button type="warning" size="large">
                        打赏
                        <Icon type="social-yen"></Icon>
                    </Button>
                </ButtonGroup>
            </p>
            <!-- 用户头像列 -->
            <Avatar class="like-avatar" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
            <Avatar class="like-avatar" src="http://photo.maguas.com//avatars/2512f102014dce572199eb5cc69456ae.png" />
            <Avatar class="like-avatar" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
            <Avatar class="like-avatar" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
            <Avatar class="like-avatar" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
            <Avatar class="like-avatar" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
            <Avatar class="like-avatar" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
            <Avatar class="like-avatar" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
            <Avatar class="like-avatar" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
            <Avatar class="like-avatar" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
            <Avatar class="like-avatar" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
            <Avatar class="like-avatar" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
            <Avatar class="like-avatar" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
            <Avatar class="like-avatar" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
        </div>
    </Card>
</template>
<script>
    export default {

    }
</script>
<style>
    .like-avatar{
        background-color: #fff;
        border: 1px solid #ddd;
        width: 60px;
        height: 60px;
        border-radius: 60px;
    }
    .like-avatar img{
        margin: 4px;
        width: 50px;
        height: 50px;
        border-radius: 50px;
    }
</style>
