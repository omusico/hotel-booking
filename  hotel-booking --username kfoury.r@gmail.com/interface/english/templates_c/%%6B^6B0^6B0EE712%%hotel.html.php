<?php /* Smarty version 2.6.19, created on 2011-04-27 19:36:10
         compiled from hotel.html */ ?>
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
<h1><?php echo $this->_tpl_vars['hotel']['hotelname']; ?>
</h1>
<div class="hotel_profile_image"><img src="/images/hotel.gif" style="width: 400px;"/></div>
<div id="hotel_contact"><h2>Contact</h2></div>
<div id="hotel_services"><h2>Services</h2>
	<div>
		<?php if ($this->_tpl_vars['hotel']['wifi'] != 'none'): ?><img src="/images/services/wifi.png" alt="Wifi" title="The hotel has WiFi."/><?php endif; ?>
		<?php if ($this->_tpl_vars['hotel']['disable_friendly'] == 1): ?><img src="/images/services/disable_friendly.png" alt="Disable Friendly" title="The hotel is disable friendly."/><?php endif; ?>
		<?php if ($this->_tpl_vars['hotel']['gay_friendly'] == 1): ?><img src="/images/services/gay_friendly.png" alt="Gay Friendly" title="The hotel is gay friendly."/><?php endif; ?>
		<?php if ($this->_tpl_vars['hotel']['express_checking'] == 1): ?><img src="/images/services/express_checking.png" alt="Express Check-in" title="The hotel allows express check-out/in."/><?php endif; ?>
		<?php if ($this->_tpl_vars['hotel']['nonsmokingareas'] == 1): ?><img src="/images/services/nonsmokingareas.png" alt="Non-Smoking" title="The hotel has non-smoking areas."/><?php endif; ?>
	</div>
	<div>
		<?php if ($this->_tpl_vars['hotel']['pool'] == 1): ?><img src="/images/services/pool.png" alt="Pool" title="The hotel has a pool."/><?php endif; ?>
		<?php if ($this->_tpl_vars['hotel']['gym'] == 1): ?><img src="/images/services/gym.png" alt="Gym" title="The hotel has a gym."/><?php endif; ?>
		<?php if ($this->_tpl_vars['hotel']['spa'] == 1): ?><img src="/images/services/spa.png" alt="Spa" title="The hotel has a spa."/><?php endif; ?>
		<?php if ($this->_tpl_vars['hotel']['bar'] == 1): ?><img src="/images/services/bar.png" alt="Bar" title="The hotel has a bar."/><?php endif; ?>
		<?php if ($this->_tpl_vars['hotel']['luggaestorage'] == 1): ?><img src="/images/services/spa.png" alt="Luggage Storage" title="The hotel has a luggage storage."/><?php endif; ?>
	</div>
	<div>
		<?php if ($this->_tpl_vars['hotel']['laundry'] == 1): ?><img src="/images/services/laundry.png" alt="Laundry" title="The hotel has laundry services."/><?php endif; ?>
		<?php if ($this->_tpl_vars['hotel']['safedepositbox'] == 1): ?><img src="/images/services/safedepositbox.png" alt="Safe-Deposit Box" title="The hotel has Safe-Deposit boxes."/><?php endif; ?>
		<?php if ($this->_tpl_vars['hotel']['pets'] == 1): ?><img src="/images/services/pets.png" alt="Pets" title="The hotel allows pets."/><?php endif; ?>
		<?php if ($this->_tpl_vars['hotel']['mettingrooms'] == 1): ?><img src="/images/services/mettingrooms.png" alt="Meeting Rooms" title="The hotel has metting rooms."/><?php endif; ?>
		<?php if ($this->_tpl_vars['hotel']['airport_shuttle'] == 1): ?><img src="/images/services/airport_shuttle.png" alt="Airport Shuttle" title="The hotel has an airport shuttle.."/><?php endif; ?>
		<?php if ($this->_tpl_vars['hotel']['shopping_center'] == 1): ?><img src="/images/services/shopping_center.png" alt="Shopping Center" title="The hotel has a shopping center."/><?php endif; ?>
	</div>
</div>
<div id="hotel_rating"><h2>Rating</h2>
	<?php if ($this->_tpl_vars['hotel']['rating']): ?>
	<img src="/images/rating/rating<?php echo $this->_tpl_vars['hotel']['rating']; ?>
.png" alt="Rating" title="This hotel has a rating of <?php echo $this->_tpl_vars['hotel']['rating']; ?>
 stars."/>
	<?php endif; ?>
</div>
<div id="hotel_reviews"><h2>Availability</h2></div>
<div id="hotel_reviews"><h2>Reviews</h2></div>
<div id="hotel_rooms"><h2>Room Types</h2></div>
<div id="hotel_about"><h2>About <?php echo $this->_tpl_vars['hotel']['hotelname']; ?>
</h2></div>
</div>