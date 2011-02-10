<? $INS = $INS ? $INS : new FamiTracker; ?>
<div id="FamiTracker">
  <div id="instrument_settings">
        <h3>Instrument Settings</h3>
    <?php echo checkbox_tag("volume",$INS->volume,""); ?> <a href="javascript:;" onclick="FT_Edit('volume')">Volume</a><br />
    <?php echo checkbox_tag("arpeggio",$INS->arpeggio,""); ?> <a href="javascript:;" onclick="FT_Edit('arpeggio')">Arpeggio</a><br />
    <?php echo checkbox_tag("pitch",$INS->pitch,""); ?> <a href="javascript:;" onclick="FT_Edit('pitch')">Pitch</a><br />
    <?php echo checkbox_tag("hi_pitch",$INS->hi_pitch,""); ?> <a href="javascript:;" onclick="FT_Edit('hi_pitch')">Hi-Pitch</a><br />
    <?php echo checkbox_tag("duty_noise",$INS->duty_noise,""); ?> <a href="javascript:;" onclick="FT_Edit('duty_noise')">Duty / Noise</a><br />
  <h3 id="editing"></h3>
  </div>

  <div id="sequence_editor">
        <ol id="sequence">
        </ol>
    <strong>MML</strong> <?php echo input_tag("mml"); ?><input type="button" name="parse" id="parse" value="parse" onclick="FT_Parse()" /><br />
  </div>
  <br class="clearFloat" />
</div>
