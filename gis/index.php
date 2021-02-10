<?php require('koneksi.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>GIS Sistem Pemetaan Data Penduduk Berbasis MAP</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/dist/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="navbar navbar-light bg-info ">
            <span class="navbar-brand mb-0 h1 text-white">Pemetaan Data Penduduk Wilayah Denpasar</span>
          </nav>
        </div>
      </div>  
      <div class="row">
        <div class="col-12">
          <div class="card bg-light mb-3" >
            <div class="card-header">Info</div>
            <div class="card-body">
              <p class="card-text">Aplikasi GIS Pemetaan data penduduk wilayah Denpasar</p>
              <h5 class="card-title">Jumlah Total Penduduk Wilayah Denpasar</h5>
              <?php 
                $sqlss = mysqli_query($db,"SELECT SUM(jml_laki+jml_perempuan) AS total FROM `tbl_data_kecamatan`");
                $total = mysqli_fetch_array($sqlss); 
              ?>
              <h4><?= number_format($total['total']) ?> Jiwa</h4>
              <span class="badge badge-info">Sumber : 20119 - bps.denpasarkota.go.id</span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <h3>Disini Akan muncul Map</h3>
              <div id="map" style="width: 100%;height: 460px"></div>

              <?php 
                 $query_modal = mysqli_query($db,"SELECT tbl_data_kecamatan.*,tbl_kecamatan.* FROM tbl_data_kecamatan INNER JOIN tbl_kecamatan ON tbl_data_kecamatan.id_kecamatan = tbl_kecamatan.id_kecamatan");
                 while ($data_modal = mysqli_fetch_array($query_modal)) {
                   ?>
              <!-- Modal -->
                <div class="modal fade data_modal_<?= $data_modal['id_data'] ?>" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Data Wilayah <?= ucfirst($data_modal['nama_kecamatan']) ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-5" style="font-size: 12px">Luas Wilayah</div>
                            <div class="col-7">: <?= $data_modal['luas_wilayah'] ?></div>
                          </div>
                          <div class="row">
                            <div class="col-5" style="font-size: 12px">Juamlah Penduduk Laki Laki</div>
                            <div class="col-7">: <?= number_format($data_modal['jml_laki']) ?></div>
                          </div>
                          <div class="row">
                            <div class="col-5" style="font-size: 12px">Jumlah Penduduk Perempuan</div>
                            <div class="col-7">: <?= number_format($data_modal['jml_perempuan']) ?></div>
                          </div>
                          <div class="row">
                            <div class="col-5" style="font-size: 12px">Total Penduduk Keselurusahn</div>
                            <div class="col-7">: <?php 
                              $total = $data_modal['jml_laki'] + $data_modal['jml_perempuan'];
                              echo '<span class="badge badge-success">'.number_format($total).'</span>';
                             ?></div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                   <?php
                 }
               ?>
            </div>
            <div class="col-md-4">
              <div class="card text-white bg-warning mb-3">
                <div class="card-header">Daftar kecamatan Wilayah Denpasar</div>
                <div class="card-body">
                  <ul class="list-group list-group-flush" style="background-color: transparent !important;">
                    <li class="list-group-item" style="background-color: transparent !important;">Kecamatan Denpasar Utara </li>
                    <li class="list-group-item" style="background-color: transparent !important;">Kecamatan Denpasar Timur</li>
                    <li class="list-group-item" style="background-color: transparent !important;">Kecamatan Denpasar Selatan</li>
                    <li class="list-group-item" style="background-color: transparent !important;">Kecamatan Denpasar Barat</li>
                  </ul>
                </div>
              </div>
              <a href="keloladata.php" class="btn btn-primary">Kelola Data</a>
            </div>
          </div>
          <div class="row" style="margin-top: 30px;">
            <div class="col-12">
              <nav class="navbar navbar-light bg-info text-center">
                <span class="navbar-brand mb-0 h1 text-white">&copy; 2020 Sumber data: bps.denpasarkota.go.id </span>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
<script type="text/javascript" src="assets/jquery/dist/jquery.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yt5E2-ebq9oEZLWJrM5vx_ZeCV_YdPs&callback=initMap"></script>
<script type="text/javascript" src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
<script>

  var map;
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: {lat: -8.6697501, lng: 115.2073583}
    });
    var contentString = '<b>Mantap bang</b>';
    // Load GeoJSON.
    var data_layer1 = new google.maps.Data({map: map});
    var data_layer2 = new google.maps.Data({map: map});
    var data_layer3 = new google.maps.Data({map: map});
    var data_layer4 = new google.maps.Data({map: map});
    data_layer1.loadGeoJson('denpasar_utara.json');
    data_layer2.loadGeoJson('denpasar_timur.json');
    data_layer3.loadGeoJson('denpasar_selatan.json');
    data_layer4.loadGeoJson('denpasar_barat.json');
    // map.data.loadGeoJson('data2.json');
    // Set the stroke width, and fill color for each polygon
    data_layer1.setStyle({
      fillColor: '#ff7907',
      strokeWeight: 1,
      strokeColor: 'black',
      fillOpacity: 0.8,
      html: contentString
    });
    data_layer2.setStyle({
      fillColor: 'blue',
      strokeWeight: 1,
      strokeColor: 'black',
      fillOpacity: 0.8
    });
    data_layer3.setStyle({
      fillColor: 'yellow',
      strokeWeight: 1,
      strokeColor: 'black',
      fillOpacity: 0.8
    });
    data_layer4.setStyle({
      fillColor: 'green',
      strokeWeight: 1,
      strokeColor: 'black',
      fillOpacity: 0.8
    });

    data_layer1.setMap(map);

    var infowindow = new google.maps.InfoWindow();
    <?php 
      $query = mysqli_query($db,"SELECT tbl_data_kecamatan.*,tbl_kecamatan.* FROM tbl_data_kecamatan INNER JOIN tbl_kecamatan ON tbl_data_kecamatan.id_kecamatan = tbl_kecamatan.id_kecamatan");
      $no = 1;
      while ($data = mysqli_fetch_array($query)) {
        ?>
  data_layer<?= $no ?>.addListener('click', function(event) {
     var feat = event.feature;
     var html = "<b><?= ucfirst($data['nama_kecamatan']) ?></b>";
     html += "<p>Luas : <?= $data['luas_wilayah'] ?> km²</p>";
     html += "<br><a class='normal_link' data-toggle='modal' data-target='.data_modal_<?= $data['id_data']?>' href='asas'>Lihat Detail</a>";
     infowindow.setContent(html);
     infowindow.setPosition(event.latLng);
     infowindow.setOptions({pixelOffset: new google.maps.Size(0,-34)});
     infowindow.open(map);
  });
        <?php
      $no++;
      }
    ?>



    // mouserHover
    google.maps.event.addListener(data_layer1,"mouseover",function(){
     this.setStyle({
      fillColor: "#ff7907",
      strokeWeight: 1,
      strokeColor: 'black',
      fillOpacity: 0.6
     });
    }); 
     google.maps.event.addListener(data_layer1,"mouseout",function(){
     this.setStyle({
      fillColor: "#ff7907",
      strokeWeight: 1,
      strokeColor: 'black',
      fillOpacity: 0.8
     });
    }); 
    google.maps.event.addListener(data_layer2,"mouseover",function(){
     this.setStyle({
      fillColor: "blue",
      strokeWeight: 1,
      strokeColor: 'black',
      fillOpacity: 0.6
     });
    }); 
     google.maps.event.addListener(data_layer2,"mouseout",function(){
     this.setStyle({
      fillColor: "blue",
      strokeWeight: 1,
      strokeColor: 'black',
      fillOpacity: 0.8
     });
    }); 
     google.maps.event.addListener(data_layer3,"mouseover",function(){
     this.setStyle({
      fillColor: "yellow",
      strokeWeight: 1,
      strokeColor: 'black',
      fillOpacity: 0.6
     });
    }); 
     google.maps.event.addListener(data_layer3,"mouseout",function(){
     this.setStyle({
      fillColor: "yellow",
      strokeWeight: 1,
      strokeColor: 'black',
      fillOpacity: 0.8
     });
    }); 
     google.maps.event.addListener(data_layer4,"mouseover",function(){
     this.setStyle({
      fillColor: "green",
      strokeWeight: 1,
      strokeColor: 'black',
      fillOpacity: 0.6
     });
    }); 
     google.maps.event.addListener(data_layer4,"mouseout",function(){
     this.setStyle({
      fillColor: "green",
      strokeWeight: 1,
      strokeColor: 'black',
      fillOpacity: 0.8
     });
    }); 

  }
</script>
</html>