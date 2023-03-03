<?php
/*
Template Name: Thống kê
*/
?> <?php get_header(); ?>
<div class="content-thongke">
    <h1 style="text-align: center;padding: 10px 10px;">Bảng Thống Kê Dữ Liệu Ngập</h1>
		<div id="flood_data" style="min-height: 300px !important;">
			<form action="POST">
        <div class="field-tk">
				<label for="selectedScenario">Chọn kịch bản:</label>
				  <select name="selectedScenario" id="selectedScenario">
						<option value="KB1">Kịch bản 1</option>
				    <option value="KB2">Kịch bản 2</option>
				    <option value="KB3">Kịch bản 3</option>
				  </select>
        </div>
        <div class="field-tk">
					<label for="selectedName2">Chọn huyện:</label>
						<select name="selectedName2" id="selectedName2">
						<option value="">Chọn huyện</option>
						</select>
          </div>
        <div class="field-tk">
  					<label for="selectedxa">Chọn xã:</label>
  						<select name="selectedxa" id="selectedxa">
								<option value="">Chọn xã</option>
  						</select>
          </div>
			  <input type='submit' id="truyvantk" value='Truy Vấn' />
			  <script type="text/javascript">
				(function($){
					$(document).ready(function(){
						$('#truyvantk').click(function(){
							var bt_kb = $('#selectedScenario').find(":selected").val();
							var bt_huyen = $('#selectedName2').find(":selected").val();
							var bt_xa = $('#selectedxa').find(":selected").val();
							console.log(bt_kb);
							$.ajax({
								type : "post", //Phương thức truyền post hoặc get
								dataType : "json", //Dạng dữ liệu trả về xml, json, script, or html
								url : '<?php echo admin_url('admin-ajax.php');?>', //Đường dẫn chứa hàm xử lý dữ liệu. Mặc định của WP như vậy
								data : {
									action: "thongke", //Tên action
									bt_kb : bt_kb,
                  bt_huyen : bt_huyen,
									bt_xa : bt_xa
								},
								context: this,
								beforeSend: function(){
									//Làm gì đó trước khi gửi dữ liệu vào xử lý
								},
								success: function(response) {
									//Làm gì đó khi dữ liệu đã được xử lý
									if(response.success) {
										$('.thongke_result').html(response.data);
									}
									else {
										alert('Đã có lỗi xảy ra');
									}
								},
								error: function( jqXHR, textStatus, errorThrown ){
									//Làm gì đó khi có lỗi xảy ra
									console.log( 'The following error occured: ' + textStatus, errorThrown );
								}
							})
							return false;
						})
					})
				})(jQuery)
			</script>
			</form>
			<div class="thongke_result">
			<?php
				//$selectedScenario = $_POST['selectedScenario'];
				$flood_result = $wpdb->get_results("SELECT scenario, objName, objName2, objCode, SUM(objArea) as objArea2 FROM wp_flood_data GROUP BY objName, objCode", 'ARRAY_A');

			  echo "<table style=\"border-collapse: collapse;margin-left: auto; margin-right: auto;font-size: 0.9em;font-family: sans-serif;min-width: 480px;max-width: 1000px;box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);width: 100%;\">
				<thead>
					<tr style=\"text-align: center;background-color: #009879;color: #ffffff;\">
						<th style=\"width: 100px;padding: 12px 15px;\">Kịch bản</th>
            <th style=\"width: 300px;padding: 12px 15px;\">Huyện</th>
						<th style=\"width: 250px;padding: 12px 15px;\">Xã</th>
						<th style=\"width: 250px;padding: 12px 15px;\">Mức ngập</th>
						<th style=\"width: 150px;padding: 12px 15px;\">Diện tích ngập (km2)</th>
					</tr>
				</thead>";
				echo "<tbody>";

				$x = 0;
				foreach ($flood_result as $key => $marker) {
					if ($x % 2 == 0){
						echo "<tr  style=\"padding: 12px 15px;border-bottom: 1px solid #dddddd;background-color: #f3f3f3;\">";
					}
					else{
						echo "<tr  style=\"padding: 12px 15px;border-bottom: 1px solid #dddddd;border-bottom: 2px solid #009879;\">";
					}
					$x = $x + 1;

					echo "<td>" . $marker['scenario'] . "</td>";
          echo "<td>" . $marker['objName2'] . "</td>";
					echo "<td>" . $marker['objName'] . "</td>";
          switch ($marker['objCode']){
            case "1":
              echo "<td>H < 0.5m</td>";
              break;
            case "2":
              echo "<td>0.5m < H < 1.0m</td>";
              break;
            default:
              echo "<td>H > 1.0m</td>";
          }

					echo "<td>" . round($marker['objArea2']/1000000,3) . "</td>";
					echo "</tr>";
				};
				echo "</tbody>";
	  		echo "</table>";
		  ?>
		  </div>
		</div>
		<div class="aloha11">
		<?php 
				$selectedduyxuyen = 'Duy Xuyên';
				$duyxuyen = $wpdb->get_results("SELECT DISTINCT objName FROM wp_flood_data WHERE objName2='" . $selectedduyxuyen . "'", 'ARRAY_A');
				$xadxp ='';
				foreach ($duyxuyen as  $xa_duyxuyen) {
					$xadx = trim($xa_duyxuyen['objName'].'|');
					$xadxp .= $xadx;
				};
				echo '<input type="hidden" id="xadx"  data-xant=" '.  $xadxp .' " >';

				$selectednuithanh = 'Núi Thành';
				$nuithanh = $wpdb->get_results("SELECT DISTINCT objName FROM wp_flood_data WHERE objName2='" . $selectednuithanh . "'", 'ARRAY_A');
				$xantp ='';
				foreach ($nuithanh as  $xa_nuithanh) {
					$xant = trim($xa_nuithanh['objName'].'|');
					$xantp .= $xant;
				};
				echo '<input type="hidden" id="xant"  data-xant=" '.  $xantp .' " >';

				$selectedtamky = 'Tam Kỳ';
				$tamky = $wpdb->get_results("SELECT DISTINCT objName FROM wp_flood_data WHERE objName2='" . $selectedtamky . "'", 'ARRAY_A');
				$xatkp ='';
				foreach ($tamky as  $xa_tamky) {
					$xatk = trim($xa_tamky['objName'].'|');
					$xatkp .= $xatk;
				};
				echo '<input type="hidden" id="xatk"  data-xant=" '.  $xatkp .' " >';

				$selectedthangbinh = 'Thăng Bình';
				$thangbinh = $wpdb->get_results("SELECT DISTINCT objName FROM wp_flood_data WHERE objName2='" . $selectedthangbinh . "'", 'ARRAY_A');
				$xatbp ='';
				foreach ($thangbinh as  $xa_thangbinh) {
					$xatb = trim($xa_thangbinh['objName'].'|');
					$xatbp .= $xatb;
				};
				echo '<input type="hidden" id="xatb"  data-xant=" '.  $xatbp .' " >';

				$selectedphuninh = 'Phú Ninh';
				$phuninh = $wpdb->get_results("SELECT DISTINCT objName FROM wp_flood_data WHERE objName2='" . $selectedphuninh . "'", 'ARRAY_A');
				$xapnp ='';
				foreach ($phuninh as  $xa_phuninh) {
					$xapn = trim($xa_phuninh['objName'].'|');
					$xapnp .= $xapn;
				};
				echo '<input type="hidden" id="xapn"  data-xant=" '.  $xapnp .' " >';
		?>
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
				var country_arr = new Array("Duy Xuyên", "Núi Thành", "Tam Kỳ", "Thăng Bình", "Phú Ninh");

				// States
				var s_a = new Array();
				s_a[0] = "";
				s_a[1] = $('#xadx').data('xant');
				s_a[2] = $('#xant').data('xant');
				s_a[3] = $('#xatk').data('xant');
				s_a[4] = $('#xatb').data('xant');
				s_a[5] = $('#xapn').data('xant');

				console.log(s_a[1]);
				console.log(s_a[2]);
				console.log(s_a[3]);
				console.log(s_a[4]);
				console.log(s_a[5]);

				function populateStates(countryElementId, stateElementId) {

					var selectedCountryIndex = document.getElementById(countryElementId).selectedIndex;

					var stateElement = document.getElementById(stateElementId);

					stateElement.length = 0; // Fixed by Julian Woods
					stateElement.options[0] = new Option('Chọn Xã', '');
					stateElement.selectedIndex = 0;

					var state_arr = s_a[selectedCountryIndex].split("|");

					for (var i = 0; i < state_arr.length - 1; i++) {
						stateElement.options[stateElement.length] = new Option($.trim(state_arr[i]), $.trim(state_arr[i]));
					}
				}

				function populateCountries(countryElementId, stateElementId) {
					// given the id of the <select> tag as function argument, it inserts <option> tags
					var countryElement = document.getElementById(countryElementId);
					countryElement.length = 0;
					countryElement.options[0] = new Option('Chọn Huyện', '');
					countryElement.selectedIndex = 0;
					for (var i = 0; i < country_arr.length - 1; i++) {
						countryElement.options[countryElement.length] = new Option(country_arr[i], country_arr[i]);
					}

					// Assigned all countries. Now assign event listener for the states.

					if (stateElementId) {
						countryElement.onchange = function() {
							populateStates(countryElementId, stateElementId);
						};
					}
				}

				$(document).ready(function() {
					populateCountries("selectedName2", "selectedxa");
				});
			});

		</script>
</div>
<script>


</script> <?php
get_footer();
