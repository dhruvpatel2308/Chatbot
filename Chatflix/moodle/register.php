
<?php

session_start();

include('partials/connect.php');

?>

<!DOCTYPE html>

<html  dir="ltr" lang="en" xml:lang="en">

<!-- Mirrored from moodle.tbcollege.com/moodle/login/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Jul 2024 20:44:33 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <title>Register Yourself</title>
    <link rel="shortcut icon" href="assets/images/logo.png" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="moodle, Log in to the site | Loyalist College In Toronto" />
    <link rel="stylesheet" type="text/css" href="../theme/combo77f0?rollup/3.17.2/yui-moodlesimple-min.css" /><script id="firstthemesheet" type="text/css">/** Required in order to fix style inclusion problems in IE with YUI **/</script><link rel="stylesheet" type="text/css" href="https://moodle.tbcollege.com/moodle/theme/styles.php/remui/1718159541_1718159626/all" />
    <script>
//<![CDATA[
        var M = {}; M.yui = {};
        M.pageloadstarttime = new Date();
        M.cfg = {"wwwroot":"https:\/\/moodle.tbcollege.com\/moodle","homeurl":{},"sesskey":"6LWAg62nMi","sessiontimeout":"7200","sessiontimeoutwarning":1200,"themerev":"1718159541","slasharguments":1,"theme":"remui","iconsystemmodule":"core\/icon_system_fontawesome","jsrev":"1718159541","admin":"admin","svgicons":true,"usertimezone":"America\/New_York","language":"en","courseId":1,"courseContextId":2,"contextid":1,"contextInstanceId":0,"langrev":1718159541,"templaterev":"1718159541"};var yui1ConfigFn = function(me) {if(/-skin|reset|fonts|grids|base/.test(me.name)){me.type='css';me.path=me.path.replace(/\.js/,'.css');me.path=me.path.replace(/\/yui2-skin/,'/assets/skins/sam/yui2-skin')}};
        var yui2ConfigFn = function(me) {var parts=me.name.replace(/^moodle-/,'').split('-'),component=parts.shift(),module=parts[0],min='-min';if(/-(skin|core)$/.test(me.name)){parts.pop();me.type='css';min=''}
        if(module){var filename=parts.join('-');me.path=component+'/'+module+'/'+filename+min+'.'+me.type}else{me.path=component+'/'+component+'.'+me.type}};
        YUI_config = {"debug":false,"base":"https:\/\/moodle.tbcollege.com\/moodle\/lib\/yuilib\/3.17.2\/","comboBase":"https:\/\/moodle.tbcollege.com\/moodle\/theme\/yui_combo.php?","combine":true,"filter":null,"insertBefore":"firstthemesheet","groups":{"yui2":{"base":"https:\/\/moodle.tbcollege.com\/moodle\/lib\/yuilib\/2in3\/2.9.0\/build\/","comboBase":"https:\/\/moodle.tbcollege.com\/moodle\/theme\/yui_combo.php?","combine":true,"ext":false,"root":"2in3\/2.9.0\/build\/","patterns":{"yui2-":{"group":"yui2","configFn":yui1ConfigFn}}},"moodle":{"name":"moodle","base":"https:\/\/moodle.tbcollege.com\/moodle\/theme\/yui_combo.php?m\/1718159541\/","combine":true,"comboBase":"https:\/\/moodle.tbcollege.com\/moodle\/theme\/yui_combo.php?","ext":false,"root":"m\/1718159541\/","patterns":{"moodle-":{"group":"moodle","configFn":yui2ConfigFn}},"filter":null,"modules":{"moodle-core-event":{"requires":["event-custom"]},"moodle-core-tooltip":{"requires":["base","node","io-base","moodle-core-notification-dialogue","json-parse","widget-position","widget-position-align","event-outside","cache-base"]},"moodle-core-dragdrop":{"requires":["base","node","io","dom","dd","event-key","event-focus","moodle-core-notification"]},"moodle-core-lockscroll":{"requires":["plugin","base-build"]},"moodle-core-handlebars":{"condition":{"trigger":"handlebars","when":"after"}},"moodle-core-formchangechecker":{"requires":["base","event-focus","moodle-core-event"]},"moodle-core-maintenancemodetimer":{"requires":["base","node"]},"moodle-core-chooserdialogue":{"requires":["base","panel","moodle-core-notification"]},"moodle-core-notification":{"requires":["moodle-core-notification-dialogue","moodle-core-notification-alert","moodle-core-notification-confirm","moodle-core-notification-exception","moodle-core-notification-ajaxexception"]},"moodle-core-notification-dialogue":{"requires":["base","node","panel","escape","event-key","dd-plugin","moodle-core-widget-focusafterclose","moodle-core-lockscroll"]},"moodle-core-notification-alert":{"requires":["moodle-core-notification-dialogue"]},"moodle-core-notification-confirm":{"requires":["moodle-core-notification-dialogue"]},"moodle-core-notification-exception":{"requires":["moodle-core-notification-dialogue"]},"moodle-core-notification-ajaxexception":{"requires":["moodle-core-notification-dialogue"]},"moodle-core-actionmenu":{"requires":["base","event","node-event-simulate"]},"moodle-core-languninstallconfirm":{"requires":["base","node","moodle-core-notification-confirm","moodle-core-notification-alert"]},"moodle-core-popuphelp":{"requires":["moodle-core-tooltip"]},"moodle-core-blocks":{"requires":["base","node","io","dom","dd","dd-scroll","moodle-core-dragdrop","moodle-core-notification"]},"moodle-core_availability-form":{"requires":["base","node","event","event-delegate","panel","moodle-core-notification-dialogue","json"]},"moodle-backup-confirmcancel":{"requires":["node","node-event-simulate","moodle-core-notification-confirm"]},"moodle-backup-backupselectall":{"requires":["node","event","node-event-simulate","anim"]},"moodle-course-dragdrop":{"requires":["base","node","io","dom","dd","dd-scroll","moodle-core-dragdrop","moodle-core-notification","moodle-course-coursebase","moodle-course-util"]},"moodle-course-util":{"requires":["node"],"use":["moodle-course-util-base"],"submodules":{"moodle-course-util-base":{},"moodle-course-util-section":{"requires":["node","moodle-course-util-base"]},"moodle-course-util-cm":{"requires":["node","moodle-course-util-base"]}}},"moodle-course-management":{"requires":["base","node","io-base","moodle-core-notification-exception","json-parse","dd-constrain","dd-proxy","dd-drop","dd-delegate","node-event-delegate"]},"moodle-course-categoryexpander":{"requires":["node","event-key"]},"moodle-form-shortforms":{"requires":["node","base","selector-css3","moodle-core-event"]},"moodle-form-passwordunmask":{"requires":[]},"moodle-form-dateselector":{"requires":["base","node","overlay","calendar"]},"moodle-question-searchform":{"requires":["base","node"]},"moodle-question-preview":{"requires":["base","dom","event-delegate","event-key","core_question_engine"]},"moodle-question-chooser":{"requires":["moodle-core-chooserdialogue"]},"moodle-availability_completion-form":{"requires":["base","node","event","moodle-core_availability-form"]},"moodle-availability_date-form":{"requires":["base","node","event","io","moodle-core_availability-form"]},"moodle-availability_grade-form":{"requires":["base","node","event","moodle-core_availability-form"]},"moodle-availability_group-form":{"requires":["base","node","event","moodle-core_availability-form"]},"moodle-availability_grouping-form":{"requires":["base","node","event","moodle-core_availability-form"]},"moodle-availability_profile-form":{"requires":["base","node","event","moodle-core_availability-form"]},"moodle-mod_assign-history":{"requires":["node","transition"]},"moodle-mod_attendance-groupfilter":{"requires":["base","node"]},"moodle-mod_quiz-toolboxes":{"requires":["base","node","event","event-key","io","moodle-mod_quiz-quizbase","moodle-mod_quiz-util-slot","moodle-core-notification-ajaxexception"]},"moodle-mod_quiz-dragdrop":{"requires":["base","node","io","dom","dd","dd-scroll","moodle-core-dragdrop","moodle-core-notification","moodle-mod_quiz-quizbase","moodle-mod_quiz-util-base","moodle-mod_quiz-util-page","moodle-mod_quiz-util-slot","moodle-course-util"]},"moodle-mod_quiz-util":{"requires":["node","moodle-core-actionmenu"],"use":["moodle-mod_quiz-util-base"],"submodules":{"moodle-mod_quiz-util-base":{},"moodle-mod_quiz-util-slot":{"requires":["node","moodle-mod_quiz-util-base"]},"moodle-mod_quiz-util-page":{"requires":["node","moodle-mod_quiz-util-base"]}}},"moodle-mod_quiz-autosave":{"requires":["base","node","event","event-valuechange","node-event-delegate","io-form"]},"moodle-mod_quiz-quizbase":{"requires":["base","node"]},"moodle-mod_quiz-questionchooser":{"requires":["moodle-core-chooserdialogue","moodle-mod_quiz-util","querystring-parse"]},"moodle-mod_quiz-modform":{"requires":["base","node","event"]},"moodle-message_airnotifier-toolboxes":{"requires":["base","node","io"]},"moodle-block_xp-filters":{"requires":["base","node","moodle-core-dragdrop","moodle-core-notification-confirm","moodle-block_xp-rulepicker"]},"moodle-block_xp-notification":{"requires":["base","node","handlebars","button-plugin","moodle-core-notification-dialogue"]},"moodle-block_xp-rulepicker":{"requires":["base","node","handlebars","moodle-core-notification-dialogue"]},"moodle-filter_glossary-autolinker":{"requires":["base","node","io-base","json-parse","event-delegate","overlay","moodle-core-event","moodle-core-notification-alert","moodle-core-notification-exception","moodle-core-notification-ajaxexception"]},"moodle-filter_mathjaxloader-loader":{"requires":["moodle-core-event"]},"moodle-editor_atto-rangy":{"requires":[]},"moodle-editor_atto-editor":{"requires":["node","transition","io","overlay","escape","event","event-simulate","event-custom","node-event-html5","node-event-simulate","yui-throttle","moodle-core-notification-dialogue","moodle-core-notification-confirm","moodle-editor_atto-rangy","handlebars","timers","querystring-stringify"]},"moodle-editor_atto-plugin":{"requires":["node","base","escape","event","event-outside","handlebars","event-custom","timers","moodle-editor_atto-menu"]},"moodle-editor_atto-menu":{"requires":["moodle-core-notification-dialogue","node","event","event-custom"]},"moodle-report_eventlist-eventfilter":{"requires":["base","event","node","node-event-delegate","datatable","autocomplete","autocomplete-filters"]},"moodle-report_loglive-fetchlogs":{"requires":["base","event","node","io","node-event-delegate"]},"moodle-gradereport_history-userselector":{"requires":["escape","event-delegate","event-key","handlebars","io-base","json-parse","moodle-core-notification-dialogue"]},"moodle-qbank_editquestion-chooser":{"requires":["moodle-core-chooserdialogue"]},"moodle-tool_capability-search":{"requires":["base","node"]},"moodle-tool_lp-dragdrop-reorder":{"requires":["moodle-core-dragdrop"]},"moodle-tool_monitor-dropdown":{"requires":["base","event","node"]},"moodle-assignfeedback_editpdf-editor":{"requires":["base","event","node","io","graphics","json","event-move","event-resize","transition","querystring-stringify-simple","moodle-core-notification-dialog","moodle-core-notification-alert","moodle-core-notification-warning","moodle-core-notification-exception","moodle-core-notification-ajaxexception"]},"moodle-atto_accessibilitychecker-button":{"requires":["color-base","moodle-editor_atto-plugin"]},"moodle-atto_accessibilityhelper-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_align-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_bold-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_charmap-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_clear-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_collapse-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_emojipicker-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_emoticon-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_equation-button":{"requires":["moodle-editor_atto-plugin","moodle-core-event","io","event-valuechange","tabview","array-extras"]},"moodle-atto_h5p-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_html-beautify":{},"moodle-atto_html-button":{"requires":["promise","moodle-editor_atto-plugin","moodle-atto_html-beautify","moodle-atto_html-codemirror","event-valuechange"]},"moodle-atto_html-codemirror":{"requires":["moodle-atto_html-codemirror-skin"]},"moodle-atto_image-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_indent-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_italic-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_link-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_managefiles-usedfiles":{"requires":["node","escape"]},"moodle-atto_managefiles-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_media-button":{"requires":["moodle-editor_atto-plugin","moodle-form-shortforms"]},"moodle-atto_noautolink-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_orderedlist-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_recordrtc-button":{"requires":["moodle-editor_atto-plugin","moodle-atto_recordrtc-recording"]},"moodle-atto_recordrtc-recording":{"requires":["moodle-atto_recordrtc-button"]},"moodle-atto_rtl-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_strike-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_subscript-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_superscript-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_table-button":{"requires":["moodle-editor_atto-plugin","moodle-editor_atto-menu","event","event-valuechange"]},"moodle-atto_teamsmeeting-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_title-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_underline-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_undo-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_unorderedlist-button":{"requires":["moodle-editor_atto-plugin"]}}},"gallery":{"name":"gallery","base":"https:\/\/moodle.tbcollege.com\/moodle\/lib\/yuilib\/gallery\/","combine":true,"comboBase":"https:\/\/moodle.tbcollege.com\/moodle\/theme\/yui_combo.php?","ext":false,"root":"gallery\/1718159541\/","patterns":{"gallery-":{"group":"gallery"}}}},"modules":{"core_filepicker":{"name":"core_filepicker","fullpath":"https:\/\/moodle.tbcollege.com\/moodle\/lib\/javascript.php\/1718159541\/repository\/filepicker.js","requires":["base","node","node-event-simulate","json","async-queue","io-base","io-upload-iframe","io-form","yui2-treeview","panel","cookie","datatable","datatable-sort","resize-plugin","dd-plugin","escape","moodle-core_filepicker","moodle-core-notification-dialogue"]},"core_comment":{"name":"core_comment","fullpath":"https:\/\/moodle.tbcollege.com\/moodle\/lib\/javascript.php\/1718159541\/comment\/comment.js","requires":["base","io-base","node","json","yui2-animation","overlay","escape"]},"mathjax":{"name":"mathjax","fullpath":"https:\/\/cdn.jsdelivr.net\/npm\/mathjax@2.7.9\/MathJax.js?delayStartupUntil=configured"}}};
        M.yui.loader = {modules: {}};

