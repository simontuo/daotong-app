<template>
    <div class="mdui-container" >
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        登录
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" :action="login">
                            <input type="hidden" name="_token" :value="token">

                            <input type="hidden" name="type" :value="type">

                            <div class="form-group"  v-if="type == 'email'">
                                <label for="email" class="col-md-4 control-label">邮箱</label>

                                <div class="col-md-6">
                                    <input  type="email" class="form-control" name="email" value="" required autofocus>
                                </div>
                            </div>


                            <div class="form-group" v-if="type == 'phone'">
                                <label for="phone" class="col-md-4 control-label">手机</label>

                                <div class="col-md-6">
                                    <input  type="phone" class="form-control" name="phone" value="" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">密码</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> 记住我
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="mdui-btn mdui-color-theme-accent mdui-ripple">
                                        登录
                                    </button>

                                    <a class="btn btn-link" :href="password">
                                        忘记密码?
                                    </a>
                                    <a class="btn btn-link" :href="register">
                                        注册
                                    </a>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <label>
                                        登录方式：
                                    </label>
                                    <label class="mdui-m-r-1">
                                        <a @click="type = 'phone'">手机登录</a>
                                    </label>
                                    <label>
                                        <a @click="type = 'email'">邮箱登录</a>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['login', 'token', 'register' , 'password'],
        data() {
            return {
                type: 'email',
            }
        }
    }
</script>
