<?php
defined('ABSPATH') or die('Access Denied!');
function requests_template($acc_id, $dataArrayVal)
{
    $nitro_access_token = $_COOKIE['nitro_access_token'];
    $response = api_list_request($acc_id);
    $datas = $response['data'];
    $account_file_response = api_account_file($nitro_access_token);
    $file_datas = $account_file_response['data'];

    ob_start();
    ?>
    <div class="ncp-request-block ncp-block">
        <h2>درخواست ها</h2>
        <div class="ncp-request">
            <div class="request-input">
                <div class="request-type">
                    <div class="ncp-select-input">
                        <label for="request-type">نوع درخواست</label>
                        <select name="request-type" id="request-type">
                            <option value="1">ساخت حساب مرحله دوم</option>
                            <option value="2">ساخت حساب مرحله Real</option>
                        </select>
                    </div>
                    <div class="ncp-select-input">
                        <label for="request-account">حساب</label>
                        <select name="request-account" id="request-account">
                            <?php
                            $first_array = 0;
                            foreach ($file_datas as $file_data) {
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
                <div class="request-description">
                    <label for="request-description">توضیحات (اختیاری)</label>
                    <textarea name="request-description" id="request-description" cols="30" rows="10"></textarea>
                </div>
            </div>
            <a id="ncp-btn-request" class="ncp-btn-request">ارسال درخواست</a>
        </div>
    </div>
    <div class="ncp-request-list-block ncp-block">
       <div class="header-request-list">
    <h2>لیست درخواست ها</h2>
    <div class="tooltip-container">
        <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/info.svg' ?>" alt="">
        <span class="tooltip-text">برای مشاهده لیست درخواست ها، لطفا حساب موردنظر را انتخاب نمایید.</span>
    </div>
        </div>
        <div class="ncp-request-list">
            <?php
            if (!$datas) {
                ?>
                <p class="null-request-list">درخواستی وجود ندارد</p>
                <?php
            } else {
                foreach ($datas as $data) {
                    ?>
                    <div class="ncp-inner-request-list-block">
                        <div class="request-condition">
                            <?php
                            if ($data['status'] == 'pending') {
                                ?>
                                <div class="request-list-condition transaction-warning ">درحال بررسی</div><?php
                            } elseif ($data['status'] == 'rejected') {
                                ?>
                                <div class="request-list-condition transaction-error ">رد شده</div><?php
                            }  elseif ($data['status'] == 'approved') {
                                ?>
                                <div class="request-list-condition transaction-success">تائید شده</div><?php
                            } else {
                                ?>
                                <div class="request-list-condition "></div><?php
                            }
                            ?>
                        </div>
                        <div class="ncp-inner-request-list">
                            <div class="request-list-account-number request-list-border">
                                <div class="text-request-list">شماره حساب</div>
                                <div class="field-request-list"><?php echo $dataArrayVal ?></div>
                            </div>
                            <div class="request-list-price  request-list-border">
                                <div class="text-request-list">موضوع</div>
                                <div class="field-request-list"><?php echo $data['title'] ?></div>
                            </div>
                            <div class="request-list-time request-list-border">
                                <div class="text-request-list">ساعت</div>
                                <?php
                                $start_ts = $data["created_ts"];
                                $timestamp = new DateTime($start_ts, new DateTimeZone('Asia/Tehran'));
                                // Format the DateTime object to get only the hour and minute
                                $formatted_time = $timestamp->format('H:i');
                                // Output the formatted time
                                echo '<div class="field-request-list">' . $formatted_time . '</div>';
                                ?>
                            </div>
                            <div class="request-list-date request-list-border">
                                <div class="text-request-list">تاریخ</div>
                                <?php
                                $timestamp = strtotime($start_ts);
                                $formatter = new IntlDateFormatter(
                                    'fa-IR',
                                    IntlDateFormatter::SHORT,
                                    IntlDateFormatter::NONE,
                                    'Asia/Tehran',
                                    IntlDateFormatter::TRADITIONAL,
                                );
                                echo '<div class="field-request-list">' . $formatter->format($timestamp) . '</div>';
                                ?>
                            </div>
                            <?php if (!empty($data['response'])) { ?>
                                <div class="request-list-desc request-list-border">
                                    <div class="text-request-list">توضیحات</div>
                                    <div class="field-request-list"><?php echo $data['response'] ?></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}