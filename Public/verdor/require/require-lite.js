(function () {
    // 原始require,暂存到变量,使require-lite具备恢复到原始状态的能力
    var nativeRequire = window.require;

    // 原始define
    var nativeDefine = window.define;

    // 当前时间戳
    var expose = Date.now();

    // 标识
    var subscribers = "$" + expose;

    // require-lite
    var require;

    // 保存模块加载状态
    var modules = {
        "ready!": {
            id: "ready!",
            state: 2,
            deps: [],
            factory: noop,
            exports: null
        }
    };

    // 加载插件
    var plugins = {};

    // 配置对象
    var config = {
        debug: false,    // 调试模式(打印加载细节)
        _basepath: null,  // 基准路径
        paths: {},       // 模块定义,amd规范
        shim: {},        // 模块依赖定义,amd规范
        nocache: false,  // 强制去除缓存
        urlArgs: ''      // 请求资源附带的参数
    };
    config.__defineGetter__('basepath', function() {
        return config._basepath;
    });
    config.__defineSetter__('basepath', function(v) {
        // 确保config.basepath是否为绝对路径
        config._basepath = fullUrl(v);
    });


    /* ------------------------------------------------------
     * 工具函数
     * ------------------------------------------------------*/

    function noop() {
        //....
    }

    var nextTick = window.setImmediate ? setImmediate.bind(window) : function (callback) {
        setTimeout(callback, 0)
    };

    /**
     * 清除URL中的query部分
     */
    function cleanUrl(url) {
        return (url || "").replace(/[?#].*/, "");
    }

    function fullUrl(url) {
        if (!/^(\w+)(\d)?:\/.*/.test(url)) {
            url = location.protocol + '//' + location.host + (location.port ? ':' + location.port : '') + '/' + (url.charAt(0) == '/' ? url.slice(1) : url);
        }
        return url;
    }

    /**
     * 获取当前脚本的路径
     * @param base
     * @returns {*}
     */
    function getCurrentScript(base) {
        var stack, url;

        // 方式1: 参考 https://github.com/samyk/jiagra/blob/master/jiagra.js
        try {
            a.b.c(); //强制报错,以便捕获e.stack
        } catch (e) { //safari的错误对象只有line,sourceId,sourceURL
            stack = e.stack;
        }

        if (stack) {
            /**e.stack最后一行在所有支持的浏览器大致如下:
             *chrome23:
             * at http://113.93.50.63/data.js:4:1
             *firefox17:
             *@http://113.93.50.63/query.js:4
             *opera12:http://www.oldapps.com/opera.php?system=Windows_XP
             *@http://113.93.50.63/data.js:4
             *IE10:
             *  at Global code (http://113.93.50.63/data.js:4:1)
             *  //firefox4+ 可以用document.currentScript
             */
            stack = stack.split(/[@ ]/g).pop(); //取得最后一行,最后一个空格或@之后的部分
            stack = stack[0] === "(" ? stack.slice(1, -1) : stack.replace(/\s/, ""); //去掉换行符
            url = stack.replace(/(:\d+)?:\d+$/i, ""); //去掉行号与或许存在的出错字符起始位置
            if (!url) { //处理window safari的Error没有stack的问题
                url = Array.prototype.slice(document.scripts).pop().src
            }
        } else {
            // 方式2: 获取最后一个处于交互状态的script标签的地址
            var nodes = document.getElementsByTagName("script");
            for (var i = nodes.length, node; node = nodes[--i];) {
                if ((base || node.className === subscribers) && node.readyState === "interactive") {
                    url = node.className = node.src;
                }
            }
        }

        return url ? fullUrl(url) : url;
    }

    /**
     * 检测是否存在循环依赖
     */
    function checkCycle(deps, name) {
        for (var id in deps) {
            if (deps.hasOwnProperty(id) &&
                (deps[id] === "require-lite-module" &&
                modules[id].state !== 2 &&
                (id === name || checkCycle(modules[id].deps, name)))) {
                return true;
            }
        }

        return false;
    }

    /**
     * 创建一个Module数据结构
     * @param id
     * @param url
     * @param deps
     * @param factory
     * @param parent
     * @returns {{id: *, url: *, factory: (*|noop), deps: Array, exports: null, state: number}}
     */
    function factoryModule(id, url, deps, factory, parent) {
        var _tmp = {};
        var _deps = [];
        id = cleanUrl(id);

        deps = deps || [];
        factory = factory || noop;

        for (var i = 0; i < deps.length; i++) {
            var resource = getResourceInfo(deps[i], parent);
            if (!_tmp[resource.id]) {
                _deps.push(resource.id);
                _tmp[resource.id] = "require-lite-module"; //去重
            }
        }

        return {
            id: id,             // 标识
            url: url,           // URL,可选
            factory: factory,   // 初始化函数
            deps: _deps,         // 依赖
            exports: null,       // 暴露的对象
            state: 0            // 状态: 未加载:0, 已加载:1 完成:2
        }
    }

    /**
     * 检测依赖
     */
    function checkDeps() {
        for (var i in modules) {
            if (modules.hasOwnProperty(i)) {
                var module = modules[i];

                if (module.state == 1) {
                    var deps = module.deps || [];
                    var depsFinished = true;

                    for (var j=0; j<deps.length; j++) {
                        var key = deps[j];
                        if (modules[key] && modules[key].state < 2) {
                            depsFinished = false;
                            break;
                        }
                    }

                    if (depsFinished) {
                        fireFactory(module.id, module.deps, module.factory);
                        checkDeps();
                    }
                }
            }
        }
    }

    /**
     * 获得资源信息
     */
    function getResourceInfo(id, parent) {
        var url = id;
        parent = parent || '';

        var rdeuce = /\/\w+\/\.\./;
        var ret, // 资源真实url
            shim; // 模块依赖配置

        // 1. 特别处理ready标识符
        if (url === "ready!") {
            return {
                id: cleanUrl(id),
                url: null,
                plugin: noop,
                shim: null,
                load: noop
            };
        }

        // 2.  处理text!  css! 等资源
        var plugin = 'js';
        url = url.replace(/^\w+!/, function (a) {
            plugin = a.slice(0, -1);
            return "";
        });
        plugin = plugins[plugin];

        // 3. 转化为完整路径
        if (config.paths[id]) { //别名机制
            url = config.paths[id];
        }
        if (typeof config.shim[id] === "object") {
            shim = config.shim[id];
        }

        // 4. 补全路径
        if (/^(\w+)(\d)?:\/.*/.test(url)) {
            ret = url
        } else {
            parent = parent.substr(0, parent.lastIndexOf('/'));
            var tmp = url.charAt(0);
            if (tmp !== "." && tmp !== "/") { //相对于根路径
                ret = config.basepath + url
            } else if (url.slice(0, 2) === "./") { //相对于兄弟路径
                ret = parent + url.slice(1)
            } else if (url.slice(0, 2) === "..") { //相对于父路径
                ret = parent + "/" + url;
                while (rdeuce.test(ret)) {
                    ret = ret.replace(rdeuce, "")
                }
            } else if (tmp === "/") {
                ret = url; // 绝对路径
            } else {
                console.error("不符合模块标识规则: " + url)
            }
        }

        // 5. 补全扩展名
        url = cleanUrl(ret);
        var ext = plugin.ext;
        if (ext) {
            if (url.slice(0 - ext.length) !== ext) {
                ret += ext
            }
        }

        // 6. 缓存处理
        if (config.nocache) {
            ret += (ret.indexOf("?") === -1 ? "?" : "&") + Date.now();
        } else if (config.urlArgs) {
            ret += (ret.indexOf("?") === -1 ? "?" : "&") + config.urlArgs;
        }

        ret = fullUrl(ret);
        id = cleanUrl(ret);

        return {
            id: id,
            url: ret,
            plugin: plugin,
            shim: shim,
            load: function () {
                if (!modules[id]) {
                    plugin(ret, shim);
                }
            }
        };
    }

    /**
     * 调用工厂函数
     * @param id
     * @param deps
     * @param factory
     * @returns {*}
     */
    function fireFactory(id, deps, factory) {
        for (var i = 0, args = [], d; d = deps[i++];) {
            args.push(modules[d].exports);
        }

        var module = Object(modules[id]),
            ret = factory.apply(window, args);

        module.state = 2;

        if (ret !== void 0) {
            modules[id].exports = ret;
        }

        return ret;
    }

    /* ------------------------------------------------------
     * 加载插件
     * ------------------------------------------------------*/
    (function () {
        /**
         * 加载JS
         * @param url
         * @param callback
         */
        function loadJS(url, callback) {
            //通过script节点加载目标模块
            var node = document.createElement("script");
            node.className = subscribers; // 让getCurrentScript只处理类名为subscribers的script节点
            node.onload = function () {
                if (callback) {
                    callback();
                }
                if (config.debug) {
                    console.log("debug: [完成] " + url);
                } else {
                    node.parentNode.removeChild(node);
                }
            };

            node.onerror = function () {
                node.onload = node.onerror = null;
                nextTick(function() {
                    document.head.removeChild(node);
                });
                console.error("debug: [失败] " + url);
            };

            node.src = url; //插入到head的第一个节点前
            document.head.appendChild(node);
            config.debug && console.log("debug: [加载] " + url)
        }

        plugins.js = function (url, shim) {
            var id = cleanUrl(url);
            shim = shim || {};

            if (!modules[id]) { //如果之前没有加载过
                modules[id] = factoryModule(id, url, shim.deps || {});
                if (shim.state && shim.state == 2) {
                    modules[id].state = 2;
                    if (shim.exports) {
                        modules[id].exports = typeof shim.exports === "function" ?
                            shim.exports() :
                            window[shim.exports];
                    }
                    nextTick(function() {
                        checkDeps();
                    });
                } else {
                    loadJS(url, function () {
                        if (shim.exports) {
                            modules[id].exports = typeof shim.exports === "function" ?
                                shim.exports() :
                                window[shim.exports];
                        }
                        modules[id].state = 1; // 置为已完成状态
                        checkDeps();
                    });
                }
            }

            return id;
        };

        plugins.css = function (url) {
            var id = url.replace(/(#.+|\W)/g, ""); //用于处理掉href中的hash与所有特殊符号
            if (!document.getElementById(id)) {
                var node = document.createElement("link");
                node.rel = "stylesheet";
                node.href = url;
                node.id = id;
                document.head.insertBefore(node, document.head.firstChild);
                checkDeps();
            }
        };
        plugins.css.ext = ".css";
        plugins.js.ext = ".js";

        plugins.text = function (url) {
            var xhr = new XMLHttpRequest;
            var id = cleanUrl(url);

            modules[id] = factoryModule(id, url);

            xhr.onload = function () {
                modules[id].state = 2; // 已加载
                modules[id].exports = xhr.responseText;
                checkDeps();
            };
            xhr.onerror = function () {
                console.error("debug: [失败] " + url);
            };
            xhr.open("GET", url, true);
            xhr.withCredentials = true;
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest")
            xhr.send();
            return id;
        };

        //http://www.html5rocks.com/zh/tutorials/webcomponents/imports/
        if ('import' in document.createElement("link")) {
            plugins.text = function (url) {
                var id = cleanUrl(url);
                modules[id] = factoryModule(id, url);

                var link = document.createElement("link");
                link.rel = "import";
                link.href = url;
                link.onload = function () {
                    modules[id].state = 2;
                    var content = this["import"];
                    if (content) {
                        modules[id].exports = content.documentElement.outerHTML;
                    }
                    onerror(0, content);
                    checkDeps();
                };

                function onerror(a, b) {
                    console.error("debug: [失败] " + url);
                    nextTick(function () {
                        document.head.removeChild(link);
                    });
                }

                link.onerror = onerror;
                document.head.appendChild(link);
                return id;
            }
        }
    })();


    /* ------------------------------------------------------
     * 定义 require
     * ------------------------------------------------------*/
    (function () {
        if (config.basepath == null) {
            var cur = getCurrentScript(true);
            var url = cleanUrl(cur);
            config.basepath = url.slice(0, url.lastIndexOf("/") + 1);
        }

        /**
         * require方法
         * @param list 依赖列表
         * @param factory 初始化函数
         * @param parent
         */
        require = function (list, factory, parent) {
            var url = parent || null;
            var id = parent || "callback" + setTimeout(1);
            parent = parent || config.basepath;

            //创建一个对象,记录模块的加载情况与其他信息
            var module = factoryModule(id, url, list, factory, parent);
            if (modules[module.id]) {
                // 已经加载过了,更新信息, 一般是运行JS之后, 通过define来到这里
                modules[module.id].deps = module.deps;
                modules[module.id].factory = module.factory;
            } else {
                module.state = 1; // 这里模块已加载,更改状态
                modules[id] = module;
            }

            // 加载依赖
            list.forEach(function (d) {
                getResourceInfo(d, parent).load();
            });

            checkDeps();
        };

        /**
         * 定义模块
         * @param {String} id ? 模块ID
         * @param {Array} deps ? 依赖列表
         * @param {Function} factory 模块工厂
         * @api public
         */
        require.define = function (id, deps, factory) { //模块名,依赖列表,模块本身
            if (Array.isArray(id)) {
                // define(['a', 'b', function() {}]);
                factory = deps;
                deps = id;
                id = null;
            } else if (typeof id === 'function') {
                // define(function() {});
                factory = id;
                id = null;
                deps = [];
            }


            if (!id) {
                // 匿名模块
                id = cleanUrl(getCurrentScript());
            }

            // 检查循环依赖
            nextTick(function () {
                try {
                    if (checkCycle(modules[id].deps, id)) {
                        console.error(id + "模块与之前的模块存在循环依赖，请不要直接用script标签引入" + d + "模块")
                    }
                } catch (e) {
                }
            });

            // 处理依赖
            require(deps, factory, id);
        };

        // 暴露一些方法,变量
        require.define.amd = modules;
        require.config = config;
        require.plugins = plugins; // 用于自定义加载插件

        /**
         * 开启require-lite
         */
        require.on = function () {
            window.require = require;
            window.define = require.define;
        };

        /**
         * 关闭require-lite,并还原状态
         */
        require.off = function () {
            window.require = nativeRequire;
            window.define = nativeDefine;
        };

        require.on();
        window.requireLite = require;
    })();
})();