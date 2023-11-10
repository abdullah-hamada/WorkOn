(self["webpackChunkmaterio_vuetify_vuejs_laravel_admin_template_free"] = self["webpackChunkmaterio_vuetify_vuejs_laravel_admin_template_free"] || []).push([["resources_js_src_views_Auth_ForgotPassword_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/layouts/dashboard/Blank.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/layouts/dashboard/Blank.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
//
//
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _mdi_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @mdi/js */ "./node_modules/@mdi/js/mdi.js");
/* harmony import */ var _layouts_dashboard_Blank__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../layouts/dashboard/Blank */ "./resources/js/src/layouts/dashboard/Blank.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
// eslint-disable-next-line object-curly-newline


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  layout: _layouts_dashboard_Blank__WEBPACK_IMPORTED_MODULE_0__["default"],
  props: {
    status: String
  },
  data: function data() {
    return {
      form: this.$inertia.form({
        email: null
      }),
      isPasswordVisible: null,
      socialLink: [{
        icon: _mdi_js__WEBPACK_IMPORTED_MODULE_1__.mdiFacebook,
        color: '#4267b2',
        colorInDark: '#4267b2'
      }, {
        icon: _mdi_js__WEBPACK_IMPORTED_MODULE_1__.mdiTwitter,
        color: '#1da1f2',
        colorInDark: '#1da1f2'
      }, // {
      //   icon: mdiGithub,
      //   color: '#272727',
      //   colorInDark: '#fff',
      // },
      {
        icon: _mdi_js__WEBPACK_IMPORTED_MODULE_1__.mdiGoogle,
        color: '#db4437',
        colorInDark: '#db4437'
      }],
      icons: {
        mdiEyeOutline: _mdi_js__WEBPACK_IMPORTED_MODULE_1__.mdiEyeOutline,
        mdiEyeOffOutline: _mdi_js__WEBPACK_IMPORTED_MODULE_1__.mdiEyeOffOutline
      }
    };
  },
  methods: {
    submit: function submit() {
      this.form.post('forgot-password');
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-21[0].rules[0].use[2]!./node_modules/vuetify/src/components/VAlert/VAlert.sass":
/*!**********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-21[0].rules[0].use[2]!./node_modules/vuetify/src/components/VAlert/VAlert.sass ***!
  \**********************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../css-loader/dist/runtime/noSourceMaps.js */ "./node_modules/css-loader/dist/runtime/noSourceMaps.js");
/* harmony import */ var _css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1__);
// Imports


var ___CSS_LOADER_EXPORT___ = _css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1___default()((_css_loader_dist_runtime_noSourceMaps_js__WEBPACK_IMPORTED_MODULE_0___default()));
// Module
___CSS_LOADER_EXPORT___.push([module.id, ".theme--light.v-alert .v-alert--prominent .v-alert__icon:after {\n  background: rgba(94, 86, 105, 0.14);\n}\n\n.theme--dark.v-alert .v-alert--prominent .v-alert__icon:after {\n  background: rgba(231, 227, 252, 0.14);\n}\n\n.v-sheet.v-alert {\n  border-radius: 5px;\n}\n.v-sheet.v-alert:not(.v-sheet--outlined) {\n  box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.2), 0px 0px 0px 0px rgba(0, 0, 0, 0.14), 0px 0px 0px 0px rgba(0, 0, 0, 0.12);\n}\n.v-sheet.v-alert.v-sheet--shaped {\n  border-radius: 24px 5px;\n}\n\n.v-alert {\n  display: block;\n  font-size: 16px;\n  margin-bottom: 16px;\n  padding: 13px 16px;\n  position: relative;\n  transition: 0.3s cubic-bezier(0.25, 0.8, 0.5, 1);\n}\n.v-alert:not(.v-sheet--tile) {\n  border-radius: 5px;\n}\n.v-application--is-ltr .v-alert > .v-icon,\n.v-application--is-ltr .v-alert > .v-alert__content {\n  margin-right: 16px;\n}\n.v-application--is-rtl .v-alert > .v-icon,\n.v-application--is-rtl .v-alert > .v-alert__content {\n  margin-left: 16px;\n}\n.v-application--is-ltr .v-alert > .v-icon + .v-alert__content {\n  margin-right: 0;\n}\n.v-application--is-rtl .v-alert > .v-icon + .v-alert__content {\n  margin-left: 0;\n}\n.v-application--is-ltr .v-alert > .v-alert__content + .v-icon {\n  margin-right: 0;\n}\n.v-application--is-rtl .v-alert > .v-alert__content + .v-icon {\n  margin-left: 0;\n}\n\n.v-alert__border {\n  border-style: solid;\n  border-width: 4px;\n  content: \"\";\n  position: absolute;\n}\n.v-alert__border:not(.v-alert__border--has-color) {\n  opacity: 0.26;\n}\n.v-alert__border--left, .v-alert__border--right {\n  bottom: 0;\n  top: 0;\n}\n.v-alert__border--bottom, .v-alert__border--top {\n  left: 0;\n  right: 0;\n}\n.v-alert__border--bottom {\n  border-bottom-left-radius: inherit;\n  border-bottom-right-radius: inherit;\n  bottom: 0;\n}\n.v-application--is-ltr .v-alert__border--left {\n  border-top-left-radius: inherit;\n  border-bottom-left-radius: inherit;\n  left: 0;\n}\n.v-application--is-rtl .v-alert__border--left {\n  border-top-right-radius: inherit;\n  border-bottom-right-radius: inherit;\n  right: 0;\n}\n.v-application--is-ltr .v-alert__border--right {\n  border-top-right-radius: inherit;\n  border-bottom-right-radius: inherit;\n  right: 0;\n}\n.v-application--is-rtl .v-alert__border--right {\n  border-top-left-radius: inherit;\n  border-bottom-left-radius: inherit;\n  left: 0;\n}\n.v-alert__border--top {\n  border-top-left-radius: inherit;\n  border-top-right-radius: inherit;\n  top: 0;\n}\n\n.v-alert__content {\n  flex: 1 1 auto;\n}\n\n.v-application--is-ltr .v-alert__dismissible {\n  margin: -16px -8px -16px 8px;\n}\n.v-application--is-rtl .v-alert__dismissible {\n  margin: -16px 8px -16px -8px;\n}\n\n.v-alert__icon {\n  align-self: flex-start;\n  border-radius: 50%;\n  height: 24px;\n  min-width: 24px;\n  position: relative;\n}\n.v-application--is-ltr .v-alert__icon {\n  margin-right: 16px;\n}\n.v-application--is-rtl .v-alert__icon {\n  margin-left: 16px;\n}\n.v-alert__icon.v-icon {\n  font-size: 24px;\n}\n\n.v-alert__wrapper {\n  align-items: center;\n  border-radius: inherit;\n  display: flex;\n}\n\n.v-application--is-ltr .v-alert--border.v-alert--prominent .v-alert__icon {\n  margin-left: 8px;\n}\n.v-application--is-rtl .v-alert--border.v-alert--prominent .v-alert__icon {\n  margin-right: 8px;\n}\n\n.v-alert--dense {\n  padding-top: 13px 16px/2;\n  padding-bottom: 13px 16px/2;\n}\n.v-alert--dense .v-alert__border {\n  border-width: medium;\n}\n\n.v-alert--outlined {\n  background: transparent !important;\n  border: thin solid currentColor !important;\n}\n.v-alert--outlined .v-alert__icon {\n  color: inherit !important;\n}\n\n.v-alert--prominent .v-alert__icon {\n  align-self: center;\n  height: 48px;\n  min-width: 48px;\n}\n.v-alert--prominent .v-alert__icon.v-icon {\n  font-size: 32px;\n}\n.v-alert--prominent .v-alert__icon.v-icon:after {\n  background: currentColor !important;\n  border-radius: 50%;\n  bottom: 0;\n  content: \"\";\n  left: 0;\n  opacity: 0.16;\n  position: absolute;\n  right: 0;\n  top: 0;\n}\n.v-alert--prominent.v-alert--dense .v-alert__icon.v-icon::after {\n  transform: scale(1);\n}\n\n.v-alert--text {\n  background: transparent !important;\n}\n.v-alert--text:before {\n  background-color: currentColor;\n  border-radius: inherit;\n  bottom: 0;\n  content: \"\";\n  left: 0;\n  opacity: 0.12;\n  position: absolute;\n  pointer-events: none;\n  right: 0;\n  top: 0;\n}", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./resources/js/src/assets/images/misc/mask-dark.png":
/*!***********************************************************!*\
  !*** ./resources/js/src/assets/images/misc/mask-dark.png ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/mask-dark.png?adc03bf1e813b450e4b930a8fa907e3f");

/***/ }),

/***/ "./resources/js/src/assets/images/misc/mask-light.png":
/*!************************************************************!*\
  !*** ./resources/js/src/assets/images/misc/mask-light.png ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/mask-light.png?77718bde08a293dba49a8d0e35b031f2");

/***/ }),

