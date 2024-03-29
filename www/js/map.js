var stred = SMap.Coords.fromWGS84(16.6008514, 49.2081519);
var mapa = new SMap(JAK.gel("mapa"), stred, 14);

mapa.addDefaultLayer(SMap.DEF_OPHOTO);
mapa.addDefaultLayer(SMap.DEF_OPHOTO0203);
mapa.addDefaultLayer(SMap.DEF_OPHOTO0406);
mapa.addDefaultLayer(SMap.DEF_TURIST);
mapa.addDefaultLayer(SMap.DEF_HISTORIC);
mapa.addDefaultLayer(SMap.DEF_BASE);
mapa.addDefaultLayer(SMap.DEF_SMART_BASE).enable();
mapa.addDefaultControls();
mapa.addControl(new SMap.Control.Orientation({mode:"ccw"}), {left:"5px",top:"5px"});
mapa.addControl(new SMap.Control.Orientation({mode:"cw"}), {left:"35px",top:"5px"});

var layerSwitch = new SMap.Control.Layer();
layerSwitch.addDefaultLayer(SMap.DEF_BASE);
layerSwitch.addDefaultLayer(SMap.DEF_OPHOTO);
layerSwitch.addDefaultLayer(SMap.DEF_TURIST);
layerSwitch.addDefaultLayer(SMap.DEF_OPHOTO0406);
layerSwitch.addDefaultLayer(SMap.DEF_OPHOTO0203);
layerSwitch.addDefaultLayer(SMap.DEF_HISTORIC);

var l = new SMap.Layer.Marker();
mapa.addLayer(l).enable();

var card = new SMap.Card();
card.getHeader().innerHTML = "<strong>ANIMALKO</strong><br>T O P Servis s.r.o";
card.getBody().innerHTML = "Preslova 26, 602 00 Brno - střed";

var marker = new SMap.Marker(stred);
marker.decorate(SMap.Marker.Feature.Card, card);
l.addMarker(marker);

// cerveny ukazatel
var pointer2 = new SMap.Control.Pointer({
    type: SMap.Control.Pointer.TYPES.RED, // dva typy, defaultni je modra
    snapHUDtoScreen: 20 // snapovani HUD prvku k okrajum obrazovky [px]
});
mapa.addControl(pointer2);
pointer2.setCoords(SMap.Coords.fromWGS84(16.6007875, 49.2081311))