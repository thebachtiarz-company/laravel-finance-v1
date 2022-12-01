<?php

namespace TheBachtiarz\Finance\Providers;

class DataProvider
{
    //

    /**
     * List of config who need to registered into current project.
     * Perform by auth app module.
     *
     * @return array
     */
    public static function registerConfig(): array
    {
        $registerConfig = [];

        // ! user status
        $registerConfig[] = [];

        // ! logging
        $logging = config('logging.channels');
        $registerConfig[] = [
            'logging.channels' => array_merge(
                $logging,
                [
                    'finance' => [
                        'driver' => 'single',
                        'path' => tbdirlocation("log/finance.log")
                    ]
                ]
            )
        ];

        return $registerConfig;
    }
}
