(()=>{"use strict";var t={1669:t=>{t.exports=jQuery}},e={};function i(o){var s=e[o];if(void 0!==s)return s.exports;var c=e[o]={exports:{}};return t[o](c,c.exports,i),c.exports}i.n=t=>{var e=t&&t.__esModule?()=>t.default:()=>t;return i.d(e,{a:e}),e},i.d=(t,e)=>{for(var o in e)i.o(e,o)&&!i.o(t,o)&&Object.defineProperty(t,o,{enumerable:!0,get:e[o]})},i.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e),(()=>{var t=i(1669),e=i.n(t);document.addEventListener("DOMContentLoaded",(function(){o.init()}));const o={init:function(){this.holder=document.querySelectorAll(".qi-block-accordion"),this.holder.length&&[...this.holder].map((t=>{o.initItem(t)}))},getRealCurrentItem:function(t){return"string"==typeof t&&""!==t&&(t=qiBlocksEditor.qodefGetCurrentBlockElement.get(t)),t},initItem:function(t){(t=o.getRealCurrentItem(t))&&(t.classList.contains("qodef-behavior--accordion")?o.initAccordion(t):t.classList.contains("qodef-behavior--toggle")&&o.initToggle(t),t.classList.add("qodef--init"))},initAccordion:function(t){let i="auto";t.classList.contains("qodef-height--content")&&(i="content");const o=e()(t);setTimeout((()=>{void 0!==o.accordion("instance")?o.accordion("refresh"):o.accordion({animate:"swing",collapsible:!0,active:0,icons:"",heightStyle:i})}),400)},initToggle:function(t){const i=t.querySelectorAll(".qodef-e-title-holder"),o=t.querySelectorAll(".qodef-accordion-content");t.classList.add("accordion"),t.classList.add("ui-accordion"),t.classList.add("ui-accordion-icons"),t.classList.add("ui-widget"),t.classList.add("ui-helper-reset"),i.forEach(((t,i)=>{t.classList.contains("qodef-event--init")||(t.classList.add("ui-accordion-header"),t.classList.add("ui-state-default"),t.classList.add("ui-corner-top"),t.classList.add("ui-corner-bottom"),t.classList.add("qodef-event--init"),o[i]&&(o[i].classList.add("ui-accordion-content"),o[i].classList.add("ui-helper-reset"),o[i].classList.add("ui-widget-content"),o[i].classList.add("ui-corner-bottom")),["mouseenter","touchstart"].forEach((e=>{t.addEventListener(e,(function(){t.classList.add("ui-state-hover")}))})),["mouseleave","touchend"].forEach((e=>{t.addEventListener(e,(function(){t.classList.remove("ui-state-hover")}))})),t.addEventListener("click",(function(){if(t.classList.contains("ui-accordion-header-active")?(t.classList.remove("ui-accordion-header-active"),t.classList.remove("ui-state-active"),t.classList.remove("ui-state-default"),t.classList.remove("ui-corner-bottom")):(t.classList.add("ui-accordion-header-active"),t.classList.add("ui-state-active"),t.classList.add("ui-state-default"),t.classList.add("ui-corner-bottom")),o[i]){const t=e()(o[i]);t.toggleClass("ui-accordion-content-active"),t.slideToggle(400)}})))}))}}})()})();