/***/ "./resources/js/src/assets/images/misc/tree-3.png":
/*!********************************************************!*\
  !*** ./resources/js/src/assets/images/misc/tree-3.png ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/tree-3.png?9dc4b192cc72b872a692b8b2ae0e30c2");

/***/ }),

/***/ "./resources/js/src/assets/images/misc/tree.png":
/*!******************************************************!*\
  !*** ./resources/js/src/assets/images/misc/tree.png ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/tree.png?fb4c6f08be7bec2860b6361574f172d7");

/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[3]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=style&index=0&lang=scss&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[3]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=style&index=0&lang=scss& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js */ "./node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, ".v-application--wrap {\n  font-family: \"system-ui\";\n}\n.auth-wrapper {\n  display: flex;\n  min-height: calc(var(--vh, 1vh) * 100);\n  width: 100%;\n  flex-basis: 100%;\n  align-items: center;\n}\n.auth-wrapper a {\n  text-decoration: unset;\n}\n.auth-wrapper.auth-v1 {\n  align-items: center;\n  justify-content: center;\n  overflow: hidden;\n  padding: 1.5rem;\n}\n.auth-wrapper.auth-v1 .auth-mask-bg {\n  position: absolute;\n  bottom: 0;\n  width: 100%;\n}\n.auth-wrapper.auth-v1 .auth-tree,\n.auth-wrapper.auth-v1 .auth-tree-3 {\n  position: absolute;\n}\n.auth-wrapper.auth-v1 .auth-tree {\n  bottom: 0;\n  left: 0;\n}\n.auth-wrapper.auth-v1 .auth-tree-3 {\n  bottom: 0;\n  right: 0;\n}\n.auth-wrapper.auth-v1 .auth-inner {\n  width: 28rem;\n  z-index: 1;\n}\n.auth-wrapper.auth-v1 .auth-inner .auth-card {\n  padding: 0.9375rem 0.875rem;\n}\n@media (max-width: 600px) {\n.auth-v1 .auth-tree,\n.auth-v1 .auth-tree-3,\n.auth-v1 .auth-mask-bg {\n    display: none;\n}\n}", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[3]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=style&index=0&lang=scss&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[3]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=style&index=0&lang=scss& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_11_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_laravel_mix_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_11_0_rules_0_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_11_0_rules_0_use_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../../node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[1]!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[2]!../../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[3]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ForgotPassword.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[3]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=style&index=0&lang=scss&");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_11_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_laravel_mix_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_11_0_rules_0_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_11_0_rules_0_use_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_11_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_laravel_mix_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_11_0_rules_0_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_11_0_rules_0_use_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/src/layouts/dashboard/Blank.vue?vue&type=script&lang=js&":
/*!*******************************************************************************!*\
  !*** ./resources/js/src/layouts/dashboard/Blank.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Blank_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Blank.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/layouts/dashboard/Blank.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Blank_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ForgotPassword.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=style&index=0&lang=scss&":
/*!******************************************************************************************!*\
  !*** ./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=style&index=0&lang=scss& ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_11_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_laravel_mix_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_11_0_rules_0_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_11_0_rules_0_use_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader/dist/cjs.js!../../../../../node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[1]!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[2]!../../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[3]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ForgotPassword.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/style-loader/dist/cjs.js!./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/laravel-mix/node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-11[0].rules[0].use[3]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=style&index=0&lang=scss&");


/***/ }),

