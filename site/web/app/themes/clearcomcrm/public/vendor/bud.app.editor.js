(self["webpackChunksage"] = self["webpackChunksage"] || []).push([["vendor/bud.app.editor"],{

/***/ "./node_modules/@roots/bud-server/lib/cjs/client/bridge.js":
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

/* eslint-disable no-console */
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.setOptionsAndConnect = exports.useCustomOverlay = exports.subscribe = exports.subscribeAll = void 0;
var options = {
    path: '/__bud/hmr',
    timeout: 20 * 1000,
    overlay: true,
    reload: false,
    log: true,
    warn: true,
    name: '',
    autoConnect: true,
    overlayStyles: {},
    overlayWarnings: false,
    ansiColors: {},
};
//@ts-ignore
if (false) { var overrides, querystring; }
if (typeof window === 'undefined') {
    // do nothing
}
else if (typeof window.EventSource === 'undefined') {
    console.warn("webpack-hot-middleware's client requires EventSource to work. " +
        'You should include a polyfill if you want to support this browser: ' +
        'https://developer.mozilla.org/en-US/docs/Web/API/Server-sent_events#Tools');
}
else {
    if (options.autoConnect) {
        connect();
    }
}
function setOverrides(overrides) {
    if (overrides.autoConnect)
        options.autoConnect = overrides.autoConnect == 'true';
    if (overrides.path)
        options.path = overrides.path;
    if (overrides.timeout)
        options.timeout = overrides.timeout;
    if (overrides.overlay)
        options.overlay = overrides.overlay !== 'false';
    if (overrides.reload)
        options.reload = overrides.reload !== 'false';
    if (overrides.noInfo && overrides.noInfo !== 'false') {
        options.log = false;
    }
    if (overrides.name) {
        options.name = overrides.name;
    }
    if (overrides.quiet && overrides.quiet !== 'false') {
        options.log = false;
        options.warn = false;
    }
    if (overrides.dynamicPublicPath) {
        // @ts-ignore
        options.path = __webpack_require__.p + options.path;
    }
    if (overrides.ansiColors)
        options.ansiColors = JSON.parse(overrides.ansiColors);
    if (overrides.overlayStyles)
        options.overlayStyles = JSON.parse(overrides.overlayStyles);
    if (overrides.overlayWarnings) {
        options.overlayWarnings = overrides.overlayWarnings == 'true';
    }
}
function EventSourceWrapper() {
    var source;
    var lastActivity = new Date();
    var listeners = [];
    init();
    var timer = setInterval(function () {
        // @ts-ignore
        if (new Date() - lastActivity > options.timeout) {
            handleDisconnect();
        }
    }, options.timeout / 2);
    function init() {
        source = new window.EventSource(options.path);
        source.onopen = handleOnline;
        source.onerror = handleDisconnect;
        source.onmessage = handleMessage;
    }
    function handleOnline() {
        if (options.log)
            console.log('[HMR] connected');
        lastActivity = new Date();
    }
    function handleMessage(event) {
        lastActivity = new Date();
        for (var i = 0; i < listeners.length; i++) {
            listeners[i](event);
        }
    }
    function handleDisconnect() {
        clearInterval(timer);
        source.close();
        setTimeout(init, options.timeout);
    }
    return {
        addMessageListener: function (fn) {
            listeners.push(fn);
        },
    };
}
function getEventSourceWrapper() {
    // @ts-ignore
    if (!window.__whmEventSourceWrapper) {
        // @ts-ignore
        window.__whmEventSourceWrapper = {};
    }
    // @ts-ignore
    if (!window.__whmEventSourceWrapper[options.path]) {
        // cache the wrapper for other entries loaded on
        // the same page with the same options.path
        // @ts-ignore
        window.__whmEventSourceWrapper[options.path] = EventSourceWrapper();
    }
    // @ts-ignore
    return window.__whmEventSourceWrapper[options.path];
}
function connect() {
    getEventSourceWrapper().addMessageListener(handleMessage);
    function handleMessage(event) {
        if (event.data == '\uD83D\uDC93') {
            return;
        }
        try {
            processMessage(JSON.parse(event.data));
        }
        catch (ex) {
            if (options.warn) {
                console.warn('Invalid HMR message: ' + event.data + '\n' + ex);
            }
        }
    }
}
// the reporter needs to be a singleton on the page
// in case the client is being used by multiple bundles
// we only want to report once.
// all the errors will go to all clients
var singletonKey = '__webpack_hot_middleware_reporter__';
var reporter;
if (typeof window !== 'undefined') {
    if (!window[singletonKey]) {
        window[singletonKey] = createReporter();
    }
    reporter = window[singletonKey];
}
function createReporter() {
    var strip = __webpack_require__("./node_modules/strip-ansi/index.js");
    var overlay;
    var styles = {
        errors: 'color: #ff0000;',
        warnings: 'color: #999933;',
    };
    var previousProblems = null;
    function log(type, obj) {
        var newProblems = obj[type]
            .map(function (problem) {
            var isNested = typeof problem === 'object';
            var message = isNested ? problem.message : problem;
            return strip(message);
        })
            .join('\n');
        if (previousProblems == newProblems) {
            return;
        }
        else {
            previousProblems = newProblems;
        }
        var style = styles[type];
        var name = obj.name ? "'" + obj.name + "' " : '';
        var title = '[HMR] bundle ' + name + 'has ' + obj[type].length + ' ' + type;
        // NOTE: console.warn or console.error will print the stack trace
        // which isn't helpful here, so using console.log to escape it.
        if (console.group && console.groupEnd) {
            console.group('%c' + title, style);
            console.log('%c' + newProblems, style);
            console.groupEnd();
        }
        else {
            console.log('%c' + title + '\n\t%c' + newProblems.replace(/\n/g, '\n\t'), style + 'font-weight: bold;', style + 'font-weight: normal;');
        }
    }
    return {
        cleanProblemsCache: function () {
            previousProblems = null;
        },
        problems: function (type, obj) {
            if (options.warn) {
                log(type, obj);
            }
            if (overlay) {
                if (options.overlayWarnings || type === 'errors') {
                    overlay.showProblems(type, obj[type]);
                    return false;
                }
                overlay.clear();
            }
            return true;
        },
        success: function () {
            if (overlay)
                overlay.clear();
        },
        useCustomOverlay: function (customOverlay) {
            overlay = customOverlay;
        },
    };
}
var processUpdate = __webpack_require__("./node_modules/@roots/bud-server/lib/cjs/client/process-update.js");
var customHandler;
var subscribeAllHandler;
function processMessage(obj) {
    switch (obj.action) {
        case 'building':
            if (options.log) {
                console.log('[HMR] bundle ' +
                    (obj.name ? "'" + obj.name + "' " : '') +
                    'rebuilding');
            }
            break;
        case 'built':
            if (options.log) {
                console.log('[HMR] bundle ' +
                    (obj.name ? "'" + obj.name + "' " : '') +
                    'rebuilt in ' +
                    obj.time +
                    'ms');
            }
        // fall through
        case 'sync':
            if (obj.name && options.name && obj.name !== options.name) {
                return;
            }
            var applyUpdate = true;
            if (obj.errors.length > 0) {
                if (reporter)
                    reporter.problems('errors', obj);
                applyUpdate = false;
            }
            else if (obj.warnings.length > 0) {
                if (reporter) {
                    var overlayShown = reporter.problems('warnings', obj);
                    applyUpdate = overlayShown;
                }
            }
            else {
                if (reporter) {
                    reporter.cleanProblemsCache();
                    reporter.success();
                }
            }
            if (applyUpdate) {
                processUpdate(obj.hash, obj.modules, options);
            }
            break;
        default:
            if (customHandler) {
                customHandler(obj);
            }
    }
    if (subscribeAllHandler) {
        subscribeAllHandler(obj);
    }
}
function subscribeAll(handler) {
    subscribeAllHandler = handler;
}
exports.subscribeAll = subscribeAll;
function subscribe(handler) {
    customHandler = handler;
}
exports.subscribe = subscribe;
function useCustomOverlay(customOverlay) {
    if (reporter)
        reporter.useCustomOverlay(customOverlay);
}
exports.useCustomOverlay = useCustomOverlay;
function setOptionsAndConnect(overrides) {
    setOverrides(overrides);
    connect();
}
exports.setOptionsAndConnect = setOptionsAndConnect;


/***/ }),

/***/ "./node_modules/@roots/bud-server/lib/cjs/client/index.js?name=bud&bud.overlay=true&bud.indicator=true&path=/__bud/hmr":
/***/ (function(__unused_webpack_module, __unused_webpack_exports, __webpack_require__) {

var __resourceQuery = "?name=bud&bud.overlay=true&bud.indicator=true&path=/__bud/hmr";
/* eslint-disable no-console */
/* global __resourceQuery */
var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    var desc = Object.getOwnPropertyDescriptor(m, k);
    if (!desc || ("get" in desc ? !m.__esModule : desc.writable || desc.configurable)) {
      desc = { enumerable: true, get: function() { return m[k]; } };
    }
    Object.defineProperty(o, k2, desc);
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __setModuleDefault = (this && this.__setModuleDefault) || (Object.create ? (function(o, v) {
    Object.defineProperty(o, "default", { enumerable: true, value: v });
}) : function(o, v) {
    o["default"] = v;
});
var __importStar = (this && this.__importStar) || function (mod) {
    if (mod && mod.__esModule) return mod;
    var result = {};
    if (mod != null) for (var k in mod) if (k !== "default" && Object.prototype.hasOwnProperty.call(mod, k)) __createBinding(result, mod, k);
    __setModuleDefault(result, mod);
    return result;
};
;
(async (query) => {
    const querystring = await Promise.resolve().then(() => __importStar(__webpack_require__("./node_modules/querystring/index.js")));
    const hmr = await Promise.resolve().then(() => __importStar(__webpack_require__("./node_modules/@roots/bud-server/lib/cjs/client/bridge.js")));
    const controllers = [];
    const FALLBACK_OPTS = {
        ['bud.overlay']: true,
        ['bud.indicator']: true,
        autoConnect: false,
        timeout: 20 * 1000,
        overlay: false,
        reload: false,
        log: false,
        warn: false,
        name: '',
        overlayWarnings: false,
        path: '/__bud/hmr',
    };
    const options = Object.entries(querystring.parse(query.slice(1))).reduce((a, [k, v]) => {
        if (v === 'true')
            v = true;
        if (v === 'false')
            v = false;
        return { ...a, [k]: v };
    }, FALLBACK_OPTS);
    hmr.setOptionsAndConnect(options);
    const registerIndicator = async () => {
        if (!options['bud.indicator'])
            return;
        const controllerModule = await Promise.resolve().then(() => __importStar(__webpack_require__("./node_modules/@roots/bud-server/lib/cjs/client/indicator/index.js")));
        const controller = await controllerModule.make();
        controller?.update && controllers.push(controller);
    };
    const registerOverlay = async () => {
        if (!options['bud.overlay'])
            return;
        const controllerModule = await Promise.resolve().then(() => __importStar(__webpack_require__("./node_modules/@roots/bud-server/lib/cjs/client/overlay/index.js")));
        const controller = await controllerModule.make();
        controller?.update && controllers.push(controller);
    };
    await registerIndicator();
    await registerOverlay();
    hmr.subscribeAll(payload => {
        if (!payload)
            return;
        console.table(payload);
        payload.warnings?.map(console.warn);
        payload.errors?.map(console.error);
        controllers.map(controller => controller.update(payload));
        if (payload.action === 'reload')
            window.location.reload();
    });
})(
// @ts-ignore
__resourceQuery);


/***/ }),

/***/ "./node_modules/@roots/bud-server/lib/cjs/client/indicator/index.js":
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    var desc = Object.getOwnPropertyDescriptor(m, k);
    if (!desc || ("get" in desc ? !m.__esModule : desc.writable || desc.configurable)) {
      desc = { enumerable: true, get: function() { return m[k]; } };
    }
    Object.defineProperty(o, k2, desc);
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __setModuleDefault = (this && this.__setModuleDefault) || (Object.create ? (function(o, v) {
    Object.defineProperty(o, "default", { enumerable: true, value: v });
}) : function(o, v) {
    o["default"] = v;
});
var __importStar = (this && this.__importStar) || function (mod) {
    if (mod && mod.__esModule) return mod;
    var result = {};
    if (mod != null) for (var k in mod) if (k !== "default" && Object.prototype.hasOwnProperty.call(mod, k)) __createBinding(result, mod, k);
    __setModuleDefault(result, mod);
    return result;
};
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.make = void 0;
const make = async () => {
    const { Controller } = await Promise.resolve().then(() => __importStar(__webpack_require__("./node_modules/@roots/bud-server/lib/cjs/client/indicator/indicator.controller.js")));
    const { Component } = await Promise.resolve().then(() => __importStar(__webpack_require__("./node_modules/@roots/bud-server/lib/cjs/client/indicator/indicator.component.js")));
    if (customElements.get('bud-activity-indicator'))
        return;
    customElements.define('bud-activity-indicator', Component);
    return new Controller();
};
exports.make = make;


/***/ }),