//]]>
    </script>

    <meta name="robots" content="noindex" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import "https://fonts.googleapis.com/css?family=Inter:100,200,300,400,500,600,700,800,900";
    </style>
</head>

<body  id="page-login-index" class="format-site  path-login dir-ltr lang-en yui-skin-sam yui3-skin-sam moodle-tbcollege-com--moodle pagelayout-login course-1 context-1 notloggedin main-area-bg logincenter">
    <div class="toast-wrapper mx-auto py-0 fixed-top" role="status" aria-live="polite"></div>

    <div id="page-wrapper">

        <div>
            <a class="sr-only sr-only-focusable" href="#maincontent">Skip to main content</a>
        </div><script src="../lib/javascript.php/1718159541/lib/polyfills/javascript.php"></script>
        <script src="../theme/combo245a?rollup/3.17.2/yui-moodlesimple-min.js"></script><script src="../lib/javascript.php/1718159541/lib/javascript.php"></script>
        <script>
//<![CDATA[
            document.body.className += ' jsenabled';
//]]>
        </script>


        <script>
            window.onload = function(){
                $(document).ready(function() {





                  var defaultImg = "<a href='https://moodle.tbcollege.com/moodle/'><img src='https://moodle.tbcollege.com/moodle/pluginfile.php/1/core_admin/logo/0x200/1576791409/logo.png' style='margin-top: 138px;'></a>";
                  var mini = "<a href='https://moodle.tbcollege.com/moodle/'><img src='https://moodle.tbcollege.com/moodle/pluginfile.php/1/core_admin/logocompact/0x200/1576789969/Loyalist_mini.png' width='56px'></a>";

                  if ($("body").hasClass("drawer-open-left")) {
                      var status = true;
                  } else {
                      var status = false;
                  }


                  function toggleLogo(status) {

                      if (status == true) {
                        $(".navbar-brand").html(defaultImg)
                        $("#nav-drawer-container").addClass("navbar-adjust");
                        $(".navbar-brand").addClass("navbar-logo-adjust");

                    } else {

                        $(".navbar-brand").html(mini)
                        $("#nav-drawer-container").removeClass("navbar-adjust");
                        $(".navbar-brand").removeClass("navbar-logo-adjust");
                    }
                }


    // Set the default logo
                toggleLogo(status);

                $('button[data-action="toggle-drawer"]').on('click',function(){
                    status = !status;
                    toggleLogo(status);
}); // On click
            }); 
            }

        </script>

        <div id="page" class="container-fluid mt-0">
            <div id="page-content" class="row">
                <div id="region-main-box" class="col-12">
                    <section id="region-main" class="col-12 h-100" aria-label="Content">
                        <div class="login-wrapper">
                            <div class="login-container">
                                <div class="logo-area r-mb-16">
                                    <img src="assets/images/logo.png" class="navbar-brand-logo logo">



                                </div>
                                <div role="main"><span id="maincontent"></span><div class="loginform d-flex flex-column flex-gap-8">
                                    <div class="login-welcome-wrapper d-flex flex-column flex-gap-1 text-center">
                                        <h2 class="h-bold-3 m-0">
                                            Welcome to Toronto Business College LMS Site
                                        </h2>
                                        <p class="para-regular-3 m-0">Enter your details and get yourself register</p>
                                    </div>
                                    <form class="login-form" action="register.php" method="POST" id="login" enctype="multipart/form-data">
                                        <input type="hidden" name="logintoken" value="">
                                        <div class="login-form-username form-group">
                                            <label for="username" class="sr-only">
                                                Full Name
                                            </label>
                                            <label class="text-link-semibold form-label-color" tabindex="-1">
                                                Full Name
                                            </label>
                                            <input type="text"  id="username" class="form-control form-control-lg" value="" placeholder="Full Name" autocomplete="" name="user_name">
                                        </div>

                                        <div class="login-form-username form-group">
                                            <label for="username" class="sr-only">
                                                Email
                                            </label>
                                            <label class="text-link-semibold form-label-color" tabindex="-1">
                                                Email
                                            </label>
                                            <input type="email"  id="username" class="form-control form-control-lg" value="" placeholder="Email" autocomplete="" name="user_email">
                                        </div>

                                        <div class="login-form-username form-group">
                                            <label for="username" class="sr-only">
                                                Contact
                                            </label>
                                            <label class="text-link-semibold form-label-color" tabindex="-1">
                                                Contact
                                            </label>
                                            <input type="text"  id="username" class="form-control form-control-lg" value="" placeholder="Mobile Number" autocomplete="" name="user_contact">
                                        </div>

                                        <div class="login-form-username form-group">
                                            <label for="username" class="sr-only">
                                                Location
                                            </label>
                                            <label class="text-link-semibold form-label-color" tabindex="-1">
                                                Location
                                            </label>
                                            <input type="text"  id="username" class="form-control form-control-lg" value="" placeholder="Toronto, ON" autocomplete="" name="user_location">
                                        </div>

                                        <div class="login-form-username form-group">
                                            <label for="username" class="sr-only">
                                                Username
                                            </label>
                                            <label class="text-link-semibold form-label-color" tabindex="-1">
                                                Username
                                            </label>
                                            <input type="text"  id="username" class="form-control form-control-lg" value="" placeholder="500147836" autocomplete="" name="user_username">
                                        </div>

                                        <div class="login-form-username form-group">
                                            <label for="username" class="sr-only">
                                                Profile Picture
                                            </label>
                                            <label class="text-link-semibold form-label-color" tabindex="-1">
                                                Profile Picture
                                            </label>
                                            <input type="file"  id="username" class="form-control form-control-lg" value="" placeholder="Mobile Number" autocomplete="" name="image">
                                        </div>

                                        <div class="login-form-password form-group">
                                            <label for="password" class="sr-only">Password</label>
                                            <label class="text-link-semibold form-label-color" tabindex="-1">
                                                Password
                                            </label>
                                            <div class="position-relative password-field-eye">
                                                <input type="password" name="user_password" id="password" value="" class="form-control form-control-lg" placeholder="Password" autocomplete="current-password">
                                                <span class="edw-icon edw-icon-Show show-password-icon"></span>
                                            </div>
                                        </div>
                                        <div class="login-form-forgotpassword form-group text-right small-info-semibold">
                                            <a href="https://sdb.tbcollege.com/enrol/student/resetpassword">Forgot your password?</a>
                                        </div>
                                        <div class="login-form-submit form-group">
                                            <button class="btn btn-primary btn-lg btn-block" type="submit" name="user_register">Register</button>
                                        </div>
                                    </form>
                                    <div class="d-flex justify-content-center flex-gap-8">
                                        <a href="login.php">Already had a account</a>
                                    </div>
                                    <div>
                                    </div>
                                    <!-- <div class="d-flex justify-content-center flex-gap-8 cookies-section">
                                        <a class="text-link-semibold" href="#"  data-modal="alert" data-modal-title-str='["cookiesenabled", "core"]'  data-modal-content-str='["cookiesenabled_help_html", "core"]'>Cookies notice</a>
                                    </div> -->
                                </div></div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <footer id="page-footer" class="footer-popover ">
            <div class="footer-container container">
                <div class="floating-buttons-wrapper">
                    <button id="gotop" class="btn btn-primary btn-floating d-none" aria-label="Go top" role="button" title="Go top">
                        <span class="edw-icon edw-icon-UpArrow"></span>
                    </button>


                    <button class="btn btn-primary btn-floating d-none d-md-flex" data-action="footer-popover" aria-label="Show footer" data-region="footer-container-popover" >
                        <span class="edw-icon edw-icon-Help"></span>
                    </button>
                </div>
                <div class="footer-content-popover container" data-region="footer-content-popover">
                    <div class="footer-section ">
                    <!--
                    -->


                    <div class="footer-popover-section-links"><div class="popover-icon-wrapper"><span><i class="icon fa edw-icon edw-icon-Email fa-fw " aria-hidden="true"  ></i></span></div><a href="https://moodle.tbcollege.com/moodle/user/contactsitesupport.php">Contact site support</a></div>
                </div>
                <div class="footer-section">
                    <div class="logininfo">
                        <div class="logininfo">You are not logged in.</div>
                    </div>
                    <div class="tool_usertours-resettourcontainer">
                    </div>

                    <a class="mobilelink" href="https://download.moodle.org/mobile?version=2022112811&amp;lang=en&amp;iosappid=633359593&amp;androidappid=com.moodle.moodlemobile">Get the mobile app</a>
                    <script>