/***/ "./resources/js/src/layouts/dashboard/Blank.vue?vue&type=template&id=a166d78c&":
/*!*************************************************************************************!*\
  !*** ./resources/js/src/layouts/dashboard/Blank.vue?vue&type=template&id=a166d78c& ***!
  \*************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Blank_vue_vue_type_template_id_a166d78c___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Blank_vue_vue_type_template_id_a166d78c___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Blank_vue_vue_type_template_id_a166d78c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Blank.vue?vue&type=template&id=a166d78c& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/layouts/dashboard/Blank.vue?vue&type=template&id=a166d78c&");


/***/ }),

/***/ "./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=template&id=b0227aea&":
/*!***************************************************************************************!*\
  !*** ./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=template&id=b0227aea& ***!
  \***************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_template_id_b0227aea___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_template_id_b0227aea___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ForgotPassword_vue_vue_type_template_id_b0227aea___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ForgotPassword.vue?vue&type=template&id=b0227aea& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=template&id=b0227aea&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/layouts/dashboard/Blank.vue?vue&type=template&id=a166d78c&":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/layouts/dashboard/Blank.vue?vue&type=template&id=a166d78c& ***!
  \****************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("v-app", [_c("v-main", [_vm._t("default")], 2)], 1)
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=template&id=b0227aea&":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=template&id=b0227aea& ***!
  \******************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "auth-wrapper auth-v1" },
    [
      _c(
        "div",
        { staticClass: "auth-inner" },
        [
          _c(
            "v-card",
            { staticClass: "auth-card" },
            [
              _c(
                "v-card-title",
                { staticClass: "d-flex align-center justify-center py-7" },
                [
                  _c(
                    "router-link",
                    { staticClass: "d-flex align-center", attrs: { to: "/" } },
                    [
                      _c("v-img", {
                        staticClass: "me-3",
                        attrs: {
                          src:
                            "/get_file/work_net_logo/" +
                            this.$page.props.logo_settings.logo,
                          alt: "logo",
                          contain: "",
                          "max-height": "30px",
                          "max-width": "30px",
                        },
                      }),
                      _vm._v(" "),
                      _c(
                        "h2",
                        { staticClass: "text-2xl font-weight-semibold" },
                        [_vm._v(_vm._s(this.$page.props.logo_settings.text))]
                      ),
                    ],
                    1
                  ),
                ],
                1
              ),
              _vm._v(" "),
              _c("v-card-text", [
                _c(
                  "p",
                  {
                    staticClass:
                      "text-2xl font-weight-semibold text--primary mb-2",
                  },
                  [_vm._v("مرحبا بكم في ملتقيات! 👋🏻")]
                ),
                _vm._v(" "),
                _c("p", { staticClass: "mb-2" }, [
                  _vm._v("استرجاع كلمة المرور "),
                ]),
              ]),
              _vm._v(" "),
              _c(
                "v-card-text",
                [
                  _vm.status
                    ? _c("v-alert", { attrs: { type: "success" } }, [
                        _vm._v(_vm._s(_vm.status) + "\n        "),
                      ])
                    : _vm._e(),
                  _vm._v(" "),
                  _c(
                    "v-form",
                    {
                      on: {
                        submit: function ($event) {
                          $event.preventDefault()
                          return _vm.submit.apply(null, arguments)
                        },
                      },
                    },
                    [
                      _c("v-text-field", {
                        staticClass: "mb-3",
                        attrs: {
                          "error-messages": _vm.$page.props.errors.email,
                          label: "البريد الإلكتروني",
                          outlined: "",
                          placeholder: "john@example.com",
                        },
                        model: {
                          value: _vm.form.email,
                          callback: function ($$v) {
                            _vm.$set(_vm.form, "email", $$v)
                          },
                          expression: "form.email",
                        },
                      }),
                      _vm._v(" "),
                      _c(
                        "v-btn",
                        {
                          staticClass:
                            " v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default ",
                          attrs: {
                            loading: _vm.form.processing,
                            block: "",
                            color: "blue",
                            type: "submit",
                          },
                        },
                        [_vm._v("\n            تأكيد\n          ")]
                      ),
                    ],
                    1
                  ),
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "v-card-text",
                {
                  staticClass:
                    "d-flex align-center justify-center flex-wrap mt-2",
                },
                [
                  _c("span", { staticClass: "me-2" }, [
                    _vm._v("جديد على منصتنا؟"),
                  ]),
                  _vm._v(" "),
                  _c(
                    "Link",
                    {
                      staticStyle: { color: "blue" },
                      attrs: { href: "/register" },
                    },
                    [_vm._v("إنشاء حساب جديد")]
                  ),
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "v-card-text",
                { staticClass: "d-flex align-center mt-2" },
                [
                  _c("v-divider"),
                  _vm._v(" "),
                  _c("span", { staticClass: "mx-5" }, [_vm._v("أو")]),
                  _vm._v(" "),
                  _c("v-divider"),
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "v-card-actions",
                { staticClass: "d-flex justify-center" },
                _vm._l(_vm.socialLink, function (link) {
                  return _c(
                    "v-btn",
                    {
                      key: link.icon,
                      staticClass: "ms-1",
                      attrs: { icon: "" },
                    },
                    [
                      _c(
                        "v-icon",
                        {
                          attrs: {
                            color: _vm.$vuetify.theme.dark
                              ? link.colorInDark
                              : link.color,
                          },
                        },
                        [
                          _vm._v(
                            "\n            " +
                              _vm._s(link.icon) +
                              "\n          "
                          ),
                        ]
                      ),
                    ],
                    1
                  )
                }),
                1
              ),
            ],
            1
          ),
        ],
        1
      ),
      _vm._v(" "),
      _c("img", {
        staticClass: "auth-mask-bg",
        attrs: {
          src: __webpack_require__("./resources/js/src/assets/images/misc sync recursive ^\\.\\/mask\\-.*\\.png$")("./mask-" +
            (_vm.$vuetify.theme.dark ? "dark" : "light") +
            ".png").default,
          height: "173",
        },
      }),
      _vm._v(" "),
      _c("v-img", {
        staticClass: "auth-tree",
        attrs: {
          src: (__webpack_require__(/*! @/assets/images/misc/tree.png */ "./resources/js/src/assets/images/misc/tree.png")["default"]),
          height: "185",
          width: "247",
        },
      }),
      _vm._v(" "),
      _c("v-img", {
        staticClass: "auth-tree-3",
        attrs: {
          src: (__webpack_require__(/*! @/assets/images/misc/tree-3.png */ "./resources/js/src/assets/images/misc/tree-3.png")["default"]),
          height: "289",
          width: "377",
        },
      }),
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vuetify/src/components/VAlert/VAlert.sass":
/*!****************************************************************!*\
  !*** ./node_modules/vuetify/src/components/VAlert/VAlert.sass ***!
  \****************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(/*! !!../../../../css-loader/dist/cjs.js!../../../../sass-loader/dist/cjs.js??clonedRuleSet-21[0].rules[0].use[2]!./VAlert.sass */ "./node_modules/css-loader/dist/cjs.js!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-21[0].rules[0].use[2]!./node_modules/vuetify/src/components/VAlert/VAlert.sass");
