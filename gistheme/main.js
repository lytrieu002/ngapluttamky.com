const siteUrl = "https://ngapluttamky.com";
///////////////////////////////////////////////////////////
var proj = new ol.proj.Projection({
   code: "EPSG:4326",
   units: "degrees",
   axisOrientation: "neu",
   global: false,
});
const _zoomSlider = 19.166728754001685;
const centerCoord = [108.48369125, 15.5658837];
const extent_full = [107.2264597722699193, 14.9613592273449072, 108.737131094039313, 16.0484610413256412];
//map.getView().fit(new ol.extent.buffer(extent_phong, 0.0005) , { duration:800 });
var view = new ol.View({
   projection: proj,
   extent: new ol.extent.buffer(extent_full, 0.5),
   //center: centerCoord,
   //zoom: 14.28,
});
function el(id) {
   return document.getElementById(id);
}
//Layer for measurement
var vectorLayer = new ol.layer.Vector({
   displayInLayerSwitcher: false,
   source: new ol.source.Vector(),
});

//-------- Base map --------
var osmBaseMap = new ol.layer.Tile({
   title: "OpenStreet Map",
   baseLayer: true,
   visible: false,
   source: new ol.source.OSM(),
});
var googleBaseMap = new ol.layer.Tile({
   title: "Google Sattelite",
   baseLayer: true,
   visible: true,
   opacity: 1.0,
   source: new ol.source.XYZ({
      url: "https://mt0.google.com/vt/lyrs=y&hl=en&x={x}&y={y}&z={z}&s=Ga",
      crossOrigin: "anonymous",
   }),
});
var baseLayers = new ol.layer.Group({
   title: "Bản đồ nền",
   openInLayerSwitcher: true,
   layers: [osmBaseMap, googleBaseMap],
});

//Overlay Group
function styleFunctionMucNgap(feature) {
   //Style of layers base on conditions
   let color = "";
   let mucNgap = "";
   let objCode = Number(feature.get("objCode"));

   switch (objCode) {
      case 1:
         color = "#b0e2ff";
         mucNgap = "< 0,5m";
         break;
      case 2:
         color = "#6a80d5";
         mucNgap = "0.5m - 1.0m";
         break;
      default: //>3
         color = "#3232b4";
         mucNgap = "> 1.0m";
   }
   return [
      new ol.style.Style({
         stroke: new ol.style.Stroke({
            color: color,
            width: 0,
         }),
         fill: new ol.style.Fill({
            color: color,
         }),
      }),
   ];
}
function styleFunctionMucNgap2(feature) {
   //Style of layers base on conditions
   let color = "";
   let mucNgap = "";
   let objCode = Number(feature.get("objCode"));
   console.log("objCode: " + objCode);
   console.log("selected_flLevel: " + selected_flLevel);
   if (objCode == 0 || objCode == selected_flLevel) {
      switch (objCode) {
         case 1:
            color = "#d6d6ff";
            mucNgap = "<0,5m";
            break;
         case 2:
            color = "#bec5f4";
            mucNgap = "0.5m - 1.0m";
            break;
         case 3:
            color = "#a7b3e8";
            mucNgap = "1.0m - 1.5m";
            break;
         case 4:
            color = "#8fa2dc";
            mucNgap = "1.5m - 2.0m";
            break;
         case 5:
            color = "#7790d0";
            mucNgap = "2.0m - 3.0m";
            break;
         case 6:
            color = "#5f7fc4";
            mucNgap = "3.0m - 4.0m";
            break;
         case 7:
            color = "#476db8";
            mucNgap = "4.0m - 5.0m";
            break;
         case 8:
            color = "#2f5cac";
            mucNgap = "5.0m - 6.0m";
            break;
         case 9:
            color = "#174aa0";
            mucNgap = "6.0m - 7.0m";
            break;
         default: //>10
            color = "#003994";
            mucNgap = ">7.0m";
      }
      return [
         new ol.style.Style({
            stroke: new ol.style.Stroke({
               color: color,
               width: 0,
            }),
            fill: new ol.style.Fill({
               color: color,
            }),
         }),
      ];
   }
}

const fill = new ol.style.Fill({
   color: "rgba(255,255,255,0.4)",
});
const stroke = new ol.style.Stroke({
   color: "#3399CC",
   width: 1.25,
});
function styleFunction_DiemNgap(feature) {
   //Style of layers base on conditions
   return [
      new ol.style.Style({
         image: new ol.style.Icon({
            src: "/wp-content/uploads/dangerous-mark.png",
         }),
         fill: fill,
         stroke: new ol.style.Stroke({
            color: "#3399CC",
            width: 2.25,
         }),
      }),
   ];
}
function styleFunction_DiemNgap_Selected(feature) {
   //Style of layers base on conditions
   return [
      new ol.style.Style({
         image: new ol.style.Icon({
            src: "/wp-content/uploads/dangerous-mark-selected.png",
         }),
         fill: fill,
         stroke: new ol.style.Stroke({
            color: "#3399CC",
            width: 2.25,
         }),
      }),
   ];
}