/***/ "./node_modules/@roots/bud-server/lib/cjs/client/indicator/indicator.component.js":
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.Component = void 0;
const indicator_pulse_1 = __webpack_require__("./node_modules/@roots/bud-server/lib/cjs/client/indicator/indicator.pulse.js");
/**
 * Indicator web component
 * @public
 */
class Component extends HTMLElement {
    constructor() {
        super(...arguments);
        /**
         * Component name
         * @public
         */
        this.name = `bud-activity-indicator`;
        /**
         * Status indicator colors
         * @public
         */
        this.colors = {
            success: [4, 120, 87],
            error: [220, 38, 38],
            warn: [252, 211, 77],
            pending: [59, 130, 246],
        };
    }
    /**
     * Get accessor: has errors
     * @public
     */
    get hasErrors() {
        return this.getAttribute('has-errors') == 'true';
    }
    /**
     * Get accessor: has warnings
     * @public
     */
    get hasWarnings() {
        return this.getAttribute('has-warnings') == 'true';
    }
    /**
     * Render status indicator
     * @public
     */
    render() {
        this.classList.add(this.name);
        this.innerHTML = `
    <style>
      .${this.name} {
        position: fixed;
        width: 10px;
        height: 10px;
        left: 10px;
        bottom: 10px;
        z-index: 9998;
        margin: 10px;
        padding: 5px;
        transition: opacity ease 1500ms;
        pointer-events: none;
        border-radius: 50%;
      }

      ${(0, indicator_pulse_1.pulse)(`${this.name}__success`, this.colors.success)}
      ${(0, indicator_pulse_1.pulse)(`${this.name}__error`, this.colors.error)}
      ${(0, indicator_pulse_1.pulse)(`${this.name}__warning`, this.colors.warn)}
      ${(0, indicator_pulse_1.pulse)(`${this.name}__pending`, this.colors.pending)}

      .${this.name}__visible {
        opacity: 1;
      }

      .${this.name}__hidden {
        opacity: 0;
      }
    </style>
    `;
    }
    /**
     * Show status indicator
     * @public
     */
    show() {
        clearTimeout(this.hideTimeout);
        this.classList.remove(`${this.name}__hidden`);
    }
    /**
     * Hide status indicator
     */
    hide() {
        this.hideTimeout = setTimeout(() => {
            this.classList.remove(`${this.name}__error`, `${this.name}__warning`, `${this.name}__success`, `${this.name}__pending`);
            this.classList.add(`${this.name}__hidden`);
        }, 2000);
    }
    /**
     * Status is pending
     * @public
     */
    onPending() {
        this.show();
        this.classList.remove(`${this.name}__error`, `${this.name}__warning`, `${this.name}__success`);
        this.classList.add(`${this.name}__pending`);
        this.hide();
    }
    /**
     * Status is success
     * @public
     */
    onSuccess() {
        this.show();
        this.classList.remove(`${this.name}__error`, `${this.name}__warning`, `${this.name}__pending`);
        this.classList.add(`${this.name}__success`);
        this.hide();
    }
    /**
     * Status is error
     * @public
     */
    onError() {
        this.show();
        this.classList.remove(`${this.name}__warning`, `${this.name}__success`, `${this.name}__pending`);
        this.classList.add(`${this.name}__error`);
    }
    /**
     * Status is warning
     * @public
     */
    onWarning() {
        this.show();
        this.classList.remove(`${this.name}__error`, `${this.name}__success`, `${this.name}__pending`);
        this.classList.add(`${this.name}__warning`);
    }
    /**
     * Update status
     * @public
     */
    update() {
        if (this.payload?.errors?.length)
            return this.onError();
        if (this.payload?.warnings?.length)
            return this.onWarning();
        if (!this.payload?.errors?.length &&
            !this.payload?.warnings?.length &&
            this.payload.action == 'built')
            return this.onSuccess();
        if (this.payload?.action == 'building' ||
            this.payload?.action == 'sync')
            return this.onPending();
    }
    static get observedAttributes() {
        return ['has-errors', 'has-warnings', 'action'];
    }
    attributeChangedCallback() {
        this.update();
    }
    connectedCallback() {
        if (!this.rendered) {
            this.render();
            this.rendered = true;
        }
    }
}
exports.Component = Component;


