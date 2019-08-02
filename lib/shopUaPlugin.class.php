<?php

class shopUaPlugin extends shopPlugin
{
    public function installFiles()
    {
        $datapath = __DIR__ . '/data/';
        foreach (waFiles::listdir($datapath, true) as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            if ($path = $this->getLocalePath(explode('_', $filename))) {
                waFiles::copy($datapath . $file, $path . basename($file));
            }
        }
        $this->installLocale();
        if (wa('installer')) {
            installerHelper::flushCache();
        }
    }

    private function getLocalePath($parts)
    {
        $home = wa()->getConfig()->getRootPath();
        if (!isset($parts[1])) {
            $home .= "/wa-apps/{$parts[0]}/";
        } elseif (in_array($parts[0], ['payment', 'shipping', 'sms'])) {
            $home .= "/wa-plugins/{$parts[0]}/{$parts[1]}/";
        } else {
            $home .= "/wa-apps/{$parts[0]}/plugins/{$parts[1]}/";
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
}
