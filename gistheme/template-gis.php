<?php
/*
Template Name: Gis
*/
?> <?php get_header(); ?> <script type="module" src="https://unpkg.com/x-frame-bypass"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDq9oFuUgh1LFguSvX7psEgk_XX8C2KIbo"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/ol-ext.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/jspdf.umd.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/elm-pep.js"></script>

<link href="https://cdn.jsdelivr.net/npm/ol-geocoder@latest/dist/ol-geocoder.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/ol-geocoder"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<div id="content">

	<section id="main-content" class="active-cl">
		<span class="popuptext" id="myPopup"></span>
		<div id="overlay_pdf">
		  <div id="popup_pdf" class="popup-pdf">
  			<div id="close_pdf">X</div>
			<h2>In Bản Đồ</h2>
			<form class="form">
				<div class="filed">
					<label for="format">Kích cỡ </label>
					<select id="format">
						<option value="a0">A0 (chậm)</option>
						<option value="a1">A1</option>
						<option value="a2">A2</option>
						<option value="a3">A3</option>
						<option value="a4" selected>A4</option>
						<option value="a5">A5 (nhanh)</option>
					</select>
				</div>
				<div class="filed">
					<label for="resolution">Chất Lượng </label>
					<select id="resolution">
						<option value="72">72 dpi (nhanh)</option>
						<option value="150">150 dpi</option>
						<option value="300">300 dpi (chậm)</option>
					</select>
				</div>
			</form>
			<button id="export-pdf">Xuất PDF</button>
		  </div>
      	</div>
    	<div id="overlay">
		<div id="popup" class="popup-khancap">
  		<div id="close">X</div>
		<h2>Báo Cáo Ngập Lụt</h2>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="filed">
				<label for="dia_chi_satlo">Địa chỉ:</label>
				<input type="text" id="dia_chi_satlo" name="dia_chi_satlo" value="" required>
			</div>


			<div class="filed">
				<label for="mieu_ta_satlo">Miêu tả:</label>
				<textarea name="mieu_ta_satlo" id="mieu_ta_satlo" rows="5" value="" required></textarea>
			</div>
			<div class="filed">
				<label for="ten_nguoi_bao">Tên người báo:</label>
				<input type="text" id="ten_nguoi_bao" name="ten_nguoi_bao" value="">
			</div>
			<div class="filed">
				<label for="sdt_nguoi_bao">Số điện thoại người báo:</label>
				<input type="text" id="sdt_nguoi_bao" name="sdt_nguoi_bao" value="" required>
			</div>
			<div class="filed">

			<input type="hidden" id="latitude" readonly="true" name="latitude" value="" required>
			<input type="hidden" id="longitude" readonly="true" name="longitude" value="" required>

			<input type="checkbox" onclick="getUserLocation()" style="width: auto;float: left;margin-left: 0;" id="position_box" required>
			<label for="position_box"> Xác nhận vị trí của bạn</label>

			</div>
			<div class="filed">
												<label for="featured_gallery_url">Hình ảnh:</label>
												<input type="hidden" class="gallery-lst" id="featured_gallery_url" name="featured_gallery_url" value="">
                        <script type="text/template" id="qq-aff-photo-upload-template-validation">
                            <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
                                <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                                    <span class="qq-upload-drop-area-text-selector"></span>
                                </div>
                                <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
                                    <li>
                                        <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                                        <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                                        <img class="qq-thumbnail-selector" qq-max-size="300" qq-server-scale>
                                        <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">x</button>
                                    </li>
                                </ul>
                                <div class="qq-upload-button-selector qq-upload-button qq-upload-main">
                                    <div class="btn-upload-image">
                                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9242 1.57613C10.6898 1.34181 10.3099 1.34181 10.0756 1.57613L6.07564 5.57613C5.84132 5.81044 5.84132 6.19034 6.07564 6.42465C6.30995 6.65897 6.68985 6.65897 6.92416 6.42465L9.8999 3.44892V12.6669C9.8999 12.9983 10.1685 13.2669 10.4999 13.2669C10.8313 13.2669 11.0999 12.9983 11.0999 12.6669V3.44892L14.0756 6.42465C14.3099 6.65897 14.6898 6.65897 14.9242 6.42465C15.1585 6.19034 15.1585 5.81044 14.9242 5.57613L10.9242 1.57613ZM3.83317 13.3336C4.20136 13.3336 4.49984 13.632 4.49984 14.0002V16.0002C4.49984 16.7387 5.09404 17.3336 5.8283 17.3336H15.168C15.9038 17.3336 16.4998 16.7373 16.4998 16.0002V14.0002C16.4998 13.632 16.7983 13.3336 17.1665 13.3336C17.5347 13.3336 17.8332 13.632 17.8332 14.0002V16.0002C17.8332 17.4723 16.6415 18.6669 15.168 18.6669H5.8283C4.35343 18.6669 3.1665 17.4709 3.1665 16.0002V14.0002C3.1665 13.632 3.46498 13.3336 3.83317 13.3336Z" fill="#525C70"/>
                                        </svg>
                                        <label><?php echo __('Drag and drop or browse to choose a file'); ?></label>
                                    </div>
                                </div>

                                <dialog class="qq-alert-dialog-selector">
                                    <div class="qq-dialog-message-selector"></div>
                                    <div class="qq-dialog-buttons">
                                        <button type="button" class="qq-cancel-button-selector">Close</button>
                                    </div>
                                </dialog>

                                <dialog class="qq-confirm-dialog-selector">
                                    <div class="qq-dialog-message-selector"></div>
                                    <div class="qq-dialog-buttons">
                                        <button type="button" class="qq-cancel-button-selector">No</button>
                                        <button type="button" class="qq-ok-button-selector">Yes</button>
                                    </div>
                                </dialog>

                                <dialog class="qq-prompt-dialog-selector">
                                    <div class="qq-dialog-message-selector"></div>
                                    <input type="text">
                                    <div class="qq-dialog-buttons">
                                        <button type="button" class="qq-cancel-button-selector">Cancel</button>
                                        <button type="button" class="qq-ok-button-selector">Ok</button>
                                    </div>
                                </dialog>
                            </div>
                        </script>
                        <div id="aff-photo-upload-template"></div>

                        <script>
                        // Photo upload by fineuploader function
                          //var affPhotoUpload = function(imgs){
                              //if ( ! $('#aff-photo-upload-template').length > 0 ) return false;

                              var FineUploaderImages = new qq.FineUploader({
                                  element: document.getElementById("aff-photo-upload-template"),
                                  template: 'qq-aff-photo-upload-template-validation',
                                  request: { endpoint: '?action=aff_upload_images_act', },
                                  // session: { endpoint:'?action=aff_get_images_uploaded_act', params: {'imgs':imgs} },
                                  validation: { allowedExtensions: ['jpg', 'png', 'jpeg', 'gif'], itemLimit: 5, sizeLimit: 10000000 },
                                  deleteFile: { enabled: true, forceConfirm: true, endpoint: '?action=aff_delete_images_act&uuid=' },
                                  callbacks: {
                                    onComplete:function(id, name, responseJSON){
                                        let list_images = jQuery('input.gallery-lst').val();
                                        this.setDeleteFileParams({id: responseJSON.id}, id);
                                        if(list_images) jQuery('input.gallery-lst').val(list_images+','+responseJSON.id);
                                        else jQuery('input.gallery-lst').val(responseJSON.id);
                                    },
                                  },
                              });
                          //}
                        </script>
			</div>
			<input type="hidden" id="status_satlo" name="status_satlo" value="0">
			<input id="gis_submit_satlo" name="gis_submit_satlo" type="submit" value="Gởi">
		</form>

		</div>
      </div>
	  <?php

	 	global $wpdb;
		 $gis_result = $wpdb->get_results(
								 "SELECT * FROM {$wpdb->prefix}gis_map_info", 'ARRAY_A'
							 );
			$_geojson_object = array();
			$_geojson_object['type'] = 'FeatureCollection';
			$_geojson_object['name'] = 'FloodPoint';
			$crs_properties = array();
			$crs_properties['name'] = 'urn:ogc:def:crs:OGC:1.3:CRS84';
			$crs = array();
			$crs['type'] = 'name';
			$crs['properties'] = $crs_properties;
			$_geojson_object['crs'] = $crs;

			$features = array();
			$value_check = myprefix_get_theme_option( 'checkbox_khancap' );
			if($value_check == 'on'){
				foreach ($gis_result as $key => $marker) {
					//var_dump($marker['status_satlo']);
					if ( $marker['status_satlo'] == 1 ) {
						//var_dump($marker);
							$marker_data = array();
							$marker_data_sub = array();
							$marker_data['lat'] = $marker['latitude'];
							$marker_data['lon'] = $marker['longitude'];
							$marker_data_sub['tieu_de'] = $marker['tieu_de'];
							$marker_data_sub['dia_chi_satlo'] = $marker['dia_chi_satlo'];
							$marker_data_sub['mieu_ta_satlo'] = $marker['mieu_ta_satlo'];
							$marker_data_sub['ten_nguoi_bao'] = $marker['ten_nguoi_bao'];
							$marker_data_sub['sdt_nguoi_bao'] = $marker['sdt_nguoi_bao'];
							$marker_data_sub['featured_gallery_url'] = $marker['featured_gallery_url'];
							$marker_data['attr'] = $marker_data_sub;


							$feature = array();

								$feature['type'] = 'Feature';

								$properties = array();
								$properties['objName'] = 'FloodPoint';
								$properties['tieu_de'] = $marker['tieu_de'];
								$properties['dia_chi_satlo'] = $marker['dia_chi_satlo'];
								$properties['mieu_ta_satlo'] = $marker['mieu_ta_satlo'];
								$properties['ten_nguoi_bao'] = $marker['ten_nguoi_bao'];
								$properties['sdt_nguoi_bao'] = $marker['sdt_nguoi_bao'];
								$properties['featured_gallery_url'] = $marker['featured_gallery_url'];

								$feature['properties'] = $properties;

								$geometry  = array();
								$geometry['type'] = 'Point';
								$geometry['coordinates'] = [$marker['longitude'], $marker['latitude']];

								$feature['geometry'] = $geometry;

							$features[] = $feature;

							//echo '_geojson_object = ' . wp_json_encode( $marker_data );

							echo '<div class="wpol-infomarker" data-id="'. $marker['gm_id'] .'" data-marker=\'' . wp_json_encode( $marker_data ) . '\' ></div>';

							//echo wp_json_encode( $marker_data );
						}
				};
			}
			$_geojson_object['features'] = $features;
			//echo wp_json_encode( $_geojson_object );

	  ?>
		<script type="text/javascript">
  		_geojson_object = <?php echo wp_json_encode( $_geojson_object); ?>;
		</script>
		
		<div id="map" class="map hideOpacity">
		</div>


		<ul class="list-ct">
				<li>
					<a href="#!" onclick="map.getView().setCenter([108.4857,15.6272]);map.getView().setZoom(10);">
						<i class="fa fa-home" aria-hidden="true"></i>
					</a>
				</li>
				<li>
					<a href="#!" onclick="vector.getSource().clear();

					">
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
				</li>

				<li class="x-tool-close">
					<a href="#!">
						<input type="radio" name="measurement" value="none" id="351" style="opacity: 0;width: 0;margin: 0;border: none;display:none" checked>
						<label for="351" style="padding: 0;margin: 0 !important;">
							<i class="fa fa-hand-paper-o" aria-hidden="true"></i>
						</label>
					</a>
				</li>
				<li class="bp-up">
					<a href="#!">
						<input type="radio" name="measurement" value="Polygon" id="352" style="opacity: 0;width: 0;margin: 0;border: none;display:none">
						<label for="352" style="padding: 0;margin: 0 !important;">
							<i class="fa fa-object-ungroup" aria-hidden="true"></i>
						</label>
					</a>
				</li>
				<li class="bp-up">
					<a href="#!">
						<input type="radio" name="measurement" value="LineString" id="353" style="opacity: 0;width: 0;margin: 0;border: none;display:none">
						<label for="353" style="padding: 0;margin: 0 !important;">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</label>
					</a>
				</li>
				<li><samp id="js-result"></samp></li> 
			</ul>
			<div class="click-chuthich-bt"><i class="fas fa-cog"></i></div>
			<div class="chuthich-bt">
			<p>Chú thích</p>
			<table style="width:100%;padding:0 2px;">
				<tr>
					<td style="width:25px">
						<svg width="25px" height="10px">
							<rect width="100%" height="100%" style="fill:#b0e2ff;stroke-width:1;stroke:rgb(0,0,0)" />
					</svg>
				</td>
					<td>H < 0.5m</td>
				</tr>
				<tr>
					<td style="width:25px">
						<svg width="25px" height="10px">
							<rect width="100%" height="100%" style="fill:#6a80d5;stroke-width:1;stroke:rgb(0,0,0)" />
					</svg>
				</td>
					<td>0.5m < H < 1.0m</td>
				</tr>
				<tr>
					<td style="width:25px">
						<svg width="25px" height="10px">
							<rect width="100%" height="100%" style="fill:#3232b4;stroke-width:1;stroke:rgb(0,0,0)" />
					</svg>
				</td>
					<td>H > 1.0m</td>
				</tr>
			</table>
			</div>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/main.js"></script>
		</div>
		<script>

			jQuery(document).ready(function($) {
				$(function(){
			    $(".floor-btn").on( "click", "button", function( event ) {
			        event.preventDefault();
			        console.log( $( this ).text() );
			    });
				}());

				 $('.bt-ngaplut').click(function() {
				  $('#overlay').fadeIn(300);
				});
				$('#close').click(function() {
				  $('#overlay').fadeOut(300);
				});
				$('.export-pdf').click(function() {
				  $('#overlay_pdf').fadeIn(300);
				});
				$('#close_pdf').click(function() {
				  $('#overlay_pdf').fadeOut(300);
				});
				$(".floor-select > button").click(function(){
					console.log('button found!');
					$(".floor-btn.active").not(this).toggleClass("active");
					$(this).toggleClass("active");
				});


				$("#btnSolve").click(function() {

				});
				$("#btnReset").click(function() {
					startPoint.setGeometry(null);
					destPoint.setGeometry(null);
					// Remove the result layer.
					map.removeLayer(vectorLayer_Route_Point);
					map.removeLayer(result);
					el('txtPoint1').value = '';
					el('txtPoint2').value = '';
				});



			});

			function openCity(evt, cityName) {
				var i, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				document.getElementById(cityName).style.display = "block";
				evt.currentTarget.className += " active";
			}

		</script>
	</section>
</div>
<script>


</script> <?php
get_footer();