/***/ }),

/***/ "./node_modules/@roots/bud-server/lib/cjs/client/indicator/indicator.controller.js":
/***/ (function(__unused_webpack_module, exports) {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.Controller = void 0;
/**
 * Activity indicator controller
 * @public
 */
class Controller {
    /**
     * Initialization
     * @public
     */
    constructor() {
        /**
         * DOM node
         * @public
         */
        this.node = null;
        /**
         * Active WHM payload
         * @public
         */
        this.payload = null;
        this.node = document.createElement('bud-activity-indicator');
        document.body && document.body.appendChild(this.node);
    }
    /**
     * Update activity indicator
     * @public
     */
    update(payload) {
        this.node.payload = payload;
        this.node.setAttribute('has-warnings', payload.errors?.length);
        this.node.setAttribute('has-errors', payload.warnings?.length);
    }
}
exports.Controller = Controller;


/***/ }),

/***/ "./node_modules/@roots/bud-server/lib/cjs/client/indicator/indicator.pulse.js":
/***/ (function(__unused_webpack_module, exports) {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.pulse = void 0;
/**
 * CSS animation for reload indicator
 * @public
 */
const pulse = (name, color) => `
  .${name} {
    transform: scale(1);
    background: rgba(${color[0]}, ${color[1]}, ${color[2]}, 1);
    box-shadow: 0 0 0 0 rgba(${color[0]}, ${color[1]}, ${color[2]}, 1);
    animation: ${name}__pulse 2s infinite;
  }

  @keyframes ${name}__pulse {
    0% {
      transform: scale(0.95);
      box-shadow: 0 0 0 0 rgba(${color[0]}, ${color[1]}, ${color[2]}, 0.7);
    }

    70% {
      transform: scale(1);
      box-shadow: 0 0 0 10px rgba(${color[0]}, ${color[1]}, ${color[2]}, 0);
    }

    100% {
      transform: scale(0.95);
      box-shadow: 0 0 0 0 rgba(${color[0]}, ${color[1]}, ${color[2]}, 0);
    }
  }
`;
exports.pulse = pulse;


/***/ }),

