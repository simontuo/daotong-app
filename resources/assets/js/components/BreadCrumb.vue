<template>
    <div class="mdui-m-b-1">
        <Breadcrumb >
            <BreadcrumbItem :to="this.url1">
                <Icon type="ios-home-outline"></Icon> 主页
            </BreadcrumbItem>
            <BreadcrumbItem :to="this.url2">
                <Icon type="social-buffer-outline"></Icon> 后台
            </BreadcrumbItem>
            <BreadcrumbItem :to="this.url3">
                <Icon type="pound"></Icon> 文章管理
            </BreadcrumbItem>
        </Breadcrumb>
    </div>
</template>
<script>
    export default {
        props: ['url1', 'url2', 'url3']
    }
</script>
