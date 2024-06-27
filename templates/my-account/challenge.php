<?php
defined('ABSPATH') or die('Access Denied!');
function challenge_page($challenge_prices_response, $nitro_access_token)
{
//    $account_data = $account_info_response['data'];
//    $challenge_prices_response = api_get_challenge_prices($nitro_access_token);
    usort($challenge_prices_response['data'], function ($a, $b) {
        return $a['group'] <=> $b['group'];
    });

    ob_start();
    ?>
    <div class="ncp-withdrawal ncp-block">
        <h2>چالش جدید</h2>
        <input type="hidden" id="price-one" value="<?php echo $challenge_prices_response['data'][0]['price'] ?>">
        <input type="hidden" id="price-two" value="<?php echo $challenge_prices_response['data'][1]['price'] ?>">
        <input type="hidden" id="price-three" value="<?php echo $challenge_prices_response['data'][2]['price'] ?>">
        <input type="hidden" id="price-fore" value="<?php echo $challenge_prices_response['data'][3]['price'] ?>">

        <!-- table -->
        <?php echo do_shortcode('[table_section]') ?>
        <!-- table -->
    </div>
    <div class="challenge-block ncp-block">
        <div class="container-payment">
            <h2 class="ncp-title header-sec">انتخاب درگاه پرداخت</h2>
            <div class="ncp-warning">
    <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/warning.svg' ?>" alt="">
                <span id="payment-warning-text">توجه داشته باشید که اطلاعات وارد شده با اطلاعات دارنده کارت بانکی یکسان باشد.</span>
            </div>
            <div class="payment-method-sec">
                <a class="ncp_btn_big payment-btn" id="payment-digital" data-method="digital">درگاه ارزدیجیتال</a>
                <a class="ncp_btn_big payment-btn btn-active" id="payment-rial" data-method="rial">درگاه ریالی</a>
            </div>
            <div class="your-order-challenge">
                <h2 class="ncp-title header-sec">سفارش شما</h2>
                <div class="order-block-grid">
                    <div class="small-block">
                        پلتفرم معاملاتی
                        <div class="inner-small-block-challenge">
                            <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/order-grid-01.svg' ?>"
                                 alt="">
                        </div>
                    </div>
                    <div class="small-block">
                        سرور اختصاصی
                        <div class="inner-small-block-challenge">
                            <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/order-grid-02.svg' ?>"
                                 alt="">
                        </div>
                    </div>
                    <div class="small-block">
                    قیمت کل به دلار
                    <div class="inner-small-block-challenge" id="dollar-price">$59</div>
                    </div>
                    <div class="small-block">
                        قیمت کل به ریال
                        <div class="inner-small-block-challenge"
                             id="rial-price"><?php echo number_format($challenge_prices_response['data'][0]['price'].'0') ?></div>
                    </div>
                </div>
            </div>
            <div class="ncp-discount-sec">
                <div class="ncp-discount-text">کد تخفیف</div>
                <div class="ncp-discount">
                    <input type="text" id="discount-code">
                    <a class="ncp_btn_normal">
                        اعمال
                        <span class="hs-spinner-gif" id="spinner-gif" style="display:none;"></span>
                    </a>
                </div>
                <div class="error-sec">
                    <p class="input-error" id="discount-error" style="display: none">لطفا کد تخفیف را وارد کنید!</p>
                    <p class="input-error" id="discount-valid" style="display: none">کد تخفیف شما معتبر نیست!</p>
                    <p class="input-success" id="discount-success" style="display: none">کد تخفیف اعمال شد</p>
                </div>
            </div>
            <div style="margin:20px;">
                <p class="selected-payment" style="text-align=center;">شما درگاه ریالی را انتخاب کرده اید</p>
            </div>
            <div class="ncp-rules">
                <label class="rules-container"">قوانین را مطالعه کرده و شرایط چالش ها را می پذیرم.
                    <input type="checkbox" id="challenge-rule">
<!--                    <span class="checkmark"></span>-->
                </label>
                <label class="rules-container"">پس از خرید چالش، امکان عودت وجه وجود ندارد.
                    <input type="checkbox" id="challenge-pay-back">
<!--                    <span class="checkmark"></span>-->
                </label>
                <div class="error-sec challenge-rule-error">
                    <p class="input-error" id="challenge-rule-error" style="display: none">لطفا قوانین و شرایط را
                        بپذیرید</p>
                </div>
            </div>
            <a class="ncp_btn_normal ncp-buy-challenge" id="buy-challenge">خرید چالش</a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
