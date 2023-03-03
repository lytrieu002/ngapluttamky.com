<section id="sidebar" class="">
		<div class="sidebar-user-logo">
			<?php if ( has_custom_logo()) : ?>
			<div class="site-logo" style="border: none;"><?php the_custom_logo(); ?></div>
			<?php endif; ?>
		</div>
		<!--<ul id="tabs">
			<li><a id="tab1">TRUY VẤN</a></li>
			 <li><a id="tab2">TÌM KIẾM</a></li>
		</ul>-->
		<div class="nav nav-sidebar container" id="tab1C" data-nav-type="accordion">
			<li class="nav-item-header">
				<div class="text-uppercase font-size-xs line-height-xs">Bản đồ</div>
				<i class="icon-menu" title="Main"></i>
			</li>

			<li class="nav-item nav-item-submenu  active-ca">
				<a href="#" class="nav-link legitRipple"><i class="fas fa-list-alt"></i> <span> CÁC LỚP DỮ LIỆU </span></a>
				<ul class="nav nav-group-sub" data-submenu-title="Các lớp dữ liệu">
					<li class="nav-item">
						<label class="switch">
							<input type="checkbox" id="chkRanhGioiXa" checked="checked" onclick="setLayerVisible(this.id);" />
							<span class="slider round"></span>
						</label>
						<span class="triger-pi">Ranh giới xã</span>
					</li>
					<li class="nav-item">
						<label class="switch">
							<input type="checkbox" id="chkRanhGioiHuyen" checked="checked" onclick="setLayerVisible(this.id);" />
							<span class="slider round"></span>
						</label>
						<span class="triger-pi">Ranh giới huyện</span>
					</li>
					<li class="nav-item">
						<label class="switch">
							<input type="checkbox"  id="chkBanDoNgap" checked="checked"  onclick="setLayerVisible(this.id);"/>
							<span class="slider round"></span>
						</label>
						<span class="triger-pi">Ngập lụt</span>
					</li>
					<li class="nav-item">
						<label class="switch">
							<input type="checkbox" id="chkSongSuoi" checked="checked" onclick="setLayerVisible(this.id);" />
							<span class="slider round"></span>
						</label>
						<span class="triger-pi">Sông suối</span>
					</li>
					<li class="nav-item">
						<label class="switch">
							<input type="checkbox" id="chkDuongBo" checked="checked" onclick="setLayerVisible(this.id);" />
							<span class="slider round"></span>
						</label>
						<span class="triger-pi">Đường bộ (updating)</span>
					</li>

				</ul>
			</li>
			<li class="nav-item nav-item-submenu">
				<a href="#" class="nav-link legitRipple"><i class="far fa-list-alt"></i> <span>Bản đồ nền</span></a>
				<ul class="nav nav-group-sub" data-submenu-title="Bản đồ nền">

					<li class="nav-item">
						<label class="switch">
							<input type="checkbox" id="GoogleSattelite"  checked="checked" onclick="setBasemap('GoogleSattelite');"/>
							<span class="slider round"></span>
						</label>
						<span class="triger-pi">Google Sattelite</span>
						</li>
					<li class="nav-item">
						<label class="switch">
							<input type="checkbox" id="OpenStreetMap"  onclick="setBasemap('OpenStreetMap');"/>
							<span class="slider round"></span>
						</label>
						<span class="triger-pi">OpenStreet Map</span>
					</li>
					<li class="nav-item">
						<label class="switch">
							<input type="checkbox" id="noBaseMap"  onclick="setBasemap('noBaseMap');"/>
							<span class="slider round"></span>
						</label>
						<span class="triger-pi">No Basemap</span>
					</li>

				</ul>
			</li>
			<li class="nav-item-header">
				<div class="text-uppercase font-size-xs line-height-xs">Kịch bản ngập</div>
				<i class="icon-menu" title="Main"></i>
			</li>
				<div id="nodelist"><em>Vui lòng chọn kịch bản</em></div>
				<form action="#">
					
					<select id="floodScenario">
						<option value="0"> Kịch bản 1 </option>
						<option value="1"> Kịch bản 2 </option>
						<option value="2"> Kịch bản 3 </option>
						<option value="3"> Kịch bản 4 </option>
						<option value="4"> Kịch bản 5 </option>
						<option value="5"> Kịch bản 6 </option>
						<option value="6"> Kịch bản 7</option>
						<option value="7"> Kịch bản 8 </option>
						<option value="8"> Kịch bản 9 </option>
						<option value="9"> Kịch bản  10</option>
						<option value="10"> Kịch bản 11 </option>
						<option value="11"> Kịch bản 12 </option>
						<option value="12"> Kịch bản 13 </option>
						<option value="13"> Kịch bản 14 </option>
						<option value="14"> Kịch bản 15 </option>
					</select>
				</form>
			<li class="nav-item-header" style="display:none">
				<div class="text-uppercase font-size-xs line-height-xs">Theo mức ngập</div>
				<i class="icon-menu" title="Main"></i>
			</li>
			<div id="nodelist" style="display:none"><em>Vui lòng chọn mức ngập</em></div>
				<form action="#" style="display:none">
					<select id="floodLevel">
						<option value="0"> Toàn bộ </option>
						<option value="1"> < 0.5m </option>
						<option value="2"> 0.5-1m </option>
						<option value="3"> 1.0-1.5m </option>
						<option value="4"> 1.5-2.0m </option>
						<option value="5"> 2.0-3.0m </option>
						<option value="6"> 3.0-4.0m </option>
						<option value="7"> 4.0-5.0m </option>
						<option value="8"> 5.0-6.0m </option>
						<option value="9"> 6.0-7.0m </option>
						<option value="10"> > 7.0m </option>
					</select>
				</form>
			<li class="nav-item-header">
				<div class="text-uppercase font-size-xs line-height-xs">Chú thích</div>

				<i class="icon-menu" title="Main">

				</i>
			</li>
			<p style="padding:0 10px;">Chiều sâu ngập lớn nhất</p>
			<table style="width:100%;padding:0 10px;">
				<tr>
					<td style="width:70px">
						<svg width="70px" height="20px">
							<rect width="100%" height="100%" style="fill:#b0e2ff;stroke-width:1;stroke:rgb(0,0,0)" />
					</svg>
				</td>
					<td>H < 0.5m</td>
				</tr>
				<tr>
					<td style="width:70px">
						<svg width="70px" height="20px">
							<rect width="100%" height="100%" style="fill:#6a80d5;stroke-width:1;stroke:rgb(0,0,0)" />
					</svg>
				</td>
					<td>0.5m < H < 1.0m</td>
				</tr>
				<tr>
					<td style="width:70px">
						<svg width="70px" height="20px">
							<rect width="100%" height="100%" style="fill:#3232b4;stroke-width:1;stroke:rgb(0,0,0)" />
					</svg>
				</td>
					<td>H > 1.0m</td>
				</tr>
			</table>
		</div>
		<!-- <div class="container" id="tab2C">Vui lòng nhập thông tin cần tìm
			<input id="search_text" type="text" value=" ">
			<div class="actions">
				<button type="button" class="button">Xóa</button>
				<button type="button" class="button">Tìm kiếm</button>
			</div>
		</div> -->
	</section>