//<![CDATA[
                        var require = {
                            baseUrl : 'https://moodle.tbcollege.com/moodle/lib/requirejs.php/1718159541/',
    // We only support AMD modules with an explicit define() statement.
                            enforceDefine: true,
                            skipDataMain: true,
                            waitSeconds : 0,

                            paths: {
                                jquery: 'https://moodle.tbcollege.com/moodle/lib/javascript.php/1718159541/lib/jquery/jquery-3.6.1.min',
                                jqueryui: 'https://moodle.tbcollege.com/moodle/lib/javascript.php/1718159541/lib/jquery/ui-1.13.2/jquery-ui.min',
                                jqueryprivate: 'https://moodle.tbcollege.com/moodle/lib/javascript.php/1718159541/lib/requirejs/jquery-private'
                            },

    // Custom jquery config map.
                            map: {
      // '*' means all modules will get 'jqueryprivate'
      // for their 'jquery' dependency.
                              '*': { jquery: 'jqueryprivate' },
      // Stub module for 'process'. This is a workaround for a bug in MathJax (see MDL-60458).
                              '*': { process: 'core/first' },

      // 'jquery-private' wants the real jQuery module
      // though. If this line was not here, there would
      // be an unresolvable cyclic dependency.
                              jqueryprivate: { jquery: 'jquery' }
                          }
                      };

