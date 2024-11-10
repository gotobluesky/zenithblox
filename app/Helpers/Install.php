<?php

namespace App\Helpers;

class Install
{
    /**
     * Check PHP version requirement.
     *
     * @return array
     */
    public function checkPHPversion(string $minPhpVersion = null)
    {
        $minVersionPhp = $minPhpVersion;
        $currentPhpVersion = $this->getPhpVersionInfo();
        $supported = false;

        if ($minPhpVersion == null) {
            $minVersionPhp = $this->getMinPhpVersion();
        }

        if (version_compare($currentPhpVersion['version'], $minVersionPhp) >= 0) {
            $supported = true;
        }

        $phpStatus = [
            'full' => $currentPhpVersion['full'],
            'current' => $currentPhpVersion['version'],
            'minimum' => $minVersionPhp,
            'supported' => $supported,
        ];

        return $phpStatus;
    }
    /**
     * Get current Php version information.
     *
     * @return array
     */
    private static function getPhpVersionInfo()
    {
        $currentVersionFull = PHP_VERSION;
        preg_match("#^\d+(\.\d+)*#", $currentVersionFull, $filtered);
        $currentVersion = $filtered[0];

        return [
            'full' => $currentVersionFull,
            'version' => $currentVersion,
        ];
    }

    /**
     * Get minimum PHP version ID.
     *
     * @return string _minPhpVersion
     */
    protected function getMinPhpVersion()
    {
        return $this->_minPhpVersion;
    }
    /**
     * Check for the server requirements.
     *
     * @param array $requirements
     * @return array
     */
    public function checkServerRequirements(array $requirements)
    {
        $results = [];
        
        foreach ($requirements as $type => $requirement) {
            switch ($type) {
                    // check php requirements
                case 'php':
                    foreach ($requirements[$type] as $requirement) {
                        $results['requirements'][$type][$requirement] = true;

                        if (!extension_loaded($requirement)) {
                            $results['requirements'][$type][$requirement] = false;

                            $results['errors'] = true;
                        }
                    }
                    break;
                case 'apache':
                    foreach ($requirements[$type] as $requirement) {
                        // if function doesn't exist we can't check apache modules
                        if (function_exists('apache_get_modules')) {
                            $results['requirements'][$type][$requirement] = true;

                            if (!in_array($requirement, apache_get_modules())) {
                                $results['requirements'][$type][$requirement] = false;

                                $results['errors'] = true;
                            }
                        }
                    }
                    break;
            }
        }
        
        return $results;
    }

    /**
     * Will check file and folder permissions
     * 
     * @param array $permissions
     * @return array
     */
    public function checkPermissions(array $permissions)
    {
        $results['permissions'] = [];
        $results['errors'] = null;
        foreach ($permissions as $folder => $permission) {
            $existing_permission = substr(sprintf('%o', fileperms(base_path($folder))), -4);

            if (is_writeable($folder)) {
                array_push($results['permissions'], [
                    'folder' => $folder,
                    'current_permission' => $existing_permission,
                    'permission' => $permission,
                    'isSet' => true,
                ]);
            } else {
                array_push($results['permissions'], [
                    'folder' => $folder,
                    'current_permission' => $existing_permission,
                    'permission' => $permission,
                    'isSet' => false,
                ]);
                $results['errors'] = true;
            }
        }
        return $results;
    }
}