/***/ "./node_modules/@roots/bud-server/lib/cjs/client/overlay/index.js":
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    var desc = Object.getOwnPropertyDescriptor(m, k);
    if (!desc || ("get" in desc ? !m.__esModule : desc.writable || desc.configurable)) {
      desc = { enumerable: true, get: function() { return m[k]; } };
    }
    Object.defineProperty(o, k2, desc);
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __setModuleDefault = (this && this.__setModuleDefault) || (Object.create ? (function(o, v) {
    Object.defineProperty(o, "default", { enumerable: true, value: v });
}) : function(o, v) {
    o["default"] = v;
});
var __importStar = (this && this.__importStar) || function (mod) {
    if (mod && mod.__esModule) return mod;
    var result = {};
    if (mod != null) for (var k in mod) if (k !== "default" && Object.prototype.hasOwnProperty.call(mod, k)) __createBinding(result, mod, k);
    __setModuleDefault(result, mod);
    return result;
};
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.make = void 0;
const make = async () => {
    const { Controller } = await Promise.resolve().then(() => __importStar(__webpack_require__("./node_modules/@roots/bud-server/lib/cjs/client/overlay/overlay.controller.js")));
    const { Component } = await Promise.resolve().then(() => __importStar(__webpack_require__("./node_modules/@roots/bud-server/lib/cjs/client/overlay/overlay.component.js")));
    if (customElements.get('bud-error'))
        return;
    customElements.define('bud-error', Component);
    return new Controller();
};
exports.make = make;


/***/ }),

/***/ "./node_modules/@roots/bud-server/lib/cjs/client/overlay/overlay.component.js":
/***/ (function(__unused_webpack_module, exports) {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.Component = void 0;
/**
 * Component container
 *
 * @public
 */
class Component extends HTMLElement {
    constructor() {
        super(...arguments);
        this.name = `bud-overlay`;
    }
    get message() {
        return this.getAttribute('message');
    }
    /**
     * Render component
     *
     * @public
     */
    render() {
        this.rendered = true;
        this.classList.add(this.name);
    }
    setInnerHtml(content) {
        this.innerHTML = `
    <style>
      .${this.name} {
        display: none;
        width: 100vw;
        height: 100vh;
        overflow-x: hidden;
        overflow-y: scroll;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        transition: all 0.2s ease-in-out;
        justify-content: center;
      }
      .${this.name}__visible {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.75);
        border-top: 3px solid red;
        display: flex;
        align-items: center;
        align-content: center;
        flex-direction: column;
        transition: all 0.2s ease-in-out;
      }
      .${this.name} > div {
        align-items: center;
        align-content: center;
        flex-direction: column;
        padding: 1rem;
      }
      .${this.name} > div > * {
        display: inline-block;
        width: 100vw;
        padding: 1rem;
      }
      .${this.name} > div > span {
        font-size: 1.5rem;
        font-weight: 500;
      }
      .${this.name} > div > pre {
        font-size: 0.8rem;
        overflow-x: scroll;
      }
    </style>
    ${content ?? ''}
  `;
    }
    static get observedAttributes() {
        return ['message'];
    }
    attributeChangedCallback() {
        if (this.getAttribute('message')) {
            document.body.style.overflow = 'hidden';
            !this.classList.contains(`${this.name}__visible`) &&
                this.classList.add(`${this.name}__visible`);
            return this.setInnerHtml(this.getAttribute('message'));
        }
        document.body.style.overflow = this.documentBodyStyle.overflow;
        this.classList.contains(`${this.name}__visible`) &&
            this.classList.remove(`${this.name}__visible`);
    }
    connectedCallback() {
        this.documentBodyStyle = document.body.style;
        if (this.rendered)
            return;
        this.render();
    }
}
exports.Component = Component;


/***/ }),

