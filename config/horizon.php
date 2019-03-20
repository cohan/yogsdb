<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Horizon Redis Connection
	|--------------------------------------------------------------------------
	|
	| This is the name of the Redis connection where Horizon will store the
	| meta information required for it to function. It includes the list
	| of supervisors, failed jobs, job metrics, and other information.
	|
	 */

	'use' => 'default',

	/*
	|--------------------------------------------------------------------------
	| Horizon Redis Prefix
	|--------------------------------------------------------------------------
	|
	| This prefix will be used when storing all Horizon data in Redis. You
	| may modify the prefix when you are running multiple installations
	| of Horizon on the same server so that they don't have problems.
	|
	 */

	'prefix' => env('HORIZON_PREFIX', 'horizon:'),

	/*
	|--------------------------------------------------------------------------
	| Queue Wait Time Thresholds
	|--------------------------------------------------------------------------
	|
	| This option allows you to configure when the LongWaitDetected event
	| will be fired. Every connection / queue combination may have its
	| own, unique threshold (in seconds) before this event is fired.
	|
	 */

	'waits'          => [
		'redis:default' => 60,
	],

	/*
	|--------------------------------------------------------------------------
	| Queue Worker Configuration
	|--------------------------------------------------------------------------
	|
	| Here you may define the queue worker settings used by your application
	| in all environments. These supervisors and settings handle all your
	| queued jobs and will be provisioned by Horizon during deployment.
	|
	 */

	'environments'  => [
		'production'   => [
			'searchIndex' => [
				'connection' => 'redis',
				'queue'      => ['searchIndex'],
				'balance'    => 'false',
				'processes'  => 1,
				'tries'      => 10,
				'timeout'    => 3600,
			],
			'queues'      => [
				'connection' => 'redis',
				'queue'      => [
					'high',
					'default'
				],
				'balance'    => 'auto',
				'processes'  => 4,
				'tries'      => 3,
				'timeout'    => 3600,
			],
		],

		'local'        => [
			'searchIndex' => [
				'connection' => 'redis',
				'queue'      => ['searchIndex'],
				'balance'    => 'false',
				'processes'  => 1,
				'tries'      => 10,
				'timeout'    => 600,
			],
			'queues'      => [
				'connection' => 'redis',
				'queue'      => [
					'high',
					'default'
				],
				'balance'    => 'auto',
				'processes'  => 3,
				'tries'      => 1,
				'timeout'    => 600,
			],
		],
	],

];
