<?php

if (! function_exists('user')) {
    /**
     * [user 获取登录用户 helperfunction]
     * @method user
     * @param  [type]   $driver [description]
     * @return [type]           [description]
     * @auth   simontuo
     */
    function user ($driver = null) {
        // api 获取用户
        if ($driver) {
            return app('auth')->guard('api')->user();
        }

        return app('auth')->user();
    }
}
