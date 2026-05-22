<?php
/**
 * Database operations for SELF by GS Forms.
 *
 * @package selfbygs-forms
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SelfByGS_DB {

	const TABLE_ENTRIES = 'selfbygs_form_entries';
	const TABLE_NOTES   = 'selfbygs_form_notes';

	public static function create_tables() {
		global $wpdb;
		$charset = $wpdb->get_charset_collate();
		$entries = $wpdb->prefix . self::TABLE_ENTRIES;
		$notes   = $wpdb->prefix . self::TABLE_NOTES;

		$sql = "
		CREATE TABLE {$entries} (
			id            BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
			form_id       VARCHAR(100)    NOT NULL DEFAULT 'lead',
			name          VARCHAR(255)    NOT NULL DEFAULT '',
			email         VARCHAR(255)    NOT NULL DEFAULT '',
			phone         VARCHAR(80)     NOT NULL DEFAULT '',
			organisation  VARCHAR(255)    NOT NULL DEFAULT '',
			who           VARCHAR(255)    NOT NULL DEFAULT '',
			programs      TEXT            NOT NULL DEFAULT '',
			context       TEXT            NOT NULL DEFAULT '',
			preferred_time VARCHAR(100)   NOT NULL DEFAULT '',
			source_page   VARCHAR(255)    NOT NULL DEFAULT '',
			ip_address    VARCHAR(64)     NOT NULL DEFAULT '',
			status        VARCHAR(50)     NOT NULL DEFAULT 'new',
			admin_notes   TEXT            NOT NULL DEFAULT '',
			created_at    DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
			updated_at    DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY (id),
			KEY form_id (form_id),
			KEY status (status),
			KEY email (email(191)),
			KEY created_at (created_at)
		) {$charset};

		CREATE TABLE {$notes} (
			id         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
			entry_id   BIGINT UNSIGNED NOT NULL,
			user_id    BIGINT UNSIGNED NOT NULL DEFAULT 0,
			note       TEXT            NOT NULL,
			created_at DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (id),
			KEY entry_id (entry_id)
		) {$charset};
		";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );

		update_option( 'selfbygs_forms_db_version', SELFBYGS_FORMS_DB_VERSION );
	}

	public static function insert_entry( array $data ) {
		global $wpdb;
		$result = $wpdb->insert(
			$wpdb->prefix . self::TABLE_ENTRIES,
			array(
				'form_id'        => $data['form_id'] ?? 'lead',
				'name'           => $data['name'] ?? '',
				'email'          => $data['email'] ?? '',
				'phone'          => $data['phone'] ?? '',
				'organisation'   => $data['organisation'] ?? '',
				'who'            => $data['who'] ?? '',
				'programs'       => $data['programs'] ?? '',
				'context'        => $data['context'] ?? '',
				'preferred_time' => $data['preferred_time'] ?? '',
				'source_page'    => $data['source_page'] ?? '',
				'ip_address'     => $data['ip_address'] ?? '',
				'status'         => $data['status'] ?? 'new',
			),
			array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
		);
		return $result ? $wpdb->insert_id : false;
	}

	public static function get_entry( $id ) {
		global $wpdb;
		return $wpdb->get_row(
			$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}" . self::TABLE_ENTRIES . " WHERE id = %d", absint( $id ) )
		);
	}

	public static function get_entries( array $args = array() ) {
		global $wpdb;

		$defaults = array(
			'per_page'  => 20,
			'page'      => 1,
			'form_id'   => '',
			'status'    => '',
			'search'    => '',
			'orderby'   => 'created_at',
			'order'     => 'DESC',
		);
		$args = wp_parse_args( $args, $defaults );

		$table  = $wpdb->prefix . self::TABLE_ENTRIES;
		$where  = array( '1=1' );
		$values = array();

		if ( $args['form_id'] ) {
			$where[]  = 'form_id = %s';
			$values[] = $args['form_id'];
		}
		if ( $args['status'] ) {
			$where[]  = 'status = %s';
			$values[] = $args['status'];
		}
		if ( $args['search'] ) {
			$like     = '%' . $wpdb->esc_like( $args['search'] ) . '%';
			$where[]  = '(name LIKE %s OR email LIKE %s OR phone LIKE %s OR organisation LIKE %s)';
			$values[] = $like;
			$values[] = $like;
			$values[] = $like;
			$values[] = $like;
		}

		$allowed_order  = array( 'id', 'name', 'email', 'created_at', 'status', 'form_id' );
		$orderby        = in_array( $args['orderby'], $allowed_order, true ) ? $args['orderby'] : 'created_at';
		$order          = strtoupper( $args['order'] ) === 'ASC' ? 'ASC' : 'DESC';
		$offset         = ( (int) $args['page'] - 1 ) * (int) $args['per_page'];
		$limit          = (int) $args['per_page'];

		$where_str = implode( ' AND ', $where );
		$sql       = "SELECT * FROM {$table} WHERE {$where_str} ORDER BY {$orderby} {$order} LIMIT %d OFFSET %d";
		$values[]  = $limit;
		$values[]  = $offset;

		if ( ! empty( $values ) ) {
			return $wpdb->get_results( $wpdb->prepare( $sql, $values ) );
		}
		return $wpdb->get_results( $sql );
	}

	public static function count_entries( array $args = array() ) {
		global $wpdb;
		$table  = $wpdb->prefix . self::TABLE_ENTRIES;
		$where  = array( '1=1' );
		$values = array();

		if ( ! empty( $args['form_id'] ) ) {
			$where[]  = 'form_id = %s';
			$values[] = $args['form_id'];
		}
		if ( ! empty( $args['status'] ) ) {
			$where[]  = 'status = %s';
			$values[] = $args['status'];
		}
		if ( ! empty( $args['search'] ) ) {
			$like     = '%' . $wpdb->esc_like( $args['search'] ) . '%';
			$where[]  = '(name LIKE %s OR email LIKE %s OR phone LIKE %s OR organisation LIKE %s)';
			$values[] = $like;
			$values[] = $like;
			$values[] = $like;
			$values[] = $like;
		}

		$where_str = implode( ' AND ', $where );
		$sql       = "SELECT COUNT(*) FROM {$table} WHERE {$where_str}";

		if ( $values ) {
			return (int) $wpdb->get_var( $wpdb->prepare( $sql, $values ) );
		}
		return (int) $wpdb->get_var( $sql );
	}

	public static function update_status( $id, $status ) {
		global $wpdb;
		$wpdb->update(
			$wpdb->prefix . self::TABLE_ENTRIES,
			array( 'status' => sanitize_text_field( $status ) ),
			array( 'id' => absint( $id ) ),
			array( '%s' ),
			array( '%d' )
		);
	}

	public static function delete_entry( $id ) {
		global $wpdb;
		$wpdb->delete( $wpdb->prefix . self::TABLE_ENTRIES, array( 'id' => absint( $id ) ), array( '%d' ) );
		$wpdb->delete( $wpdb->prefix . self::TABLE_NOTES, array( 'entry_id' => absint( $id ) ), array( '%d' ) );
	}

	public static function add_note( $entry_id, $note, $user_id = 0 ) {
		global $wpdb;
		$wpdb->insert(
			$wpdb->prefix . self::TABLE_NOTES,
			array(
				'entry_id' => absint( $entry_id ),
				'user_id'  => absint( $user_id ),
				'note'     => sanitize_textarea_field( $note ),
			),
			array( '%d', '%d', '%s' )
		);
	}

	public static function get_notes( $entry_id ) {
		global $wpdb;
		return $wpdb->get_results(
			$wpdb->prepare(
				"SELECT n.*, u.display_name FROM {$wpdb->prefix}" . self::TABLE_NOTES . " n LEFT JOIN {$wpdb->users} u ON u.ID = n.user_id WHERE n.entry_id = %d ORDER BY n.created_at ASC",
				absint( $entry_id )
			)
		);
	}

	public static function get_counts_by_status() {
		global $wpdb;
		$table = $wpdb->prefix . self::TABLE_ENTRIES;
		$rows  = $wpdb->get_results( "SELECT status, COUNT(*) AS cnt FROM {$table} GROUP BY status" );
		$out   = array( 'all' => 0 );
		foreach ( $rows as $row ) {
			$out[ $row->status ] = (int) $row->cnt;
			$out['all']         += (int) $row->cnt;
		}
		return $out;
	}
}