/***/ "./node_modules/@roots/bud-server/lib/cjs/client/overlay/overlay.controller.js":
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.Controller = void 0;
const strip_ansi_1 = __importDefault(__webpack_require__("./node_modules/strip-ansi/index.js"));
/**
 * Overlay controller
 * @public
 */
class Controller {
    /**
     * Class constructor
     * @public
     */
    constructor() {
        this.element = document.createElement('bud-error');
        document.body && document.body.appendChild(this.element);
    }
    /**
     * Formatted error message
     * @public
     */
    get message() {
        return this.payload.errors?.reduce((a, c) => `${a}
        <div>
          <span>${c?.title ?? 'Compilation error'}</span>
          <pre>${(0, strip_ansi_1.default)(c?.message) ?? ''}</pre>
        </div>`, ``);
    }
    /**
     * Update element
     * @public
     */
    update(payload) {
        this.payload = payload;
        this.element.setAttribute('message', this.message ?? ``);
    }
}
exports.Controller = Controller;


/***/ }),

/***/ "./node_modules/@roots/bud-server/lib/cjs/client/process-update.js":
/***/ (function(module, __unused_webpack_exports, __webpack_require__) {

/* eslint-disable no-console */
/**
 * Based heavily on https://github.com/webpack/webpack/blob/
 *  c0afdf9c6abc1dd70707c594e473802a566f7b6e/hot/only-dev-server.js
 * Original copyright Tobias Koppers @sokra (MIT license)
 */
/* global window __webpack_hash__ */
if (false) {}
var hmrDocsUrl = 'https://webpack.js.org/concepts/hot-module-replacement/'; // eslint-disable-line max-len
var lastHash;
var failureStatuses = { abort: 1, fail: 1 };
function upToDate(hash) {
    if (hash)
        lastHash = hash;
    return lastHash == __webpack_require__.h();
}
module.exports = function (hash, moduleMap, options) {
    var reload = options.reload;
    if (!upToDate(hash) && module.hot.status() == 'idle') {
        if (options.log)
            console.log('[HMR] Checking for updates on the server...');
        check();
    }
    function check() {
        var cb = function (err, updatedModules) {
            if (err)
                return handleError(err);
            if (!updatedModules) {
                if (options.warn) {
                    console.warn('[HMR] Cannot find update (Full reload needed)');
                    console.warn('[HMR] (Probably because of restarting the server)');
                }
                performReload();
                return null;
            }
            var failedUpdate = false;
            var applyCallback = function (applyErr, renewedModules) {
                if (applyErr)
                    return handleError(applyErr);
                if (!upToDate())
                    check();
                logUpdates(updatedModules, renewedModules);
                if (failedUpdate) {
                    performReload();
                }
            };
            var applyOptions = {
                ignoreUnaccepted: true,
                ignoreDeclined: true,
                ignoreErrored: true,
                onUnaccepted: function (data) {
                    console.warn('Ignored an update to unaccepted module ' +
                        data.chain.join(' -> '));
                    failedUpdate = true;
                },
                onDeclined: function (data) {
                    console.warn('Ignored an update to declined module ' +
                        data.chain.join(' -> '));
                    failedUpdate = true;
                },
                onErrored: function (data) {
                    console.error(data.error);
                    console.warn('Ignored an error while updating module ' +
                        data.moduleId +
                        ' (' +
                        data.type +
                        ')');
                    failedUpdate = true;
                },
            };
            var applyResult = module.hot.apply(applyOptions, applyCallback);
            // webpack 2 promise
            if (applyResult && applyResult.then) {
                // HotModuleReplacement.runtime.js refers to the result as `outdatedModules`
                applyResult.then(function (outdatedModules) {
                    applyCallback(null, outdatedModules);
                });
                applyResult.catch(applyCallback);
            }
        };
        var result = module.hot.check(false, cb);
        // webpack 2 promise
        if (result && result.then) {
            result.then(function (updatedModules) {
                cb(null, updatedModules);
            });
            result.catch(cb);
        }
    }
    function logUpdates(updatedModules, renewedModules) {
        var unacceptedModules = updatedModules.filter(function (moduleId) {
            return renewedModules && renewedModules.indexOf(moduleId) < 0;
        });
        if (unacceptedModules.length > 0) {
            if (options.warn) {
                console.warn("[HMR] The following modules couldn't be hot updated: " +
                    '(Full reload needed)\n' +
                    'This is usually because the modules which have changed ' +
                    '(and their parents) do not know how to hot reload themselves. ' +
                    'See ' +
                    hmrDocsUrl +
                    ' for more details.');
                unacceptedModules.forEach(function (moduleId) {
                    console.warn('[HMR]  - ' + (moduleMap[moduleId] || moduleId));
                });
            }
            performReload();
            return;
        }
        if (options.log) {
            if (!renewedModules || renewedModules.length === 0) {
                console.log('[HMR] Nothing hot updated.');
            }
            else {
                console.log('[HMR] Updated modules:');
                renewedModules.forEach(function (moduleId) {
                    console.log('[HMR]  - ' + (moduleMap[moduleId] || moduleId));
                });
            }
            if (upToDate()) {
                console.log('[HMR] App is up to date.');
            }
        }
    }
    function handleError(err) {
        if (module.hot.status() in failureStatuses) {
            if (options.warn) {
                console.warn('[HMR] Cannot check for update (Full reload needed)');
                console.warn('[HMR] ' + (err.stack || err.message));
            }
            performReload();
            return;
        }
        if (options.warn) {
            console.warn('[HMR] Update check failed: ' + (err.stack || err.message));
        }
    }
    function performReload() {
        if (reload) {
            if (options.warn)
                console.warn('[HMR] Reloading page');
            window.location.reload();
        }
    }
};


/***/ }),

