
<div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="latitud">Latitud </label>
                                            <input type="text" id="latitud" name="latitud" class="form-control">
                                        </div>
</div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="longitud">Longitud </label>
                                            <input type="text" id="longitud" name="latitud" class="form-control">
                                        </div>
                                    </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-md-12">
                                        <div id="mapa" name="mapa" style="width:100%; height:500px;"></div>
                                       </div>
                                     </div>
                                     <script>
                                          function iniciarMapa(){
                                            var latitud=-16.4925886;
                                            var longitud=-68.1245496;
                                            coordenadas={
                                                lng: longitud,
                                                lat: latitud
                                            }
                                            generarMapa(coordenadas);
                                          }
                                          function generarMapa(coordenadas){
                                            var mapa=new google.maps.Map(document.getElementById('mapa'),
                                            {
                                                zoom:15,
                                                center: new google.maps.LatLng(coordenadas.lat,coordenadas.lng)
                                            });

                                            marcador=new google.maps.Marker({
                                                map:mapa,
                                                draggable:true,
                                                position:new google.maps.LatLng(coordenadas.lat,coordenadas.lng)
                                            });

                                            marcador.addListener('dragend',function(event){
                                                document.getElementById("latitud").value=this.getPosition().lat();
                                                document.getElementById("longitud").value=this.getPosition().lng();
                                              
                                            })
                                          }
                                        </script>
                                     <script   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDmxG5O8DwYeoKV1_56xxWYPXLs7l6Bpk&callback=iniciarMapa"></script>
