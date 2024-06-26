<?php
defined('ABSPATH') or die('Access Denied!');
function support_template()
{
    ob_start();
    ?>
    <div class="ncp-support-block ncp-block">
<!--        <div class="header-request-list">-->
<!--            <h2>پشتیبانی</h2>-->
<!--        </div>-->
        <div class="ncp-support-content">
            <h2 class="title">راه های پشتیبانی</h2>
            <p>برای دریافت پشتیبانی بهتر توصیه می شود از چت آنلاین سایت، پشتیبانی تلگرام و یا اکانت منیجر خود اقدام نمایید.</p>
        </div>
        <div class="connection-sec">
            <a href="https://www.goftino.com/c/XcFiN3" class="connection-inner-sec">
                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/chat.png' ?>" alt="">
                چت آنلاین سایت
            </a>
            <a href="https://t.me/nitroprop_support" class="connection-inner-sec">
                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/telegram.png' ?>" alt="">
                پشتیبانی تلگرام
            </a>
            <a href="/support/" class="connection-inner-sec">
                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/support-ticket.png' ?>" alt="">
                ارسال تیکت
            </a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}