<?php

function rudr_instagram_api_curl_connect( $api_url ) {
	$connection_c = curl_init(); // initializing
	curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
	curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
	curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
	$json_return = curl_exec( $connection_c ); // connect and get json data
	curl_close( $connection_c ); // close connection
	return json_decode( $json_return ); // decode and return
}

if (get_field('instagram_token', 'option')) {
  $access_token = get_field('instagram_token', 'option');
}
else {
  $access_token = '';
}
$return = rudr_instagram_api_curl_connect("https://api.instagram.com/v1/users/self/media/recent?access_token=" . $access_token);
$data = $return->data;

?>

<?php if(!empty($data) && count($data) > 4) { ?>

<section class="section section_large">
  <div class="b-instagram">

    <div class="container">
      <div class="b-instagram__inner">
        <div class="row">

          <div class="col-sm-4">
            <div class="row">
              <div class="col-sm-12">
                <div class="b-instagram__head">
                  <div class="b-instagram__title"><?php the_field('instagram_title', 'option'); ?></div>
                  <a class="b-instagram__link" href="<?php the_field('instagram_account_link_url', 'option'); ?>" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/src/img/icons/icon-instagram.svg"
                      alt="Instagram icon">
                    <span><?php the_field('instagram_account_link_text', 'option'); ?></span>
                  </a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="b-instagram__item">
                  <div class="b-instagram__image">
                    <img src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?php echo $data[0]->images->standard_resolution->url; ?>" class="u-full u-object-fit lazy">
                  </div>
                  <div class="b-instagram__count"><?php echo $data[0]->likes->count; ?></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="row">
              <div class="col-sm-12">
                <div class="b-instagram__item">
                  <div class="b-instagram__image">
                    <img src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?php echo $data[1]->images->standard_resolution->url; ?>" class="u-full u-object-fit lazy">
                  </div>
                  <div class="b-instagram__count"><?php echo $data[1]->likes->count; ?></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-9 offset-sm-2">
                <div class="b-instagram__item">
                  <div class="b-instagram__image">
                    <img src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?php echo $data[2]->images->standard_resolution->url; ?>" class="u-full u-object-fit lazy">
                  </div>
                  <div class="b-instagram__count"><?php echo $data[2]->likes->count; ?></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="row">
              <div class="col-sm-8 offset-sm-1">
                <div class="b-instagram__item">
                  <div class="b-instagram__image">
                    <img src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?php echo $data[3]->images->standard_resolution->url; ?>" class="u-full u-object-fit lazy">
                  </div>
                  <div class="b-instagram__count"><?php echo $data[3]->likes->count; ?></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-10 offset-sm-1">
                <div class="b-instagram__item">
                  <div class="b-instagram__image">
                    <img src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?php echo $data[4]->images->standard_resolution->url; ?>" class="u-full u-object-fit lazy">
                  </div>
                  <div class="b-instagram__count"><?php echo $data[4]->likes->count; ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<?php } ?>