//]]>
                  </script>
                  <script src="../lib/javascript.php/1718159541/lib/requirejs/javascript.php"></script>
                  <script>
//<![CDATA[
                    M.util.js_pending("core/first");
                    require(['core/first'], function() {
                        require(['core/prefetch'])
                        ;
                        require(["media_videojs/loader"], function(loader) {
                            loader.setUp('en');
                        });;

                        require(['theme_remui/footer-popover'], function(FooterPopover) {
                            FooterPopover.init();
                        });



                        ;

                        M.util.js_pending('theme_remui/loader');
                        require(['theme_remui/loader'], function() {
                          M.util.js_complete('theme_remui/loader');
                      });
                        ;

                        require(['core_form/submit'], function(Submit) {
                            Submit.init("loginbtn");
                            Submit.init("loginguestbtn");
                        });
                        ;
                        M.util.js_pending('core/notification'); require(['core/notification'], function(amd) {amd.init(1, []); M.util.js_complete('core/notification');});;
                        M.util.js_pending('core/log'); require(['core/log'], function(amd) {amd.setConfig({"level":"warn"}); M.util.js_complete('core/log');});;
                        M.util.js_pending('core/page_global'); require(['core/page_global'], function(amd) {amd.init(); M.util.js_complete('core/page_global');});;
                        M.util.js_pending('core/utility'); require(['core/utility'], function(amd) {M.util.js_complete('core/utility');});
                        M.util.js_complete("core/first");
                    });
