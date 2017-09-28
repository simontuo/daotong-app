<template>
    <Card>
        <p slot="title">
            评论数量：
        </p>
        <a href="#" slot="extra" @click.prevent="changeLimit">
            <Icon type="ios-loop-strong"></Icon>
            换一换
        </a>
        <ul class="mdui-list">
            <li class="mdui-list-item mdui-ripple">
                <div class="mdui-list-item-avatar"><img src="https://i.loli.net/2017/08/21/599a521472424.jpg" /></div>
                <div class="mdui-list-item-content">
                    <div class="mdui-list-item-title">Brunch this weekend?</div>
                    <div class="mdui-list-item-text mdui-list-item-one-line"><span class="mdui-text-color-theme-text">All Connors</span> - I'll be in your neighborhood ...</div>
                </div>
            </li>
            <li class="mdui-divider-inset mdui-m-y-0"></li>
            <li class="mdui-list-item mdui-ripple">
                <div class="mdui-list-item-avatar"><img src="http://photo.maguas.com//avatars/2512f102014dce572199eb5cc69456ae.png" /></div>
                <div class="mdui-list-item-content">
                    <div class="mdui-list-item-title">Summer BBQ</div>
                    <div class="mdui-list-item-text mdui-list-item-one-line"><span class="mdui-text-color-theme-text">to Alex, Scott, Jennifer</span> - Wish I could ...</div>
                </div>
            </li>
            <li class="mdui-divider-inset mdui-m-y-0"></li>
            <li class="mdui-list-item mdui-ripple">
                <div class="mdui-list-item-avatar"><img src="https://i.loli.net/2017/08/21/599a521472424.jpg" /></div>
                <div class="mdui-list-item-content">
                    <div class="mdui-list-item-title">Oui oui</div>
                    <div class="mdui-list-item-text mdui-list-item-one-line"><span class="mdui-text-color-theme-text">Sandra Adams</span> - Do you have Paris reco ...</div>
                </div>
            </li>
        </ul>
        <editor></editor>
        <button type="button" class="mdui-btn mdui-color-theme mdui-m-t-1">提交评论</button>
    </Card>
</template>
<script>
    export default {

    }
</script>
<style>

</style>
