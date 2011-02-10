<?php
 
class universeFilter extends sfFilter
{
  public function execute ($filterChain)
  {
	//set default tag
	sfConfig::set('app_tag', "LSDJ");
	// maintenace mode:
	if (sfConfig::get('app_maintenance') && $this->isFirstCall()) {
	  die("The Patch Book is currently undergoing maintenance. Please check back at a later time.");
	}
    // execute this filter only once
    if (sfConfig::get('app_universe') && $this->isFirstCall())
    {
	  // is there a tag in the hostname?
	  $hostname = $this->getContext()->getRequest()->getHost();
	  if (!preg_match($this->getParameter('host_exclude_regex'), $hostname) && $pos = strpos($hostname, '.'))
	  {
	    $tag = Tag::normalize(substr($hostname, 0, $pos));
 
	    // add a permanent tag custom configuration parameter
		if ($tag == "lsdj") $tag = "LSDJ";
		else if ($tag == "famitracker" || $tag == "ft") $tag = "FamiTracker";
		else if ($tag == "goattracker") $tag = "goattracker";

	    sfConfig::set('app_tag', $tag);

	    // add a custom stylesheet/javascript
	    $this->getContext()->getResponse()->addStylesheet($tag);
	    $this->getContext()->getResponse()->addJavascript($tag);
	  }
    }
 
    // execute next filter
    $filterChain->execute();
  }
}
 
?>