//]]>
                </script>
                <script>
//<![CDATA[
                    M.str = {"moodle":{"lastmodified":"Last modified","name":"Name","error":"Error","info":"Information","yes":"Yes","no":"No","cancel":"Cancel","confirm":"Confirm","areyousure":"Are you sure?","closebuttontitle":"Close","unknownerror":"Unknown error","file":"File","url":"URL","collapseall":"Collapse all","expandall":"Expand all"},"repository":{"type":"Type","size":"Size","invalidjson":"Invalid JSON string","nofilesattached":"No files attached","filepicker":"File picker","logout":"Logout","nofilesavailable":"No files available","norepositoriesavailable":"Sorry, none of your current repositories can return files in the required format.","fileexistsdialogheader":"File exists","fileexistsdialog_editor":"A file with that name has already been attached to the text you are editing.","fileexistsdialog_filemanager":"A file with that name has already been attached","renameto":"Rename to \"{$a}\"","referencesexist":"There are {$a} links to this file","select":"Select"},"admin":{"confirmdeletecomments":"You are about to delete comments, are you sure?","confirmation":"Confirmation"},"debug":{"debuginfo":"Debug info","line":"Line","stacktrace":"Stack trace"},"langconfig":{"labelsep":": "}};
//]]>
                </script>
                <script>