/***/ "./node_modules/@roots/bud-server/lib/cjs/client/proxy-click-interceptor.js":
/***/ (function() {

/* global __resourceQuery */
/* eslint-disable no-console, no-extra-semi */
// @ts-check
const collect = () => [
    [document.getElementsByTagName('a'), 'href'],
    [document.getElementsByTagName('link'), 'href'],
    [document.getElementsByTagName('form'), 'action'],
];
const main = async () => {
    const { headers } = await fetch(window.location.origin, {
        method: 'GET',
    });
    const origin = {
        proxy: headers.get('x-bud-proxy-origin'),
        dev: headers.get('x-bud-dev-origin'),
    };
    const normalize = ([elements, attribute]) => [
        Array.from(elements),
        attribute,
    ];
    const filter = ([elements, attribute]) => elements.filter(el => el.getAttribute(attribute)?.includes(origin.proxy)).length;
    const mapElements = ([elements, attribute]) => {
        elements.map(el => {
            const value = el.getAttribute(attribute);
            if (!value)
                return;
            el.setAttribute(attribute, value.replace(origin.proxy, origin.dev));
        });
    };
    collect().map(normalize).filter(filter).map(mapElements);
};
(async () => window.requestAnimationFrame(async function ready() {
    return document.body
        ? await main()
        : window.requestAnimationFrame(ready);
}))();


/***/ }),

/***/ 329:
/***/ (function(__unused_webpack_module, exports) {

"use strict";

Object.defineProperty(exports, "__esModule", ({ value: true }));
const domReady = onReady => {
    window.requestAnimationFrame(function check() {
        document.body ? onReady() : window.requestAnimationFrame(check);
    });
};
exports["default"] = domReady;


/***/ }),

/***/ 194:
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";

var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.domReady = void 0;
const domReady_1 = __importDefault(__webpack_require__(329));
exports.domReady = domReady_1.default;


/***/ }),

/***/ "./node_modules/ansi-regex/index.js":
/***/ (function(module) {

"use strict";


module.exports = ({onlyFirst = false} = {}) => {
	const pattern = [
		'[\\u001B\\u009B][[\\]()#;?]*(?:(?:(?:(?:;[-a-zA-Z\\d\\/#&.:=?%@~_]+)*|[a-zA-Z\\d]+(?:;[-a-zA-Z\\d\\/#&.:=?%@~_]*)*)?\\u0007)',
		'(?:(?:\\d{1,4}(?:;\\d{0,4})*)?[\\dA-PR-TZcf-ntqry=><~]))'
	].join('|');

	return new RegExp(pattern, onlyFirst ? undefined : 'g');
};


/***/ }),

/***/ "./node_modules/css-loader/dist/runtime/api.js":
/***/ (function(module) {

"use strict";


/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
*/
module.exports = function (cssWithMappingToString) {
  var list = []; // return the list of modules as css string

  list.toString = function toString() {
    return this.map(function (item) {
      var content = "";
      var needLayer = typeof item[5] !== "undefined";

      if (item[4]) {
        content += "@supports (".concat(item[4], ") {");
      }

      if (item[2]) {
        content += "@media ".concat(item[2], " {");
      }

      if (needLayer) {
        content += "@layer".concat(item[5].length > 0 ? " ".concat(item[5]) : "", " {");
      }

      content += cssWithMappingToString(item);

      if (needLayer) {
        content += "}";
      }

      if (item[2]) {
        content += "}";
      }

      if (item[4]) {
        content += "}";
      }

      return content;
    }).join("");
  }; // import a list of modules into the list


  list.i = function i(modules, media, dedupe, supports, layer) {
    if (typeof modules === "string") {
      modules = [[null, modules, undefined]];
    }

    var alreadyImportedModules = {};

    if (dedupe) {
      for (var k = 0; k < this.length; k++) {
        var id = this[k][0];

        if (id != null) {
          alreadyImportedModules[id] = true;
        }
      }
    }

    for (var _k = 0; _k < modules.length; _k++) {
      var item = [].concat(modules[_k]);

      if (dedupe && alreadyImportedModules[item[0]]) {
        continue;
      }

      if (typeof layer !== "undefined") {
        if (typeof item[5] === "undefined") {
          item[5] = layer;
        } else {
          item[1] = "@layer".concat(item[5].length > 0 ? " ".concat(item[5]) : "", " {").concat(item[1], "}");
          item[5] = layer;
        }
      }

      if (media) {
        if (!item[2]) {
          item[2] = media;
        } else {
          item[1] = "@media ".concat(item[2], " {").concat(item[1], "}");
          item[2] = media;
        }
      }

      if (supports) {
        if (!item[4]) {
          item[4] = "".concat(supports);
        } else {
          item[1] = "@supports (".concat(item[4], ") {").concat(item[1], "}");
          item[4] = supports;
        }
      }

      list.push(item);
    }
  };

  return list;
};

/***/ }),

