!function(e){"use strict";"object"!=typeof qiBlocksDashboard&&(window.qiBlocksDashboard={}),qiBlocksDashboard.scroll=0,qiBlocksDashboard.windowWidth=e(window).width(),e(document).ready((function(){i.init(),t.init(),s.init(),o.init()})),e(window).scroll((function(){qiBlocksDashboard.scroll=e(window).scrollTop()})),e(window).resize((function(){qiBlocksDashboard.windowWidth=e(window).width(),void 0!==i.adminPage&&i.adminPage.length&&i.adminHeader.width(i.adminPage.width())}));const i={init:function(){this.adminPage=e(".qodef-admin-page"),this.adminPage.length&&(this.setPremiumLinksAttributes(),this.adminHeaderPosition())},setPremiumLinksAttributes:function(){const i=e('a[href="admin.php?page=qi_blocks_pro"]'),t=e('a[href="admin.php?page=qi_templates"]');i.length&&i.attr("target","_blank"),t.length&&t.attr("target","_blank")},adminHeaderPosition:function(){this.adminPage.length&&(this.adminBarHeight=e("#wpadminbar").height(),this.adminHeader=e(".qodef-admin-header"),this.adminHeader.length&&(this.adminHeaderHeight=this.adminHeader.outerHeight(!0),this.adminHeaderTopPosition=this.adminHeader.offset().top-parseInt(this.adminBarHeight,10),this.adminContent=e(".qodef-admin-content"),this.adminHeader.width(this.adminPage.width()),e(window).on("scroll load",(function(){qiBlocksDashboard.scroll>=i.adminHeaderTopPosition?(i.adminHeader.addClass("qodef-fixed").css("top",parseInt(i.adminBarHeight,10)),i.adminContent.css("marginTop",i.adminHeaderHeight)):(i.adminHeader.removeClass("qodef-fixed").css("top",0),i.adminContent.css("marginTop",0))}))))}},t={init:function(){if(this.searchField=e(".qodef-search-widget-field"),this.adminContent=e(".qodef-admin-content"),this.sectionHolder=e(".qodef-widgets-section"),this.fieldHolder=e(".qodef-widgets-item"),this.searchField.length){let i,o,s=this.searchField.next(".qodef-search-widget-loading");this.searchField.on("keyup paste",(function(){let d=e(this);d.attr("autocomplete","off"),s.removeClass("qodef-hidden"),clearTimeout(o),o=setTimeout((function(){let o=d.val();i=new RegExp(d.val(),"gi"),s.addClass("qodef-hidden"),o.length<3?t.resetSearchView():(t.resetSearchView(),t.adminContent.addClass("qodef-apply-search"),t.fieldHolder.each((function(){const t=e(this);-1!==t.find(".qodef-widgets-title").text().search(i)?t.parents(".qodef-widgets-section").addClass("qodef-search-show"):t.addClass("qodef-search-hide")})))}),500)}))}},resetSearchView:function(){this.adminContent.removeClass("qodef-apply-search"),this.sectionHolder.removeClass("qodef-search-show"),this.fieldHolder.removeClass("qodef-search-hide")}},o={init:function(){this.form=e(".qodef-dashboard-ajax-form"),this.form.length&&this.saveForm(this.form)},saveForm:function(i){const t=i.parent(),o=e(".qodef-save-reset-loading"),s=e(".qodef-save-success");i.length&&i.on("submit",(function(d){d.preventDefault(),d.stopPropagation(),o.addClass("qodef-show-loader"),t.addClass("qodef-save-reset-disable");const n=e(this),a={action:"qi_blocks_action_"+i.data("action")+"_save_options"};e.ajax({type:"POST",url:ajaxurl,cache:!1,data:e.param(a,!0)+"&"+n.serialize(),success:function(){o.removeClass("qodef-show-loader"),t.removeClass("qodef-save-reset-disable"),s.fadeIn(300),setTimeout((function(){s.fadeOut(200)}),2e3)}})}))}},s={init:function(){this.formHolder=e(".qodef-admin-widgets-page"),this.formHolder.length&&(this.switchWidgetsValuesByController(this.formHolder),this.switchControllerValuesByWidget(this.formHolder))},switchWidgetsValuesByController:function(i){this.optionsForm=i.find(".qodef-dashboard-ajax-form"),i.find(".qodef-widgets-section").each((function(){const i=e(this),t=i.find(".qodef-section-enable");t.on("click",(function(){i.find(".qodef-widgets-item:not(.qodef-premium--disabled) input:checkbox").prop("checked",t.is(":checked"))}))}))},switchControllerValuesByWidget:function(i){this.optionsForm=i.find(".qodef-dashboard-ajax-form"),i.find(".qodef-widgets-section").each((function(){const i=e(this),t=i.find(".qodef-section-enable"),o=i.find(".qodef-widgets-item input:checkbox");o.each((function(){e(this).on("click",(function(){o.not(":checked").length>0?t.prop("checked",!1):t.prop("checked",!0)}))}))}))}}}(jQuery);