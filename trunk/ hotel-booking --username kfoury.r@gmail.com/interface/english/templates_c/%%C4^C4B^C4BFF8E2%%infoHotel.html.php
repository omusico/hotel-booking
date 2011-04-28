<?php /* Smarty version 2.6.19, created on 2011-04-27 17:40:22
         compiled from infoHotel.html */ ?>
<div id="hotel_info">
<?php if ($this->_tpl_vars['_REQUEST']['msg']): ?><div class="msg"><?php if ($this->_tpl_vars['_REQUEST']['msg'] == 'success'): ?>Your changes were successfully saved.<?php endif; ?></div><?php endif; ?>
<form method="post" action="/actions/doHotel.php">
<?php if ($this->_tpl_vars['hotel']): ?>
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['hotel']['hotelid']; ?>
" />
<input type="hidden" name="action" value="edit" />
<?php else: ?>
<input type="hidden" name="action" value="add" />
<?php endif; ?>
	<div class="contentBox">
	<div class="title"><?php if ($this->_tpl_vars['hotel']): ?>Edit: <?php echo $this->_tpl_vars['hotel']['hotelname']; ?>
<?php else: ?>Add New Hotel<?php endif; ?></div>
	<fieldset>
	<legend>Info</legend>
	<div class="leftitem">Hotel Name</div>
	<div class="rightitem"><input type="text" name="hotelname" size="50" value="<?php echo $this->_tpl_vars['hotel']['hotelname']; ?>
" /></div><br/><br/>
	<div id="countrySelect">
	<div class="leftitem">Country</div>
	<div class="rightitem"><select name="countryid">
		<option value="">Select a country</option>
		<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?><option value="<?php echo $this->_tpl_vars['i']['countryid']; ?>
