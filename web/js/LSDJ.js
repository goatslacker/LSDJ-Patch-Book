function validateLsdjTable(input) { // validates an lsdj table
  var cmd = input.value.substr(0,1).toUpperCase();
  var _cmd = isLSDJCommand(cmd);

  if (cmd != 'O' && cmd != 'W') {
    var val = input.value.substr(1,2).toUpperCase();
    var _val = (Validate({validate: val, is: 'hex'}) === true)? true:false;
	input.value = (_cmd == true && _val == true) ? cmd+val : input.title;
  }
}

function isLSDJCommand(val) {
  var command = "ACEFGHKLMOPRSTVW";
  for (var a=0;a<command.length;a++) {
	if (val == command.substr(a,1)) return true;
  }
  return false;
}

function changeINStype(inst) {
  location.href=location.pathname+'?type='+inst;
}

function special_hex_check(input) {
  var ret = input.value.toUpperCase();
  var tt = input.name;

  if (tt == 'length' && input.size == 4) return(/^[0-3][0-9A-F]$/.test(ret) == true || ret == 'UNLIM')?ret:input.title; // length validation: 00-3F + UNLIM
  else if (tt == 'start_phase' || tt == 'end_phase') return(/^[0-1][0-9A-F]$/.test(ret) == true)?ret:input.title; // phase validation: 00-1F
  else return(/^[0-9A-F]$/.test(ret) == true)?ret:input.title; // single validation: 0-F
}

function lsdj_table(e,input) {
  var Key = window.event ? window.event.keyCode : e.keyCode;
  var _val = false;
  if (Key === 87) { // wave
	while (_val == false) {
	  var val = prompt("Wave Type? (12.5, 25, 50, 75)");
	  _val = (val === '12.5' || val === '25' || val === '50' || val === '75')? true:false;
	}
	input.value = input.value.toUpperCase() + val;
  } else if (Key === 79) { // output
	while (_val == false) {
	  var val = prompt("Output Value? (L = Left , R = Right)").toUpperCase();
	  _val = (val === 'L' || val === 'R')? true:false;
	}
	input.value = (val === 'R')? input.value.toUpperCase() + ' ' + val : input.value.toUpperCase() + val;
  }
}
