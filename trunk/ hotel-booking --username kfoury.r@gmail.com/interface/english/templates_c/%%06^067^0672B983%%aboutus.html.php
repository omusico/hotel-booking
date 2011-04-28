<?php /* Smarty version 2.6.19, created on 2011-04-27 19:39:50
         compiled from aboutus.html */ ?>
<div id="LeftCol">
	<div id="sideBox">
	<div class="title">Search Hotels</div>
	<form method="get" action="searchresults.php">	
	<input type="hidden" name="locationid" id="locationid" value="" />
		Destination<br />
		<input type="text" id="searchDestination" class="defaultValue" value="type your location..." originalValue="type your location..." size="30" /><br />
		<br />
		Check-in on<br />
		<input type="text" class="datepicker" /><br />
		<br />
		Check-out on<br />
		<input type="text" class="datepicker" /><br />
		<br />
		Adults <select name="adults">
		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['start'] = (int)1;
$this->_sections['i']['loop'] = is_array($_loop=101) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
if ($this->_sections['i']['start'] < 0)
    $this->_sections['i']['start'] = max($this->_sections['i']['step'] > 0 ? 0 : -1, $this->_sections['i']['loop'] + $this->_sections['i']['start']);
else
    $this->_sections['i']['start'] = min($this->_sections['i']['start'], $this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] : $this->_sections['i']['loop']-1);
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
		<option value="<?php echo $this->_sections['i']['index']; ?>
"><?php echo $this->_sections['i']['index']; ?>
</option>
		<?php endfor; endif; ?>
		</select>
		Children <select name="children">
		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['start'] = (int)1;
$this->_sections['i']['loop'] = is_array($_loop=101) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
if ($this->_sections['i']['start'] < 0)
    $this->_sections['i']['start'] = max($this->_sections['i']['step'] > 0 ? 0 : -1, $this->_sections['i']['loop'] + $this->_sections['i']['start']);
else
    $this->_sections['i']['start'] = min($this->_sections['i']['start'], $this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] : $this->_sections['i']['loop']-1);
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
		<option value="<?php echo $this->_sections['i']['index']; ?>
"><?php echo $this->_sections['i']['index']; ?>
</option>
		<?php endfor; endif; ?>
		</select><br />
		<br />
		<input type="submit" class="button" value="Search" /> 
		<input type="button" class="button" value="Choose more options" /> 
	</form>
	</div>
	<div id="sideBox">
		<div class="title">Recent Bookings</div>
	</div>
</div>
	

<div id="center">
<div id="textBox">
<h1>Why Use Booking Lebanon?</h1>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sit amet fermentum nibh. Phasellus ullamcorper mi egestas augue dictum a vehicula arcu fermentum. Vivamus viverra congue ligula et blandit. Vivamus tincidunt blandit lorem sed tempor. Nullam quis elit nec felis tempor volutpat id eu risus. Aenean fringilla ligula a massa lobortis non porttitor dolor ultrices. Morbi consectetur felis nec erat mollis porta. Vivamus ut tortor neque. Aenean vel ornare magna. Praesent lacinia ante arcu. Maecenas bibendum venenatis viverra. Pellentesque at augue a tortor convallis dictum ut ac erat. Donec vel justo turpis. Suspendisse id mi risus, sit amet molestie tellus. Duis molestie quam in urna bibendum lacinia. Vivamus vel velit orci. Pellentesque nec odio lorem.
<br /><br />
Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse consectetur, orci faucibus tincidunt gravida, nunc nulla dapibus mauris, at vestibulum erat libero vel orci. Pellentesque ac auctor ligula. Suspendisse non leo in est porta scelerisque eu sed augue. Phasellus diam elit, dapibus vel porta eget, dignissim interdum augue. Aliquam erat volutpat. In orci orci, euismod id elementum et, luctus at magna. Proin vestibulum nibh at lorem venenatis vel ultricies sem tempor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse potenti. In consequat mattis urna.
<h1>Who We Are?</h1>
Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse consectetur, orci faucibus tincidunt gravida, nunc nulla dapibus mauris, at vestibulum erat libero vel orci. Pellentesque ac auctor ligula. Suspendisse non leo in est porta scelerisque eu sed augue. Phasellus diam elit, dapibus vel porta eget, dignissim interdum augue. Aliquam erat volutpat. In orci orci, euismod id elementum et, luctus at magna. Proin vestibulum nibh at lorem venenatis vel ultricies sem tempor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse potenti. In consequat mattis urna.
</div>

</div>