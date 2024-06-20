<?php
defined('ABSPATH') or die('Access Denied!');
function withdrawal_loader($dataArrayId, $nitro_access_token)
{
    $response = api_account_file($nitro_access_token);
    $dataArray = $response['data'][$dataArrayId];
    $datas = $response['data'];
    $nitro_access_token = $_COOKIE['nitro_access_token'];
    $historys = api_withdrawal_history($nitro_access_token, $dataArray['id'])['data'];
    ob_start();
    ?>
    <div class="ncp-my-account-withdrawal">
        <div class="ncp-withdrawal ncp-block">
            <h2>برداشت سود</h2>
            <div class="ncp-warning"><img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/warning.svg' ?>" alt="توجه">
                داشته باشید درخواست برداشت سود در روز های شنبه و یکشنبه امکان پذیر است.
            </div>
            <div class="hcp-profit-withdrawal">
                سود قابل برداشت (80%):
                <p>$<?php
                    $current_balance = $dataArray ? $dataArray['current_balance'] : 0;
                    $percentage_value = $current_balance * 0.8;
                    $rounded_value = round($percentage_value);
                    echo $rounded_value;
                    ?></p>
            </div>
            <div class="withdrawal-input-sec">
                <input type="text" placeholder="USDT-TRC20" id="withdrawal-input">
            </div>
            <div class="ncp-withdrawal-btn">
                <a class="ncp_btn_normal" id="withdrawal-btn" data-id="<?php echo $dataArray['id'] ?>">
                    درخواست برداشت
                    <span class="hs-spinner-gif" id="spinner-gif" style="display:none;"></span>
                </a>
            </div>
        </div>
        <div class="ncp-transaction ncp-block">
            <h2>تاریخچه تراکنش ها</h2>
            <?php
            echo '<div class="ncp-transaction-grid">';
            if (!empty($historys)){
                foreach ($historys as $history) {
                    // Given timestamp
                    $timestamp = $history['created_ts'];

                    // Create a DateTime object from the timestamp
                    $date = new DateTime($timestamp);

                    // Extract hour and minutes
                    $hour = $date->format('H');
                    $minutes = $date->format('i');

                    // Set the locale for Persian
                    $locale = 'fa_IR';

                    // Create a formatter for Persian date
                    $formatter = new IntlDateFormatter($locale, IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Tehran', IntlDateFormatter::TRADITIONAL, 'yyyy/MM/dd');

                    // Format the date to Persian
                    $persianDate = $formatter->format($date);
                    ?>
                    <div class="ncp-transaction-block">
                        <div class="transaction-account-number transaction-50 transaction-border">
                            <div class="text-transaction">شماره حساب</div>
                            <div class="field-transaction"><?php echo !empty($history['login']) ? $history['login'] : '-'; ?></div>
                        </div>
                        <div class="transaction-time transaction-50 transaction-border">
                            <div class="text-transaction">ساعت</div>
                            <div class="field-transaction"><?php echo "$hour:$minutes"; ?></div>
                        </div>
                        <div class="transaction-price transaction-50 transaction-border">
                            <div class="text-transaction">مبلغ</div>
                            <div class="field-transaction"><?php echo !empty($history['profit']) ? $history['profit'] : '-'; ?></div>
                        </div>
                        <div class="transaction-date transaction-50 transaction-border">
                            <div class="text-transaction">تاریخ</div>
                            <div class="field-transaction"><?php echo $persianDate; ?></div>
                        </div>
                        <div class="transaction-wallet transaction-100 transaction-border">
                            <div class="text-transaction">آدرس کیف پول</div>
                            <div class="field-transaction"><?php echo !empty($history['address']) ? $history['address'] : '-'; ?></div>
                        </div>
                        <div class="transaction-wallet transaction-100 transaction-border">
                            <div class="text-transaction">توضیحات</div>
                            <div class="field-transaction"><?php echo !empty($history['response']) ? htmlspecialchars($history['response'], ENT_QUOTES, 'UTF-8') : '-'; ?></div>
                        </div>
                        <?php if ($history['certificate'] != null) { ?>
                            <div class="transaction-condition transaction-success transaction-50">
                                <a href="<?php echo $history['certificate']; ?>" target="_blank">گواهی</a>
                            </div>
                        <?php } ?>

                        <?php
                        if ($history['status'] == 'pending') {
                            $statusClass = 'transaction-warning';
                            $statusText = 'درحال بررسی';
                        } elseif ($history['status'] == 'approved') {
                            $statusClass = 'transaction-success';
                            $statusText = 'انجام شده';
                        } elseif ($history['status'] == 'rejected') {
                            $statusClass = 'transaction-error';
                            $statusText = 'رد شده';
                        } else {
                            $statusClass = '';
                            $statusText = '';
                        }

                        if ($history['certificate'] == null) {
                            ?>
                            <div class="transaction-condition <?php echo $statusClass; ?> transaction-100"><?php echo $statusText; ?></div>
                            <?php
                        } else {
                            ?>
                            <div class="transaction-condition <?php echo $statusClass; ?> transaction-50"><?php echo $statusText; ?></div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="third-account-status">';
                echo '<p class="null-data">درخواستی وجود ندرد</p>';
                echo '</div>';
            }
            echo '</div>';
            ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
?>
