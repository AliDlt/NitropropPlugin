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
            <div class="ncp-warning"><img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/warning.svg' ?>"
                                          alt="توجه">
                                          واریز سود در تاریخ های ۱۴ ام و ۲۸ ام ماه میلادی انجام می شود. لطفا حداقل یک روز قبل از تاریخ های مذکور درخواست برداشت سود را ثبت نمایید.</div>
            <div class="hcp-profit-withdrawal">
                سود قابل برداشت (80%):
                <p>$<?php echo $dataArray['profit'] ?: '0' ?></p>
            </div>
            <div class="withdrawal-input-sec">
                <div class="withdrawal-input-sec-inner">
                    <label for="withdrawal-input"> آدرس کیف پول</label>
                    <input type="text" placeholder="USDT-TRC20" id="withdrawal-input" name="withdrawal-input"></div>
                <div class="withdrawal-input-sec-inner">
                    <label for="withdrawal-type">شماره حساب</label>
                    <select name="withdrawal-type" id="withdrawal-type">
                        <?php
                        $first_array = 0;
                        foreach ($datas as $file_data) {
                            ?>
                            <option value="<?php echo $file_data['login'] ?>"
                                    data-array-id="<?php echo $first_array ?>"><?php echo $file_data['login'] ?></option>
                            <?php
                            $first_array++;
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="ncp-withdrawal-btn">
                <a class="ncp_btn_normal" id="withdrawal-btn" data-id="<?php echo $dataArray['id'] ?>">
                    درخواست برداشت
                    <span class="hs-spinner-gif" id="spinner-gif" style="display:none;"></span>
                </a>
            </div>
        </div>
    </div>
    <div class="ncp-transaction ncp-block">
        <h2>تاریخچه برداشت ها</h2>
        <?php
        echo '<div class="ncp-transaction-grid">';
        if (!empty($historys)) {
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
                <div class="ncp-inner-transaction-list-block">
                    <div class="transaction-condition">
                        <?php
                        if ($history['status'] == 'pending') {
                            $statusClass = 'transaction-warning';
                            $statusText = 'درحال بررسی';
                        } elseif ($history['status'] == 'reject') {
                            $statusClass = 'transaction-error';
                            $statusText = 'رد شده';
                        }  elseif ($history['status'] == 'accept') {
                            $statusClass = 'transaction-done';
                            $statusText = 'تائید شده';
                        } else {
                            $statusClass = 'transaction-warning';
                            $statusText = $history['status'];
                        }
                        ?>
                        <?php if ($history['certificate'] != null) { ?>
                            <a class="certificate-btn transaction-condition transaction-success transaction-list-condition"
                               href="<?php echo $history['certificate']; ?>" target="_blank">دریافت سرتیفیکیت</a>
                        <?php } ?>
                        <div class="transaction-list-condition <?php echo $statusClass; ?>"><?php echo $statusText; ?></div>
                    </div>
                    <div class="ncp-inner-transaction-list">
                        <div class="transaction-list-account-number transaction-list-border">
                            <div class="text-transaction-list">شماره حساب</div>
                            <div class="field-transaction-list"><?php echo !empty($history['login']) ? $history['login'] : '-'; ?></div>
                        </div>
                        <div class="transaction-list-price transaction-list-border">
                            <div class="text-transaction-list">مبلغ</div>
                            <div class="field-transaction-list"><?php echo !empty($history['profit']) ? $history['profit'] : '-'; ?></div>
                        </div>
                        <div class="transaction-list-time transaction-list-border">
                            <div class="text-transaction-list">ساعت</div>
                            <div class="field-transaction-list"><?php echo "$hour:$minutes"; ?></div>
                        </div>
                        <div class="transaction-list-date transaction-list-border">
                            <div class="text-transaction-list">تاریخ</div>
                            <div class="field-transaction-list"><?php echo $persianDate; ?></div>
                        </div>
                        <div class="transaction-wallet transaction-100 transaction-border">
                        <div class="text-transaction">آدرس کیف پول</div>
                        <div class="field-transaction"><?php echo !empty($history['address']) ? $history['address'] : '-'; ?></div>
                    </div>
                    <?php if ($history['response'] != null) { ?>
                        <div class="transaction-list-desc transaction-list-border">
                            <div class="text-transaction-list">توضیحات</div>
                            <div class="field-transaction-list"><?php echo !empty($history['response']) ? htmlspecialchars($history['response'], ENT_QUOTES, 'UTF-8') : '-'; ?></div>
                        </div>
                         <?php }?>
                    </div>
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
    <?php
    return ob_get_clean();
}
?>
