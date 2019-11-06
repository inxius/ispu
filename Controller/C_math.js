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

// U NAIVE BAYES //

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