if(content.__esModule) content = content.default;
if(typeof content === 'string') content = [[module.id, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var add = (__webpack_require__(/*! !../../../../vue-style-loader/lib/addStylesClient.js */ "./node_modules/vue-style-loader/lib/addStylesClient.js")["default"])
var update = add("85cde618", content, false, {});
// Hot Module Replacement
if(false) {}

/***/ }),

/***/ "./resources/js/src/layouts/dashboard/Blank.vue":
/*!******************************************************!*\
  !*** ./resources/js/src/layouts/dashboard/Blank.vue ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Blank_vue_vue_type_template_id_a166d78c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Blank.vue?vue&type=template&id=a166d78c& */ "./resources/js/src/layouts/dashboard/Blank.vue?vue&type=template&id=a166d78c&");
/* harmony import */ var _Blank_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Blank.vue?vue&type=script&lang=js& */ "./resources/js/src/layouts/dashboard/Blank.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
/* harmony import */ var _node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! !../../../../../node_modules/vuetify-loader/lib/runtime/installComponents.js */ "./node_modules/vuetify-loader/lib/runtime/installComponents.js");
/* harmony import */ var _node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var vuetify_lib_components_VApp__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! vuetify/lib/components/VApp */ "./node_modules/vuetify/lib/components/VApp/VApp.js");
/* harmony import */ var vuetify_lib_components_VMain__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! vuetify/lib/components/VMain */ "./node_modules/vuetify/lib/components/VMain/VMain.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Blank_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Blank_vue_vue_type_template_id_a166d78c___WEBPACK_IMPORTED_MODULE_0__.render,
  _Blank_vue_vue_type_template_id_a166d78c___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* vuetify-loader */