" <?php if ($this->_tpl_vars['location']['countryid'] == $this->_tpl_vars['i']['countryid']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']['countryname']; ?>
</option><?php endforeach; endif; unset($_from); ?>
	</select></div><br /><br />
	</div>
	<?php if ($this->_tpl_vars['hotel']): ?>
	<div id="locationSelect">
	<div class="leftitem">Location</div>
	<div class="rightitem"><select name="locationid"><?php $_from = $this->_tpl_vars['locations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?><option value="<?php echo $this->_tpl_vars['i']['locationid']; ?>
" <?php if ($this->_tpl_vars['hotel']['locationid'] == $this->_tpl_vars['i']['locationid']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']['locationname']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></div><br /><br/>
	</div>
	<?php else: ?>
	<div id="locationSelect" class="hidden">
	<div class="leftitem">Location</div>
	<div class="rightitem"></div><br /><br />
	</div>
	<?php endif; ?>
	<div class="leftitem">Rating</div>
	<div class="rightitem"><select name='rating'>
		<option value='1' <?php if ($this->_tpl_vars['hotel']['rating'] == '1'): ?>selected="selected"<?php endif; ?>>1</option>
		<option value='2' <?php if ($this->_tpl_vars['hotel']['rating'] == '2'): ?>selected="selected"<?php endif; ?>>2</option>
		<option value='3' <?php if ($this->_tpl_vars['hotel']['rating'] == '3'): ?>selected="selected"<?php endif; ?>>3</option>
		<option value='4' <?php if ($this->_tpl_vars['hotel']['rating'] == '4'): ?>selected="selected"<?php endif; ?>>4</option>
		<option value='5' <?php if ($this->_tpl_vars['hotel']['rating'] == '5'): ?>selected="selected"<?php endif; ?>>5</option>
	</select></div><br /><br/>
	<div class="leftitem">Type</div>
	<div class="rightitem"><select name='type'>
		<option value='all' <?php if ($this->_tpl_vars['hotel']['type'] == 'all'): ?>selected="selected"<?php endif; ?>>All</option>
		<option value='business' <?php if ($this->_tpl_vars['hotel']['type'] == 'business'): ?>selected="selected"<?php endif; ?>>Business</option>
		<option value='tourism' <?php if ($this->_tpl_vars['hotel']['type'] == 'tourism'): ?>selected="selected"<?php endif; ?>>Tourism</option>
	</select></div><br /><br/>
	</fieldset>
	<fieldset>
		<legend>Services</legend>
		<div class="leftitem">WiFi</div>
		<div class="rightitem"><select name='wifi'>
			<option value='no' <?php if ($this->_tpl_vars['hotel']['wifi'] == 'all'): ?>selected="selected"<?php endif; ?>>No</option>
			<option value='paid' <?php if ($this->_tpl_vars['hotel']['wifi'] == 'paid'): ?>selected="selected"<?php endif; ?>>Paid</option>
			<option value='free' <?php if ($this->_tpl_vars['hotel']['wifi'] == 'free'): ?>selected="selected"<?php endif; ?>>Free</option>
		</select></div><br /><br />
		<div class="leftitem">Internet</div>
		<div class="rightitem"><select name='internet'>
			<option value='none' <?php if ($this->_tpl_vars['hotel']['internet'] == 'none'): ?>selected="selected"<?php endif; ?>>None</option>
			<option value='lobbyonly' <?php if ($this->_tpl_vars['hotel']['internet'] == 'lobbyonly'): ?>selected="selected"<?php endif; ?>>Lobby Only</option>
			<option value='cable' <?php if ($this->_tpl_vars['hotel']['internet'] == 'cable'): ?>selected="selected"<?php endif; ?>>Cable</option>
			<option value='wireless' <?php if ($this->_tpl_vars['hotel']['internet'] == 'wireless'): ?>selected="selected"<?php endif; ?>>Wireless</option>
		</select></div><br /><br />
		<div class="leftitem">Parking</div>
		<div class="rightitem"><select name='parking'>
			<option value='none' <?php if ($this->_tpl_vars['hotel']['parking'] == 'none'): ?>selected="selected"<?php endif; ?>>None</option>
			<option value='self' <?php if ($this->_tpl_vars['hotel']['parking'] == 'self'): ?>selected="selected"<?php endif; ?>>Self</option>
			<option value='valet' <?php if ($this->_tpl_vars['hotel']['parking'] == 'valet'): ?>selected="selected"<?php endif; ?>>Valet</option>
			<option value='both' <?php if ($this->_tpl_vars['hotel']['parking'] == 'both'): ?>selected="selected"<?php endif; ?>>Self & Valet</option>
		</select></div><br /><br />
		<div class="leftitem">Number of Restaurants:</div>
		<div class="rightitem"><input type="text" name="restaurants" size="4" value="<?php echo $this->_tpl_vars['hotel']['restaurants']; ?>
" /></div><br/><br />
		<div class="hotelOptions">
		<div class="leftitem">Pool</div>
		<div class="rightitem"><input type="checkbox" name="pool" value="1" <?php if ($this->_tpl_vars['hotel']['pool'] == '1'): ?>checked="checked"<?php endif; ?> /></div>
		<div class="leftitem">Bar</div>
		<div class="rightitem"><input type="checkbox" name="bar" value="1" <?php if ($this->_tpl_vars['hotel']['bar'] == '1'): ?>checked="checked"<?php endif; ?> /></div>
		<div class="leftitem">Gym</div>
		<div class="rightitem"><input type="checkbox" name="gym" value="1" <?php if ($this->_tpl_vars['hotel']['gym'] == '1'): ?>checked="checked"<?php endif; ?> /></div>
		<div class="leftitem">Spa</div>
		<div class="rightitem"><input type="checkbox" name="spa" value="1" <?php if ($this->_tpl_vars['hotel']['spa'] == '1'): ?>checked="checked"<?php endif; ?> /></div>
		<div class="leftitem">Laundry</div>
		<div class="rightitem"><input type="checkbox" name="laundry" value="1" <?php if ($this->_tpl_vars['hotel']['laundry'] == '1'): ?>checked="checked"<?php endif; ?> /></div>
		<div class="leftitem">Disable Friendly</div>
		<div class="rightitem"><input type="checkbox" name="disable_friendly" value="1" <?php if ($this->_tpl_vars['hotel']['disable_friendly'] == '1'): ?>checked="checked"<?php endif; ?> /></div>
		<div class="leftitem">Gay Friendly</div>
		<div class="rightitem"><input type="checkbox" name="gay_friendly" value="1" <?php if ($this->_tpl_vars['hotel']['gay_friendly'] == '1'): ?>checked="checked"<?php endif; ?> /></div>
		<div class="leftitem">Pets</div>
		<div class="rightitem"><input type="checkbox" name="pets" value="1" <?php if ($this->_tpl_vars['hotel']['pets'] == '1'): ?>checked="checked"<?php endif; ?> /></div>
		<div class="leftitem">Meeting Rooms</div>
		<div class="rightitem"><input type="checkbox" name="meetingrooms" value="1" <?php if ($this->_tpl_vars['hotel']['meetingrooms'] == '1'): ?>checked="checked"<?php endif; ?> /></div>
		<div class="leftitem">Airport Shuttle</div>
		<div class="rightitem"><input type="checkbox" name="airport_shuttle" value="1" <?php if ($this->_tpl_vars['hotel']['airport_shuttle'] == '1'): ?>checked="checked"<?php endif; ?> /></div>
		<div class="leftitem">Shopping Center</div>
		<div class="rightitem"><input type="checkbox" name="shopping_center" value="1" <?php if ($this->_tpl_vars['hotel']['shopping_center'] == '1'): ?>checked="checked"<?php endif; ?> /></div>
		<div class="leftitem">Express Check-in</div>
		<div class="rightitem"><input type="checkbox" name="express_checking" value="1" <?php if ($this->_tpl_vars['hotel']['express_checking'] == '1'): ?>checked="checked"<?php endif; ?> /></div>
		<div class="leftitem">Non-Smoking</div>
		<div class="rightitem"><input type="checkbox" name="nonsmokingareas" value="1" <?php if ($this->_tpl_vars['hotel']['nonsmokingareas'] == '1'): ?>checked="checked"<?php endif; ?> /></div>
		<div class="leftitem">Safe-Deposit Box</div>
		<div class="rightitem"><input type="checkbox" name="safedepositbox" value="1" <?php if ($this->_tpl_vars['hotel']['safedepositbox'] == '1'): ?>checked="checked"<?php endif; ?> /></div>
		<div class="leftitem">Luggage Storage</div>
		<div class="rightitem"><input type="checkbox" name="luggagestorage" value="1" <?php if ($this->_tpl_vars['hotel']['luggagestorage'] == '1'): ?>checked="checked"<?php endif; ?> /></div>
		</div>
	</fieldset>
	<input type="submit" class="button" value="Save Changes" />
	</div>
</form>
</div>