// KLASIFIKASI ZONE //

// K NAIVE BAYES //

function k_getProb(fitur, datates){
  var out = new Array();
  for (var i = 0; i < fitur.length; i++) {
    var temp = new Array();
    for (var j = 0; j < 5; j++) {
      if (fitur[i][j] == 0) {
        var Probability = 0;
      }
      else if (fitur[i][j + 5] == 0) {
        var Probability = 0;
      }
      else {
        var a = Math.pow((datates[j] - fitur[i][j]), 2).toFixed(5);
        var b = (2 * fitur[i][j + 5]).toFixed(5);
        var c = (a / b).toFixed(5);
        var exponen = Math.pow(2.7183, -c).toPrecision(6);
        var d = Math.sqrt(2 * 3.14 * fitur[i][j + 5]).toFixed(5);
        var e = (1 / d).toFixed(5);
        var Probability = (e * exponen).toPrecision(6);
      }
      temp.push(Probability);
    }
    temp.push(fitur[i][10]);
    out.push(temp);
  }
  return out;
}

function k_getLikelihood(data){
  var out = new Array();
  for (var i = 0; i < data.length; i++) {
    var likelihood = 1;
    for (var j = 0; j < 6; j++) {
      likelihood = (parseFloat(likelihood) * parseFloat(data[i][j])).toPrecision(6);
    }
    out.push(likelihood)
  }
  return out;
}

function k_getProbAkhir(data){
  var out = new Array();
  var sum = 0;
  for (var i = 0; i < data.length; i++) {
    sum = (parseFloat(sum) + parseFloat(data[i])).toPrecision(6);
  }

  for (var i = 0; i < data.length; i++) {
    var probAkhir = (data[i] / sum).toPrecision(6);
    out.push(probAkhir);
  }
  return out;
}

function k_getKat(data){
  var max = Math.max(data[0], data[1], data[2], data[3]);
  if (data[0] == max) {
    return "baik";
  }
  else if (data[1] == max) {
    return "sedang";
  }
  else if (data[2] == max) {
    return "tidak sehat";
  }
  else if (data[3] == max) {
    return "sangat tidak sehat";
  }
  else {
    return "error";
  }
}


// UJI ZONE //

// UJI NAIVE BAYES //

function u_getProb(fitur, dataUji){
  var out = new Array();
  for (var i = 0; i < dataUji.length; i++) {
    var temp = new Array();
    for (var j = 0; j < fitur.length; j++) {
      var temp1 = new Array();
      for (var k = 0; k < 5; k++) {
        if (fitur[j][k] == 0) {
          var Probability = 0;
        }
        else if (fitur[j][k + 5] == 0) {
          var Probability = 0;
        }
        else {
          var a = Math.pow(dataUji[i][k + 2] - fitur[j][k], 2).toFixed(5);
          var b = (2 * fitur[j][k + 5]).toFixed(5);
          var c = (a / b).toFixed(5);
          var exponen = Math.pow(2.7183, -c).toPrecision(6);
          var d = Math.sqrt(2 * 3.14 * fitur[j][k + 5]).toFixed(5);
          var e = (1 / d).toFixed(5);
          var Probability = (e * exponen).toPrecision(6);
        }
        temp1.push(Probability);
      }
      temp1.push(fitur[j][10]);
      temp.push(temp1);
    }
    out.push(temp);
  }
  return out;
}

function u_getLilelihood(data){
  var out = new Array();
  for (var i = 0; i < data.length; i++) {
    var temp = new Array();
    for (var j = 0; j < 4; j++) {
      var likelihood = 1;
      for (var k = 0; k < 6; k++) {
        likelihood = (parseFloat(likelihood) * parseFloat(data[i][j][k])).toPrecision(6);
      }
      temp.push(likelihood);
    }
    out.push(temp);
  }
  return out;
}

function u_getProbAkhir(likelihood){
  var out = new Array();
  for (var i = 0; i < likelihood.length; i++) {
    var temp = new Array();
    var sum = (parseFloat(likelihood[i][0]) + parseFloat(likelihood[i][1]) + parseFloat(likelihood[i][2]) + parseFloat(likelihood[i][3]));
    for (var j = 0; j < 4; j++) {
      var probAkhir = (likelihood[i][j] / sum).toPrecision(6);
      temp.push(probAkhir);
    }
    out.push(temp);
  }
  return out;
}

function u_getKatBayes(probAkhir, dataUji){
  var out = new Array();
  for (var i = 0; i < probAkhir.length; i++) {
    var max = Math.max(probAkhir[i][0], probAkhir[i][1], probAkhir[i][2], probAkhir[i][3]);
    if (probAkhir[i][0] == max) {
      var kat = "baik";
    }
    else if (probAkhir[i][1] == max) {
      var kat = "sedang";
    }
    else if (probAkhir[i][2] == max) {
      var kat = "tidak sehat";
    }
    else if (probAkhir[i][3] == max) {
      var kat = "sangat tidak sehat";
    }

    if (kat == dataUji[i][7]) {
      var ok = "B";
    }
    else {
      var ok = "S";
    }
    out.push([kat, ok]);
  }
  return out;
}

function u_getAkurasiBayes(katAkhir){
  var out = new Array();
  var right = 0;
  for (var i = 0; i < katAkhir.length; i++) {
    if (katAkhir[i][1] == "B") {
      right++;
    }
  }
  var akurasi = ((right / katAkhir.length) * 100).toPrecision(5);
  out.push(akurasi);
  out.push(katAkhir.length);
  out.push(right);
  out.push(katAkhir.length - right);
  return out;
}

// UJI KNN //

