/**
 * 购物车 service
 * User: hgh
 * Date: 2015/10/12
 * Time: 10:35
 */
define(['angular', '../module.js', './StorageService.js'], function(angular, module) {
    module.factory('app.CartService', ['app.ApiService', 'app.storageProvider', function(Api, Storage) {
        var service = {
            data: null,
            key: '__ql_shopping_cart__',
            key_updated: '__ql_cart_timestamp__',

            /**
             * 加载数据
             * @returns {*}
             */
            load: function () {
                if (this.data == null) {
                    this.data = Storage.get(this.key) || [];
                }
                return this.data;
            },

            save: function() {
                var data = angular.copy(this.data);
                /**
                 * 去掉对象中的$$hashKey,否则在删除对象之后,再添加,会引起遍历错误
                 */
                angular.forEach(data, function(o) {
                    delete o.$$hashKey;
                });

                Storage.set(this.key, data);
                Storage.set(this.key_updated, new Date().getTime());
            },

            add: function(goods, number, remark) {
                var c = this.find(goods.id);
                number = number || 1;
                if (c) {
                    c.number+= number;
                    c.remark = remark;
                } else {
                    this.data.push({gid:goods.id, price:goods.price, goods:goods._data?goods._data:goods, number:number, remark:remark});
                }

                this.save();
            },

            plus: function(gid, number) {
                var c = this.find(gid);
                number = number | 1;
                if (c) {
                    c.number += number;
                    this.save();
                }
            },

            minus: function(gid, number) {
                var c = this.find(gid);
                number = number | 1;
                if (c) {
                    if (c.number - number <= 0) {
                        this.remove(c.gid);
                    } else {
                        c.number -= number;
                        this.save();
                    }
                }
            },

            remove: function(gid) {
                this.each(function(c, i) {
                    if (c.gid == gid) {
                        this.data.splice(i, 1);
                        this.save();
                        return false;
                    }
                });
            },

            clean: function() {
                this.data.splice(0);
                this.save();
            },

            find: function(gid) {
                var cart = null;
                this.each(function(c) {
                    if (c.gid == gid) {
                        cart = c;
                        return false;
                    }
                });

                return cart;
            },

            each: function(iterator, context) {
                var data = this.data;
                var len = data.length;
                for (var i=0; i<len; i++) {
                    if (iterator.call((context || this), data[i], i, data) === false) {
                        break;
                    }
                }
            },

            /**
             * 查看一个店铺商品在购物车中的数量
             * @param gid
             */
            goodsSelected: function(gid) {
                var number = 0;
                this.each(function(c) {
                    if (c.goods.id == gid) {
                        number += c.number;
                    }
                });
                return number;
            },

            /**
             * 查看一个店铺商品在购物车中的数量
             * @param sid
             */
            SpecSelected: function(sid) {
                var number = 0;
                this.each(function(c) {
                    if (c.spec.id == sid) {
                        number += c.number;
                    }
                });
                return number;
            },

            selected: function() {
                var number = 0;
                this.each(function(c) {
                    number += c.number;
                });
                return number;
            },

            total: function() {
                var price = 0;
                this.each(function(c) {
                    price += c.number * (c.price*100);
                });

                return price / 100;
            }
        };

        service.load();

        return service;
    }]);
});