//<![CDATA[
                    var remuiFontSelect = "1";var remuiFontName = "Roboto";
//]]>
                </script>
                <script>
//<![CDATA[
                    (function() {Y.use("moodle-filter_mathjaxloader-loader",function() {M.filter_mathjaxloader.configure({"mathjaxconfig":"\nMathJax.Hub.Config({\n    config: [\"Accessible.js\", \"Safe.js\"],\n    errorSettings: { message: [\"!\"] },\n    skipStartupTypeset: true,\n    messageStyle: \"none\"\n});\n","lang":"en"});
                });
                    M.util.help_popups.setup(Y);
                    M.util.js_pending('random668da12c983882'); Y.on('domready', function() { M.util.js_complete("init");  M.util.js_complete('random668da12c983882'); });
                })();
//]]>
            </script>


        </div>
        <div class="footer-section ">
            <div class="footer-poweredby">Powered by <a href="https://moodle.com/">Moodle</a></div>

        </div>
    </div>
    <div class="footer-mainsection-wrapper">

        <div class="footerdata">
        </div>
        <hr class="d-block mb-0">
    </div>
    <div class="footer-secondarysection-wrapper">
    </div>

</div>
</footer>
</div>

</body>

</html>

<?php
if(isset($_POST['user_register']))
{
    include('partials/connect.php');

    // Check connection
    if (pg_last_error())
    {
        echo "Failed to connect to MySQL: " . pg_last_error();
    }

    $user_name = pg_escape_string($con, $_POST['user_name']);
    $user_email = pg_escape_string($con, $_POST['user_email']);
    $user_username = pg_escape_string($con, $_POST['user_username']);
    $user_location = pg_escape_string($con, $_POST['user_location']);
    $user_contact = pg_escape_string($con, $_POST['user_contact']);
    $user_password = pg_escape_string($con, $_POST['user_password']);
    $image = $_FILES['image']['name'];

    $temp_name  = $_FILES['image']['tmp_name'];  
    $source_image_path = basename($_FILES['image']['name']);
    $ext = pathinfo($source_image_path,PATHINFO_EXTENSION);
    $random_code=md5(uniqid(rand(),true));
    $destination_file_name = $random_code . "." . strtolower($ext);
    $name = $destination_file_name;
    $folder = "assets/images/user_profile/".$name;
    $upload_image = move_uploaded_file($temp_name, $folder);
    $image_uploaded = "assets/images/user_profile/".$name;

    $password_hashed = password_hash($user_password, PASSWORD_DEFAULT);

    $query = pg_query($con,"SELECT * FROM users_tbl WHERE user_username='$user_username' OR user_email='$user_email'");

    if(pg_num_rows($query)>0)
    {
        // $_SESSION['status'] = 'Details already Exits ....';
        // $_SESSION['status_code'] = 'error';
        // header('location: index.php?certificates');
        echo "<script>alert('Details already Exits ....')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
    else 
    {
        $sql="INSERT INTO users_tbl (user_name, user_email, user_pic, user_contact, user_location, user_username, user_password, user_created_at)
        VALUES('$user_name', '$user_email', '$image_uploaded', '$user_contact', '$user_location', '$user_username', '$password_hashed',  NOW())";

        if (!pg_query($con,$sql))
        {
          die('Error: ' . pg_error($con));
      }
      else
      {
          // $_SESSION['status'] = 'Success ! ! !';
          // $_SESSION['status_code'] = 'success';
          // header('location: index.php?certificates');

        echo "<script>alert('You are Registered Successfully .....')</script>";

        echo "<script>window.open('login.php','_self')</script>";
    }
    pg_close($con);
}


}
?>