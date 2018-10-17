#!/usr/bin/env php
<?php
if(!defined('sugarEntry'))define('sugarEntry', true);
if(PHP_SAPI !== 'cli') {
    echo "CLI only\n";
    sugar_die('');
}
require_once 'include/entryPoint.php';
// legacy password hash is md5('your passsword')
$GLOBALS['db']->query("UPDATE users SET user_hash = '46f94c8de14fb36680850768ff1b7f2a', reports_to_id = NULL
    WHERE user_name LIKE 'test%' AND deleted = 0");

$GLOBALS['db']->query("INSERT INTO user_preferences (id, category, deleted, date_entered, date_modified, assigned_user_id)
SELECT uuid(), 'global', 0, SYSDATE(), SYSDATE(), u.id FROM users u
LEFT JOIN user_preferences p ON p.assigned_user_id = u.id
WHERE p.id IS NULL
   AND u.deleted = 0");

$preferences = array (
  'loginfailed' => '0',
  'user_theme' => 'SuiteP',
  'reminder_time' => 1800,
  'email_reminder_time' => 3600,
  'mailmerge_on' => 'on',
  'timezone' => 'Europe/Berlin',
  'theme_current_group' => 'Все',
  'swap_last_viewed' => '',
  'swap_shortcuts' => '',
  'navigation_paradigm' => 'gm',
  'subpanel_tabs' => '',
  'module_favicon' => '',
  'hide_tabs' => array (),
  'no_opps' => 'off',
  'reminder_checked' => '1',
  'email_reminder_checked' => '1',
  'ut' => '1',
  'currency' => '-99',
  'default_currency_significant_digits' => '2',
  'num_grp_sep' => ',',
  'dec_sep' => '.',
  'datef' => 'm/d/Y',
  'timef' => 'H:i',
  'default_locale_name_format' => 's f l',
  'use_real_names' => 'on',
  'mail_smtpauth_req' => '',
  'mail_smtpssl' => 0,
  'email_show_counts' => 0,
);
$GLOBALS['db']->query("UPDATE user_preferences SET contents = '"
    .base64_encode(serialize($preferences))."'
    WHERE assigned_user_id IN (SELECT id FROM users WHERE user_name LIKE 'test%' AND deleted = 0)
        AND category = 'global' AND deleted = 0");
