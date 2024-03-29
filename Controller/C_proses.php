<?php
  /**
   *
   */
  class c_proses
  {
    private $DBS;
    function __construct($db)
    {
      $this->DBS = $db;
    }

    public function Tes(){
      if (!$this->DBS) {
        echo "Gagl";
      }
      else {
        echo "OK";
      }
    }

    public function login($email, $pass){
      $cekLogin = $this->DBS->action_Select_Where("tb_petugas", "email", $email);
      if (mysqli_num_rows($cekLogin) == 1) {
        $row = mysqli_fetch_assoc($cekLogin);
        $tesEmail = $row['email'];
        $tesPass = $row['password'];
        $name = $row['nama'];
        $id_petugas = $row['id_petugas'];

        if ($email == $tesEmail && $pass == $tesPass) {
          // session_start();
          $_SESSION['status'] = "login";
          $_SESSION['name'] = $name;
          $_SESSION['id_petugas'] = $id_petugas;
          return true;
        }
        else {
          return false;
        }
      }
      else {
        return false;
      }
    }

    public function toArray($object){
      $rows = [];
      while ($row = mysqli_fetch_array($object)) {
        unset($row[0]);
        unset($row['id']);
        unset($row['1']);
        unset($row['id_petugas']);
        unset($row['pm10']);
        unset($row['so2']);
        unset($row['co']);
        unset($row['o3']);
        unset($row['no2']);
        unset($row['kategori']);
        unset($row['9']);
        unset($row['8']);
        unset($row['tanggal_pengambilan']);
        unset($row['tanggal_unggah']);
        array_push($rows, $row);
      }
      return $rows;
    }

    public function toArray2($object){
      $rows = Array();
      while ($row = mysqli_fetch_array($object, MYSQLI_NUM)) {
        array_push($rows, $row);
      }
      return $rows;
    }

    public function uploadFileToDB($filename, $id_petugas, $filter){
      $dataArray = $this->convertToArray($filename);
      $upload = $this->getNormalData($dataArray, $id_petugas, $filter);
      return $upload;
    }

    public function convertToArray($filename){
      $file = '../temp/'.$filename;
      $csv = array();
      $csv = array_map('str_getcsv', file($file));
      return $csv;
    }

    public function getNormalData($data, $id_petugas, $filter){
      $pm10 = -10;
      $so2 = -10;
      $co = -10;
      $o3 = -10;
      $no2 = -10;
      $kat = -10;
      $tanggal = -10;
      $y = date('Y');
      $m = date('m');
      $d = date('d');
      $today = $y."-".$m."-".$d;
      $iterasi = count($data[0]);
      for ($i=0; $i < $iterasi; $i++) {
        if (strcasecmp($data[0][$i], 'tanggal') == 0) {
          $tanggal = $i;
        }

        if (strcasecmp($data[0][$i], 'pm10') == 0) {
          $pm10 = $i;
        }

        if (strcasecmp($data[0][$i], 'so2') == 0 || strcasecmp($data[0][$i], 's02') == 0) {
          $so2 = $i;
        }

        if (strcasecmp($data[0][$i], 'co') == 0) {
          $co = $i;
        }

        if (strcasecmp($data[0][$i], 'o3') == 0) {
          $o3 = $i;
        }

        if (strcasecmp($data[0][$i], 'no2') == 0) {
          $no2 = $i;
        }

        if (strcasecmp($data[0][$i], 'categori') == 0 || strcasecmp($data[0][$i], 'kategori') == 0) {
          if (strcasecmp($data[1][$i], 'baik') == 0 || strcasecmp($data[1][$i], 'sedang') == 0 || strcasecmp($data[1][$i], 'tidak sehat') == 0
              || strcasecmp($data[1][$i], 'sangat tidak sehat') == 0 || strcasecmp($data[1][$i], 'tidak ada data') == 0) {
            $kat = $i;
          }
        }

        if (strcasecmp($data[0][$i], 'keterangan') == 0) {
          if (strcasecmp($data[1][$i], 'baik') == 0 || strcasecmp($data[1][$i], 'sedang') == 0 || strcasecmp($data[1][$i], 'tidak sehat') == 0
              || strcasecmp($data[1][$i], 'sangat tidak sehat') == 0 || strcasecmp($data[1][$i], 'tidak ada data') == 0) {
            $kat = $i;
          }
        }

      }

      if ($pm10 == -10 || $so2 == -10 || $co == -10 || $o3 == -10 || $no2 == -10 || $kat == -10 || $tanggal == -10) {
        return false;
      }
      else {
        for ($i=0; $i < count($data); $i++) {
          if ($data[$i][$kat] != "TIDAK ADA DATA" && $data[$i][$kat] != "Tidak Ada Data") {
            if (is_numeric($data[$i][$pm10]) && is_numeric($data[$i][$so2]) && is_numeric($data[$i][$co]) &&
                is_numeric($data[$i][$o3]) && is_numeric($data[$i][$no2])) {

              if (strcasecmp($filter, "latih") == 0) {
                // $this->DBS->addToTBLatih($id_petugas, $data[$i][$pm10], $data[$i][$so2], $data[$i][$co], $data[$i][$o3], $data[$i][$no2], strtolower($data[$i][$kat]), $data[$i][$tanggal], $today);
                $this->DBS->addToTBTemp($id_petugas, $data[$i][$pm10], $data[$i][$so2], $data[$i][$co], $data[$i][$o3], $data[$i][$no2], strtolower($data[$i][$kat]), $data[$i][$tanggal], $today);
              }

              if (strcasecmp($filter, "uji") == 0) {
                $this->DBS->addToTBUji($id_petugas, $data[$i][$pm10], $data[$i][$so2], $data[$i][$co], $data[$i][$o3], $data[$i][$no2], strtolower($data[$i][$kat]), $data[$i][$tanggal], $today);
              }

            }
          }
        }
        return true;
      }
    }

// PEMBAGIAN DATA //

    public function bagiData($persen){
      $baik = $this->toArray2($this->get_Temp_Where('baik'));
      $sedang = $this->toArray2($this->get_Temp_Where('sedang'));
      $TSehat = $this->toArray2($this->get_Temp_Where('tidak sehat'));
      $STSehat = $this->toArray2($this->get_Temp_Where('sangat tidak sehat'));

      $this->insertToDBLatih($baik, $persen);
      $this->insertToDBLatih($sedang, $persen);
      $this->insertToDBLatih($TSehat, $persen);
      $this->insertToDBLatih($STSehat, $persen);

      $this->insertToDBUji($baik, $persen);
      $this->insertToDBUji($sedang, $persen);
      $this->insertToDBUji($TSehat, $persen);
      $this->insertToDBUji($STSehat, $persen);

      echo "OK";
    }

    public function slicesLatih($data, $persen){
      $num = floor($persen * count($data) / 100);
      return array_slice($data, 0, $num);
    }

    public function slicesUji($data, $persen){
      $num = floor($persen * count($data) / 100);
      return array_slice($data, $num);
    }

    private function insertToDBLatih($data, $persen){
      $dataToUpload = $this->slicesLatih($data, $persen);
      for ($i=0; $i < count($dataToUpload); $i++) {
        $this->DBS->addToTBLatih($dataToUpload[$i][1], $dataToUpload[$i][2], $dataToUpload[$i][3], $dataToUpload[$i][4], $dataToUpload[$i][5], $dataToUpload[$i][6], $dataToUpload[$i][7], $dataToUpload[$i][8], $dataToUpload[$i][9]);
      }
    }

    private function insertToDBUji($data, $persen){
      $dataToUpload = $this->slicesUji($data, $persen);
      for ($i=0; $i < count($dataToUpload); $i++) {
        $this->DBS->addToTBUji($dataToUpload[$i][1], $dataToUpload[$i][2], $dataToUpload[$i][3], $dataToUpload[$i][4], $dataToUpload[$i][5], $dataToUpload[$i][6], $dataToUpload[$i][7], $dataToUpload[$i][8], $dataToUpload[$i][9]);
      }
    }

// -------------------------- //

    public function pelatihan(){
      $out = Array();
      $y = date('Y');
      $m = date('m');
      $d = date('d');
      $today = $y."-".$m."-".$d;
      $count = $this->getTotalData('tb_data_latih');
      $countBaik = $this->getTotalDataWhere('tb_data_latih', 'kategori', 'baik');
      $countSedang = $this->getTotalDataWhere('tb_data_latih', 'kategori', 'sedang');
      $countTSehat = $this->getTotalDataWhere('tb_data_latih', 'kategori', 'tidak sehat');
      $countSTSehat = $this->getTotalDataWhere('tb_data_latih', 'kategori', 'sangat tidak sehat');
      $countBerbahaya = $this->getTotalDataWhere('tb_data_latih', 'kategori', 'berbahaya');
      $baik = $this->getCiri('baik', $count);
      $sedang = $this->getCiri('sedang', $count);
      $tidakSehat = $this->getCiri('tidak sehat', $count);
      $sangatTdkSehat = $this->getCiri('sangat tidak sehat', $count);
      $berbahaya = $this->getCiri('berbahaya', $count);
      $this->DBS->updateParameter('baik', $baik, $today);
      $this->DBS->updateParameter('sedang', $sedang, $today);
      $this->DBS->updateParameter('tidak sehat', $tidakSehat, $today);
      $this->DBS->updateParameter('sangat tidak sehat', $sangatTdkSehat, $today);
      $this->DBS->updateParameter('berbahaya', $berbahaya, $today);
      array_push($out, $count);
      array_push($out, $countBaik);
      array_push($out, $countSedang);
      array_push($out, $countTSehat);
      array_push($out, $countSTSehat);
      array_push($out, $countBerbahaya);
      return $out;
    }

    public function getTotalData($table){
      $count = $this->DBS->countDataTable($table);
      while ($row = mysqli_fetch_array($count)) {
        $out = $row[0];
      }
      return $out;
    }

    public function getTotalDataWhere($table, $where, $key){
      $count = $this->DBS->countDataTableWhere($table, $where, $key);
      while ($row = mysqli_fetch_array($count)) {
        $out = $row[0];
      }
      return $out;
    }

    public function getCiri($filter, $totalLenght){
      $out = Array();
      $data = $this->DBS->action_Select_Where('tb_data_latih', 'kategori', $filter);
      $dataArray = $this->toArray($data);
      $mean = $this->getMean($dataArray);
      $S2 = $this->getS2($dataArray, $mean);
      $pKategori = $this->getDiscritProb($dataArray, $totalLenght);
      for ($i=0; $i < count($mean); $i++) {
        array_push($out, $mean[$i]);
      }

      for ($i=0; $i < count($S2); $i++) {
        array_push($out, $S2[$i]);
      }

      array_push($out, $pKategori);
      return $out;
    }

    public function getMean($data){
      $out = Array();
      $lenght = count($data);

      for ($i=2; $i < 7; $i++) {
        $sum = 0;
        if ($lenght == 0) {
          $mean = 0;
        }
        else {
          for ($j=0; $j < $lenght; $j++) {
            $sum += $data[$j][$i];
          }
          $mean = $sum / $lenght;
        }
        array_push($out, number_format($mean, 5, '.', ""));
      }
      return $out;
    }

    public function getS2($data, $mean){
      $out = Array();
      $lenght = count($data);

      for ($i=2; $i < 7; $i++) {
        $sum = 0;
        if ($lenght == 0) {
          $S2 = 0;
        }
        else {
          for ($j=0; $j < $lenght; $j++) {
            $pow = number_format(pow(($data[$j][$i] - $mean[$i -2]), 2), 5, '.', "");
            $sum += $pow;
          }

          if ($lenght == 1) {
            $S2 = $sum / $lenght;
          }
          else {
            $S2 = $sum / ($lenght - 1);
          }
        }
        array_push($out, number_format($S2, 5, '.', ""));
      }
      return $out;
    }

    public function getDiscritProb($data, $totalLenght){
      if ($totalLenght != 0) {
        if ($data == NULL) {
          return 0;
        }
        else {
          $lenght = count($data);
          $out = $lenght / $totalLenght;
          return number_format($out, 5, '.', "");
        }
      }
      else {
        return 0;
      }
    }

    public function cekData(){
      $dtlatih = $this->DBS->countDataTable('tb_data_latih');
      $dtuji = $this->DBS->countDataTable('tb_data_uji');

      while ($row = mysqli_fetch_array($dtlatih)) {
        $latih = $row[0];
      }

      while ($row = mysqli_fetch_array($dtuji)) {
        $uji = $row[0];
      }

      if ($latih == 0 || $uji == 0) {
        return false;
      }
      else {
        return true;
      }
    }

    public function toArrayFiture($object){
      $rows = Array();
      while ($row = mysqli_fetch_array($object)) {
        array_push($rows, $row[3]);
      }
      return $rows;
    }

    public function get_DataLatih(){
      $data = $this->DBS->action_Select("tb_data_latih");
      if (mysqli_num_rows($data) == 0) {
        $data = false;
      }
      return $data;
    }

    public function get_DataLatih_Limit(){
      $data = $this->DBS->action_SelectLimit("tb_data_latih");
      if (mysqli_num_rows($data) == 0) {
        $data = false;
      }
      return $data;
    }

    public function get_DataLatih_LimitNext($next){
      $data = $this->DBS->action_SelectLimitNext("tb_data_latih", $next);
      if (mysqli_num_rows($data) == 0) {
        $data = false;
      }
      return $data;
    }

    public function get_DataUji(){
      $data = $this->DBS->action_Select("tb_data_uji");
      if (mysqli_num_rows($data) == 0) {
        $data = false;
      }
      return $data;
    }

    public function get_DataUji_Limit(){
      $data = $this->DBS->action_SelectLimit("tb_data_uji");
      if (mysqli_num_rows($data) == 0) {
        $data = false;
      }
      return $data;
    }

    public function get_DataUji_LimitNext($next){
      $data = $this->DBS->action_SelectLimitNext("tb_data_uji", $next);
      if (mysqli_num_rows($data) == 0) {
        $data = false;
      }
      return $data;
    }

    public function get_Petugas_All(){
      return $this->DBS->action_Select("tb_petugas");
    }

    public function get_Parameter_All(){
      return $this->DBS->action_Select("tb_parameter");
    }

    public function get_Parameter_Where($key){
      return $this->DBS->action_Select_Where('tb_parameter', 'kategori', $key);
    }

    public function get_Temp_Where($key){
      return $this->DBS->action_Select_Where('temp', 'kategori', $key);
    }
  }

 ?>
