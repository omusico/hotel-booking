<?php /* Smarty version 2.6.19, created on 2011-04-27 15:29:01
         compiled from hotels.html */ ?>

<div id="hotelList">
<?php if ($this->_tpl_vars['_REQUEST']['delete']): ?><div class="msg">The hotel has been deleted. All associated reservations, rooms, and other data have been removed.</div><?php endif; ?>
<form method="post" action="/actions/doHotel.php">
<div style="font-size: 16px; font-weight: bold; padding-bottom: 10px">Hotels List</div>
<table border="1" cellpadding="5" style="border-collapse: collapse">
<tr>
	<th>ID</th>
	<th>Name</th>
	<th>Country</th>
	<th>Location</th>
	<th>Rating</th>
	<th>Type</th>
	<th>Actions</th>
</tr>
<?php $_from = $this->_tpl_vars['hotels']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
<tr>
	<td><?php echo $this->_tpl_vars['i']['hotelid']; ?>
</td>
	<td><?php echo $this->_tpl_vars['i']['hotelname']; ?>
</td>
	<td><?php echo $this->_tpl_vars['i']['country']['countryname']; ?>
</td>
	<td><?php echo $this->_tpl_vars['i']['location']['locationname']; ?>
</td>
	<td><?php echo $this->_tpl_vars['i']['rating']; ?>
</td>
	<td><?php echo $this->_tpl_vars['i']['type']; ?>
</td>
	<td><a href="infoHotel.php?id=<?php echo $this->_tpl_vars['i']['hotelid']; ?>
"><img src="/images/edit.png" alt="Edit" title="Edit" /></a> <a href="javascript:if (confirm('Are you sure you want to delete this hotel? This will remove all related reservations permanently.')) window.location = '/actions/doHotel.php?action=remove&id=<?php echo $this->_tpl_vars['i']['hotelid']; ?>
'"><img src="/images/remove.png" alt="Remove" title="Remove" /></a></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>