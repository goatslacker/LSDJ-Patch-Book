var Instr = ['volume','arpeggio','pitch','hi_pitch','duty_noise'];
var InstrVal = ['','','','','']; // may be obsolete

function FT_Init(val) { //	initializes the sequencer for parsing MML
  var Key = Instr.getKey(val);

  var mml = $('mml').value.split(" ");
  FT_Clear();
  return mml;
}

function FT_Clear() { // Clears sequencer data
  var clearMe = $$('bar');
  if (clearMe) {
	for (var i=0; i<clearMe.length; i++) {
	  $('sequence').removeChild(clearMe[i]);
	}
  }
}

function FT_Bar(val,i,mml) { // sets the height, width and bottom parameters
  var bar_height = 0;
  var bar_bottom = 0;
  if (val == "volume") {
    bar_height = mml[i] * 10;
    bar_bottom = 0;
  }
  else if (val == "arpeggio") {
	bar_height = 14;
	bar_bottom = 75 + (parseInt(mml[i]) + (13 * i));
  }
  else if (val == "pitch" || val == "hi_pitch") {
	if (mml[i] < 0) {
	  bar_height = (mml[i] * -1)/1.7;
	  bar_bottom = 75 - bar_height;
	} else {
	  bar_height = mml[i]/1.7;
	  bar_bottom = 75;
	}
  }
  else if (val == "duty_noise") {
	bar_height = mml[i] * 50;
	bar_bottom = 0;
  }
  return [bar_height, bar_bottom];
}

function FT_Validate(val,mml) {
  //if (mml > 15 || Validate({ validate: mml, is: "numeric" }) == false) mml = 15; <<< the numeric validate sux balls
  if (val == "volume") {
	if (mml > 15) return 15;
  }
  else if (val == "arpeggio" || val == "pitch" || val == "hi_pitch") {
	if (mml > 126) return 126;
	if (mml < -127) return -127;
  }
  else if (val == "duty_noise") {
	if (mml > 3) return 3;
  }
  return mml;
}

function FT_Duty_Noise() {
  var mml = FT_Init();
}

function FT_Parse() { // parses the volume MML
  var val = $('editing').innerHTML;
  var mml = FT_Init(val);

  for(var i=0; i<mml.length; i++) {
	mml[i] = FT_Validate(val,mml[i]); // validates

	// creates element
	var span = document.createElement('span');
	span.className = 'bar';

	// get parameters
	var bar = FT_Bar(val,i,mml);
    var bar_width = (300 / mml.length) - 1;
	// set parameters

	span.style.height = bar[0] + 'px';
	span.style.width = bar_width + 'px';
	span.style.left = (bar_width * i) + i + 'px';
	span.style.bottom = bar[1] + 'px';

	$('sequence').appendChild(span);
  }
  $(val).value = mml;
}

function FT_Edit(val) { // resets the sequence editor
  var clearMe = $$('Br');
  var InstrLen = 0;
  if (clearMe) {
	for (var i=0; i<clearMe.length; i++) {
	  $('sequence').removeChild(clearMe[i]);
	}
  }
  FT_Clear(); // clear data

  $('editing').innerHTML = val;

  // set number of bars
  if (val == 'volume') InstrLen = 15;
  else if(val == 'arpeggio') InstrLen = 10;
  else if(val == 'duty_noise') InstrLen = 3;
  else InstrLen = 2;

  for (var i=0; i<InstrLen; i++) {
	var li = document.createElement('li');
	li.className = 'Br';
	var InstrHeight = 150/InstrLen;
	li.style.height = (InstrHeight-1) + 'px';
	$('sequence').appendChild(li);
  }
  var Key = Instr.getKey(val);

  // load default data
  $('mml').value = $(val).value.split(",").join(" ");
  if ($('mml').value != '') FT_Parse();
}
