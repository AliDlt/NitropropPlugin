<?php
$id = $_GET['id'];
$status = $_GET['status'];
?>
<div class="call-back-main-container">
    <div class="your-order">
        <h2 class="ncp-title-call-back
            <?php
                if ($status == 'SUCCESSFUL'){
                    echo 'ncp-title-success">پرداخت شما با موفقیت انجام شد';
                }elseif ($status== 'FAILED'){
                    echo 'ncp-title-failed">پرداخت انجام نشد';
                }else{
                    echo 'ncp-title-failed">مقادیر برگشت مشکل دارد';
                }
            ?>
        </h2>
        <div class="order-block-grid">
            <div class="small-block">
                شماره پیگیری شما
                <div class="inner-small-block">
                    <?php echo $id ?>
                </div>
            </div>
        </div>
        <div class="btn-sec">
            <a href="/panel/" class="ncp_btn_normal">پنل کاربری</a>
            <a href="/" class="ncp_btn_normal">صفحه اصلی</a>
        </div>
    </div>
</div>