;


_node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_3___default()(component, {VApp: vuetify_lib_components_VApp__WEBPACK_IMPORTED_MODULE_4__["default"],VMain: vuetify_lib_components_VMain__WEBPACK_IMPORTED_MODULE_5__["default"]})


/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/layouts/dashboard/Blank.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/Auth/ForgotPassword.vue":
/*!********************************************************!*\
  !*** ./resources/js/src/views/Auth/ForgotPassword.vue ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _ForgotPassword_vue_vue_type_template_id_b0227aea___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ForgotPassword.vue?vue&type=template&id=b0227aea& */ "./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=template&id=b0227aea&");
/* harmony import */ var _ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ForgotPassword.vue?vue&type=script&lang=js& */ "./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=script&lang=js&");
/* harmony import */ var _ForgotPassword_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ForgotPassword.vue?vue&type=style&index=0&lang=scss& */ "./resources/js/src/views/Auth/ForgotPassword.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
/* harmony import */ var _node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! !../../../../../node_modules/vuetify-loader/lib/runtime/installComponents.js */ "./node_modules/vuetify-loader/lib/runtime/installComponents.js");
/* harmony import */ var _node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var vuetify_lib_components_VAlert__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! vuetify/lib/components/VAlert */ "./node_modules/vuetify/lib/components/VAlert/VAlert.js");
/* harmony import */ var vuetify_lib_components_VBtn__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! vuetify/lib/components/VBtn */ "./node_modules/vuetify/lib/components/VBtn/VBtn.js");
/* harmony import */ var vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! vuetify/lib/components/VCard */ "./node_modules/vuetify/lib/components/VCard/VCard.js");
/* harmony import */ var vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! vuetify/lib/components/VCard */ "./node_modules/vuetify/lib/components/VCard/index.js");
/* harmony import */ var vuetify_lib_components_VDivider__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! vuetify/lib/components/VDivider */ "./node_modules/vuetify/lib/components/VDivider/VDivider.js");
/* harmony import */ var vuetify_lib_components_VForm__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! vuetify/lib/components/VForm */ "./node_modules/vuetify/lib/components/VForm/VForm.js");
/* harmony import */ var vuetify_lib_components_VIcon__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! vuetify/lib/components/VIcon */ "./node_modules/vuetify/lib/components/VIcon/VIcon.js");
/* harmony import */ var vuetify_lib_components_VImg__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! vuetify/lib/components/VImg */ "./node_modules/vuetify/lib/components/VImg/VImg.js");
/* harmony import */ var vuetify_lib_components_VTextField__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! vuetify/lib/components/VTextField */ "./node_modules/vuetify/lib/components/VTextField/VTextField.js");



