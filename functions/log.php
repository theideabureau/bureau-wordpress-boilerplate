<?php

class LogData {

	/**
	 * Sets up the database table if it does not exist
	 * @return null
	 */
	private function setupTable() {

		global $wpdb;

		// just in case the table doesn't exist, re-create it
		$wpdb->query("CREATE TABLE IF NOT EXISTS `log_data` (
		  `id` INT NOT NULL AUTO_INCREMENT,
		  `user_id` INT NOT NULL,
		  `user_email` VARCHAR(255) NOT NULL DEFAULT '',
		  `user_role` VARCHAR(255) NOT NULL DEFAULT '',
		  `event` VARCHAR(255) NOT NULL DEFAULT '',
		  `user_agent` VARCHAR(255) NOT NULL DEFAULT '',
		  `url` VARCHAR(255) NOT NULL DEFAULT '',
		  `additional_data` TEXT NOT NULL DEFAULT '',
		  `event_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (id)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

	}

	/**
	 * Inserts data into the log table
	 * @param  string $event A string specifying the event type
	 * @param  [array $additional_data] Any additional information to be logged
	 * @param  [WP_User $user] The WordPress user object
	 * @return null
	 */
	public static function log($event, $additional_data = [], $user = null) {

		self::setupTable();

		// if the user hasn't been set, get the current user
		if ( ! $user ) {
			$user = wp_get_current_user();
		}

		// merging default data with supplied data
		$additional_data = array_merge([
			'server' => $_SERVER
		], $additional_data);

		global $wpdb;

		$wpdb->insert('log_data', [
			'user_id' => $user->data->ID,
			'user_email' => $user->data->user_email,
			'user_role' => $user->roles[0],
			'event' => $event,
			'user_agent' => $_SERVER['HTTP_USER_AGENT'],
			'url' => (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
			'additional_data' => var_export($additional_data, true),
		]);

	}

}
