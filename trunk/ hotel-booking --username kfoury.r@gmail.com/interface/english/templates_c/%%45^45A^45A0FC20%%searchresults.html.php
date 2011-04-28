<?php /* Smarty version 2.6.19, created on 2011-04-27 19:58:57
         compiled from searchresults.html */ ?>
<div id="hotelList">
<form method="post" action="/actions/doHotel.php">
<?php if ($this->_tpl_vars['hotels']): ?>
	<h2>These are the hotels we found for you:</h2>
	<?php $_from = $this->_tpl_vars['hotels']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
	<div class="searchresult_row">
		<div class="hotel_image"><a href="/hotel.php?id=<?php echo $this->_tpl_vars['i']['hotelid']; ?>
"><img src="/images/hotel.gif"/></a></div>
		<div class="hotel_info"><a href="/hotel.php?id=<?php echo $this->_tpl_vars['i']['hotelid']; ?>
"><h3><?php echo $this->_tpl_vars['i']['hotelname']; ?>
</h3></a>
		<span class="titleBold">Location:</span> <?php echo $this->_tpl_vars['i']['country']['countryname']; ?>
, <?php echo $this->_tpl_vars['i']['location']['locationname']; ?>
 - <span class="titleBold">Rating:</span> <img src="/images/rating/rating<?php echo $this->_tpl_vars['i']['rating']; ?>
.png" alt="Rating" title="This hotel has a rating of <?php echo $this->_tpl_vars['i']['rating']; ?>
 stars."/> - <span class="titleBold">Type:</span> <?php if ($this->_tpl_vars['i']['type'] == 'all'): ?>business/tourism<?php else: ?><?php echo $this->_tpl_vars['i']['type']; ?>
<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>
	<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
	We couldn't find any hotels matching your criteria, please <a href=".">try again</a>.
<?php endif; ?>
</table>
</div>