;


/* normalize component */

var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _ForgotPassword_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ForgotPassword_vue_vue_type_template_id_b0227aea___WEBPACK_IMPORTED_MODULE_0__.render,
  _ForgotPassword_vue_vue_type_template_id_b0227aea___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* vuetify-loader */
;











_node_modules_vuetify_loader_lib_runtime_installComponents_js__WEBPACK_IMPORTED_MODULE_4___default()(component, {VAlert: vuetify_lib_components_VAlert__WEBPACK_IMPORTED_MODULE_5__["default"],VBtn: vuetify_lib_components_VBtn__WEBPACK_IMPORTED_MODULE_6__["default"],VCard: vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_7__["default"],VCardActions: vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_8__.VCardActions,VCardText: vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_8__.VCardText,VCardTitle: vuetify_lib_components_VCard__WEBPACK_IMPORTED_MODULE_8__.VCardTitle,VDivider: vuetify_lib_components_VDivider__WEBPACK_IMPORTED_MODULE_9__["default"],VForm: vuetify_lib_components_VForm__WEBPACK_IMPORTED_MODULE_10__["default"],VIcon: vuetify_lib_components_VIcon__WEBPACK_IMPORTED_MODULE_11__["default"],VImg: vuetify_lib_components_VImg__WEBPACK_IMPORTED_MODULE_12__["default"],VTextField: vuetify_lib_components_VTextField__WEBPACK_IMPORTED_MODULE_13__["default"]})


/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/Auth/ForgotPassword.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./node_modules/vuetify/lib/components/VAlert/VAlert.js":
/*!**************************************************************!*\
  !*** ./node_modules/vuetify/lib/components/VAlert/VAlert.js ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _src_components_VAlert_VAlert_sass__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../src/components/VAlert/VAlert.sass */ "./node_modules/vuetify/src/components/VAlert/VAlert.sass");
/* harmony import */ var _src_components_VAlert_VAlert_sass__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_src_components_VAlert_VAlert_sass__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _VSheet__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../VSheet */ "./node_modules/vuetify/lib/components/VSheet/index.js");
/* harmony import */ var _VBtn__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../VBtn */ "./node_modules/vuetify/lib/components/VBtn/index.js");
/* harmony import */ var _VIcon__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../VIcon */ "./node_modules/vuetify/lib/components/VIcon/index.js");
/* harmony import */ var _mixins_toggleable__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../mixins/toggleable */ "./node_modules/vuetify/lib/mixins/toggleable/index.js");
/* harmony import */ var _mixins_themeable__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../mixins/themeable */ "./node_modules/vuetify/lib/mixins/themeable/index.js");
/* harmony import */ var _mixins_transitionable__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../mixins/transitionable */ "./node_modules/vuetify/lib/mixins/transitionable/index.js");
/* harmony import */ var _util_mixins__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../util/mixins */ "./node_modules/vuetify/lib/util/mixins.js");
/* harmony import */ var _util_console__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../util/console */ "./node_modules/vuetify/lib/util/console.js");
// Styles
 // Extensions

 // Components


 // Mixins



 // Utilities



