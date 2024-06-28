<?php
defined('ABSPATH') or die('Access Denied!');
function dashboard_template($account_info_response, $data)
{
    $fullname = $account_info_response['data']['fullname'];
    global $wpdb;
    $table_name = $wpdb->prefix . 'nitro_table';
    $query = $wpdb->prepare("SELECT auth_status FROM $table_name WHERE account_id = %d", $account_info_response['data']['id']);
    $auth_status = $wpdb->get_var($query);
    ob_start(); ?>
    <div id="dashboard-content">
        <div class="dashboard-first-block">
            <div class="account-info-block">
                <div class="account-info-block-certificate">
                    <h2>اطلاعات حساب</h2>
                    <?php if ($data['certificate'] != null) { ?>
                                <a class="ncp-update-btn"
                                   href="<?php echo $data['certificate']; ?>" target="_blank">دریافت سرتیفیکیت</a>
                            <?php } ?>
                </div>
                <div class="info-btn">
                    <div class="inner-acc-info-sec">
                        <div class="inner-acc-info">
                            <span>Login :</span>
                            <div class="right-info">
                                <?php echo $data ? $data['login'] : '-' ?>
                                <img id="login-clipboard"
                                     src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/copy.svg' ?>"
                                     alt="">
                            </div>
                        </div>
                        <div class="inner-acc-info">
                            <span>Main Password :</span>
                            <div class="right-info">
                                <?php echo $data ? $data['main_password'] : '-' ?>
                                <img id="main-pass-clipboard"
                                     src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/copy.svg' ?>" alt="">
                            </div>
                        </div>
                        <div class="inner-acc-info">
                            <span>Inverstor Password :</span>
                            <div class="right-info"><?php echo $data ? $data['invest_password'] : '-' ?></div>
                        </div>
                        <div class="inner-acc-info">
                            <span>MT5 Server :</span>
                            <div class="right-info"><?php if ($data) {
                                    $step = $data["step"];
                                    if ($step == 'first') {
                                        echo 'MishovMarkets-Demo';
                                    } elseif ($step == 'second') {
                                        echo 'MishovMarkets-Demo';
                                    } elseif ($step == 'third') {
                                        echo 'MishovMarkets-Live';
                                    }
                                } else {
                                    echo '-';
                                } ?></div>
                        </div>
                        <?php
                        if ($data) {
                            ?>
                            <div class="pln-btn-sec">
                                <div class="account-plan-btn1">
                                    <a style="background:#56CFB9;"
                                       href="https://download.mql5.com/cdn/web/mishov.markets.llc/mt5/mishovmarkets5setup.exe">
                                        دانلود متاتریدر ۵
                                    </a>
                                </div>
                                <div class="account-plan-btn1">
                                    <a style="background:#4EBCF0;" href="https://t.me/amiri_nitroprop">
                                        ارتباط با اکانت منیجر
                                    </a>
                                </div>
                            </div>

                            <?php
                        }
                        ?>
                    </div>

                </div>
            </div>
            <div class="account-plan-block">
                <h2>سلام <?php echo $fullname ?> عزیز!</h2>
                <div class="account-plan-sec">
                    <div class="inner-acc-plan">
                        <h3><?php echo $data ? 'دو مرحله ای' : 'در انتظار خرید' ?></h3>
                        <span>نوع پلن</span>
                    </div>
                    <div class="inner-acc-plan">
                        <h3>$<?php echo isset($data['current_balance']) ? $data['current_balance'] : 0 ?></h3>
                        <span>بالانس فعلی</span>
                    </div>
                    <div class="inner-acc-plan">
                        <h3>$<?php echo isset($data['first_balance']) ? $data['first_balance'] : 0 ?></h3>
                        <span>بالانس اولیه</span>
                    </div>
                    <div class="inner-acc-plan">
                        <?php
                        switch ($auth_status) {
                            case (0):
                                echo '<h3>انجام نشده</h3>';
                                break;
                            case (1):
                                echo '<h3>در انتظار تایید</h3>';
                                break;
                            case (2):
                                echo '<h3>تایید شده</h3>';
                                break;
                            case (3):
                                echo '<h3>رد شده</h3>';
                                break;
                        }
                        ?>
                        <span>وضعیت احراز هویت</span>
                    </div>

                    <div class="inner-acc-plan">
                        <?php
                        if (isset($data['start_ts'])) {
                            $start_ts = $data['start_ts'];
                            if ($start_ts != 'None') {
                                $timestamp = strtotime($start_ts);
                                $formatter = new IntlDateFormatter(
                                    'fa-IR',
                                    IntlDateFormatter::SHORT,
                                    IntlDateFormatter::NONE,
                                    'Asia/Tehran',
                                    IntlDateFormatter::TRADITIONAL,
                                );
                                echo '<h3>' . $formatter->format($timestamp) . '</h3>';
                            } else {
                                echo '<h3>-</h3>';
                            }
                        } else {
                            echo '<h3>-</h3>';
                        }
                        ?>

                        <span>شروع چالش</span>
                    </div>
                    <div class="inner-acc-plan">
                        <?php
                        if ($data) {
                            $step = $data["step"];
                            if ($step == 'first') {
                                echo '<h3>مرحله اول</h3>';
                            } elseif ($step == 'second') {
                                echo '<h3>مرحله دوم</h3>';
                            } elseif ($step == 'third') {
                                echo '<h3>حساب ریل</h3>';
                            }
                        } else {
                            echo '<h3>در انتظار خرید</h3>';
                        }

                        ?>
                        <span>مرحله چالش</span>
                    </div>
                </div>
                <div class="account-plan-btn">
                    <?php
                    if ($data) {
                        $state = $data["state"];
                        if ($state == 'first_trade') {
                            echo '<a class="transaction-success">وضعیت حساب: در انتظار اولین ترید</a>';
                        } elseif ($state == 'trading') {
                            echo '<a class="transaction-success">وضعیت حساب: در  حال ترید</a>';
                        } elseif ($state == 'rejected') {
                            echo '<a class="transaction-error">وضعیت حساب: رد شده</a>';
                        } elseif ($state == 'completed') {
                            echo '<a class="transaction-done">وضعیت حساب: تکمیل شده</a>';
                        }
                    } else {
                        echo '<a class="transaction-success">وضعیت حساب: در انتظار خرید چالش</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
            <div class="dashboard-second ncp-block">
                <div class="ncp-update-btn-contianer">
                    <h2>وضعیت حساب</h2>
                    <a class="ncp-update-btn" id="refresh-dashboard">آپدیت اطلاعات پنل</a>
                </div>
                <div class="account-status-sec">
                    <div class="account-status">
                        <div class="inner-status">
                            روز های معاملاتی
                            <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/status-01.svg' ?>" alt="">
                        </div>
                        <?php
                        if (isset($data["step"]) && ($data["step"] === 'first' || $data["step"] === 'second')) {
                            echo isset($data["trade_days"]) ? $data["trade_days"] : 'ندارد';
                        } else {
                            echo 'ندارد';
                        }
                        ?>
                    </div>
                    <div class="account-status">
                        <div class="inner-status">
                            درادون روزانه
                            <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/status-02.svg' ?>" alt="">
                        </div>
                        <?php
                        if (isset($data["daily_drawdown"])) {
                            $daily = $data["daily_drawdown"];
                            $daily_num = intval($daily);
                            if ($daily_num < 0) {
                                echo '-$' . abs($daily_num);
                            } else {
                                echo '$' . $daily;
                            }
                        } else {
                            echo '$0';
                        }
                        ?>
                    </div>
                    <div class="account-status">
                        <div class="inner-status">
                            درادون کل
                            <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/status-02.svg' ?>" alt="">
                        </div>
                        <?php
                        if (isset($data["total_drawdown"])) {
                            $total = $data["total_drawdown"];
                            $total_num = intval($total);
                            if ($total_num < 0) {
                                echo '-$' . abs($total_num);
                            } else {
                                echo '$' . $total;
                            }
                        } else {
                            echo '$0';
                        }
                        ?>
                    </div>
                    <div class="account-status">
                        <div class="inner-status">
                            تارگت چالش
                            <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/status-03.svg' ?>" alt="">
                        </div>
                        <?php
                        if (isset($data["target"])) {
                            echo '$' . $data["target"];
                        } else {
                            echo '$0';
                        }
                        ?>
                    </div>
                </div>
            </div>
        <div class="dashboard-third ncp-block">
            <h2>جزئیات حساب</h2>
            <div class="third-account-status">
                    <div class="inner-third-account-status">
                        <div class="right">
                            <div class="header-status">
                                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/status-01.svg' ?>"
                                     alt="">
                                روز های معاملاتی
                            </div>
                            <div class="content-status">
                                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/check-mark.svg' ?>"
                                     alt="">
                                حداقل روزهای معاملاتی: <?php
                                if (isset($data["step"]) && ($data["step"] === 'first' || $data["step"] === 'second')) {
                                    echo '5 روز';
                                } else {
                                    echo 'ندارد';
                                } ?>
                            </div>
                            <div class="content-status">
                                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/check-mark.svg' ?>"
                                     alt="">
                                روزهای معاملاتی شما: <?php
                                if (isset($data["step"]) && ($data["step"] === 'first' || $data["step"] === 'second')) {
                                    if (isset($data["trade_days"])) {
                                        echo $data["trade_days"] . ' روز';
                                    } else {
                                        echo 'ندارد';
                                    }
                                } else {
                                    echo 'ندارد';
                                }
                                ?>                                
                            </div>
                        </div>
                        <div class="left">
                            <?php
                            $trade_passed = $data['trade_days_is_passed'];
                            if ($trade_passed) {
                                echo '<span class="transaction-done">انجام شده</span>';
                            } else {
                                echo '<span class="transaction-success">در حال انجام</span>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="inner-third-account-status">
                        <div class="right">
                            <div class="header-status">
                                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/status-02.svg' ?>"
                                     alt="">
                                درادون روزانه
                            </div>
                            <div class="content-status">
                                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/check-mark.svg' ?>"
                                     alt="">
                                بالانس ابتدای روز: <?php
                                if (isset($data["balance_in_morning"])) {
                                    $morning = $data["balance_in_morning"];
                                    $morning_num = intval($morning);
                                    if ($morning_num < 0) {
                                        echo abs($morning_num) . '$-';
                                    } elseif ($morning_num == 0) {
                                        echo '0$';
                                    } else {
                                        echo $morning . '$';
                                    }
                                } else {
                                    echo '0$';
                                }
                                ?>
                            </div>
                            <div class="content-status">
                                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/check-mark.svg' ?>"
                                     alt="">
                                درادون روزانه مجاز: <?php
                                if (isset($data["daily_drawdown"])) {
                                    $daily = $data["daily_drawdown"];
                                    $daily_num = intval($daily);
                                    if ($daily_num < 0) {
                                        echo abs($daily_num) . '$-';
                                    } else {
                                        echo $daily . '$';
                                    }
                                } else {
                                    echo '0$';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="left">
                            <?php
                            echo $data['daily_drawdown_is_rejected'] ? '<span class="transaction-error">رد شده</span>' : '<span class="transaction-success">در حال انجام</span>';
                            ?>
                        </div>
                    </div>
                    <div class="inner-third-account-status">
                        <div class="right">
                            <div class="header-status">
                                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/status-02.svg' ?>"
                                     alt="">
                                درادون کل
                            </div>
                            <div class="content-status">
                                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/check-mark.svg' ?>"
                                     alt="">
                                حداکثر درادون کل: <?php
                                switch ($data['group']) {
                                    case 1:
                                        $amount = 600;
                                        break;
                                    case 2:
                                        $amount = 1200;
                                        break;
                                    case 3:
                                        $amount = 3000;
                                        break;
                                    case 4:
                                        $amount = 6000;
                                        break;
                                    default:
                                        $amount = 0;
                                        break;
                                }
                                echo $amount . '$';
                                ?>
                            </div>
                            <div class="content-status">
                                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/check-mark.svg' ?>"
                                     alt="">
                                درادون کل مجاز: <?php
                                if (isset($data["total_drawdown"])) {
                                    $total = $data["total_drawdown"];
                                    $total_num = intval($total);
                                    if ($total_num < 0) {
                                        echo abs($total_num) . '$-';
                                    } else {
                                        echo $total . '$';
                                    }
                                } else {
                                    echo '0$';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="left">
                            <?php
                            if ($data['total_drawdown_is_rejected']) {
                                echo '<span class="transaction-error">رد شده</span>';
                            } else {
                                echo '<span class="transaction-success">در حال انجام</span>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="inner-third-account-status">
                        <div class="right">
                            <div class="header-status">
                                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/status-03.svg' ?>"
                                     alt="">
                                تارگت چالش
                            </div>
                            <div class="content-status">
                                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/check-mark.svg' ?>"
                                     alt="">
                                تارگت مورد نیاز:
                                <?php
                                switch ($data['group']) {
                                    case 1:
                                        $amount = match ($data['step']) {
                                            'first' => 400,
                                            'second' => 200,
                                            'third' => "ندارد",
                                            default => "نامعتبر",
                                        };
                                        break;
                                    case 2:
                                        $amount = match ($data['step']) {
                                            'first' => 800,
                                            'second' => 400,
                                            'third' => "ندارد",
                                            default => "نامعتبر",
                                        };
                                        break;
                                    case 3:
                                        $amount = match ($data['step']) {
                                            'first' => 2000,
                                            'second' => 1000,
                                            'third' => "ندارد",
                                            default => "نامعتبر",
                                        };
                                        break;
                                    case 4:
                                        $amount = match ($data['step']) {
                                            'first' => 4000,
                                            'second' => 2000,
                                            'third' => "ندارد",
                                            default => "نامعتبر",
                                        };
                                        break;
                                    default:
                                        $amount = "بدون گروه";
                                        break;
                                }
                                echo is_numeric($amount) ? $amount . '$' : $amount;
                                ?>
                            </div>

                            <div class="content-status">
                                <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/check-mark.svg' ?>"
                                     alt="">
                                تارگت کسب شده: <?php
                                if (isset($data["target"])) {
                                    echo $data["target"] . '$';
                                } else {
                                    echo 0 . '$';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="left">
                            <?php
                            if ($data['target_is_passed']) {
                                echo '<span class="transaction-done">انجام شده</span>';
                            } else {
                                echo '<span class="transaction-success">در حال انجام</span>';
                            }
                            ?>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <?php
    return ob_get_clean();
}
?>
