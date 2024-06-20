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
            <h2 class="title">راه های ارتباطی با نیتروپراپ</h2>
            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، لورم ایپسوم متن ساختگی با تولید سادگی لورم</p>
        </div>
        <div class="connection-sec">
            <a class="connection-inner-sec">
                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/chat.png' ?>" alt="">
                چت آنلاین سایت
            </a>
            <a class="connection-inner-sec">
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