/* @vue/component */

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ((0,_util_mixins__WEBPACK_IMPORTED_MODULE_1__["default"])(_VSheet__WEBPACK_IMPORTED_MODULE_2__["default"], _mixins_toggleable__WEBPACK_IMPORTED_MODULE_3__["default"], _mixins_transitionable__WEBPACK_IMPORTED_MODULE_4__["default"]).extend({
  name: 'v-alert',
  props: {
    border: {
      type: String,

      validator(val) {
        return ['top', 'right', 'bottom', 'left'].includes(val);
      }

    },
    closeLabel: {
      type: String,
      default: '$vuetify.close'
    },
    coloredBorder: Boolean,
    dense: Boolean,
    dismissible: Boolean,
    closeIcon: {
      type: String,
      default: '$cancel'
    },
    icon: {
      default: '',
      type: [Boolean, String],

      validator(val) {
        return typeof val === 'string' || val === false;
      }

    },
    outlined: Boolean,
    prominent: Boolean,
    text: Boolean,
    type: {
      type: String,

      validator(val) {
        return ['info', 'error', 'success', 'warning'].includes(val);
      }

    },
    value: {
      type: Boolean,
      default: true
    }
  },
  computed: {
    __cachedBorder() {
      if (!this.border) return null;
      let data = {
        staticClass: 'v-alert__border',
        class: {
          [`v-alert__border--${this.border}`]: true
        }
      };

      if (this.coloredBorder) {
        data = this.setBackgroundColor(this.computedColor, data);
        data.class['v-alert__border--has-color'] = true;
      }

      return this.$createElement('div', data);
    },

    __cachedDismissible() {
      if (!this.dismissible) return null;
      const color = this.iconColor;
      return this.$createElement(_VBtn__WEBPACK_IMPORTED_MODULE_5__["default"], {
        staticClass: 'v-alert__dismissible',
        props: {
          color,
          icon: true,
          small: true
        },
        attrs: {
          'aria-label': this.$vuetify.lang.t(this.closeLabel)
        },
        on: {
          click: () => this.isActive = false
        }
      }, [this.$createElement(_VIcon__WEBPACK_IMPORTED_MODULE_6__["default"], {
        props: {
          color
        }
      }, this.closeIcon)]);
    },

    __cachedIcon() {
      if (!this.computedIcon) return null;
      return this.$createElement(_VIcon__WEBPACK_IMPORTED_MODULE_6__["default"], {
        staticClass: 'v-alert__icon',
        props: {
          color: this.iconColor
        }
      }, this.computedIcon);
    },

    classes() {
      const classes = { ..._VSheet__WEBPACK_IMPORTED_MODULE_2__["default"].options.computed.classes.call(this),
        'v-alert--border': Boolean(this.border),
        'v-alert--dense': this.dense,
        'v-alert--outlined': this.outlined,
        'v-alert--prominent': this.prominent,
        'v-alert--text': this.text
      };

      if (this.border) {
        classes[`v-alert--border-${this.border}`] = true;
      }

      return classes;
    },

    computedColor() {
      return this.color || this.type;
    },

    computedIcon() {
      if (this.icon === false) return false;
      if (typeof this.icon === 'string' && this.icon) return this.icon;
      if (!['error', 'info', 'success', 'warning'].includes(this.type)) return false;
      return `$${this.type}`;
    },

    hasColoredIcon() {
      return this.hasText || Boolean(this.border) && this.coloredBorder;
    },

    hasText() {
      return this.text || this.outlined;
    },

    iconColor() {
      return this.hasColoredIcon ? this.computedColor : undefined;
    },

    isDark() {
      if (this.type && !this.coloredBorder && !this.outlined) return true;
      return _mixins_themeable__WEBPACK_IMPORTED_MODULE_7__["default"].options.computed.isDark.call(this);
    }

  },

  created() {
    /* istanbul ignore next */
    if (this.$attrs.hasOwnProperty('outline')) {
      (0,_util_console__WEBPACK_IMPORTED_MODULE_8__.breaking)('outline', 'outlined', this);
    }
  },

  methods: {
    genWrapper() {
      const children = [this.$slots.prepend || this.__cachedIcon, this.genContent(), this.__cachedBorder, this.$slots.append, this.$scopedSlots.close ? this.$scopedSlots.close({
        toggle: this.toggle
      }) : this.__cachedDismissible];
      const data = {
        staticClass: 'v-alert__wrapper'
      };
      return this.$createElement('div', data, children);
    },

    genContent() {
      return this.$createElement('div', {
        staticClass: 'v-alert__content'
      }, this.$slots.default);
    },

    genAlert() {
      let data = {
        staticClass: 'v-alert',
        attrs: {
          role: 'alert'
        },
        on: this.listeners$,
        class: this.classes,
        style: this.styles,
        directives: [{
          name: 'show',
          value: this.isActive
        }]
      };

      if (!this.coloredBorder) {
        const setColor = this.hasText ? this.setTextColor : this.setBackgroundColor;
        data = setColor(this.computedColor, data);
      }

      return this.$createElement('div', data, [this.genWrapper()]);
    },

    /** @public */
    toggle() {
      this.isActive = !this.isActive;
    }

  },

  render(h) {
    const render = this.genAlert();
    if (!this.transition) return render;
    return h('transition', {
      props: {
        name: this.transition,
        origin: this.origin,
        mode: this.mode
      }
    }, [render]);
  }

}));
//# sourceMappingURL=VAlert.js.map

