function hex_check(input) { // double validation: 00-FF
  var ret = input.value.toUpperCase();
  return (Validate({validate: ret, is: 'hex'}) === true)? ret:input.title;
}

function whatsShare() {
  Lightbox({
	html: '<p>By choosing to share your instrument patch you are agreeing to distribute your patch through the following license:<br /><br /> <a rel="license" href="http://creativecommons.org/licenses/by/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by/3.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attribution 3.0 Unported License</a>.<br /><br />This basically means that you allow anyone to freely share, build upon, or modify this patch as long as there is proper attribution.<br /><br />Sharing is not mandatory and one may use this service as a private patch storage space.<br /><br /><small>Instruments you did not author are always shared and can not be changed unless specified by the original author.</small></p>',
    fade: true
  })
}

Array.prototype.getKey = function (compare) {
  var count = 0;
  for (key in this) {
	if (this[key] == compare) return count;
	count++;
  }
}