var layer_mucNgap_KB1 = new ol.layer.VectorImage({
   title: "Kịch bản 1",
   visible: true,
   displayInLayerSwitcher: true,
   style: styleFunctionMucNgap,
   //declutter: true,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/mucNgapKB01.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_mucNgap_KB2 = new ol.layer.VectorImage({
   title: "Kịch bản 2",
   visible: false,
   displayInLayerSwitcher: true,
   style: styleFunctionMucNgap,
   //declutter: true,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/mucNgapKB02.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_mucNgap_KB3 = new ol.layer.VectorImage({
   title: "Kịch bản 3",
   visible: false,
   displayInLayerSwitcher: true,
   style: styleFunctionMucNgap,
   //declutter: true,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/mucNgapKB03.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_mucNgap_KB4 = new ol.layer.VectorImage({
   title: "Kịch bản 4",
   visible: false,
   displayInLayerSwitcher: true,
   style: styleFunctionMucNgap,
   //declutter: true,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/mucNgapKB04.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_mucNgap_KB5 = new ol.layer.VectorImage({
   title: "Kịch bản 5",
   visible: false,
   displayInLayerSwitcher: true,
   style: styleFunctionMucNgap,
   //declutter: true,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/mucNgapKB05.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_mucNgap_KB6 = new ol.layer.VectorImage({
   title: "Kịch bản 6",
   visible: false,
   displayInLayerSwitcher: true,
   style: styleFunctionMucNgap,
   //declutter: true,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/mucNgapKB06.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_mucNgap_KB7 = new ol.layer.VectorImage({
   title: "Kịch bản 7",
   visible: false,
   displayInLayerSwitcher: true,
   style: styleFunctionMucNgap,
   //declutter: true,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/mucNgapKB07.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_mucNgap_KB8 = new ol.layer.VectorImage({
   title: "Kịch bản 8",
   visible: false,
   displayInLayerSwitcher: true,
   style: styleFunctionMucNgap,
   //declutter: true,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/mucNgapKB08.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_mucNgap_KB9 = new ol.layer.VectorImage({
   title: "Kịch bản 9",
   visible: false,
   displayInLayerSwitcher: true,
   style: styleFunctionMucNgap,
   //declutter: true,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/mucNgapKB09.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_mucNgap_KB10 = new ol.layer.VectorImage({
   title: "Kịch bản 10",
   visible: false,
   displayInLayerSwitcher: true,
   style: styleFunctionMucNgap,
   //declutter: true,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/mucNgapKB10.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_mucNgap_KB11 = new ol.layer.VectorImage({
   title: "Kịch bản 11",
   visible: false,
   displayInLayerSwitcher: true,
   style: styleFunctionMucNgap,
   //declutter: true,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/mucNgapKB11.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_mucNgap_KB12 = new ol.layer.VectorImage({
   title: "Kịch bản 12",
   visible: false,
   displayInLayerSwitcher: true,
   style: styleFunctionMucNgap,
   //declutter: true,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/mucNgapKB12.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_mucNgap_KB13 = new ol.layer.VectorImage({
   title: "Kịch bản 13",
   visible: false,
   displayInLayerSwitcher: true,
   style: styleFunctionMucNgap,
   //declutter: true,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/mucNgapKB13.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_mucNgap_KB14 = new ol.layer.VectorImage({
   title: "Kịch bản 14",
   visible: false,
   displayInLayerSwitcher: true,
   style: styleFunctionMucNgap,
   //declutter: true,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/mucNgapKB14.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_mucNgap_KB15 = new ol.layer.VectorImage({
   title: "Kịch bản 15",
   visible: false,
   displayInLayerSwitcher: true,
   style: styleFunctionMucNgap,
   //declutter: true,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/mucNgapKB15.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});

function styleFunctionRanhGioiHuyen(feature) {
   //Style of layers base on conditions
   return [
      new ol.style.Style({
         text: new ol.style.Text({
            font: "22px Tahoma",
            text: feature.get("objName2"),
            placement: "point",
            fill: new ol.style.Fill({
               color: "#000",
            }),
            stroke: new ol.style.Stroke({
               color: "#fff",
               width: 2,
            }),
         }),
         stroke: new ol.style.Stroke({
            color: "#ff2323",
            width: 3,
         }),
      }),
   ];
}
function styleFunctionRanhGioiXa(feature) {
   //Style of layers base on conditions
   return [
      new ol.style.Style({
         text: new ol.style.Text({
            font: "14px Tahoma",
            text: feature.get("objName"),
            placement: "line",
            fill: new ol.style.Fill({
               color: "#000",
            }),
            stroke: new ol.style.Stroke({
               color: "#fff",
               width: 1,
            }),
         }),
         stroke: new ol.style.Stroke({
            color: "#ff2323",
            width: 1,
         }),
      }),
   ];
}
var layer_ranhGioiHuyen = new ol.layer.Vector({
   title: "Ranh giới huyện",
   visible: true,
   displayInLayerSwitcher: true,
   style: styleFunctionRanhGioiHuyen,
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/ranhGioiHuyen.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_ranhGioiXa = new ol.layer.Vector({
   title: "Ranh giới xã",
   visible: true,
   displayInLayerSwitcher: true,
   style: styleFunctionRanhGioiXa,
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/ranhGioiXa.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_SongSuoiA = new ol.layer.Vector({
   title: "Sông suối A",
   visible: true,
   displayInLayerSwitcher: true,
   style: new ol.style.Style({
      stroke: new ol.style.Stroke({
         color: "#3232b4",
         width: 0,
      }),
      fill: new ol.style.Fill({
         color: "#3232b4",
      }),
   }),
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/SongSuoiA.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_SongSuoiL = new ol.layer.Vector({
   title: "Sông suối L",
   visible: true,
   displayInLayerSwitcher: true,
   //style: styleFunction_toaNha,
   //features: [results],
   source: new ol.source.Vector({
      url: siteUrl + "/wp-content/uploads/mapdata/SongSuoiL.geojson",
      projection: "EPSG:4326",
      format: new ol.format.GeoJSON(),
   }),
});
var layer_SongSuoi = new ol.layer.Image({
   title: "Sông suối",
   visible: true,
   displayInLayerSwitcher: true,
   source: new ol.source.ImageWMS({
      ratio: 1,
      url: siteUrl + "/geoserver/WebGIS_TamKy/wms",
      params: {
         FORMAT: "image/png",
         VERSION: "1.1.1",
         STYLES: "WebGIS_TamKy:style_SongSuoi",
         LAYERS: "WebGIS_TamKy:layer_SongSuoi",
         exceptions: "application/vnd.ogc.se_inimage",
      },
   }),
});
var layer_matDuongBo = new ol.layer.Image({
   title: "Đường bộ",
   visible: true,
   displayInLayerSwitcher: true,
   source: new ol.source.ImageWMS({
      ratio: 1,
      url: "https://ngapluttamky.com/geoserver/WebGIS_TamKy/wms",
      params: {
         FORMAT: "image/vnd.jpeg-png",
         VERSION: "1.1.1",
         STYLES: "WebGIS_TamKy:Style_DoanTimDuongBo",
         LAYERS: "WebGIS_TamKy:Doan_tim_duong_Bo_Chinh2",
         exceptions: "application/vnd.ogc.se_inimage",
      },
   }),
});
var layer_duongNoiDo = new ol.layer.Image({
   title: "Đường nội đô",
   visible: true,
   displayInLayerSwitcher: true,
   source: new ol.source.ImageWMS({
      ratio: 1,
      url: "https://ngapluttamky.com/geoserver/WebGIS_TamKy/wms",
      params: {
         FORMAT: "image/vnd.jpeg-png",
         VERSION: "1.1.1",
         STYLES: "WebGIS_TamKy:Style_DoanTimDuongBo",
         LAYERS: "WebGIS_TamKy:du_lieu_duong_noi_do",
         exceptions: "application/vnd.ogc.se_inimage",
      },
   }),
});

var layerGroup_songSuoi = new ol.layer.Group({
   title: "Sông suối",
   openInLayerSwitcher: true,
   //layers: [ untiled_KhuChucNang, untiled_network]
   //layers: [layer_khuChucNang_tienIch, layer_khuChucNang_tienIch_unSl, layer_giaoThong, layer_khuChucNang_toaNha]
   layers: [
      //layer_SongSuoiL,
      //layer_SongSuoiA,
      //layer_SongSuoi,
   ],
});

var layerGroup_mucNgap = new ol.layer.Group({
   title: "Mức ngập",
   openInLayerSwitcher: true,
   opacity: 0.75,
   //layers: [ untiled_KhuChucNang, untiled_network]
   //layers: [layer_khuChucNang_tienIch, layer_khuChucNang_tienIch_unSl, layer_giaoThong, layer_khuChucNang_toaNha]
   layers: [
      layer_mucNgap_KB1,
      layer_mucNgap_KB2,
      layer_mucNgap_KB3,
      layer_mucNgap_KB4,
      layer_mucNgap_KB5,
      layer_mucNgap_KB6,
      layer_mucNgap_KB7,
      layer_mucNgap_KB8,
      layer_mucNgap_KB9,
      layer_mucNgap_KB10,
      layer_mucNgap_KB11,
      layer_mucNgap_KB12,
      layer_mucNgap_KB13,
      layer_mucNgap_KB14,
      layer_mucNgap_KB15,

      //banDoNgap,
   ],
});

var layerGroup_hanhChinh = new ol.layer.Group({
   title: "Dữ liệu hành chính",
   openInLayerSwitcher: true,
   //layers: [ untiled_KhuChucNang, untiled_network]
   //layers: [layer_khuChucNang_tienIch, layer_khuChucNang_tienIch_unSl, layer_giaoThong, layer_khuChucNang_toaNha]
   layers: [
      layer_duongNoiDo,
      layer_ranhGioiXa,
      layer_ranhGioiHuyen,
      //banDoNgap,
   ],
});
///////////////////////////////////////////////////////////
//Basemap switcher
var layerSwitcher = new ol.control.LayerSwitcher({
   tipLabel: "Bật tắt lớp bản đồ",

   show_progress: false,
   reordering: false,
   extent: true,
});

var _geojson_object;
var vector_DiemNgap = new ol.source.Vector({
   features: new ol.format.GeoJSON().readFeatures(_geojson_object, {
      featureProjection: "EPSG:4326",
   }),
});
var layer_DiemNgap = new ol.layer.Vector({
   title: "Điểm ngập",
   visible: true,
   displayInLayerSwitcher: false,
   source: vector_DiemNgap,
   style: styleFunction_DiemNgap,
});

//Main map
var map = new ol.Map({
   target: "map",
   interactions: ol.interaction.defaults({
      altShiftDragRotate: false,
      pinchRotate: false,
   }),
   layers: [
      baseLayers,
      //layer_matDuongBo,
      //layer_duongNoiDo,
      layerGroup_mucNgap,
      //layer_SongSuoi,
      //layerGroup_songSuoi,
      //layer_SongSuoi,
      layerGroup_hanhChinh,
      layer_DiemNgap,
      //layer_CSDL_GIS,
   ],
   controls: ol.control.defaults().extend([new ol.control.ZoomSlider(), layerSwitcher]),
   view: view,
});
function styleFunction_selected(feature) {
   //Style of layers base on conditions
   return [
      new ol.style.Style({
         fill: new ol.style.Fill({
            color: "#0066ff",
         }),
         stroke: new ol.style.Stroke({
            color: "#ff0000",
            width: 3,
         }),
      }),
   ];
}

var dims = {
   a0: [1189, 841],
   a1: [841, 594],
   a2: [594, 420],
   a3: [420, 297],
   a4: [297, 210],
   a5: [210, 148],
};

setTimeout(function () {
   layer_mucNgap_KB2.setVisible(false);
   layer_mucNgap_KB3.setVisible(false);
   layer_mucNgap_KB4.setVisible(false);
   layer_mucNgap_KB5.setVisible(false);
   layer_mucNgap_KB6.setVisible(false);
   layer_mucNgap_KB7.setVisible(false);
   layer_mucNgap_KB8.setVisible(false);
   layer_mucNgap_KB9.setVisible(false);
   layer_mucNgap_KB10.setVisible(false);
   layer_mucNgap_KB11.setVisible(false);
   layer_mucNgap_KB12.setVisible(false);
   layer_mucNgap_KB13.setVisible(false);
   layer_mucNgap_KB14.setVisible(false);
   layer_mucNgap_KB15.setVisible(false);
}, 5e3);

var exportButton = document.getElementById("export-pdf");
var xxxxxx;
exportButton.addEventListener(
   "click",
   function () {
      exportButton.disabled = true;
      document.body.style.cursor = "progress";

      var format = document.getElementById("format").value;
      var resolution = document.getElementById("resolution").value;
      var dim = dims[format];
      var width = Math.round((dim[0] * resolution) / 25.4);
      var height = Math.round((dim[1] * resolution) / 25.4);
      var size = map.getSize();
      var viewResolution = map.getView().getResolution();
      map.once("rendercomplete", function () {
         var mapCanvas = document.createElement("canvas");
         mapCanvas.width = width;
         mapCanvas.height = height;
         //mapCanvas.useCORS = true;
         //mapCanvas.allowTaint = false;
         var mapContext = mapCanvas.getContext("2d");
         Array.prototype.forEach.call(document.querySelectorAll(".ol-layer canvas"), function (canvas) {
            if (canvas.width > 0) {
               var opacity = canvas.parentNode.style.opacity;
               mapContext.globalAlpha = opacity === "" ? 1 : Number(opacity);
               var transform = canvas.style.transform;
               // Get the transform parameters from the style's transform matrix
               var matrix = transform
                  .match(/^matrix\(([^\(]*)\)$/)[1]
                  .split(",")
                  .map(Number);
               // Apply the transform to the export map context
               CanvasRenderingContext2D.prototype.setTransform.apply(mapContext, matrix);
               mapContext.drawImage(canvas, 0, 0);
            }
         });
         mapContext.globalAlpha = 1;
         mapContext.setTransform(1, 0, 0, 1, 0, 0);
         var data = [
            {
               co_quan: "Truong BK Da Nang",
               nguoi_lap: "Anh Phi",
               ngay_lap: "01/12/2022",
            },
         ];
         var headers = [
            {
               id: "co_quan",
               name: "co_quan",
               prompt: "Co Quan",
               width: 100,
               align: "center",
            },
            {
               id: "nguoi_lap",
               name: "nguoi_lap",
               prompt: "Nguoi Lap",
               width: 100,
               align: "center",
            },
            {
               id: "ngay_lap",
               name: "ngay_lap",
               prompt: "Ngay Lap",
               width: 100,
               align: "center",
            },
         ];
         var imgtitle =
            "data:image/png;base64,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";
         var imgCompass =
            "data:image/png;base64,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";
         var chuthich =
            "data:image/png;base64,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";
         var pdf = new jspdf.jsPDF("landscape", undefined, format);

         pdf.addImage(mapCanvas.toDataURL("image/jpeg"), "JPEG", 15, 20, dim[0] - 30, dim[1] - 35);
         //console.log(width);
         pdf.addImage(imgCompass, "JPEG", dim[0] - 36, 21, 20, 20);
         pdf.addImage(chuthich, "JPEG", dim[0] - 56, dim[1] - 43, 40, 27);
         pdf.addImage(imgtitle, "JPEG", dim[0] / 2 - 70, 3, 140, 10);
         pdf.setLineWidth(0.5);
         pdf.line(10, 15, dim[0] - 10, 15);
         pdf.line(10, dim[1] - 10, dim[0] - 10, dim[1] - 10);
         pdf.line(10, 15, 10, dim[1] - 10);
         pdf.line(dim[0] - 10, 15, dim[0] - 10, dim[1] - 10);
         //pdf.table(1, dim[1] - 25, data, headers, { autoSize: true });

         pdf.save("map.pdf");

         // Reset original map size
         map.setSize(size);
         map.getView().setResolution(viewResolution);
         exportButton.disabled = false;
         document.body.style.cursor = "auto";
      });

      // Set print size
      var printSize = [width, height];
      map.setSize(printSize);
      var scaling = Math.min(width / size[0], height / size[1]);
      map.getView().setResolution(viewResolution / scaling);
   },
   false
);
// Select  interaction
var select_mucNgap = new ol.interaction.Select({
   layers: [
      layer_mucNgap_KB1,
      layer_mucNgap_KB2,
      layer_mucNgap_KB3,
      layer_mucNgap_KB4,
      layer_mucNgap_KB5,
      layer_mucNgap_KB6,
      layer_mucNgap_KB7,
      layer_mucNgap_KB8,
      layer_mucNgap_KB9,
      layer_mucNgap_KB10,
      layer_mucNgap_KB11,
      layer_mucNgap_KB12,
      layer_mucNgap_KB13,
      layer_mucNgap_KB14,
      layer_mucNgap_KB15,
   ],
   hitTolerance: 1,
   multi: false,
   style: styleFunction_selected,
   condition: ol.events.condition.singleClick,
});
map.addInteraction(select_mucNgap);
var select_diemNgap = new ol.interaction.Select({
   layers: [layer_DiemNgap],
   hitTolerance: 5,
   multi: false,
   style: styleFunction_DiemNgap_Selected,
   condition: ol.events.condition.singleClick,
});
map.addInteraction(select_diemNgap);

map.getView().fit(new ol.extent.buffer(extent_full, 0.5), map.getSize());
map.getView().setZoom(14.28);
map.getView().setCenter(centerCoord);
//map.addOverlay(popupOverlay);

var geoloc = new ol.control.GeolocationButton({
   title: "Vị trí của bạn",
   zoom: 20,
   followTrack: false,
   delay: 86400000, // delay before removing the location in ms, delfaut 3000
});
map.addControl(geoloc);

// Show position popup
var youAreHere = new ol.Overlay.Popup({
   positioning: "auto",
   anim: true, //Animate the popup the popup
   closeBox: false, //popup has a close box
});
//Add You are here popup on the map
map.addOverlay(youAreHere);
var popup_Attr_diemNgap = new ol.Overlay.PopupFeature({
   popupClass: "default anim",
   closeBox: true,
   //offsetBox: 50,
   showImage: true,
   select: select_diemNgap,
   //canFix: false,
   template: {
      title: function (f) {
         return "ĐIỂM NGẬP BÁO CÁO";
      },
      attributes: {
         dia_chi_satlo: { title: "Địa chỉ ngập" },
         mieu_ta_satlo: { title: "Miêu tả ngập" },
         ten_nguoi_bao: { title: "Tên người báo" },
         sdt_nguoi_bao: { title: "SĐT người báo" },
      },
      thumbnail: function (f) {
         return f.get("featured_gallery_url");
      },
   },
});
map.addOverlay(popup_Attr_diemNgap);
popup_Attr_diemNgap.on("closeClick", function () {
   clearAllSelectedFeatures();
});

var popup_Attr_mucNgap = new ol.Overlay.PopupFeature({
   popupClass: "default anim",
   closeBox: true,
   //offsetBox: 50,
   showImage: true,
   select: select_mucNgap,
   //canFix: false,
   template: {
      title: function (f) {
         return "MỨC NGẬP - " + flScenario.options[flScenario.selectedIndex].text;
      },
      attributes: {
         objName2: { title: "Huyện/Thành phố" },
         objName3: { title: "Xã/Phường" },
         objCode: { title: "Mức ngập (code)" },
         objCode: {
            title: "Mức ngập", // attribute's title
            format: function (val, f) {
               //console.log("val = " + val);
               switch (Number(val)) {
                  case 1:
                     return "< 0.5m";
                     break;
                  case 2:
                     return "0.5m - 1.0m";
                     break;
                  case 3:
                     return "1.0m - 1.5m";
                     break;
                  case 4:
                     return "1.5m - 2.0m";
                     break;
                  case 5:
                     return "2.0m - 3.0m";
                     break;
                  case 6:
                     return "3.0m - 4.0m";
                     break;
                  case 7:
                     return "4.0m - 5.0m";
                     break;
                  case 8:
                     return "5.0m - 6.0m";
                     break;
                  case 9:
                     return "6.0m - 7.0m";
                     break;
                  default: //>10
                     return "> 7.0m";
               }
            },
         },
         objArea: { title: "Diện tích ngập (m2)" },
      },
   },
});
map.addOverlay(popup_Attr_mucNgap);

popup_Attr_mucNgap.on("direction", function (feature) {
   alert("Tính năng đang được phát triển!");
});
function clearAllSelectedFeatures() {
   select_mucNgap.getFeatures().clear();
   select_diemNgap.getFeatures().clear();
}
popup_Attr_mucNgap.on("closeClick", function () {
   clearAllSelectedFeatures();
   //console.log('khu CN hide');
});

var geolocation = new ol.Geolocation({
   // enableHighAccuracy must be set to true to have the heading value.
   trackingOptions: {
      enableHighAccuracy: true,
   },
   projection: view.getProjection(),
});

popup_Attr_diemNgap.on("show", function () {
   //console.log('khu CN show');
   //select_khoaPhong.getFeatures().clear();

   //select_toaNha.getFeatures().clear();
   //popup_Attr_toaNha.hide();
   setTimeout(turnOffPopup, 100);
});
function turnOffPopup() {
   popup_Attr_mucNgap.hide();
   select_mucNgap.getFeatures().clear();
}

var flLevel = document.getElementById("floodLevel");
var selected_flLevel = 0;
function flLevelChange() {
   selected_flLevel = flLevel.value;
   var text = flLevel.options[flLevel.selectedIndex].text;
   //console.log(selected_flLevel, text);
   popup_Attr_mucNgap.hide();
   select_mucNgap.getFeatures().clear();
   map.getView().setZoom(map.getView().getZoom() + 0.00000000001);
}
flLevel.onchange = flLevelChange;
flLevelChange();

var selected_flScenario = 0;
var lastSelected_flScenario = 0;

var flScenario = document.getElementById("floodScenario");
flScenario.onchange = flScenarioChange;
function flScenarioChange() {
   let numLayers = layerGroup_mucNgap.getLayers().getLength();
   let temp = flScenario.value;
   //console.log("numLayers = " + numLayers);
   if (temp >= numLayers) {
      alert("Kịch bản chưa có!");
      flScenario.selectedIndex = lastSelected_flScenario;
      return;
   }
   selected_flScenario = temp;
   lastSelected_flScenario = selected_flScenario;
   //console.log("selected_flScenario = " + selected_flScenario);
   layerGroup_mucNgap.getLayers().forEach((item, i) => {
      //console.log("i = " + i);
      //console.log(item);
      if (Number(i) == Number(selected_flScenario)) {
         item.setVisible(true);
         //console.log("Set true");
      } else {
         item.setVisible(false);
         //console.log("Set false");
      }
   });
   //console.log("-------------");
   select_mucNgap.getFeatures().clear();
   popup_Attr_mucNgap.hide();

   map.getView().setZoom(map.getView().getZoom() + 0.00000000001);
}
//flScenarioChange();

const source = new ol.source.Vector();
const vector = new ol.layer.Vector({
   source: source,
   title: "Đo đạc",
   visible: true,
   displayInLayerSwitcher: false,
});
map.addLayer(vector);
let sketch;
let helpTooltipElement;
let helpTooltip;
let measureTooltipElement;
let measureTooltip;
const continuePolygonMsg = "Click để tiếp tục vẽ vùng";
const continueLineMsg = "Click để tiếp tục vẽ đường";
const pointerMoveHandler = function (evt) {
   if (evt.dragging) {
      return;
   }
   /** @type {string} */
   let helpMsg = "Chọn điểm trên bản đồ";

   if (sketch) {
      const geom = sketch.getGeometry();
      if (geom instanceof ol.geom.Polygon) {
         helpMsg = continuePolygonMsg;
      } else if (geom instanceof ol.geom.LineString) {
         helpMsg = continueLineMsg;
      }
   }

   helpTooltipElement.innerHTML = helpMsg;
   helpTooltip.setPosition(evt.coordinate);

   helpTooltipElement.classList.remove("hidden");
};

let draw; // global so we can remove it later

/**
 * Format length output.
 * @param {LineString} line The line.
 * @return {string} The formatted length.
 */
const formatLength = function (length) {
   let output;
   if (length > 100) {
      output = Math.round((length / 1000) * 100) / 100 + " " + "km";
   } else {
      output = Math.round(length * 100) / 100 + " " + "m";
   }
   return output;
};

/**
 * Format area output.
 * @param {Polygon} polygon The polygon.
 * @return {string} Formatted area.
 */
const formatArea = function (area) {
   let output;
   if (area > 10000) {
      output = Math.round((area / 1000000) * 100) / 100 + " " + "km<sup>2</sup>";
   } else {
      output = Math.round(area * 100) / 100 + " " + "m<sup>2</sup>";
   }
   return output;
};

function addInteraction() {
   const type = measurementRadios.filter(":checked").val();
   draw = new ol.interaction.Draw({
      source: source,
      type: type,
      style: new ol.style.Style({
         fill: new ol.style.Fill({
            color: "rgba(255, 255, 255, 0.2)",
         }),
         stroke: new ol.style.Stroke({
            color: "rgba(0, 0, 0, 0.5)",
            lineDash: [10, 10],
            width: 2,
         }),
         image: new ol.style.Circle({
            radius: 5,
            stroke: new ol.style.Stroke({
               color: "rgba(0, 0, 0, 0.7)",
            }),
            fill: new ol.style.Fill({
               color: "rgba(255, 255, 255, 0.2)",
            }),
         }),
      }),
   });
   map.addInteraction(draw);

   createMeasureTooltip();
   createHelpTooltip();

   function getD(sketch) {
      var geometry = sketch.getGeometry();
      let dist = ol.sphere.getLength(geometry, {
         projection: "EPSG:4326",
         radius: 6371008.8,
      });
      return dist;
   }
   function getA(sketch) {
      var geometry = sketch.getGeometry();
      let area = ol.sphere.getArea(geometry, {
         projection: "EPSG:4326",
         radius: 6371008.8,
      });
      return area;
   }

   let listener;
   draw.on("drawstart", function (evt) {
      map.removeInteraction(select_mucNgap);
      //vector.getSource().clear();
      sketch = evt.feature;
      let tooltipCoord = evt.coordinate;
      listener = sketch.getGeometry().on("change", function (evt) {
         const geom = evt.target;
         let output;
         if (geom instanceof ol.geom.Polygon) {
            output = formatArea(getA(sketch));
            tooltipCoord = geom.getInteriorPoint().getCoordinates();
         } else if (geom instanceof ol.geom.LineString) {
            output = formatLength(getD(sketch));
            tooltipCoord = geom.getLastCoordinate();
         }
         measureTooltipElement.innerHTML = output;
         measureTooltip.setPosition(tooltipCoord);
      });
   });

   draw.on("drawend", function () {
      measureTooltipElement.className = "ol-tooltip ol-tooltip-static";
      measureTooltip.setOffset([0, -7]);
      // unset sketch
      sketch = null;
      // unset tooltip so that a new one can be created
      measureTooltipElement = null;
      createMeasureTooltip();
      ol.Observable.unByKey(listener);
      map.addInteraction(select_mucNgap);
   });
}

/**
 * Creates a new help tooltip
 */
function createHelpTooltip() {
   if (helpTooltipElement) {
      helpTooltipElement.parentNode.removeChild(helpTooltipElement);
   }
   helpTooltipElement = document.createElement("div");
   helpTooltipElement.className = "ol-tooltip hidden";
   helpTooltip = new ol.Overlay({
      element: helpTooltipElement,
      offset: [15, 0],
      positioning: "center-left",
   });
   map.addOverlay(helpTooltip);
}

/**
 * Creates a new measure tooltip
 */
function createMeasureTooltip() {
   if (measureTooltipElement) {
      measureTooltipElement.parentNode.removeChild(measureTooltipElement);
   }
   measureTooltipElement = document.createElement("div");
   measureTooltipElement.className = "ol-tooltip ol-tooltip-measure";
   measureTooltip = new ol.Overlay({
      element: measureTooltipElement,
      offset: [0, -15],
      positioning: "bottom-center",
      stopEvent: false,
      insertFirst: false,
   });
   map.addOverlay(measureTooltip);
}

const copyright = new ol.Overlay({
   element: document.getElementById("copyright"),
});
map.addOverlay(copyright);

//Mesuremnt Tools
var measurementRadios = jQuery("[type=radio]");
var resultElement = jQuery("#js-result");
var measuringTool;
//const opts: SphereMetricOptions = { projection: 'EPSG:4326' }
//Vector layer for mesure length, area

measurementRadios.on("change", function () {
   var geometryType = measurementRadios.filter(":checked").val();

   if (geometryType !== "none") {
      map.getViewport().addEventListener("mouseout", function () {
         helpTooltipElement.classList.add("hidden");
      });
      map.removeInteraction(draw);
      map.on("pointermove", pointerMoveHandler);
      addInteraction();
   } else {
      map.removeInteraction(draw);
      map.removeEventListener("pointermove", pointerMoveHandler);
      map.getViewport().removeEventListener("mouseout", function () {
         helpTooltipElement.classList.add("hidden");
      });
   }
});

function setBasemap(mapType) {
   switch (mapType) {
      case "GoogleSattelite":
         googleBaseMap.setVisible(true);
         el("GoogleSattelite").checked = true;
         el("OpenStreetMap").checked = false;
         el("noBaseMap").checked = false;
         osmBaseMap.setVisible(false);
         break;
      case "OpenStreetMap":
         el("GoogleSattelite").checked = false;
         el("OpenStreetMap").checked = true;
         el("noBaseMap").checked = false;
         googleBaseMap.setVisible(false);
         osmBaseMap.setVisible(true);
         break;
      default: //>3
         el("GoogleSattelite").checked = false;
         el("OpenStreetMap").checked = false;
         el("noBaseMap").checked = true;
         googleBaseMap.setVisible(false);
         osmBaseMap.setVisible(false);
   }
}
function setLayerVisible(layerName) {
   switch (layerName) {
      case "chkRanhGioiXa":
         console.log("xa");
         layer_ranhGioiXa.setVisible(el(layerName).checked);
         break;
      case "chkRanhGioiHuyen":
         console.log("huyen");
         layer_ranhGioiHuyen.setVisible(el(layerName).checked);
         break;
      case "chkBanDoNgap":
         console.log("ngap");
         layerGroup_mucNgap.setVisible(el(layerName).checked);
         break;
      case "chkSongSuoi":
         console.log("song");
         layerGroup_songSuoi.setVisible(el(layerName).checked);
         break;
      case "chkDuongBo":
         console.log("duong");
         layer_matDuongBo.setVisible(el(layerName).checked);
         break;
      default: //>3
         console.log("default");
   }
}
let isFollowing = false;
let count = 0;
let hasWarning = false;
function getUserLocation() {
   console.log("Getting location...");
   isFollowing = true;
   count = 0;
   if (!hasWarning) {
      alert("Vui lòng cho phép truy cập vị trí khi được hỏi để xác định vị trí của bạn!");
      hasWarning = true;
   }
   getPermission();
   setTimeout(getUserPosition, 3000);
}
function getUserPosition() {
   try {
      let lc = geolocation.getPosition();
      if (lc) {
         el("longitude").value = lc[0].toString();
         el("latitude").value = lc[1].toString();
      } else {
         //alert('Cần bật vị trí và cho phép truy cập vị trí khi sử dụng tính năng này!');

         el("toaDo").value = "ERROR_USER_DENIED";
      }
   } catch (e) {
      console.log("khong the lay vi tri 2");
   } finally {
   }
}
function getPermission() {
   try {
      geolocation.setTracking(true);
   } catch (e) {
      console.log("Da tu choi");
   } finally {
   }
}
var geolocation = new ol.Geolocation({
   trackingOptions: {
      enableHighAccuracy: true,
   },
   projection: view.getProjection(),
});
geolocation.on("change:position", () => {
   console.log("In onchange, location: " + geolocation.getPosition());
   console.log("isFollowing: " + isFollowing);
   console.log("Count: " + count);
   if (isFollowing && count < 5) {
      count += 1;
      getUserPosition();
   } else {
      isFollowing = false;
   }
});

jQuery(document).ready(function ($) {
   $(".wpol-infomarker").each(function (key) {
      var datamarker = $(this).data("marker");
      var datamarker_sub = $(this).data("sub");
      var key = $(this).data("id");

      //console.log(datamarker);
      // Add Marker
   });
});

function openModal() {
   document.getElementById("myModal").style.display = "block";
}

function closeModal() {
   document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
//showSlides(slideIndex);

function plusSlides(n) {
   showSlides((slideIndex += n));
}

function currentSlide(n) {
   showSlides((slideIndex = n));
}

function showSlides(n) {
   var i;
   var slides = document.getElementsByClassName("mySlides");
   //console.log("slides.length: " + slides.length)
   if (n > slides.length / 2) {
      slideIndex = 1;
   }
   if (n < 1) {
      slideIndex = slides.length / 2;
   }
   for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
   }

   slides[slideIndex - 1].style.display = "block";
   //console.log("slides index: " + slideIndex)
   //console.log("slides.length / 2 + slideIndex - 1 : " + (slides.length / 2 + slideIndex - 1));
   slides[slides.length / 2 + slideIndex - 1].style.display = "block";
}