/***/ "./node_modules/css-loader/dist/runtime/noSourceMaps.js":
/***/ (function(module) {

"use strict";


module.exports = function (i) {
  return i[1];
};

/***/ }),

/***/ "./node_modules/querystring/decode.js":
/***/ (function(module) {

"use strict";
// Copyright Joyent, Inc. and other Node contributors.
//
// Permission is hereby granted, free of charge, to any person obtaining a
// copy of this software and associated documentation files (the
// "Software"), to deal in the Software without restriction, including
// without limitation the rights to use, copy, modify, merge, publish,
// distribute, sublicense, and/or sell copies of the Software, and to permit
// persons to whom the Software is furnished to do so, subject to the
// following conditions:
//
// The above copyright notice and this permission notice shall be included
// in all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
// OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
// MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN
// NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
// DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
// OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE
// USE OR OTHER DEALINGS IN THE SOFTWARE.



// If obj.hasOwnProperty has been overridden, then calling
// obj.hasOwnProperty(prop) will break.
// See: https://github.com/joyent/node/issues/1707
function hasOwnProperty(obj, prop) {
  return Object.prototype.hasOwnProperty.call(obj, prop);
}

module.exports = function(qs, sep, eq, options) {
  sep = sep || '&';
  eq = eq || '=';
  var obj = {};

  if (typeof qs !== 'string' || qs.length === 0) {
    return obj;
  }

  var regexp = /\+/g;
  qs = qs.split(sep);

  var maxKeys = 1000;
  if (options && typeof options.maxKeys === 'number') {
    maxKeys = options.maxKeys;
  }

  var len = qs.length;
  // maxKeys <= 0 means that we should not limit keys count
  if (maxKeys > 0 && len > maxKeys) {
    len = maxKeys;
  }

  for (var i = 0; i < len; ++i) {
    var x = qs[i].replace(regexp, '%20'),
        idx = x.indexOf(eq),
        kstr, vstr, k, v;

    if (idx >= 0) {
      kstr = x.substr(0, idx);
      vstr = x.substr(idx + 1);
    } else {
      kstr = x;
      vstr = '';
    }

    k = decodeURIComponent(kstr);
    v = decodeURIComponent(vstr);

    if (!hasOwnProperty(obj, k)) {
      obj[k] = v;
    } else if (Array.isArray(obj[k])) {
      obj[k].push(v);
    } else {
      obj[k] = [obj[k], v];
    }
  }

  return obj;
};


/***/ }),

/***/ "./node_modules/querystring/encode.js":
/***/ (function(module) {

"use strict";
// Copyright Joyent, Inc. and other Node contributors.
//
// Permission is hereby granted, free of charge, to any person obtaining a
// copy of this software and associated documentation files (the
// "Software"), to deal in the Software without restriction, including
// without limitation the rights to use, copy, modify, merge, publish,
// distribute, sublicense, and/or sell copies of the Software, and to permit
// persons to whom the Software is furnished to do so, subject to the
// following conditions:
//
// The above copyright notice and this permission notice shall be included
// in all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
// OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
// MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN
// NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
// DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
// OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE
// USE OR OTHER DEALINGS IN THE SOFTWARE.



var stringifyPrimitive = function(v) {
  switch (typeof v) {
    case 'string':
      return v;

    case 'boolean':
      return v ? 'true' : 'false';

    case 'number':
      return isFinite(v) ? v : '';

    default:
      return '';
  }
};

module.exports = function(obj, sep, eq, name) {
  sep = sep || '&';
  eq = eq || '=';
  if (obj === null) {
    obj = undefined;
  }

  if (typeof obj === 'object') {
    return Object.keys(obj).map(function(k) {
      var ks = encodeURIComponent(stringifyPrimitive(k)) + eq;
      if (Array.isArray(obj[k])) {
        return obj[k].map(function(v) {
          return ks + encodeURIComponent(stringifyPrimitive(v));
        }).join(sep);
      } else {
        return ks + encodeURIComponent(stringifyPrimitive(obj[k]));
      }
    }).filter(Boolean).join(sep);

  }

  if (!name) return '';
  return encodeURIComponent(stringifyPrimitive(name)) + eq +
         encodeURIComponent(stringifyPrimitive(obj));
};


/***/ }),

/***/ "./node_modules/querystring/index.js":
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";


exports.decode = exports.parse = __webpack_require__("./node_modules/querystring/decode.js");
exports.encode = exports.stringify = __webpack_require__("./node_modules/querystring/encode.js");


/***/ }),

