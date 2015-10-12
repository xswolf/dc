/**
 * 存储服务
 * User: hgh
 * Date: 2015/10/12
 * Time: 10:35
 */
define(['../module.js'], function(module) {
    module.provider('app.storageProvider', function() {
        var provider = {
            handler: localStorage,
            $get: function () {
                return {
                    get: function (key) {
                        return JSON.parse(provider.handler.getItem(key));
                    },

                    set: function (key, value) {
                        provider.handler.setItem(key, JSON.stringify(value));
                    },

                    remove: function (key) {
                        return provider.handler.getItem(key) ? true : false;
                    },

                    has: function (key) {
                        return provider.handler.getItem(key) ? true : false;
                    }
                }
            }
        };

        return provider;
    });
});