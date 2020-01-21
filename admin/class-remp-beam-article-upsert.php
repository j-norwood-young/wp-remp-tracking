<?php

class remp_BeamArticleUpsert {
    /**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $remp_tracking    The ID of this plugin.
	 */
	private $remp_tracking;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $remp_tracking       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */

    public function __construct( $remp_tracking, $version ) {
        $this->remp_tracking = $remp_tracking;
        $this->version = $version;
        $this->url = get_option("remp_tracking_beam_url") . "/api/articles/upsert";
        $this->token = get_option("remp_tracking_property_token");
        $this->apikey = get_option("remp_api_key");
        if ($this->url && $this->token && $this->apikey) {
            add_action( 'transition_post_status', function($new_status, $old_status, $post) { 
                if ($new_status === "publish") { 
                    $this->upsert_post($post); 
                }
            }, 10, 3 );
        }
    }

    public function upsert_post( $post ) {
        $post_id = $post->ID;
        // $this->log("upsert_post {$post_id}");
        $sections = [];
        foreach(get_the_terms( $post_id, "section" ) as $term) {
            $sections[] = $term->name;
        }
        $remp_post_author = get_the_author_meta('display_name');
        $remp_post_title = esc_html( get_the_title($post_id) );
        $remp_post_url = get_the_permalink($post_id);
        $remp_post_date = get_the_date("c", $post_id);
        $data = array("articles" => [
            array(
                "external_id"=> (string)$post_id,
                "property_uuid"=>  $this->token,
                "title"=> $remp_post_title,
                "url"=> $remp_post_url,
                "authors"=> [
                    $remp_post_author
                ],
                "sections"=> $sections,
                "published_at"=> $remp_post_date
            )]
        );
        // $this->log(json_encode($data["articles"]));
        add_action( 'admin_notices', '_errnotice' );
        $response = wp_remote_post( $this->url, 
            array(
                'method' => 'POST',
                'timeout' => 45,
                'headers' => array(
                    "Authorization" => "Bearer " . $this->apikey,
                    "Accept" => "application/json",
                    "Content-Type" => "application/json"
                ),
                'body' => json_encode( $data ),
            )
        );
        if ( is_wp_error( $response ) || ($response["response"]["code"] !== 200) ) {
            $message = json_decode($response["body"])->message;
            add_action( 'admin_notices', '_errnotice' );
        }
    }

    public function _errnotice() {
        ?>
        <div class="error notice">
            <p><?php _e( 'There has been an error saving this post to REMP Beam' ); ?></p>
        </div>
        <?php
    }

    private function log($data) {
        $logfile = "./beam.log";
        $line = date("c") . "\t" . $data . "\n";
        file_put_contents($logfile, $line, FILE_APPEND);
    }
}