/***/ "./node_modules/strip-ansi/index.js":
/***/ (function(module, __unused_webpack_exports, __webpack_require__) {

"use strict";

const ansiRegex = __webpack_require__("./node_modules/ansi-regex/index.js");

module.exports = string => typeof string === 'string' ? string.replace(ansiRegex(), '') : string;


/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js":
/***/ (function(module) {

"use strict";


var stylesInDOM = [];

function getIndexByIdentifier(identifier) {
  var result = -1;

  for (var i = 0; i < stylesInDOM.length; i++) {
    if (stylesInDOM[i].identifier === identifier) {
      result = i;
      break;
    }
  }

  return result;
}

function modulesToDom(list, options) {
  var idCountMap = {};
  var identifiers = [];

  for (var i = 0; i < list.length; i++) {
    var item = list[i];
    var id = options.base ? item[0] + options.base : item[0];
    var count = idCountMap[id] || 0;
    var identifier = "".concat(id, " ").concat(count);
    idCountMap[id] = count + 1;
    var indexByIdentifier = getIndexByIdentifier(identifier);
    var obj = {
      css: item[1],
      media: item[2],
      sourceMap: item[3],
      supports: item[4],
      layer: item[5]
    };

    if (indexByIdentifier !== -1) {
      stylesInDOM[indexByIdentifier].references++;
      stylesInDOM[indexByIdentifier].updater(obj);
    } else {
      var updater = addElementStyle(obj, options);
      options.byIndex = i;
      stylesInDOM.splice(i, 0, {
        identifier: identifier,
        updater: updater,
        references: 1
      });
    }

    identifiers.push(identifier);
  }

  return identifiers;
}

function addElementStyle(obj, options) {
  var api = options.domAPI(options);
  api.update(obj);

  var updater = function updater(newObj) {
    if (newObj) {
      if (newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap && newObj.supports === obj.supports && newObj.layer === obj.layer) {
        return;
      }

      api.update(obj = newObj);
    } else {
      api.remove();
    }
  };

  return updater;
}

module.exports = function (list, options) {
  options = options || {};
  list = list || [];
  var lastIdentifiers = modulesToDom(list, options);
  return function update(newList) {
    newList = newList || [];

    for (var i = 0; i < lastIdentifiers.length; i++) {
      var identifier = lastIdentifiers[i];
      var index = getIndexByIdentifier(identifier);
      stylesInDOM[index].references--;
    }

    var newLastIdentifiers = modulesToDom(newList, options);

    for (var _i = 0; _i < lastIdentifiers.length; _i++) {
      var _identifier = lastIdentifiers[_i];

      var _index = getIndexByIdentifier(_identifier);

      if (stylesInDOM[_index].references === 0) {
        stylesInDOM[_index].updater();

        stylesInDOM.splice(_index, 1);
      }
    }

    lastIdentifiers = newLastIdentifiers;
  };
};

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/insertBySelector.js":
/***/ (function(module) {

"use strict";


var memo = {};
/* istanbul ignore next  */

function getTarget(target) {
  if (typeof memo[target] === "undefined") {
    var styleTarget = document.querySelector(target); // Special case to return head of iframe instead of iframe itself

    if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
      try {
        // This will throw an exception if access to iframe is blocked
        // due to cross-origin restrictions
        styleTarget = styleTarget.contentDocument.head;
      } catch (e) {
        // istanbul ignore next
        styleTarget = null;
      }
    }

    memo[target] = styleTarget;
  }

  return memo[target];
}
/* istanbul ignore next  */


function insertBySelector(insert, style) {
  var target = getTarget(insert);

  if (!target) {
    throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
  }

  target.appendChild(style);
}

module.exports = insertBySelector;

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/insertStyleElement.js":
/***/ (function(module) {

"use strict";


/* istanbul ignore next  */
function insertStyleElement(options) {
  var element = document.createElement("style");
  options.setAttributes(element, options.attributes);
  options.insert(element, options.options);
  return element;
}

module.exports = insertStyleElement;

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/setAttributesWithoutAttributes.js":
/***/ (function(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


/* istanbul ignore next  */
function setAttributesWithoutAttributes(styleElement) {
  var nonce =  true ? __webpack_require__.nc : 0;

  if (nonce) {
    styleElement.setAttribute("nonce", nonce);
  }
}

module.exports = setAttributesWithoutAttributes;

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/styleDomAPI.js":
/***/ (function(module) {

"use strict";


/* istanbul ignore next  */
function apply(styleElement, options, obj) {
  var css = "";

  if (obj.supports) {
    css += "@supports (".concat(obj.supports, ") {");
  }

  if (obj.media) {
    css += "@media ".concat(obj.media, " {");
  }

  var needLayer = typeof obj.layer !== "undefined";

  if (needLayer) {
    css += "@layer".concat(obj.layer.length > 0 ? " ".concat(obj.layer) : "", " {");
  }

  css += obj.css;

  if (needLayer) {
    css += "}";
  }

  if (obj.media) {
    css += "}";
  }

  if (obj.supports) {
    css += "}";
  }

  var sourceMap = obj.sourceMap;

  if (sourceMap && typeof btoa !== "undefined") {
    css += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))), " */");
  } // For old IE

  /* istanbul ignore if  */


  options.styleTagTransform(css, styleElement, options.options);
}

function removeStyleElement(styleElement) {
  // istanbul ignore if
  if (styleElement.parentNode === null) {
    return false;
  }

  styleElement.parentNode.removeChild(styleElement);
}
/* istanbul ignore next  */


function domAPI(options) {
  var styleElement = options.insertStyleElement(options);
  return {
    update: function update(obj) {
      apply(styleElement, options, obj);
    },
    remove: function remove() {
      removeStyleElement(styleElement);
    }
  };
}

module.exports = domAPI;

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/styleTagTransform.js":
/***/ (function(module) {

"use strict";


/* istanbul ignore next  */
function styleTagTransform(css, styleElement) {
  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css;
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild);
    }

    styleElement.appendChild(document.createTextNode(css));
  }
}

module.exports = styleTagTransform;

/***/ })

}]);