function u_getJarakEuclidean(dataLatih, dataUji){
  var out = new Array();
  for (var i = 0; i < dataUji.length; i++) {
    var temp = new Array();
    for (var j = 0; j < dataLatih.length; j++) {
      var pm10 = Math.pow((dataLatih[j][2] - dataUji[i][2]),2).toFixed(5);
      var so2 = Math.pow((dataLatih[j][3] - dataUji[i][3]),2).toFixed(5);
      var co = Math.pow((dataLatih[j][4] - dataUji[i][4]),2).toFixed(5);
      var o3 = Math.pow((dataLatih[j][5] - dataUji[i][5]),2).toFixed(5);
      var no2 = Math.pow((dataLatih[j][6] - dataUji[i][6]),2).toFixed(5);
      var jarak = Math.sqrt(parseFloat(pm10) + parseFloat(so2) + parseFloat(co) + parseFloat(o3) + parseFloat(no2)).toFixed(5);
      temp.push(jarak);
    }
    out.push(temp);
  }
  return out;
}

function u_getJarakManhattan(dataLatih, dataUji){
  var out = new Array();
  for (var i = 0; i < dataUji.length; i++) {
    var temp = new Array();
    for (var j = 0; j < dataLatih.length; j++) {
      var pm10 = Math.abs((dataLatih[j][2] - dataUji[i][2]));
      var so2 = Math.abs((dataLatih[j][3] - dataUji[i][3]));
      var co = Math.abs((dataLatih[j][4] - dataUji[i][4]));
      var o3 = Math.abs((dataLatih[j][5] - dataUji[i][5]));
      var no2 = Math.abs((dataLatih[j][6] - dataUji[i][6]));
      var jarak = parseFloat(pm10) + parseFloat(so2) + parseFloat(co) + parseFloat(o3) + parseFloat(no2);
      temp.push(jarak);
    }
    out.push(temp);
  }
  return out;
}

function u_getJarakMinkowski(dataLatih, dataUji){
  var Lambda = 3;
  var out = new Array();
  for (var i = 0; i < dataUji.length; i++) {
    var temp = new Array();
    for (var j = 0; j < dataLatih.length; j++) {
      var pm10 = Math.pow( Math.abs((dataLatih[j][2] - dataUji[i][2])), Lambda);
      var so2 = Math.pow( Math.abs((dataLatih[j][3] - dataUji[i][3])), Lambda);
      var co = Math.pow( Math.abs((dataLatih[j][4] - dataUji[i][4])), Lambda);
      var o3 = Math.pow( Math.abs((dataLatih[j][5] - dataUji[i][5])), Lambda);
      var no2 = Math.pow( Math.abs((dataLatih[j][6] - dataUji[i][6])), Lambda);
      var jarak = Math.pow((parseFloat(pm10) + parseFloat(so2) + parseFloat(co) + parseFloat(o3) + parseFloat(no2)), 1/3).toFixed(5);
      temp.push(jarak);
    }
    out.push(temp);
  }
  return out;
}

function u_getSmallJarak(jarak, dataLatih, filter){
  var out = new Array();
  var jarak_temp = jarak.slice();

  for (var i = 0; i < jarak_temp.length; i++) {
    var temp = new Array();
    for (var j = 0; j < 5; j++) {

      if (filter == 'manhattan') {
        // Untuk Jarak Manhattan
        var min = Math.min.apply(null, jarak_temp[i]);
      }
      else {
        // Untuk Jarak euclidian dan minkowski
        var min = Math.min.apply(null, jarak_temp[i]).toFixed(5);
      }
      var index = jarak_temp[i].indexOf(min);
      jarak_temp[i][index] = 1000;
      temp.push([index, min, dataLatih[index][7]]);
    }
    for (var j = 0; j < temp.length; j++) {
      jarak[i][temp[j][0]] = temp[j][1];
    }
    out.push(temp);
  }
  return out;
}

function u_getKatKnn(smallJarak, dataUji){
  var out = new Array();
  for (var i = 0; i < smallJarak.length; i++) {
    var temp = new Array();
    var baik = 0;
    var sedang = 0;
    var tidakSehat = 0;
    var sangatTdkSehat = 0;
    var target = dataUji[i][7];

    temp.push(target);

    for (var j = 0; j < 5; j++) {
      if (smallJarak[i][j][2] == "baik") {
        baik++;
      }
      else if (smallJarak[i][j][2] == "sedang") {
        sedang++;
      }
      else if (smallJarak[i][j][2] == "tidak sehat") {
        tidakSehat++;
      }
      else if (smallJarak[i][j][2] == "sangat tidak sehat") {
        sangatTdkSehat++;
      }
      else {
        console.log("Error In getKatKnn");
        break;
      }

    }
    max = Math.max(baik, sedang, tidakSehat, sangatTdkSehat);
    if (baik == max) {
      var kat = "baik";
    }
    else if (sedang == max) {
      var kat = "sedang";
    }
    else if (tidakSehat == max) {
      var kat = "tidak sehat";
    }
    else if (sangatTdkSehat == max) {
      var kat = "sangat tidak sehat";
    }
    else {
      console.log("error in get Kat Knn");
      break;
    }

    temp.push(kat);

    if (kat == target) {
      temp.push("B");
    }
    else {
      temp.push("S");
    }
    out.push(temp);
  }
  return out;
}

function u_getAkurasiKnn(kat_knn){
  var out = new Array();
  var right = 0;
  for (var i = 0; i < kat_knn.length; i++) {
    if (kat_knn[i][2] == "B") {
      right++;
    }
  }

  var akurasi = ((right/kat_knn.length) * 100).toPrecision(6);
  out.push(akurasi);
  out.push(kat_knn.length);
  out.push(right);
  out.push(kat_knn.length - right);
  return out;
}