/***/ }),

/***/ "./node_modules/vuetify/lib/components/VForm/VForm.js":
/*!************************************************************!*\
  !*** ./node_modules/vuetify/lib/components/VForm/VForm.js ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _util_mixins__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../util/mixins */ "./node_modules/vuetify/lib/util/mixins.js");
/* harmony import */ var _mixins_binds_attrs__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../mixins/binds-attrs */ "./node_modules/vuetify/lib/mixins/binds-attrs/index.js");
/* harmony import */ var _mixins_registrable__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../mixins/registrable */ "./node_modules/vuetify/lib/mixins/registrable/index.js");
// Mixins



/* @vue/component */

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ((0,_util_mixins__WEBPACK_IMPORTED_MODULE_0__["default"])(_mixins_binds_attrs__WEBPACK_IMPORTED_MODULE_1__["default"], (0,_mixins_registrable__WEBPACK_IMPORTED_MODULE_2__.provide)('form')
/* @vue/component */
).extend({
  name: 'v-form',

  provide() {
    return {
      form: this
    };
  },

  inheritAttrs: false,
  props: {
    disabled: Boolean,
    lazyValidation: Boolean,
    readonly: Boolean,
    value: Boolean
  },
  data: () => ({
    inputs: [],
    watchers: [],
    errorBag: {}
  }),
  watch: {
    errorBag: {
      handler(val) {
        const errors = Object.values(val).includes(true);
        this.$emit('input', !errors);
      },

      deep: true,
      immediate: true
    }
  },
  methods: {
    watchInput(input) {
      const watcher = input => {
        return input.$watch('hasError', val => {
          this.$set(this.errorBag, input._uid, val);
        }, {
          immediate: true
        });
      };

      const watchers = {
        _uid: input._uid,
        valid: () => {},
        shouldValidate: () => {}
      };

      if (this.lazyValidation) {
        // Only start watching inputs if we need to
        watchers.shouldValidate = input.$watch('shouldValidate', val => {
          if (!val) return; // Only watch if we're not already doing it

          if (this.errorBag.hasOwnProperty(input._uid)) return;
          watchers.valid = watcher(input);
        });
      } else {
        watchers.valid = watcher(input);
      }

      return watchers;
    },

    /** @public */
    validate() {
      return this.inputs.filter(input => !input.validate(true)).length === 0;
    },

    /** @public */
    reset() {
      this.inputs.forEach(input => input.reset());
      this.resetErrorBag();
    },

    resetErrorBag() {
      if (this.lazyValidation) {
        // Account for timeout in validatable
        setTimeout(() => {
          this.errorBag = {};
        }, 0);
      }
    },

    /** @public */
    resetValidation() {
      this.inputs.forEach(input => input.resetValidation());
      this.resetErrorBag();
    },

    register(input) {
      this.inputs.push(input);
      this.watchers.push(this.watchInput(input));
    },

    unregister(input) {
      const found = this.inputs.find(i => i._uid === input._uid);
      if (!found) return;
      const unwatch = this.watchers.find(i => i._uid === found._uid);

      if (unwatch) {
        unwatch.valid();
        unwatch.shouldValidate();
      }

      this.watchers = this.watchers.filter(i => i._uid !== found._uid);
      this.inputs = this.inputs.filter(i => i._uid !== found._uid);
      this.$delete(this.errorBag, found._uid);
    }

  },

  render(h) {
    return h('form', {
      staticClass: 'v-form',
      attrs: {
        novalidate: true,
        ...this.attrs$
      },
      on: {
        submit: e => this.$emit('submit', e)
      }
    }, this.$slots.default);
  }

}));
//# sourceMappingURL=VForm.js.map

/***/ }),

/***/ "./resources/js/src/assets/images/misc sync recursive ^\\.\\/mask\\-.*\\.png$":
/*!***********************************************************************!*\
  !*** ./resources/js/src/assets/images/misc/ sync ^\.\/mask\-.*\.png$ ***!
  \***********************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var map = {
	"./mask-dark.png": "./resources/js/src/assets/images/misc/mask-dark.png",
	"./mask-light.png": "./resources/js/src/assets/images/misc/mask-light.png"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "./resources/js/src/assets/images/misc sync recursive ^\\.\\/mask\\-.*\\.png$";

/***/ })

}]);