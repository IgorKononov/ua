<?php

class shopUaPlugin extends shopPlugin
{
    public function saveSettings($settings = array())
    {
        $this->installFiles();
        $this->installLocale();
        $this->copyJs();
        if (wa('installer')) {
            installerHelper::flushCache();
        }
    }

    private function installFiles()
    {
        $datapath = __DIR__ . '/data/';
        foreach (waFiles::listdir($datapath, true) as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            if ($path = $this->getLocalePath(explode('_', $filename))) {
                waFiles::copy($datapath . $file, $path . basename($file));
            }
        }
    }

    private function getLocalePath($parts)
    {
        $home = wa()->getConfig()->getRootPath();
        if ($parts[0] === 'webasyst') {
            $home .= "/wa-system/webasyst/";
        } elseif ($parts[0] === 'widget') {
            $home .= "/wa-widgets/$parts[1]/";
        } elseif (!isset($parts[1])) {
            $home .= "/wa-apps/$parts[0]/";
        } elseif (in_array($parts[0], array('payment', 'shipping', 'sms'))) {
            $home .= "/wa-plugins/$parts[0]/$parts[1]/";
        } else {
            $home .= "/wa-apps/$parts[0]/plugins/$parts[1]/";
        }
        if (!file_exists($home)) {
            return false;
        }
        return $home . 'locale/uk_UA/LC_MESSAGES/';
    }

    private function installLocale()
    {
        $path = wa()->getConfig()->getPath('system').'/locale/data/uk_UA.php';
        if (!file_exists($path)) {
            waUtils::varExportToFile($this->getLocaleInfo(), $path);
        }
        $locales = waLocale::getAll();
        if (!in_array('uk_UA', $locales)) {
            $locales[] = 'uk_UA';
            waUtils::varExportToFile($locales, wa()->getConfig()->getPath('config', 'locale'));
        }
    }

    private function getLocaleInfo()
    {
        return array (
            'currency' => 'UAH',
            'frac_digits' => '1',
            'first_day' => '1',
            'name' => 'Ukrainian',
            'region' => 'uk_UA',
            'english_name' => 'Ukrainian',
            'english_region' => 'Ukraine',
            'decimal_point' => '.',
            'thousands_sep' => ',',
            'iso3' => 'ukr',
        );
    }

    private function copyJs()
    {
        waFiles::copy(
            wa()->getAppPath('plugins/ua/js/jquery.ui.datepicker-uk_UA.js', 'shop'),
            wa()->getConfig()->getRootPath() . '/wa-content/js/jquery-ui/i18n/jquery.ui.datepicker-uk_UA.js'
        );
        waFiles::copy(
            wa()->getAppPath('plugins/ua/js/uk.js', 'shop'),
            wa()->getConfig()->getRootPath() . '/wa-content/js/redactor/uk.js'
        );
        waFiles::copy(
            wa()->getAppPath('plugins/ua/js/uk2.js', 'shop'),
            wa()->getConfig()->getRootPath() . '/wa-content/js/redactor/2/uk.js'
        );
    }
}
